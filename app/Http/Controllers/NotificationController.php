<?php

namespace App\Http\Controllers;

use App\Models\Notificattion;

/**
 * Controller for managing user notifications
 * Handles fetching and deleting notifications for authenticated users
 */
class NotificationController extends Controller
{
    /**
     * Fetch notifications for the authenticated user
     * Returns notifications as JSON for AJAX requests
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function notifications()
    {
        try {
            // Get all notifications for the current authenticated user
            $notifications = Notificattion::where('to', auth('web')->user()->id)
                ->get();

            // Return notifications as JSON response
            return response()->json([
                'notifications' => $notifications
            ], 200);
        } catch (\Exception $e) {
            // Handle any errors (database issues, authentication errors, etc.)
            return response()->json([
                'error' => 'Failed to fetch notifications'
            ], 500);
        }
    }

    /**
     * Delete all notifications for the authenticated user
     * Used for clearing notification history
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function notificationDel()
    {
        // Delete all notifications for the current user
        Notificattion::where('to', auth('web')->user()->id)
            ->delete();

        // Redirect back to previous page
        return redirect()->back();
    }
}
