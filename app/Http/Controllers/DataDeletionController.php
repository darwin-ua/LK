<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataDeletionController extends Controller
{
    public function handleDeletion(Request $request)
    {
        $signed_request = $request->input('signed_request');
        $data = $this->parseSignedRequest($signed_request);
        $user_id = $data['user_id'];

        // Инициируйте удаление данных пользователя здесь
        $status_url = route('deletion.status', ['id' => $user_id]);
        $confirmation_code = 'unique_code_for_' . $user_id;

        return response()->json([
            'url' => $status_url,
            'confirmation_code' => $confirmation_code
        ]);
    }

    private function parseSignedRequest($signed_request)
    {
        list($encoded_sig, $payload) = explode('.', $signed_request, 2);

        $secret = env('FACEBOOK_APP_SECRET'); // Используйте секретный ключ вашего приложения

        // Декодирование данных
        $sig = $this->base64UrlDecode($encoded_sig);
        $data = json_decode($this->base64UrlDecode($payload), true);

        // Подтверждение подписи
        $expected_sig = hash_hmac('sha256', $payload, $secret, true);
        if ($sig !== $expected_sig) {
            error_log('Bad Signed JSON signature!');
            return null;
        }

        return $data;
    }

    private function base64UrlDecode($input)
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }

    public function status(Request $request)
    {
        $user_id = $request->query('id');
        // Проверьте статус удаления данных пользователя и верните его
        return response()->json(['status' => 'Data deletion in progress for user ' . $user_id]);
    }
}
