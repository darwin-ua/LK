<?php

namespace App\Http\Controllers\Admin;


use App\Models\Event;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class AdminOrderController extends Controller
{
    public function index()
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();


            // Для всех остальных пользователей
            $orders = Order::where('user_id', $currentAdmin->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10000);


        // Получаем события для текущего пользователя
        $events = Event::where('user_id', $currentAdmin->id)
            ->get(['title as title', 'start_date as start', 'end_date as end']);


        return view('admin.orders.index', compact('currentAdmin', 'admins', 'orders', 'events'));
    }

    public function create()
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();

        return view('admin.orders.create',compact('currentAdmin','admins'));
    }

    public function statistic()
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();

        return view('admin.orders.statistic', compact('currentAdmin','admins'));
    }




}
