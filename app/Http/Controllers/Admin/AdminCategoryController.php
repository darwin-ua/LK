<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function fetchSubcategory(Request $request)
    {
        // Получаем данные из запроса
        $categoryId = $request->input('categoryId');
        $id = $request->input('id');

        // Загружаем подкатегории
        $subcategories = Subcategory::where('category_id', $categoryId)
            ->where('category_sub_id', $id)
            ->get();

        // Возвращаем отрендеренный HTML-фрагмент
        return view('admin.events.subcategory.category_sub_courses', [
            'subcategories' => $subcategories
        ])->render();
    }


    public function getCategoryView($category)
    {
        $categoriesMap = [
            'courses' => 1,
            'trade' => 2,
            'event' => 3,
            'goods' => 4,
        ];

        $categoryId = $categoriesMap[$category] ?? null;
        $categoryData = Category::where('select_id', $categoryId)->get();

        switch ($category) {

            case 'courses':
                $view = 'admin.events.category.category_courses';
                break;
            case 'event':
                $view = 'admin.events.category.category_event';
                break;
            case 'trade':
                $view = 'admin.events.category.category_trade';
                break;
            case 'goods':
                $view = 'admin.events.category.category_goods';
                break;
        }

        return view($view, ['categoryData' => $categoryData]);
    }
}
