<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{
    public function orders()
    {
        $userId = auth()->id();

        $notifications = DB::table('notifications')
            ->where('user_id', $userId)
            ->whereIn('type', ['order_new', 'order_status'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        $unreadCount = DB::table('notifications')
            ->where('user_id', $userId)
            ->whereIn('type', ['order_new', 'order_status'])
            ->where('is_read', 0)
            ->count();

        return response()->json([
            'count' => $unreadCount,
            'items' => $notifications
        ]);
    }

    public function markOrdersRead()
    {
        $userId = auth()->id();

        DB::table('notifications')
            ->where('user_id', $userId)
            ->whereIn('type', ['order_new', 'order_status'])
            ->where('is_read', 0)
            ->update([
                'is_read' => 1,
                'read_at' => now()
            ]);

        return response()->json(['ok' => true]);
    }

}

