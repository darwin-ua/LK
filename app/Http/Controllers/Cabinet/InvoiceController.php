<?php
namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use App\Models\User;

class InvoiceController extends Controller
{
    public function createIn1c(Request $request)
    {
        // ======================================================
        // 1. Валидация
        // ======================================================
        $data = $request->validate([
            'order_id'     => 'required|integer',
            'company_name' => 'nullable|string',
            'contact_name' => 'nullable|string',
            'edrpou'       => 'nullable|string',
            'email'        => 'nullable|string',
            'phone'        => 'nullable|string',
            'amount'       => 'required|numeric',
            'install'      => 'nullable|boolean',
            'contract'     => 'nullable|boolean',

            // 🔑 ДОБАВИТЬ
            'ПлатникПДВ'   => 'nullable|boolean',
            'Бюджет'       => 'nullable|boolean',
        ]);

        // ======================================================
        // 2. Заказ
        // ======================================================
        $order = Order::findOrFail($data['order_id']);

        // ======================================================
        // 3. Пользователь (дилер)
        // ======================================================
        $user = User::findOrFail($order->user_id);

        if (empty($user->name) || empty($user->id_lk)) {
            \Log::error('Dealer data missing in users table', [
                'user_id' => $user->id,
                'name'    => $user->name,
                'id_lk'   => $user->id_lk,
            ]);

            return response()->json([
                'status'  => 500,
                'message' => 'У дилера відсутні дані для передачі в 1С'
            ], 500);
        }

        $dealerName = $user->name;
        $dealerIdLk = (string) $user->id_lk;

        // ======================================================
        // 4. Название плательщика
        // ======================================================
        $companyName = trim(
            $data['company_name']
                ?: $data['contact_name']
                ?: $dealerName
        );

        // ======================================================
        // 5. ДАННЫЕ ДОСТУПА К 1С
        // ======================================================
        $urlCreateInvoice = 'http://192.168.170.105/sandbox_1/hs/lk/creatingInvoice';

        $login    = 'LK';
        $password = 'ewq12345ASDF';

        $authString = iconv('UTF-8', 'Windows-1251', $login . ':' . $password);
        $authHeader = 'Basic ' . base64_encode($authString);

        // ======================================================
        // 6. PAYLOAD
        // ======================================================
        $payload = [
            'Организация' => 'Дарвін',

            'Дилер'     => $dealerName,
            'ДилерАЙДИ' => $dealerIdLk,

            'НаименованиеПлательщика'     => $companyName,
            'ЕДРПОУПлательщика'           => $data['edrpou'] ?? '',
            'ЭлектроннаяПочтаПлательщика' => $data['email'] ?? '',
            'ТелефонПлательщика'          => $data['phone'] ?? '',
            'ПИБКонтактноеЛицо'           => $data['contact_name'] ?? '',

            'Сумма' => (float) $data['amount'],
            'Комментарий' => 'Создано з ЛК дилера',

            'ВыделятьМонтажОтдельнойСтрокойВСчете' => (bool) ($data['install'] ?? false),
            'НуженДоговор'                         => (bool) ($data['contract'] ?? false),

            // 🔑 ВЕШАЮТСЯ В 1С
            'ПлатникПДВ' => (bool) ($data['ПлатникПДВ'] ?? false),
            'Бюджет'     => (bool) ($data['Бюджет'] ?? false),

            'НомерЗаказа' => (string) $order->client_order_number,
        ];



        \Log::info('Invoice payload to 1C', $payload);

        // ======================================================
        // 7. ОТПРАВКА В 1С
        // ======================================================
        $response = Http::timeout(20)
            ->withHeaders([
                'Authorization' => $authHeader,
                'Content-Type'  => 'application/json; charset=utf-8',
                'Accept'        => 'application/json',
            ])
            ->post($urlCreateInvoice, $payload);

        if (empty($order->client_order_number)) {
            return response()->json([
                'status'  => 422,
                'message' => 'У замовлення відсутній номер замовлення 1С (client_order_number)'
            ], 422);
        }


        if (!$response->ok()) {
            return response()->json([
                'status'  => 500,
                'message' => '1С не змогла створити рахунок',
                'details' => $response->body(),
            ], 500);
        }

        return response()->json($response->json(), 200);
    }
}
