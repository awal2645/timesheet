<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class AuthController extends Controller
{
    public function verify(Request $request, $token)
    {
        try {
            // Use first() to retrieve the first result from the query
            $data = DB::table('password_reset_tokens')->where('token', $token)->first();

            if ($data) {
                // Update the user's email_verified_at column to mark the email as verified
                $user = User::where('email', $data->email)->first();
                if ($user) {
                    $user->update(['email_verified_at' => now()]);

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

    public function usernamePassword($token)
    {
        return view('auth.usernamePassword');
    }

    public function updateUserInfo(Request $request)
    {
        // Validate the form data
        $request->validate(
            [
                'username' => 'required|string|max:255',
                'password' => 'nullable|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
            [
                'password.required' => 'The password field is required.',
                'password.min' => 'The password must be at least 8 characters long.',
                'password.confirmed' => 'The password confirmation does not match.',
                'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, and one number.',
            ],
        );
        try {
            // Get the currently authenticated user
            $data = DB::table('password_reset_tokens')
                ->where('token', $request->token)
                ->first();

            $user = User::where('email', $data->email)->first();

            // Update the user information
            $user->username = $request->username;

            // Check if a new password is provided and update it
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            // Save the changes
            $user->save();

            if ($user) {
                // Use the credentials to attempt to authenticate the user
                $credentials = [
                    'email' => $user->email,
                    'password' => $request->password, // Assuming the password field is filled
                ];

                // Attempt to log in the user
                if (Auth::attempt($credentials)) {
                    // Authentication successful
                    return redirect('/dashboard'); // Redirect to the dashboard or any other desired page
                } else {
                    // Authentication failed
                    return redirect('/login')->with('error', 'Invalid credentials');
                }
            } else {
                // Handle the case where the user update was not successful
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

    public function changeLanguage(Request $request)
    {

        try {
            session()->put('current_lang', $request->language);
            app()->setLocale($request->language);
            App::setLocale($request->language);
            $locale = App::currentLocale();

            // dd($locale);

            return back()->with('success', 'language updated successfully! ');
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error('Error changing language: ' . $e->getMessage());

            return back()->with('error', 'Unable to change the language.');
        }
    }
}
