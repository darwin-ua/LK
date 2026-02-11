<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WinDrawController extends Controller
{
    public function index()
    {
        $theme = session('theme', 'darwin');
        $user  = Auth::user();

        // Значение по умолчанию
        $windrawUrl = null;

        if ($user && $user->group) {
            if ($user->group === 'Дилери: Дарвін') {
                $windrawUrl = 'https://rds.gwd.goodwin.ua/RDWeb/webclient/';
            } elseif ($user->group === 'Дилери: Гудвін') {
                $windrawUrl = 'http://localhost';
            }
        }

        return view('admin.cabinet.windraw.index', [
            'theme'        => $theme,
            'defaultPage'  => 'windraw',
            'windrawUrl'   => $windrawUrl, // ⬅️ передаём во view
        ]);
    }
}

