<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEmployerStatus
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Assuming you have an authenticated employer user
        $user = Auth::user();

        // Check if the user has an 'employer' role and if their status is 0 or false
        if ($user->role === 'employer' && $user->employer->status == 0) {
            // Redirect or return a 403 forbidden response
            return redirect()->route('plans.index')->with('error', 'Your account is inactive Please buy a plan.');
        }

        return $next($request);
    }
}
