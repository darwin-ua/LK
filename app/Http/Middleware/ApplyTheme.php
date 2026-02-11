<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApplyTheme
{
    public function handle(Request $request, Closure $next)
    {
        // Если в GET присутствует theme — обновляем
        if ($request->has('theme')) {
            session(['theme' => $request->get('theme')]);
        }

        // Если нет, просто используем значение из сессии
        $theme = session('theme', 'darwin');

        // Делаем тему доступной во всех view
        view()->share('theme', $theme);

        return $next($request);
    }
}

