<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TimesheetReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;

    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $body)
    {
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.template') // Point to a Blade view for email content
            ->subject($this->subject)
            ->view('mails.email-template', ['content' => $this->body]);
    }
}
