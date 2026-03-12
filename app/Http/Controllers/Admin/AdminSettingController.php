<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Order;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\Statistic;
use Illuminate\Support\Facades\DB;
use App\Models\Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class AdminSettingController extends Controller
{
    public function confirmTelegram(Request $request)
    {
        $user = User::find($request->input('user_id'));

        if ($user && $request->filled('chat_id')) {
            $user->telegram_chat_id = $request->input('chat_id');
            $user->save();

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Не вдалося підключити Telegram. Спробуйте ще раз.']);
    }

    public function index()
    {

        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();
        $currentAdmin = auth()->user();
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $orderCount = Order::where('user_id', $currentAdmin->id)->count();
        $events = Event::where('user_id', $currentAdmin->id)
            ->get(['id', 'title as title', 'start_date as start', 'end_date as end']);



        $eventOrderCounts = collect([]);
        if ($currentAdmin->role_id == 1 || $currentAdmin->role_id == 3 || $currentAdmin->role_id == 2) {
            $eventIds = $events->pluck('id');
            foreach ($eventIds as $eventId) {
                $orderCount = Order::where('order_id', $eventId)->count();
                $eventOrderCounts->push(['order_id' => $eventId, 'order_count' => $orderCount]);
            }
        }

        if ($currentAdmin->role_id == 1) {
            $withEventsAll = Statistic::all();
            $statisticsWithEventsType = collect();
        } elseif ($currentAdmin->role_id == 3 || $currentAdmin->role_id == 2) {
            $withEventsAll = collect();
            $statisticsWithEventsType = Statistic::join('events', 'statistics.event_id', '=', 'events.id')
                ->where('events.user_id', $currentAdmin->id)
                ->get();
        }

        if ($currentAdmin->role_id == 1) {
            $orders = Order::where('user_id', $currentAdmin->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10000);
        } elseif ($currentAdmin->role_id == 3) {
            $eventIds = Event::where('user_id', $currentAdmin->id)->pluck('id');
            $orders = Order::whereIn('order_id', $eventIds)
                ->orderBy('created_at', 'desc')
                ->paginate(10000);
        }

        $newOrderCount = Order::where('user_id', $currentAdmin->id)
            ->where('created_at', '>=', $thirtyDaysAgo)
            ->count();
        $oldOrderCount = Order::where('user_id', $currentAdmin->id)
            ->where('created_at', '<', $thirtyDaysAgo)
            ->count();
        $statisticsWithEvents = Statistic::join('events', 'statistics.event_id', '=', 'events.id')
            ->where('events.user_id', $currentAdmin->id)
            ->count();
        $totalRecentOrders = Event::where('events.user_id', $currentAdmin->id)
            ->where('events.status', 1) // Учитываем только активные события
            ->join('orders', 'events.id', '=', 'orders.order_id') // Соединяем с таблицей заказов
            ->where('orders.created_at', '>=', Carbon::now()->subDays(3)) // Заказы за последние 3 дня
            ->count();
        $totalOrdersInActiveEvents = Event::where('events.user_id', $currentAdmin->id) // Уточняем таблицу
        ->where('events.status', 1) // Уточняем таблицу
        ->join('orders', 'events.id', '=', 'orders.order_id') // Соединяем с таблицей заказов
        ->count();

        // Считаем общую сумму заказов для всех активных событий
        $totalAmountInActiveEvents = Event::where('events.user_id', $currentAdmin->id) // Уточняем таблицу
        ->where('events.status', 1) // Учитываем только активные события
        ->join('orders', 'events.id', '=', 'orders.order_id') // Соединяем с таблицей заказов
        ->sum('orders.amount'); // Суммируем поле 'amount' из таблицы заказов
        $settings = Settings::orderBy('order')->get();
        $eventsWithOrders = $events->map(function ($event) {
            $orders = Order::where('order_id', $event->id);

            $event->order_count = $orders->count(); // Количество заказов
            $lastOrderDate = $orders->max('created_at'); // Дата последнего заказа
            $event->last_order_date = $lastOrderDate ? Carbon::parse($lastOrderDate) : null; // Преобразуем в Carbon или оставляем null
            $event->total_amount = $orders->sum('amount'); // Сумма всех заказов
            return $event;
        });
        return view('admin.settings.index', compact('settings','eventsWithOrders','eventOrderCounts','statisticsWithEvents','totalOrdersInActiveEvents','totalAmountInActiveEvents','totalRecentOrders','currentAdmin'));
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:settings,key|max:255',
            'display_name' => 'required|max:255',
            'value' => 'nullable',
            'details' => 'nullable',
            'type' => 'required|max:255',
            'order' => 'required|integer',
            'group' => 'nullable|max:255'
        ]);

        Settings::create($request->all());

        return redirect()->route('admin.settings.index')->with('success', 'Настройка добавлена.');
    }

    public function edit($id)
    {
        $setting = Settings::findOrFail($id);
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = Settings::findOrFail($id);

        $request->validate([
            'key' => 'required|max:255|unique:settings,key,' . $id,
            'display_name' => 'required|max:255',
            'value' => 'nullable',
            'details' => 'nullable',
            'type' => 'required|max:255',
            'order' => 'required|integer',
            'group' => 'nullable|max:255'
        ]);

        $setting->update($request->all());

        return redirect()->route('admin.settings.index')->with('success', 'Настройка обновлена.');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'num_pay_card' => 'nullable|string|max:20',
            'record_datetime' => 'nullable|date',
            'country' => 'nullable|string|max:50', // Добавляем страну
        ]);

        $user = Auth::user();
        if (!$user) {
            return back()->with('error', 'Користувач не знайдений');
        }

        // Очистка номера телефона
        $cleanPhone = preg_replace('/[^0-9]/', '', $request->input('phone'));

        // Обновление данных пользователя
        $user->update([
            'name' => $request->input('name'),
            'phone' => $cleanPhone,
            'num_pay_card' => $request->input('num_pay_card'),
            'record_datetime' => $request->input('record_datetime'),
            'country' => $request->input('country'), // Сохраняем страну
        ]);

        return redirect()->back()->with('success', 'Дані оновлено успішно!');
    }





    public function destroy($id)
    {
        Settings::findOrFail($id)->delete();
        return redirect()->route('admin.settings.index')->with('success', 'Настройка удалена.');
    }
}

