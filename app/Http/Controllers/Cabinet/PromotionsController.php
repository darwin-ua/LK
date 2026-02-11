<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;

class PromotionsController extends Controller
{
    public function index()
    {
        $theme = session('theme', 'darwin');

        return view('admin.cabinet.promotions.index', [
            'theme' => $theme,
            'defaultPage' => 'promotions',
        ]);
    }
}

