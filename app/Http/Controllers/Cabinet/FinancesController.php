<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinancesExport;

class FinancesController extends Controller
{
    public function index(Request $request)
    {
        $theme = session('theme', 'darwin');
        $user  = Auth::user();

        $perPage = (int) $request->get('per_page', 10);
        $currentRange = $request->get('date_range', 'all');

        // ===== SORTING =====
        $sortable = [
            'created_at'      => ['type' => 'column', 'value' => 'p.created_at'],
            'order_name'      => ['type' => 'column', 'value' => 'p.order_name'],
            'last_payment_at' => ['type' => 'column', 'value' => 'p.last_payment_at'],

            // ⬇️ ЧИСЛА (CAST!)
            'balance'      => ['type' => 'raw', 'value' => 'CAST(p.balance AS SIGNED)'],
            'credit'       => ['type' => 'raw', 'value' => 'CAST(p.credit AS SIGNED)'],
            'order_amount' => ['type' => 'raw', 'value' => 'CAST(o.amount AS SIGNED)'],

            // ⬇️ ВЫЧИСЛЯЕМОЕ
            'margin' => ['type' => 'raw', 'value' => '(p.credit - p.debit)'],
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
        | DATE RANGE → from date
        |--------------------------------------------------------------------------
        */
        $dateFrom = null;

        if ($currentRange !== 'all') {
            $days = (int) $currentRange;
            if ($days > 0) {
                $dateFrom = now()->subDays($days)->startOfDay();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | ОСНОВНАЯ ТАБЛИЦА
        |--------------------------------------------------------------------------
        */
        $rowsQuery = DB::table('lk_partner_payments as p')
            ->leftJoin('orders as o', function ($join) use ($user) {
                $join->on(
                    DB::raw('o.client_order_number COLLATE utf8mb4_unicode_ci'),
                    '=',
                    DB::raw('p.order_name COLLATE utf8mb4_unicode_ci')
                )
                    ->where('o.user_id', $user->id);
            })
            ->where('p.id_lk', $user->id_lk);

        // ⬇️ ФИЛЬТР ПО ДАТЕ
        if ($dateFrom) {
            $rowsQuery->where('p.created_at', '>=', $dateFrom);
        }

        $rowsQuery = $rowsQuery->select([
            'p.created_at',
            'p.order_name',
            'p.balance',
            'p.last_payment_at',
            'p.debit',
            'p.credit',
            DB::raw('o.amount as order_amount'),
            DB::raw('(p.credit - p.debit) as margin'),
        ]);

        if ($sortable[$sort]['type'] === 'raw') {
            $rowsQuery->orderByRaw($sortable[$sort]['value'] . ' ' . $direction);
        } else {
            $rowsQuery->orderBy($sortable[$sort]['value'], $direction);
        }

        $rows = $rowsQuery
            ->paginate($perPage)
            ->withQueryString();

        $ordersSummaryQuery = DB::table('lk_partner_payments as p')
            ->leftJoin('orders as o', function ($join) use ($user) {
                $join->on(
                    DB::raw('o.client_order_number COLLATE utf8mb4_unicode_ci'),
                    '=',
                    DB::raw('p.order_name COLLATE utf8mb4_unicode_ci')
                )
                    ->where('o.user_id', $user->id);
            })
            ->where('p.id_lk', $user->id_lk)
            ->select([
                DB::raw('MIN(p.created_at) as created_at'),
                'p.order_name',

                // оплачено всего (деньги + взаимозачёты)
                DB::raw('SUM(p.credit) as paid_total'),

                // начислено всего (временно)
                DB::raw('SUM(p.debit) as accrued_total'),

                // ДОЛГ ПО ЗАКАЗУ
                DB::raw('GREATEST(SUM(p.debit) - SUM(p.credit), 0) as total_debt'),

                // пока без логики отгрузки
                DB::raw('GREATEST(SUM(p.debit) - SUM(p.credit), 0) as shipped_debt'),
            ])
            ->groupBy('p.order_name')
            ->orderBy(DB::raw('MIN(p.created_at)'), 'desc');

        $ordersSummary = $ordersSummaryQuery
            ->paginate($perPage, ['*'], 'orders_page')
            ->withQueryString();
        /*
        |--------------------------------------------------------------------------
        | ИТОГИ (ТОЖЕ С УЧЁТОМ ПЕРИОДА)
        |--------------------------------------------------------------------------
        */
        $totalsQuery = DB::table('lk_partner_payments')
            ->where('id_lk', $user->id_lk);

        if ($dateFrom) {
            $totalsQuery->where('created_at', '>=', $dateFrom);
        }

        $startBalance = DB::table('lk_partner_payments')
            ->where('id_lk', $user->id_lk)
            ->orderBy('created_at')
            ->value('balance') ?? 0;

        $accrued = (clone $totalsQuery)->sum('debit');
        $paid    = (clone $totalsQuery)->sum('credit');

        $rawBalance = $startBalance + $accrued - $paid;

        $debt = $rawBalance > 0 ? $rawBalance : 0;
        $overpayment = $rawBalance < 0 ? abs($rawBalance) : 0;


        return view('admin.cabinet.finances.index', [
            'theme'        => $theme,
            'defaultPage'  => 'finances',
            'sort'      => $sort,
            'direction' => $direction,
            'ordersSummary' => $ordersSummary,


            'rows'         => $rows,
            'perPage'      => $perPage,

            'startBalance' => $startBalance,
            'accrued'      => $accrued,
            'paid'         => $paid,
            'debt'         => $debt,
            'overpayment'  => $overpayment,


            'currentRange' => $currentRange,
        ]);
    }


    public function export(Request $request)
    {
        $user = Auth::user();
        $range = $request->get('date_range', 'all');

        return Excel::download(
            new FinancesExport($user, $range),
            'finances.xlsx'
        );
    }

}
