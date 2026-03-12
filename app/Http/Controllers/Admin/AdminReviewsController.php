<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Review; // Подключите модель Review
use App\Models\Alert;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


class AdminReviewsController extends Controller
{

    public function generateReview(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string|max:500',
            'product_id' => 'required|integer',
        ]);

        $prompt = $request->input('prompt');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Сгенерируй реалистичный отзыв на основе запроса. Также имя пользователя (loginname), которое выглядит как имя в интернете. Верни в JSON-формате с двумя ключами: "review" и "loginname". Ничего, кроме JSON.'
                ],
                [
                    'role' => 'user',
                    'content' => $prompt
                ],
            ],
        ]);

        if (!$response->successful()) {
            return response()->json([
                'status' => 'error',
                'message' => $response->json('error.message') ?? 'Ошибка GPT',
            ], 500);
        }

        $gptRaw = $response->json('choices.0.message.content');

        try {
            // Первый decode — строка JSON (экранированная) => обычная строка JSON
            $firstDecode = json_decode($gptRaw, true);

            if (!is_array($firstDecode)) {
                throw new \Exception('Некорректный JSON от GPT');
            }

            if (!isset($firstDecode['review'], $firstDecode['loginname'])) {
                throw new \Exception('Отсутствуют нужные ключи');
            }

            $parsed = $firstDecode;

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ошибка разбора ответа GPT: ' . $e->getMessage(),
                'raw_response' => $gptRaw,
            ], 500);
        }

        $review = new Review();
        $review->product_id = $request->input('product_id');
        $review->user_id = auth()->id() ?? 1;
        $review->content = $parsed['review'];
        $review->loginname = $parsed['loginname'];
        $review->status = 1;
        $review->code = Str::random(8);
        $review->save();

        return response()->json([
            'status' => 'ok',
            'review' => $parsed['review'],
            'loginname' => $parsed['loginname'],
            'review_id' => $review->id,
        ]);
    }


    public function index()
    {
        $currentAdmin = auth()->user();

        // Получаем ID всех событий текущего пользователя
        $eventIds = Event::where('user_id', $currentAdmin->id)->pluck('id');

        // Получаем отзывы, которые относятся к этим событиям (product_id = id события)
        $reviews = Review::whereIn('product_id', $eventIds)
            ->orderBy('created_at', 'desc')
            ->get();

        // Загружаем события пользователя
        $events = Event::where('user_id', $currentAdmin->id)
            ->get(['title as title', 'start_date as start', 'end_date as end']);




        return view('admin.reviews.index', compact('reviews', 'currentAdmin', 'events'));
    }


    public function updateStatus(Request $request)
    {
        $reviewId = $request->input('review_id');

        $review = Review::find($reviewId);

        if ($review) {
            $review->status = 0; // Отметим как просмотренный
            $review->save();

            // Ищем alert по коду из отзыва
            $alert = Alert::where('code', $review->code)->first();

            if ($alert) {
                $alert->status = 0;
                $alert->save();
            }

            return response()->json(['success' => true, 'message' => 'Статус обновлён']);
        }

        return response()->json(['success' => false, 'message' => 'Запись не найдена'], 404);
    }




}

