<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;

class LeaveApplicationMail extends Mailable
{
    use Queueable;

    public $user;
    public $start_date;
    public $end_date;
    public $reason;
    public $action; // 'submitted', 'approved', 'denied'

    public function __construct($user, $start_date, $end_date, $reason, $action)
    {
        $this->user = $user;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->reason = $reason;
        $this->action = $action;
    }

    public function build()
    {
        $type = 'leave_application_' . $this->action;
        $subject = DB::table('email_templates')->where('type', $type)->first();
        $formatted_mail_data = getFormattedTextByType($type, [
            'user_name' => $this->user->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'reason' => $this->reason,
        ]);

        return $this->subject($subject->subject)
                    ->view('mails.email-template', ['content' => $formatted_mail_data]);
    }
}
