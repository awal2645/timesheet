<?php

namespace App\Listeners;

use App\Events\UserMentioned;
use App\Models\Notificattion;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendMentionNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserMentioned $event): void
    {
        try {
            // Create database notification
            Notificattion::create([
                'message' => $event->mentionedBy->username . ' mentioned you in task: ' . $event->task->task_name,
                'from' => $event->mentionedBy->id,
                'to' => $event->mentionedUser->id,
                'page_url' => '/task/' . $event->task->id,
            ]);

            // Log the mention for debugging
            Log::info('User mentioned', [
                'mentioned_user' => $event->mentionedUser->username,
                'mentioned_by' => $event->mentionedBy->username,
                'task_id' => $event->task->id,
                'task_name' => $event->task->task_name,
            ]);

            // Here you can add additional push notification services
            // For example, Firebase Cloud Messaging, Pusher, etc.
            $this->sendPushNotification($event);

        } catch (\Exception $e) {
            Log::error('Failed to send mention notification', [
                'error' => $e->getMessage(),
                'mentioned_user' => $event->mentionedUser->id,
                'task_id' => $event->task->id,
            ]);
        }
    }

    /**
     * Send push notification via broadcasting
     */
    private function sendPushNotification(UserMentioned $event): void
    {
        // The event itself handles broadcasting to the user's private channel
        // This will send a real-time notification via WebSocket/Pusher
        
        // If you want to add additional push notification services like FCM:
        // $this->sendFirebaseNotification($event);
        // $this->sendEmailNotification($event);
    }

    /**
     * Send Firebase Cloud Messaging notification (example)
     * Uncomment and configure if you want to use FCM
     */
    // private function sendFirebaseNotification(UserMentioned $event): void
    // {
    //     // Implementation for Firebase Cloud Messaging
    //     // You would need to install firebase/php-jwt or kreait/firebase-php
    // }

    /**
     * Send email notification (example)
     * Uncomment if you want email notifications for mentions
     */
    // private function sendEmailNotification(UserMentioned $event): void
    // {
    //     Mail::to($event->mentionedUser->email)->send(
    //         new MentionNotificationMail($event)
    //     );
    // }
}
