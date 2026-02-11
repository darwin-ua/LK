<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Event;
use App\Models\Alert;
use App\Models\Doing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use Illuminate\Support\Facades\DB;



class OrderController extends Controller
{


    // app/Http/Controllers/OrderController.php

    public function invoiceData(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $user = auth()->user();

        // ⚠️ пример: если себестоимость хранится в заказе
        $cost = $order->cost_price ?? 0;

        $margin = $order->amount - $cost;

        return response()->json([
            'order' => [
                'id'      => $order->id,
                'amount'  => $order->amount,
                'cost'    => $cost,
            ],
            'user' => [
                'company_name' => $user->company_name,
                'edrpou'       => $user->payer_code,
                'is_vat'       => $user->is_vat,
                'is_budget'    => $user->is_budget,
                'contact_name' => $user->name,
                'phone'        => $user->phone,
                'email'        => $user->email,
            ],
            'calc' => [
                'margin'       => $margin,
                'total_amount' => $order->amount,
            ],
        ]);
    }

    public function details(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $items = DB::table('order_details')
            ->where('order_id', $order->id)
            ->get();

        return response()->json([
            'order' => [
                'id'           => $order->id,
                'order_number' => $order->order_number,
                'created_at'   => $order->created_at,
                'client'       => $order->client,
                'address'      => $order->address ?? '—',
                'status_1c'    => $order->status_1c,
                'amount'       => $order->amount,
            ],
            'items' => $items
        ]);
    }

    private function mapStatus($status)
    {
        return match ((int)$status) {
            0 => 'Створено',
            1 => 'В обробці',
            2 => 'Підтверджено',
            3 => 'Завершено',
            default => '—',
        };
    }


}

