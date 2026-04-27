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
        $perPage = in_array($perPage, [5, 10, 20, 50]) ? $perPage : 20;

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
         | 🔹 БАЗОВЫЙ ЗАПРОС
         |--------------------------------------------------------------------------
         */
        $baseQuery = Order::query()
            ->where('orders.user_id', auth()->id());

        /*
         |--------------------------------------------------------------------------
         | 🔍 ПОИСК
         |--------------------------------------------------------------------------
         */
        if ($request->filled('q')) {
            $search = trim($request->q);

            $baseQuery->where(function ($q) use ($search) {
                $q->where('orders.order_number', 'like', "%{$search}%")
                    ->orWhere('orders.client', 'like', "%{$search}%");
            });
        }

        /*
         |--------------------------------------------------------------------------
         | 📅 ФИЛЬТР ПО ДАТЕ
         |--------------------------------------------------------------------------
         */
        if ($request->filled('date_range') && $request->date_range !== 'all') {
            $days = (int) $request->date_range;
            $baseQuery->where('orders.created_at', '>=', now()->subDays($days));
        }

        /*
         |--------------------------------------------------------------------------
         | 🔢 СТАТИЧЕСКИЕ СЧЁТЧИКИ
         |--------------------------------------------------------------------------
         */
        $statusCounts = (clone $baseQuery)
            ->selectRaw('orders.status_1c, COUNT(*) as total')
            ->groupBy('orders.status_1c')
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
         | 🔽 ФИЛЬТР ПО ЭТАПУ
         |--------------------------------------------------------------------------
         */
        if ($request->filled('stage')) {

            $stageMap = [
                'pogodzenya'   => 'Фин. контроль',
                'vyrobnytctvo' => 'Выполняется',
                'vykonano'     => 'Виконано',
                'reklamaciya'  => 'Отменен',
                'reserved'     => 'Забронирован',
            ];

            if (isset($stageMap[$request->stage])) {
                $query->where('orders.status_1c', $stageMap[$request->stage]);
            }
        }

        /*
         |--------------------------------------------------------------------------
         | 📑 ПАГИНАЦИЯ + ПОДТЯГИВАЕМ ДАННЫЕ ПО СЧЁТУ
         |--------------------------------------------------------------------------
         */
        $orders = $query
            ->leftJoin('order_invoice_requests as oir', function ($join) {
                $join->on('oir.order_id', '=', 'orders.id')
                    ->whereRaw('oir.id = (
                    SELECT MAX(oir2.id)
                    FROM order_invoice_requests oir2
                    WHERE oir2.order_id = orders.id
                )');
            })
            ->select(
                'orders.*',
                'oir.id as invoice_request_id',
                'oir.status as invoice_request_status',
                'oir.invoice_number as invoice_number',
                'oir.created_at as invoice_created_at'
            )
            ->orderBy('orders.' . $sortable[$sort], $direction)
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
            'sort'         => $sort,
            'direction'    => $direction,
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

