<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('sortUrl')) {
    function sortUrl(string $column): string
    {
        $currentSort = request('sort');
        $currentDirection = request('direction', 'desc');

        // если кликаем по той же колонке — меняем направление
        if ($currentSort === $column) {
            $direction = $currentDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // если новая колонка — всегда asc
            $direction = 'asc';
        }

        return request()->fullUrlWithQuery([
            'sort' => $column,
            'direction' => $direction,
            'page' => 1, // ⚠️ сбрасываем страницу
        ]);
    }
}

