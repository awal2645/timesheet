<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;

class NewPlanPurchaseMail extends Mailable
{
    use Queueable;

    public $admin;

    public $order;

    public $plan;

    public $user;

    public function __construct($admin, $order, $plan, $user)
    {
        $this->admin = $admin;
        $this->order = $order;
        $this->plan = $plan;
        $this->user = $user;
    }

    public function build()
    {
        $type = 'new_plan_purchase';
        $subject = DB::table('email_templates')
            ->where('type', $type)
            ->first();
        $formatted_mail_data = getFormattedTextByType($type, [
            'admin_name' => config('app.name'),
            'user_name' => $this->user->email,
            'plan_label' => $this->plan->label,
        ]);
        $message = $formatted_mail_data;

        return $this->subject($subject->subject)
            ->view('mails.email-template', ['content' => $message]);
    }
}
