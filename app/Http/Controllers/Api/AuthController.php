<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Generate token for desktop app
     */
    public function desktopLogin(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
                'callback_url' => 'nullable|url'
            ]);

            $user = User::where('username', $request->username)
                       ->orWhere('email', $request->username)
                       ->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                if ($request->wantsJson() || $request->header('Accept') === 'application/json') {
                    return response()->json([
                        'error' => 'Invalid credentials',
                        'message' => 'The provided credentials are incorrect.'
                    ], 401);
                }
                
                return back()->withErrors([
                    'username' => 'The provided credentials are incorrect.',
                ]);
            }

            // Delete any existing desktop tokens for this user
            $user->tokens()->where('name', 'like', 'desktop-%')->delete();

            // Create new token with specific abilities
            $token = $user->createToken('desktop-' . now()->timestamp, [
                'screenshot:store',
                'activity:store',
                'timesheet:read',
                'timesheet:write'
            ]);

            $tokenString = $token->plainTextToken;
            
            // If callback URL is provided, redirect with token
            if ($request->callback_url) {
                $callbackUrl = $request->callback_url;
                if (str_contains($callbackUrl, '?')) {
                    $callbackUrl .= '&';
                } else {
                    $callbackUrl .= '?';
                }
                $callbackUrl .= 'token=' . urlencode($tokenString);
                
                return redirect($callbackUrl);
            }

            // Otherwise return JSON response
            return response()->json([
                'token' => $tokenString,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => $user->username
                ]
            ]);
            
        } catch (ValidationException $e) {
            Log::error('Desktop login validation error', [
                'errors' => $e->errors(),
                'username' => $request->username ?? 'unknown'
            ]);
            
            if ($request->wantsJson() || $request->header('Accept') === 'application/json') {
                return response()->json([
                    'error' => 'Validation error',
                    'message' => $e->getMessage(),
                    'errors' => $e->errors()
                ], 422);
            }
            
            throw $e;
        } catch (\Exception $e) {
            Log::error('Desktop login error', [
                'error' => $e->getMessage(),
                'username' => $request->username ?? 'unknown'
            ]);
            
            if ($request->wantsJson() || $request->header('Accept') === 'application/json') {
                return response()->json([
                    'error' => 'Login failed',
                    'message' => $e->getMessage()
                ], 500);
            }
            
            throw $e;
        }
    }

    /**
     * Revoke desktop app token
     */
    public function desktopLogout(Request $request)
    {
        try {
            $request->user()->tokens()->where('name', 'like', 'desktop-%')->delete();
            
            return response()->json(['message' => 'Logged out successfully']);
        } catch (\Exception $e) {
            Log::error('Desktop logout error', [
                'error' => $e->getMessage(),
                'user_id' => $request->user()->id ?? 'unknown'
            ]);
            
            return response()->json([
                'error' => 'Logout failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
} 