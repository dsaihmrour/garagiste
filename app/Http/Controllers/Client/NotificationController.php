<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function clientNotifications()
    {
        $notifications = auth()->user()->notifications;

        if (!$notifications) {
            return response()->json(["notifications" => []], 200);
        }

        return response()->json(["notifications" => $notifications], 200);
    }
}
