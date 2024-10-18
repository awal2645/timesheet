<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AccessLimitation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the app is in demo mode
        if (env('APP_MODE') === 'demo') {
            // Optionally, add logic to check roles/permissions here if needed
            
            // Block access with a 403 Forbidden response
            return redirect()->back()->with('error', 'This action is not allowed in demo mode.');
            
        }

        return $next($request);
    }
}
