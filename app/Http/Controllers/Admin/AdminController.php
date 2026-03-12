<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\Statistic;
use Illuminate\Support\Facades\DB;
use App\Models\Alert;

class AdminController extends Controller
{

    public function index()
    {
        $currentLocale = session('locale', config('app.locale'));
        $admins        = User::where('role_id', 1)->get();
        $currentAdmin  = auth()->user();
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        // Счётчик заказов текущего пользователя (НЕ трогаем дальше)
        $orderCount = Order::where('user_id', $currentAdmin->id)->count();

        // На всякий: чтобы compact() не падал — инициализируем пустым пагинатором
        $orders = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);

        // Счётчик заказов по событиям (если нужно)
        $eventOrderCounts = collect([]);
        if (in_array($currentAdmin->role_id, [1,2,3], true)) {
            $eventIds = Event::where('user_id', $currentAdmin->id)
                ->where('status', 1)
                ->pluck('id');

            foreach ($eventIds as $eventId) {
                $orderCountForEvent = Order::where('order_id', $eventId)->count(); // <-- не портим $orderCount
                $eventOrderCounts->push(['order_id' => $eventId, 'order_count' => $orderCountForEvent]);
            }
        }

        // Статистика
        if ($currentAdmin->role_id == 1) {
            $withEventsAll           = Statistic::all();
            $statisticsWithEventsType = collect();
        } else { // роли 2 и 3
            $withEventsAll            = collect();
            $statisticsWithEventsType = Statistic::join('events', 'statistics.event_id', '=', 'events.id')
                ->where('events.user_id', $currentAdmin->id)
                ->get();
        }

        $statisticsWithEvents = Statistic::join('events', 'statistics.event_id', '=', 'events.id')
            ->where('events.user_id', $currentAdmin->id)
            ->count();

        $statisticsWithEventsUnic = Statistic::select('statistics.*')
            ->join('events', 'statistics.event_id', '=', 'events.id')
            ->where('events.user_id', $currentAdmin->id)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('statistics as s2')
                    ->whereRaw('s2.event_id = events.id')
                    ->whereRaw('s2.ip = statistics.ip');
            })
            ->distinct()
            ->count();

        $eventsWithOrders = Event::query()
            ->where('events.user_id', $currentAdmin->id)
            ->leftJoin('orders', 'orders.order_id', '=', 'events.id')
            ->select([
                'events.id',
                'events.specialization',
                DB::raw('COUNT(orders.id) AS order_count'),
                DB::raw('MAX(orders.created_at) AS last_order_date'),
                DB::raw('COALESCE(SUM(orders.amount), 0) AS total_amount'),
            ])
            ->groupBy('events.id', 'events.specialization')
            ->orderByRaw('MAX(orders.created_at) IS NULL') // сначала у кого даты нет
            ->orderByRaw('MAX(orders.created_at) DESC')    // затем по дате
            ->get()
            ->map(function ($row) {
                $row->last_order_date = $row->last_order_date
                    ? \Carbon\Carbon::parse($row->last_order_date)
                    : null;
                return $row;
            });

        // ---- ВАЖНО: гарантируем наличие $orders для всех ролей ----
        if ($currentAdmin->role_id == 1) {
            // Админ: показываем его собственные заказы (если это и есть логика)
            $orders = Order::where('user_id', $currentAdmin->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } elseif (in_array($currentAdmin->role_id, [2,3], true)) {
            // Организатор/менеджер: заказы по его событиям
            $eventIds = Event::where('user_id', $currentAdmin->id)->pluck('id');
            $orders = Order::whereIn('order_id', $eventIds)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }
        // ----------------------------------------------------------

        $newOrderCount = Order::where('user_id', $currentAdmin->id)
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->count();

        $oldOrderCount = Order::where('user_id', $currentAdmin->id)
            ->where('created_at', '<', $thirtyDaysAgo)
            ->count();

        if (in_array($currentAdmin->role_id, [1,2,3], true)) {
            return view('admin.index', compact(
                'currentAdmin',
                'admins',
                'currentLocale',
                'orderCount',
                'statisticsWithEventsType',
                'withEventsAll',
                'statisticsWithEventsUnic',
                'statisticsWithEvents',
                'newOrderCount',
                'oldOrderCount',
                'orders',
                'eventsWithOrders'
            ));
        }

        return abort(403);
    }


    public function getOrdersWithStatus(Request $request)
    {
        $orders = Order::where('status', 0)->get();

        return response()->json($orders);
    }
    public function updateOrderDetails($orderId)
    {
        try {

            // 1. Находим заказ
            $order = Order::findOrFail($orderId);
            $codeID = $order->code;

// 2. Обновляем статус всех алертов с таким code
            Alert::where('code', $codeID)->update(['status' => 1]);

// 3. Обновляем сам заказ
            $order->status = 1;
            $order->save();


            // 4. Возвращаем JSON-ответ
            return response()->json([
                'success' => true,
                'message' => 'Статусы успешно обновлены',
                'order'   => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при обновлении',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function getOrderDetails($orderId)
    {

        $order = Order::findOrFail($orderId);
        $this->updateOrderDetails($orderId);

        return response()->json($order);
    }

    public function updateOrderStatus($orderId)
    {
        // Обновляем статус в таблице alerts
        Alert::where('order_id', $orderId)
            ->update(['status' => 0]);
        try {

            return response()->json(['message' => 'Статус заказа и связанных алертов успешно обновлен']);
        } catch (\Exception $e) {
            // В случае ошибки возвращаем сообщение об ошибке
            return response()->json(['error' => 'Не удалось обновить статус заказа и связанных алертов'], 500);
        }
    }

}

