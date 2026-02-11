<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ThemeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Получаем тему из URL
        $themeFromUrl = $request->query('theme');

        if ($themeFromUrl) {
            // Сохраняем в session
            session(['theme' => $themeFromUrl]);

            // И в cookie, если нужно долговременное хранение
            cookie()->queue(cookie('theme', $themeFromUrl, 60*24*30));
        }

        // 2. Определяем активную тему:
        //    приоритет: URL → SESSION → COOKIE → дефолт
        $theme =
            $themeFromUrl ??
            session('theme') ??
            $request->cookie('theme') ??
            'darwin';

        // Чтобы Blade знал о теме
        view()->share('theme', $theme);

        return $next($request);
    }
}
