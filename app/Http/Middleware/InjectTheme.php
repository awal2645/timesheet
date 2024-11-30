<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Theme;
use Illuminate\Http\Request;

class InjectTheme
{
    public function handle(Request $request, Closure $next)
    {
        $theme = Theme::first();
        view()->share('theme', $theme);
        return $next($request);
    }
} 