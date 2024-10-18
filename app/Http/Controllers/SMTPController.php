<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMTPController extends Controller
{
    public function __construct()
    {
        $this->middleware('role_or_permission:SMTP Config', ['only' => ['email']]);
        // Apply the access_limitation middleware if the app is in demo mode
        $this->middleware('access_limitation', ['only' => ['emailUpdate']]);
    }

    public function email()
    {
        return view('smtp.index');
    }

    public function emailUpdate(Request $request)
    {
        try {

            $request->validate([
                'mail_host' => 'required',
                'mail_port' => 'required',
                'numeric',
                'mail_username' => 'required',
                'mail_password' => 'required',
                'mail_encryption' => 'required',
                'mail_from_name' => 'required',
                'mail_from_address' => 'required',
                'email',
            ]);

            envUpdate('MAIL_HOST', $request->mail_host);
            envUpdate('MAIL_PORT', $request->mail_port);
            envUpdate('MAIL_USERNAME', $request->mail_username);
            envUpdate('MAIL_PASSWORD', $request->mail_password);
            envUpdate('MAIL_ENCRYPTION', $request->mail_encryption);
            replaceAppName('MAIL_FROM_NAME', $request->mail_from_name);
            envUpdate('MAIL_FROM_ADDRESS', $request->mail_from_address);

            return back()->with('success', 'Mail configuration update successfully');
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()
                ->back()
                ->withInput($request->all())
                ->with(['error' => 'Please try again later.']);
        }
    }
}
