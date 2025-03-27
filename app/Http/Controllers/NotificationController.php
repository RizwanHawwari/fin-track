<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function read($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        
        if ($notification->notifiable_id === auth()->id()) {
            $notification->markAsRead();
        }

        return back();
    }
}

