<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;

class MotivationController extends Controller
{
    public function index()
    {
        $theme = session('theme', 'darwin');

        return view('admin.cabinet.motivation.index', [
            'theme' => $theme,
            'defaultPage' => 'motivation',
        ]);
    }
}

