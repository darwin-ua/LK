<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\User;

class InvoiceController extends Controller
{
    public function createIn1c(Request $request)
    {
        \Log::info('===== INVOICE CREATE START =====');

        try {
            // ======================================================
            // 1. Лог входящего запроса
            // ======================================================
            \Log::info('Invoice incoming request', [
                'all' => $request->all(),
                'user_auth_id' => auth()->id(),
                'ip' => $request->ip(),
            ]);

            // ======================================================
            // 2. Валидация
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

                'ПлатникПДВ'   => 'nullable|boolean',
                'Бюджет'       => 'nullable|boolean',
            ]);

            \Log::info('Invoice validation passed', [
                'data' => $data,
            ]);

            // ======================================================
            // 3. Заказ
            // ======================================================
            \Log::info('Trying to find order', [
                'order_id' => $data['order_id'],
            ]);

            $order = Order::findOrFail($data['order_id']);

            \Log::info('Order found', [
                'order_id' => $order->id,
                'order_number' => $order->order_number ?? null,
                'client_order_number' => $order->client_order_number ?? null,
                'order_user_id' => $order->user_id ?? null,
                'amount' => $order->amount ?? null,
                'status_1c' => $order->status_1c ?? null,
            ]);

            // ======================================================
            // 3.1 Проверка номера заказа 1С ДО отправки
            // ======================================================
            if (empty($order->client_order_number)) {
                \Log::warning('Invoice stopped: empty client_order_number', [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number ?? null,
                ]);

                return response()->json([
                    'status'  => 422,
                    'message' => 'У замовлення відсутній номер замовлення 1С (client_order_number)'
                ], 422);
            }

            // ======================================================
            // 4. Пользователь / дилер
            // ======================================================
            \Log::info('Trying to find dealer user', [
                'user_id' => $order->user_id,
            ]);

            $user = User::findOrFail($order->user_id);

            \Log::info('Dealer user found', [
                'user_id' => $user->id,
                'name' => $user->name ?? null,
                'id_lk' => $user->id_lk ?? null,
                'email' => $user->email ?? null,
            ]);

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
            // 5. Название плательщика
            // ======================================================
            $companyName = trim(
                $data['company_name']
                    ?: $data['contact_name']
                    ?: $dealerName
            );

            \Log::info('Invoice payer resolved', [
                'company_name' => $companyName,
                'dealer_name' => $dealerName,
                'dealer_id_lk' => $dealerIdLk,
            ]);

            // ======================================================
            // 6. Данные доступа к 1С
            // ======================================================
            $urlCreateInvoice = 'http://185.112.41.230/prod/hs/lk/creatingInvoice';

            $login    = 'LK';
            $password = 'ewq12345ASDF';

            $authString = iconv('UTF-8', 'Windows-1251', $login . ':' . $password);
            $authHeader = 'Basic ' . base64_encode($authString);

            \Log::info('Invoice 1C endpoint prepared', [
                'url' => $urlCreateInvoice,
                'login' => $login,
            ]);

            // ======================================================
            // 7. Payload для 1С
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

                'ПлатникПДВ' => (bool) ($data['ПлатникПДВ'] ?? false),
                'Бюджет'     => (bool) ($data['Бюджет'] ?? false),

                'НомерЗаказа' => (string) $order->client_order_number,
            ];

            \Log::info('Invoice payload to 1C', $payload);

            // ======================================================
            // 8. Проверяем, существует ли таблица логов
            // ======================================================
            $tableExists = DB::select("SHOW TABLES LIKE 'order_invoice_requests'");

            \Log::info('Invoice log table check', [
                'table' => 'order_invoice_requests',
                'exists' => !empty($tableExists),
            ]);

            if (empty($tableExists)) {
                \Log::error('Invoice log table does not exist', [
                    'table' => 'order_invoice_requests',
                ]);

                return response()->json([
                    'status' => 500,
                    'message' => 'Таблиця order_invoice_requests не існує в БД'
                ], 500);
            }

            // ======================================================
            // 9. Сохраняем факт попытки создания счёта
            // ======================================================
            \Log::info('Trying to insert invoice request row', [
                'order_id' => $order->id,
                'user_id' => $user->id,
                'client_order_number' => $order->client_order_number,
            ]);

            $invoiceRequestId = DB::table('order_invoice_requests')->insertGetId([
                'user_id'             => $user->id,
                'order_id'            => $order->id,
                'order_number'        => $order->order_number ?? null,
                'client_order_number' => $order->client_order_number,
                'id_lk'               => $user->id_lk,
                'status'              => 'created',
                'request_payload'     => json_encode($payload, JSON_UNESCAPED_UNICODE),
                'response_payload'    => null,
                'error_message'       => null,
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);

            \Log::info('Invoice request row inserted successfully', [
                'invoice_request_id' => $invoiceRequestId,
                'order_id' => $order->id,
            ]);

            // ======================================================
            // 10. Отправка в 1С
            // ======================================================
            \Log::info('Sending invoice request to 1C', [
                'invoice_request_id' => $invoiceRequestId,
                'url' => $urlCreateInvoice,
            ]);

            $response = Http::timeout(20)
                ->withHeaders([
                    'Authorization' => $authHeader,
                    'Content-Type'  => 'application/json; charset=utf-8',
                    'Accept'        => 'application/json',
                ])
                ->post($urlCreateInvoice, $payload);

            \Log::info('1C response received', [
                'invoice_request_id' => $invoiceRequestId,
                'http_status' => $response->status(),
                'ok' => $response->ok(),
                'body' => $response->body(),
            ]);

            // ======================================================
            // 11. Если 1С вернула ошибку
            // ======================================================
            if (!$response->ok()) {
                \Log::warning('1C invoice create failed, updating invoice request row', [
                    'invoice_request_id' => $invoiceRequestId,
                    'http_status' => $response->status(),
                    'body' => $response->body(),
                ]);

                DB::table('order_invoice_requests')
                    ->where('id', $invoiceRequestId)
                    ->update([
                        'status'           => 'error',
                        'response_payload' => $response->body(),
                        'error_message'    => '1С не змогла створити рахунок',
                        'updated_at'       => now(),
                    ]);

                \Log::info('Invoice request row updated as error', [
                    'invoice_request_id' => $invoiceRequestId,
                ]);

                return response()->json([
                    'status'  => 500,
                    'message' => '1С не змогла створити рахунок',
                    'details' => $response->body(),
                ], 500);
            }

            // ======================================================
            // 12. Успешный ответ 1С
            // ======================================================
            $responseJson = $response->json();

            \Log::info('1C invoice create success, updating invoice request row', [
                'invoice_request_id' => $invoiceRequestId,
                'response_json' => $responseJson,
            ]);

            DB::table('order_invoice_requests')
                ->where('id', $invoiceRequestId)
                ->update([
                    'status'           => 'success',
                    'response_payload' => json_encode($responseJson, JSON_UNESCAPED_UNICODE),
                    'updated_at'       => now(),
                ]);

            \Log::info('Invoice request row updated as success', [
                'invoice_request_id' => $invoiceRequestId,
            ]);

            \Log::info('===== INVOICE CREATE FINISH SUCCESS =====', [
                'invoice_request_id' => $invoiceRequestId,
                'order_id' => $order->id,
            ]);

            return response()->json($responseJson, 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Invoice validation exception', [
                'errors' => $e->errors(),
                'request' => $request->all(),
            ]);

            throw $e;

        } catch (\Throwable $e) {
            \Log::error('===== INVOICE CREATE EXCEPTION =====', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status'  => 500,
                'message' => 'Помилка при створенні рахунку',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
