<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;

class NewMeetingAlertMail extends Mailable
{
    use Queueable;

    public $user;
    public $meeting;

    public function __construct($user, $meeting)
    {
        $this->user = $user;
        $this->meeting = $meeting;
    }

    public function build()
    {
        $subject = 'New Meeting Scheduled';
        $formatted_mail_data = getFormattedTextByType('new_meeting_alert', [
            'user_name' => $this->user->name,
            'meeting_topic' => $this->meeting->topic,
            'start_time' => $this->meeting->start_time,
            'join_url' => $this->meeting->meeting_join_url,
        ]);

        return $this->subject($subject)
                    ->view('mails.email-template', ['content' => $formatted_mail_data]);
    }
}