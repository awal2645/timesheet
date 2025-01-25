<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\EmailHistory;
use Illuminate\Http\Request;
use App\Mail\NotificationMail;
use App\Mail\EmployeeInviteMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

/**
 * Controller for handling email operations and history
 */
class EmailController extends Controller
{
    /**
     * Display email history with search functionality
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = EmailHistory::query();

        // Search functionality for recipient email and subject
        if ($request->filled('search')) {
            $query->where('recipient_email', 'like', '%' . $request->search . '%')
                ->orWhere('subject', 'like', '%' . $request->search . '%');
        }

        // Paginate results with 10 items per page
        $emailHistories = $query->paginate(10);

        return view('email_histories.index', compact('emailHistories'));
    }

    /**
     * Show email composition form with available users and roles
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        // Fetch all users and roles for email targeting
        $users = User::all();
        $roles = Role::all();
        return view('emails.send', compact('users', 'roles'));
    }

    /**
     * Send emails to selected recipients and store in history
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        // Validate the request data
        $request->validate([
            'role' => 'sometimes|array',
            'emails' => 'sometimes|array',
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);
    
        // Configure SMTP settings for employer role
        if (auth('web')->user()->role == 'employer') {
            $smtp = smtp();
    
            // Set up custom SMTP configuration
            Config::set('mail.mailers.smtp', [
                'transport' => 'smtp',
                'host' => $smtp->host,
                'port' => $smtp->port,
                'encryption' => $smtp->encryption,
                'username' => $smtp->username,
                'password' => $smtp->password,
                'from' => [
                    'address' => $smtp->mail_from_address,
                    'name' => $smtp->mail_from_name,
                ],
            ]);
    
            Config::set('mail.default', 'smtp');
        }
    
        // Get users by selected roles
        $roles = Role::whereIn('id', $request->role)->pluck('name')->toArray();
        $users = User::whereIn('role', $roles)->get();
    
        // Combine directly entered emails with users from selected roles
        $emailList = $request->emails ?? [];
        foreach ($users as $user) {
            $emailList[] = $user->email;
        }
    
        // Send emails to all recipients and log to history
        foreach ($emailList as $email) {
            // Send the email
            Mail::to($email)->send(new NotificationMail($request->subject, $request->body));
    
            // Create history record
            EmailHistory::create([
                'recipient_email' => $email,
                'subject' => $request->subject,
                'body' => $request->body,
            ]);
        }
    
        return redirect()->back()->with('success', 'Emails sent successfully!');
    }
}
