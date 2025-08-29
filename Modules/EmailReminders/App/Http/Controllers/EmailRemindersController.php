<?php

namespace Modules\EmailReminders\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\EmailReminders\App\Models\EmailReminder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\EmailReminders\App\Emails\ReminderMail;

class EmailRemindersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reminders = EmailReminder::with(['creator', 'template'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('emailreminders::index', compact('reminders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('emailreminders::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:task_deadline,timesheet_submission,project_milestone,meeting,custom',
            'frequency' => 'required|string|in:once,daily,weekly,monthly',
            'reminder_days_before' => 'nullable|integer|min:0|max:365',
            'reminder_time' => 'nullable|date_format:H:i',
            'recipient_type' => 'required|string|in:specific,role,department,all',
            'recipients' => 'required_unless:recipient_type,all',
            'description' => 'nullable|string'
        ]);

        // Process recipients based on type
        $recipients = [];
        if ($request->recipient_type === 'specific') {
            // Handle multiple select array
            $recipients = is_array($request->recipients) ? $request->recipients : explode(',', $request->recipients);
            $recipients = array_filter($recipients);
        } elseif ($request->recipient_type === 'all') {
            $recipients = ['all_users'];
        } else {
            $recipients = array_filter(explode(',', $request->recipients));
        }

        // Calculate next run time
        $nextRun = now();
        if ($request->reminder_time) {
            $nextRun->setTimeFromTimeString($request->reminder_time);
        }

        $reminder = EmailReminder::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'frequency' => $request->frequency,
            'reminder_days_before' => $request->reminder_days_before ?? 1,
            'reminder_time' => $request->reminder_time ?? '09:00',
            'recipients' => $recipients,
            'recipient_type' => $request->recipient_type,
            'is_active' => true,
            'next_run_at' => $nextRun,
            'created_by' => Auth::id(),
        ]);

        // Send immediate test email if requested or frequency is 'once'
        if ($request->frequency === 'once' || $request->has('send_now')) {
            $this->sendReminderEmail($reminder);
        }

        return redirect()->route('emailreminders.index')
            ->with('success', 'Email reminder created successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $reminder = EmailReminder::with(['creator', 'template'])->findOrFail($id);
        return view('emailreminders::show', compact('reminder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reminder = EmailReminder::findOrFail($id);
        return view('emailreminders::edit', compact('reminder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $reminder = EmailReminder::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:task_deadline,timesheet_submission,project_milestone,meeting,custom',
            'frequency' => 'required|string|in:once,daily,weekly,monthly',
            'reminder_days_before' => 'nullable|integer|min:0|max:365',
            'reminder_time' => 'nullable|date_format:H:i',
            'recipient_type' => 'required|string|in:specific,role,department,all',
            'recipients' => 'required_unless:recipient_type,all|string',
            'description' => 'nullable|string'
        ]);

        // Process recipients
        $recipients = [];
        if ($request->recipient_type === 'specific') {
            $recipients = array_filter(explode(',', $request->recipients));
        } elseif ($request->recipient_type === 'all') {
            $recipients = ['all_users'];
        } else {
            $recipients = array_filter(explode(',', $request->recipients));
        }

        $reminder->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'frequency' => $request->frequency,
            'reminder_days_before' => $request->reminder_days_before ?? 1,
            'reminder_time' => $request->reminder_time ?? '09:00',
            'recipients' => $recipients,
            'recipient_type' => $request->recipient_type,
            'next_run_at' => $reminder->calculateNextRun(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('emailreminders.index')
            ->with('success', 'Email reminder updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reminder = EmailReminder::findOrFail($id);
        $reminder->delete();

        return redirect()->route('emailreminders.index')
            ->with('success', 'Email reminder deleted successfully!');
    }

    /**
     * Toggle reminder active status.
     */
    public function toggle($id)
    {
        $reminder = EmailReminder::findOrFail($id);
        $reminder->update([
            'is_active' => !$reminder->is_active,
            'updated_by' => Auth::id(),
        ]);

        $status = $reminder->is_active ? 'activated' : 'deactivated';
        return redirect()->route('emailreminders.index')
            ->with('success', "Email reminder {$status} successfully!");
    }

    /**
     * Send a test email for the reminder.
     */
    public function sendTest($id)
    {
        $reminder = EmailReminder::findOrFail($id);
        
        try {
            $this->sendReminderEmail($reminder);
            return redirect()->route('emailreminders.index')
                ->with('success', 'Test email sent successfully!');
        } catch (\Exception $e) {
            return redirect()->route('emailreminders.index')
                ->with('error', 'Failed to send test email: ' . $e->getMessage());
        }
    }

    /**
     * Send reminder email to all recipients.
     */
    private function sendReminderEmail(EmailReminder $reminder)
    {
        $emails = $reminder->getRecipientEmails();
        
        foreach ($emails as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Mail::to($email)->send(new ReminderMail($reminder));
            }
        }

        $reminder->markAsSent();
    }
}
