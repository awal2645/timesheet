<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleDesktopLogin
{
    /**
     * Handle desktop application login flow.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Only intercept if this is a desktop app login
        if ($request->has('desktop_app') && $request->desktop_app === 'true') {
            // Store callback information in session
            session([
                'desktop_callback_port' => $request->callback_port,
                'desktop_callback_url' => $request->callback_url,
                'desktop_state' => $request->state
            ]);

            // If user is already authenticated, redirect to callback
            if (Auth::check()) {
                return $this->handleCallback($request, Auth::user());
            }
        }
        
        // If this is a post-login redirect and we have desktop callback info
        if (Auth::check() && session()->has('desktop_callback_port')) {
            return $this->handleCallback($request, Auth::user());
        }

        return $next($request);
    }

    /**
     * Handle successful authentication callback
     */
    private function handleCallback($request, $user)
    {
        // Generate API token for desktop app
        $token = $user->createToken('desktop-app')->plainTextToken;

        // Build callback URL with authentication data
        $callbackUrl = session('desktop_callback_url') . 
            "?token=" . urlencode($token) . 
            "&state=" . urlencode(session('desktop_state')) .
            "&user=" . urlencode(json_encode([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]));

        // Clear desktop login session data
        session()->forget([
            'desktop_callback_port',
            'desktop_callback_url',
            'desktop_state'
        ]);

        return redirect($callbackUrl);
    }
} 