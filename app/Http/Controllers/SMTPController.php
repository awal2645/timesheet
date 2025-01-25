<?php

namespace App\Http\Controllers;

use App\Models\Smtp;
use Illuminate\Http\Request;

/**
 * Controller for managing SMTP email configurations
 * Handles email server settings for different user roles
 */
class SMTPController extends Controller
{
    /**
     * Set up middleware for access control
     * Restricts access to SMTP configuration based on permissions
     */
    public function __construct()
    {
        // Only users with 'SMTP Config' permission can access email settings
        $this->middleware('role_or_permission:SMTP Config', ['only' => ['email']]);
        
        // Restrict updates in demo mode
        $this->middleware('access_limitation', ['only' => ['emailUpdate']]);
    }

    /**
     * Display SMTP configuration form
     * 
     * @return \Illuminate\View\View
     */
    public function email()
    {
        return view('smtp.index');
    }

    /**
     * Update SMTP configuration settings
     * Handles both system-wide and employer-specific settings
     * 
     * @param Request $request Contains SMTP configuration data
     * @return \Illuminate\Http\RedirectResponse
     */
    public function emailUpdate(Request $request)
    {
        try {
            // Validate SMTP configuration data
            $request->validate([
                'mail_host' => 'required',
                'mail_port' => 'required|numeric',
                'mail_username' => 'required',
                'mail_password' => 'required',
                'mail_encryption' => 'required',
                'mail_from_name' => 'required',
                'mail_from_address' => 'required|email',
            ]);

            // Handle different user roles
            if (auth()->user()->role != 'employer') {
                // Update system-wide SMTP settings
                envUpdate('MAIL_HOST', $request->mail_host);
                envUpdate('MAIL_PORT', $request->mail_port);
                envUpdate('MAIL_USERNAME', $request->mail_username);
                envUpdate('MAIL_PASSWORD', $request->mail_password);
                envUpdate('MAIL_ENCRYPTION', $request->mail_encryption);
                replaceAppName('MAIL_FROM_NAME', $request->mail_from_name);
                envUpdate('MAIL_FROM_ADDRESS', $request->mail_from_address);
            } else {
                // Handle employer-specific SMTP settings
                if (Smtp::where('created_by', auth()->user()->id)->exists()) {
                    // Update existing SMTP configuration
                    Smtp::where('created_by', auth()->user()->id)->update([
                        'host' => $request->mail_host,
                        'port' => $request->mail_port,
                        'username' => $request->mail_username,
                        'password' => $request->mail_password,
                        'encryption' => $request->mail_encryption,
                        'mail_from_name' => $request->mail_from_name,
                        'mail_from_address' => $request->mail_from_address,
                    ]);
                } else {
                    // Create new SMTP configuration
                    Smtp::create([
                        'host' => $request->mail_host,
                        'port' => $request->mail_port,
                        'username' => $request->mail_username,
                        'password' => $request->mail_password,
                        'encryption' => $request->mail_encryption,
                        'mail_from_name' => $request->mail_from_name,
                        'mail_from_address' => $request->mail_from_address,
                        'created_by' => auth()->user()->id,
                    ]);
                }
            }

            return back()->with('success', 'Mail configuration update successfully');
        } catch (\Exception $e) {
            // Handle any errors during update
            return redirect()
                ->back()
                ->withInput($request->all())
                ->with(['error' => 'Please try again later.']);
        }
    }
}

