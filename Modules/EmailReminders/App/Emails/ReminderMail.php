<?php

namespace Modules\EmailReminders\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\EmailReminders\App\Models\EmailReminder;

class ReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reminder;

    /**
     * Create a new message instance.
     */
    public function __construct(EmailReminder $reminder)
    {
        $this->reminder = $reminder;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject('Reminder: ' . $this->reminder->title)
                    ->view('emailreminders::emails.reminder')
                    ->with([
                        'reminder' => $this->reminder,
                        'title' => $this->reminder->title,
                        'description' => $this->reminder->description,
                        'type' => $this->reminder->type,
                    ]);
    }
}
