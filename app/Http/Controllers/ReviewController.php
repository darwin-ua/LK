<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    // Метод для добавления отзыва
    public function store(Request $request, $productId)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Вы должны войти в систему, чтобы оставить отзыв.');
        }

        // Валидация данных
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        // Вставка отзыва в таблицу reviews
        DB::table('reviews')->insert([
            'product_id' => $productId,
            'user_id' => auth()->id(),  // ID текущего пользователя
            'content' => $validated['content'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Перенаправление обратно на страницу товара с сообщением об успехе
        return redirect()->back()->with('success', 'Отзыв успешно добавлен!');
    }
}
