<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Verify user's email using the token from the verification link
     * @param Request $request
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request, $token)
    {
        try {
            // Check if token exists in password_reset_tokens table
            $data = DB::table('password_reset_tokens')->where('token', $token)->first();

            if ($data) {
                // Find user by email and update verification timestamp
                $user = User::where('email', $data->email)->first();
                if ($user) {
                    $user->update(['email_verified_at' => now()]);
                    // Redirect to set username and password page
                    return redirect()->route('username.password', $data->token);
                }
            } else {
                return back();
            }
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()
                ->back()
                ->withErrors(['error' => 'An error occurred while verifying the email. Please try again later.']);
        }
    }

    /**
     * Display the username and password setup form
     * @param string $token
     * @return \Illuminate\View\View
     */
    public function usernamePassword($token)
    {
        return view('auth.usernamePassword');
    }

    /**
     * Update user's username and password after email verification
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserInfo(Request $request)
    {
        // Validate username and password with custom error messages
        $request->validate(
            [
                'username' => 'required|string|max:255',
                // Password must contain uppercase, lowercase, and number
                'password' => 'nullable|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            [
                'password.required' => 'The password field is required.',
                'password.min' => 'The password must be at least 8 characters long.',
                'password.confirmed' => 'The password confirmation does not match.',
                'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one number.',
            ]
        );

        try {
            // Find user by token from password_reset_tokens table
            $data = DB::table('password_reset_tokens')
                ->where('token', $request->token)
                ->first();

            $user = User::where('email', $data->email)->first();

            // Update username and password if provided
            $user->username = $request->username;
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            if ($user) {
                // Attempt to login user with new credentials
                $credentials = [
                    'email' => $user->email,
                    'password' => $request->password,
                ];

                if (Auth::attempt($credentials)) {
                    return redirect('/dashboard');
                } else {
                    return redirect('/login')->with('error', 'Invalid credentials');
                }
            } else {
                return redirect('/login')->with('error', 'Failed to update user information');
            }
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return an error response
            return redirect()
                ->back()
                ->withInput($request->all())
                ->with(['error' => 'An error occurred while updating user information. Please try again later.']);
        }
    }

    /**
     * Change the application's language
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLanguage(Request $request)
    {
        try {
            // Store language preference in session and update application locale
            session()->put('current_lang', $request->language);
            app()->setLocale($request->language);
            App::setLocale($request->language);
            $locale = App::currentLocale();

            return back()->with('success', 'language updated successfully! ');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            return back()->with('error', 'Unable to change the language.');
        }
    }
}
