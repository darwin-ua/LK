<?php

namespace App\Http\Controllers;

use App\Models\Doing;
use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function contactus()
    {
        $user = Auth::user();
        $sessionId = session()->getId();
        //$cartCount = Product::where('session_id', $sessionId)->count();
        $uuid = request()->cookie('uuid') ?: \Illuminate\Support\Str::uuid();
        $cartCount = Product::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
                // Если пользователь авторизован, добавляем товары с его user_id
                $query->orWhere('user_id', $user->id);
            })
            ->count();
        $cartDoingCount = Doing::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
                $query->orWhere('user_id', $user->id);
            })
            ->count();
        $likeCount = Like::where('hash', $sessionId)->count();
        return view('layouts.contactus',['cartCount' => $cartCount, 'cartDoingCount' => $cartDoingCount, 'likeCount' => $likeCount]); // Вернет представление для страницы "Contact Us"
    }

    public function faqs()
    {
        $user = Auth::user();
        $sessionId = session()->getId();
        //$cartCount = Product::where('session_id', $sessionId)->count();
        $uuid = request()->cookie('uuid') ?: \Illuminate\Support\Str::uuid();
        $cartCount = Product::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
                // Если пользователь авторизован, добавляем товары с его user_id
                $query->orWhere('user_id', $user->id);
            })
            ->count();
        $cartDoingCount = Doing::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
                $query->orWhere('user_id', $user->id);
            })
            ->count();

        $likeCount = Like::where('hash', $sessionId)->count();
        return view('layouts.faqs', ['cartCount' => $cartCount, 'cartDoingCount' => $cartDoingCount, 'likeCount' => $likeCount]);
    }

    public function aboutus()
    {
        $user = Auth::user();
        $sessionId = session()->getId();
        $uuid = request()->cookie('uuid') ?: \Illuminate\Support\Str::uuid();
        //$cartCount = Product::where('session_id', $sessionId)->count();
        $cartCount = Product::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
                // Если пользователь авторизован, добавляем товары с его user_id
                $query->orWhere('user_id', $user->id);
            })
            ->count();
        $cartDoingCount = Doing::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
                $query->orWhere('user_id', $user->id);
            })
            ->count();
        $likeCount = Like::where('hash', $sessionId)->count();
        return view('layouts.aboutus', ['cartCount' => $cartCount,  'cartDoingCount' => $cartDoingCount,  'likeCount' => $likeCount]); // Вернет представление для страницы "About Us"
    }
}

