<?php

namespace Modules\EmailReminders\App\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Modules\EmailReminders\App\Models\EmailReminder;
use Modules\EmailReminders\App\Emails\ReminderMail;

class SendEmailReminders extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'emails:send-reminders {--test : Send test emails to all active reminders}';

    /**
     * The console command description.
     */
    protected $description = 'Send due email reminders to recipients';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting email reminders processing...');

        if ($this->option('test')) {
            $this->sendTestReminders();
        } else {
            $this->sendDueReminders();
        }

        $this->info('Email reminders processing completed.');
    }

    /**
     * Send all due reminders.
     */
    private function sendDueReminders()
    {
        $dueReminders = EmailReminder::due()->get();

        if ($dueReminders->isEmpty()) {
            $this->info('No reminders are due at this time.');
            return;
        }

        $this->info("Found {$dueReminders->count()} due reminder(s).");

        foreach ($dueReminders as $reminder) {
            try {
                $this->sendReminderEmail($reminder);
                $this->info("✓ Sent reminder: {$reminder->title}");
            } catch (\Exception $e) {
                $this->error("✗ Failed to send reminder '{$reminder->title}': {$e->getMessage()}");
            }
        }
    }

    /**
     * Send test emails for all active reminders.
     */
    private function sendTestReminders()
    {
        $activeReminders = EmailReminder::active()->get();

        if ($activeReminders->isEmpty()) {
            $this->info('No active reminders found.');
            return;
        }

        $this->info("Found {$activeReminders->count()} active reminder(s). Sending test emails...");

        foreach ($activeReminders as $reminder) {
            try {
                $this->sendReminderEmail($reminder, true);
                $this->info("✓ Sent test email for: {$reminder->title}");
            } catch (\Exception $e) {
                $this->error("✗ Failed to send test email for '{$reminder->title}': {$e->getMessage()}");
            }
        }
    }

    /**
     * Send reminder email to all recipients.
     */
    private function sendReminderEmail(EmailReminder $reminder, $isTest = false)
    {
        $emails = $reminder->getRecipientEmails();
        
        if (empty($emails)) {
            throw new \Exception('No recipient emails found');
        }

        $emailCount = 0;
        foreach ($emails as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // For test mode, only send to the first email to avoid spam
                if ($isTest && $emailCount > 0) {
                    break;
                }
                
                Mail::to($email)->send(new ReminderMail($reminder));
                $emailCount++;
            }
        }

        if (!$isTest) {
            $reminder->markAsSent();
        }

        $this->line("  → Sent to {$emailCount} recipient(s)");
    }
}
