<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;



class OrdersTrackingController extends Controller
{
    public function index(Request $request)
    {
        $theme = session('theme', 'darwin');

        $perPage = (int) $request->get('per_page', 10);
        $perPage = in_array($perPage, [5, 10, 20]) ? $perPage : 10;

        // ===== SORTING =====
        $sortable = [
            'order_number' => 'order_number',
            'created_at'   => 'created_at',
            'client'       => 'client',
            'status_1c'    => 'status_1c',
            'amount'       => 'amount',
        ];

        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        if (!array_key_exists($sort, $sortable)) {
            $sort = 'created_at';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        /*
         |--------------------------------------------------------------------------
         | 🔹 БАЗОВЫЙ ЗАПРОС (ВСЕГДА ОДИНАКОВЫЙ)
         |--------------------------------------------------------------------------
         */
        $baseQuery = Order::where('user_id', auth()->id());

        /*
         |--------------------------------------------------------------------------
         | 🔍 ПОИСК (общий)
         |--------------------------------------------------------------------------
         */
        if ($request->filled('q')) {
            $search = trim($request->q);

            $baseQuery->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhere('client', 'like', "%{$search}%");
            });
        }

        /*
         |--------------------------------------------------------------------------
         | 📅 ФИЛЬТР ПО ДАТЕ (общий)
         |--------------------------------------------------------------------------
         */
        if ($request->filled('date_range') && $request->date_range !== 'all') {
            $days = (int) $request->date_range;
            $baseQuery->where('created_at', '>=', now()->subDays($days));
        }

        /*
         |--------------------------------------------------------------------------
         | 🔢 СТАТИЧЕСКИЕ СЧЁТЧИКИ (НЕ ЗАВИСЯТ ОТ stage)
         |--------------------------------------------------------------------------
         */
        $statusCounts = (clone $baseQuery)
            ->selectRaw('status_1c, COUNT(*) as total')
            ->groupBy('status_1c')
            ->pluck('total', 'status_1c');

        $totalCount = (clone $baseQuery)->count();

        /*
         |--------------------------------------------------------------------------
         | 📋 ЗАПРОС ДЛЯ ТАБЛИЦЫ
         |--------------------------------------------------------------------------
         */
        $query = clone $baseQuery;

        /*
         |--------------------------------------------------------------------------
         | 🔽 ФИЛЬТР ПО ЭТАПУ (ТОЛЬКО ТАБЛИЦА)
         |--------------------------------------------------------------------------
         */
        if ($request->filled('stage')) {

            $stageMap = [
                'pogodzenya'   => 'Фин. контроль',
                'vyrobnytctvo' => 'Выполняется',
                'vykonano'     => 'Виконано',
                'reklamaciya'  => 'Отменен',
                'reserved'     => 'Забронирован', // 👈 ОТДЕЛЬНЫЙ СТАТУС
            ];

            if (isset($stageMap[$request->stage])) {
                $query->where('status_1c', $stageMap[$request->stage]);
            }
        }

        /*
         |--------------------------------------------------------------------------
         | 📑 ПАГИНАЦИЯ
         |--------------------------------------------------------------------------
         */
        $orders = $query
            ->orderBy($sortable[$sort], $direction)
            ->paginate($perPage)
            ->withQueryString();


        /*
         |--------------------------------------------------------------------------
         | 📦 VIEW
         |--------------------------------------------------------------------------
         */
        return view('admin.cabinet.orders-tracking.index', [
            'theme'        => $theme,
            'defaultPage'  => 'orders-tracking',
            'orders'       => $orders,
            'perPage'      => $perPage,
            'dateRange'    => $request->get('date_range', 'all'),
            'statusCounts' => $statusCounts,
            'sort'      => $sort,
            'direction' => $direction,
            'totalCount'   => $totalCount,
        ]);
    }

    public function export(Request $request)
    {
        return Excel::download(
            new OrdersExport($request->all()),
            'orders.xlsx'
        );
    }


}

