<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    //
    public function destroy($user, $notificationId)
    {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();
    }
    
}
