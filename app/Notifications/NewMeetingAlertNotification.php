<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewMeetingAlertNotification extends Notification
{
    use Queueable;

    public $user;
    public $meeting;

    public function __construct($user, $meeting)
    {
        $this->user = $user;
        $this->meeting = $meeting;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $subject = 'New Meeting Scheduled';
        $formatted_mail_data = getFormattedTextByType('new_meeting_alert', [
            'user_name' => $this->user->name,
            'meeting_topic' => $this->meeting->topic,
            'start_time' => $this->meeting->start_time,
            'join_url' => $this->meeting->meeting_join_url,
        ]);

        return (new MailMessage)
                    ->subject($subject)
                    ->view('mails.email-template', ['content' => $formatted_mail_data]);
    }
} 