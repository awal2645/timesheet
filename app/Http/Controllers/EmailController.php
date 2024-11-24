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

class EmailController extends Controller
{

    public function index(Request $request)
    {
        $query = EmailHistory::query();

        // Search functionality
        if ($request->filled('search')) {
            $query->where('recipient_email', 'like', '%' . $request->search . '%')
                ->orWhere('subject', 'like', '%' . $request->search . '%');
        }

        $emailHistories = $query->paginate(10); // Adjust pagination as needed

        return view('email_histories.index', compact('emailHistories'));
    }

    public function showForm()
    {
        // Fetch users to send emails to
        $users = User::all(); // Adjust this to your user model
        $roles = Role::all();
        return view('emails.send', compact('users', 'roles'));
    }
    public function send(Request $request)
    {
        // Validate the request
        $request->validate([
            'role' => 'sometimes|array',
            'emails' => 'sometimes|array',
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);
    
        // Configure SMTP for 'employer' role
        if (auth('web')->user()->role == 'employer') {
            $smtp = smtp();
    
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
    
        // Fetch roles and users
        $roles = Role::whereIn('id', $request->role)->pluck('name')->toArray(); // Extract role names
        $users = User::whereIn('role', $roles)->get();
    
        // Create an email list from request emails and user emails
        $emailList = $request->emails ?? []; // Use request emails if provided
        foreach ($users as $user) {
            $emailList[] = $user->email;
        }
    
        // Send emails
        foreach ($emailList as $email) {
            Mail::to($email)->send(new NotificationMail($request->subject, $request->body));
    
            // Save email to history
            EmailHistory::create([
                'recipient_email' => $email,
                'subject' => $request->subject,
                'body' => $request->body,
            ]);
        }
    
        return redirect()->back()->with('success', 'Emails sent successfully!');
    }
    
    
}
