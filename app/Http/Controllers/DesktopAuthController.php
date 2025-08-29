<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DesktopAuthController extends Controller
{
    public function showLogin(Request $request)
    {
        try {
            return view('auth.login', [
                'callback_port' => $request->get('callback_port', 8766),
                'callback_url' => $request->get('callback_url'),
                'state' => $request->get('state'),
                'desktop_app' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Desktop login error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to show login page'], 500);
        }
    }

    public function authenticate(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => 'required|string',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('desktop-app')->plainTextToken;
               
              return redirect()->away($request->callback_url . '?token=' . urlencode($token));
            

            }

            return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
        } catch (\Exception $e) {
            Log::error('Desktop authentication error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred during authentication'], 500);
        }
    }
} 