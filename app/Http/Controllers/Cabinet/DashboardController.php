<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {

        $perPage = (int) request()->get('per_page', 5);
        $perPage = in_array($perPage, [5, 10, 20]) ? $perPage : 5;

        $theme = session('theme', 'darwin');
        $user  = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | 🔹 КАРТОЧКИ СВЕРХУ
        |--------------------------------------------------------------------------
        */

        // УСЬОГО ЗАМОВЛЕНЬ
        $totalOrders = DB::table('orders')
            ->where('user_id', $user->id)
            ->count();

        // В РОБОТІ
        $inProgressCount = DB::table('orders')
            ->where('user_id', $user->id)
            ->whereIn('status_1c', [
                'Фин. контроль',
                'Выполняется',
                'Производство',
                'Логистика',
                'Рекламация',
            ])
            ->count();

        // ВИКОНАНО
        $completedOrders = DB::table('orders')
            ->where('user_id', $user->id)
            ->whereIn('status_1c', [
                'Выполнен',
                'Закрыт',
                'Отгружен',
            ]);

        $completedCount = (clone $completedOrders)->count();
        $completedSum   = (clone $completedOrders)->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | 🔹 ОЧІКУЄ ОПЛАТИ (РЕАЛЬНЫЙ ДОЛГ)
        |--------------------------------------------------------------------------
        */

        $awaiting = DB::table('lk_partner_payments')
            ->where('id_lk', $user->id_lk)
            ->where(function ($q) {
                $q->where('debit', '=', 0)
                    ->where('credit', '=', 0);
            })
            ->get();

        $awaitingCount = $awaiting->count();   // 👉 будет 20
        $awaitingDebt  = $awaiting->sum('balance');


        $sortable = [
            'order_name'   => 'p.order_name',
            'order_amount' => 'o.amount',
            'paid_total'   => DB::raw('SUM(p.credit)'),
            'status'       => DB::raw('GREATEST(SUM(p.debit) - SUM(p.credit), 0)'),
            'date'         => DB::raw('MAX(p.last_payment_at)'),
        ];

        $sort = request('sort', 'date');
        $direction = request('direction', 'desc');

        if (!array_key_exists($sort, $sortable)) {
            $sort = 'date';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        /*
|--------------------------------------------------------------------------
| 🔹 ВІДВАНТАЖЕННЯ
|--------------------------------------------------------------------------
*/

        $shipments = DB::table('shipments')
            ->where('user_id', $user->id)
            ->orderByDesc('eta')
            ->limit(5)
            ->get();



        /*
        |--------------------------------------------------------------------------
        | 🔹 ТАБЛИЦА "ПЛАТЕЖІ"
        |--------------------------------------------------------------------------
        */

        $payments = DB::table('lk_partner_payments as p')
            ->leftJoin('orders as o', function ($join) use ($user) {
                $join->on(
                    DB::raw('o.client_order_number COLLATE utf8mb4_unicode_ci'),
                    '=',
                    DB::raw('p.order_name COLLATE utf8mb4_unicode_ci')
                )
                    ->where('o.user_id', $user->id);
            })
            ->where('p.id_lk', $user->id_lk)
            ->groupBy('p.order_name', 'o.amount')
            ->select([
                'p.order_name',
                DB::raw('o.amount as order_amount'),
                DB::raw('SUM(p.debit)  as billed_total'),
                DB::raw('SUM(p.credit) as paid_total'),
                DB::raw('GREATEST(SUM(p.debit) - SUM(p.credit), 0) as debt'),
                DB::raw('MAX(p.last_payment_at) as last_payment_at'),
                DB::raw('MIN(p.created_at) as created_at'),
            ])
            ->orderBy($sortable[$sort], $direction)
            ->paginate($perPage)
            ->withQueryString()
            ->through(function ($row) {

                if ((float)$row->paid_total == 0) {
                    $row->status = 'not_paid';
                } elseif ($row->paid_total < $row->billed_total) {
                    $row->status = 'partial';
                } else {
                    $row->status = 'paid';
                }

                $row->date = $row->last_payment_at ?? $row->created_at;
                return $row;
            });
        return view('admin.cabinet.dashboard.index', compact(
            'theme',
            'totalOrders',
            'inProgressCount',
            'completedCount',
            'completedSum',
            'shipments',
            'awaitingCount',
            'awaitingDebt',
            'payments',
            'perPage'
        ));

    }


}
