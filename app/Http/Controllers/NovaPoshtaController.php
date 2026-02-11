<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\Http;

class NovaPoshtaController extends Controller
{

    public function findCity(Request $request)
    {
        $cityName = $request->input('city');
        $apiKey = '3110a41404e4da977a1815cc2d39cac8'; // Вставь сюда свой API ключ

        if (!$cityName) {
            return response()->json(['message' => 'Город не найден'], 400);
        }

        $client = new \GuzzleHttp\Client();

        $response = $client->post('https://api.novaposhta.ua/v2.0/json/', [
            'json' => [
                'apiKey' => $apiKey,
                'modelName' => 'Address',
                'calledMethod' => 'getCities',
                'methodProperties' => [
                    'FindByString' => $cityName,
                ]
            ]
        ]);

        $responseBody = json_decode($response->getBody(), true);
        $cities = $responseBody['data'] ?? [];

        return response()->json($cities);
    }

    public function searchDepartments(Request $request)
    {
        $apiKey = '3110a41404e4da977a1815cc2d39cac8';
        $cityName = $request->input('city');

        if (!$cityName) {
            return response()->json(['message' => 'Выберите город'], 400);
        }

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->post('https://api.novaposhta.ua/v2.0/json/', [
                'json' => [
                    'apiKey' => $apiKey,
                    'modelName' => 'Address',
                    'calledMethod' => 'getWarehouses',
                    'methodProperties' => [
                        'FindByString' => $cityName,
                    ]
                ]
            ]);

            // Декодируем тело ответа
            $data = json_decode($response->getBody(), true);

            // Проверяем, был ли успешным запрос и содержит ли он данные
            if ($response->getStatusCode() === 200 && isset($data['data'])) {
                return response()->json($data['data']);
            }

            return response()->json(['message' => 'Отделения не найдены'], 404);

        } catch (\Exception $e) {
            // Обрабатываем возможные ошибки
            return response()->json(['message' => 'Ошибка при выполнении запроса', 'error' => $e->getMessage()], 500);
        }
    }


}
