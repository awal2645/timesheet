<?php

namespace App\Http\Controllers;

use App\Models\Notificattion;

class NotificationController extends Controller
{
    public function notifications()
    {
        try {
            // Assuming you have a 'Notification' model
            $notifications = Notificattion::where('to', auth('web')->user()->id)->get();

            // You may further process or format the notifications here if needed

            return response()->json(['notifications' => $notifications], 200);
        } catch (\Exception $e) {
            // Handle any potential errors, such as database connection issues, authentication errors, etc.
            return response()->json(['error' => 'Failed to fetch notifications'], 500);
        }
    }

    public function notificationDel()
    {
        Notificattion::where('to', auth('web')->user()->id)->delete();

        return redirect()->back();
    }
}
