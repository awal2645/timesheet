<?php

namespace App\Http\Controllers;

use App\Mail\EmployeeInviteMail;
use App\Mail\EmployerInviteMail;
use App\Models\Employer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Controller for handling user invitations
 * Manages both employer and employee invitation processes
 */
class InvitationController extends Controller
{
    /**
     * Set up middleware for invitation permissions
     */
    public function __construct()
    {
        $this->middleware('role_or_permission:Invite send', ['only' => ['employerInvitePageData']]);
    }

    /**
     * Get data for employer invite page based on user role
     * @return \Illuminate\View\View
     */
    public function employerInvitePageData()
    {
        // Filter available roles based on current user's role
        if(auth()->user()->role == 'employer'){
            // Employers can't invite employers or superadmins
            $roles = Role::whereNotIn('name', ['employer', 'superadmin'])->get();
        }else{
            // Others can't invite employees, clients, or superadmins
            $roles = Role::whereNotIn('name', ['employee', 'client', 'superadmin'])->get();
        }

        return view('invite.send_invite_employer', compact('roles'));
    }

    /**
     * Process employer invitation
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function employerInviteSend(Request $request)
    {
        // Clean up any existing data for this email
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        DB::table('users')->where('email', $request->email)->delete();

        // Validate request input
        $request->validate(
            [
                'email' => 'required|email|unique:users',
                'role_name' => 'required',
            ],
            [
                'email.required' => 'The email field is required.',
                'email.email' => 'The email must be a valid email address.',
            ]
        );

        try {
            // Generate and store password reset token
            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            // Create new user with specified role
            $input = $request->all();
            $input['role'] = $request->role_name;
            $user = User::create($input);

            // Assign role to user
            if ($request->role_name) {
                $user->assignRole([$request->role_name]);
            } else {
                $user->assignRole(['employee']);
            }

            // Create employer record if applicable
            if ($request->role_name == 'employer') {
                DB::table('employers')->insert([
                    'user_id' => $user->id,
                ]);
            }

            // Send invitation email if email is provided
            if ($input['email']) {
                // Get email template
                $emailTemplate = DB::table('email_templates')
                    ->where('type', 'employer_invite')
                    ->first();

                if ($emailTemplate && isset($emailTemplate->subject) && isset($emailTemplate->message)) {
                    // Format email content with dynamic data
                    $formattedBody = getFormattedTextByType('employer_invite', [
                        'app_name' => config('app.name'),
                        'verify_link' => url('/verify', $token),
                        'year' => date('Y'),
                    ]);

                    // Send invitation email
                    Mail::to($input['email'])->send(new EmployerInviteMail($emailTemplate->subject, $formattedBody));
                } else {
                    return redirect()->back()->with('error', 'Email template not found or is missing required fields.');
                }
            }

            // Generate API token for user
            $success['token'] = $user->createToken('timesheet')->plainTextToken;
            $success['name'] = $user->name;

            return redirect()->back()->with('success', 'Invite sent successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput($request->all())
                ->with(['error' => 'An error occurred while sending the invitation. Please try again later.']);
        }
    }

    /**
     * Process employee invitation
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function employeeInviteSend(Request $request)
    {
        // Validate request
        $request->validate(
            [
                'email' => 'required|email|unique:users',
                'role_name' => 'required',
            ],
            [
                'email.required' => 'The email field is required.',
                'email.email' => 'The email must be a valid email address.',
            ]
        );

        // Delete existing password reset tokens and users with the same email
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();
        DB::table('users')
            ->where('email', $request->email)
            ->delete();

        try {
            // Generate a new token and save it to the database
            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            // Create a new user
            $input = $request->all();
            $input['role'] = 'employee';
            $user = User::create($input);

            // Assign the specified role to the user
            if ($request->role_name) {
                $user->assignRole([$request->role_name]);
            } else {
                $user->assignRole(['employee']);
            }

            // Insert the employee record
            $employer = Employer::where('user_id', auth('web')->user()->id)->first();
            DB::table('employees')->insert([
                'employer_id' => $employer->id,
                'user_id' => $user->id,
            ]);

            // Send the invitation email
            if ($input['email']) {
                // Retrieve the email template from the database
                $emailTemplate = DB::table('email_templates')
                    ->where('type', 'employee_invite')
                    ->first();

                if ($emailTemplate && isset($emailTemplate->subject) && isset($emailTemplate->message)) {
                    // Replace placeholders with dynamic content
                    $formattedBody = getFormattedTextByType('employee_invite', [
                        'app_name' => config('app.name'),
                        'verify_link' => route('email.verify', $token),
                        'year' => date('Y'),
                    ]);

                    // Send email using Mailable class
                    Mail::to($input['email'])->send(new EmployeeInviteMail($emailTemplate->subject, $formattedBody));
                } else {
                    return redirect()->back()->with('error', 'Email template not found or is missing required fields.');
                }
            }

            $success['token'] = $user->createToken('timesheet')->plainTextToken;
            $success['name'] = $user->name;

            return redirect()->back()->with('success', 'Invite sent successfully');
        } catch (\Exception $e) {
            // Handle the exception
            return redirect()->back()->withInput($request->all())->with(['error' => 'An error occurred while sending the invitation. Please try again later.']);
        }
    }
}
