<?php

namespace App\Http\Middleware;

use App\Models\UserPlan;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Ensure this model matches your table structure

class CheckPlanLimits
{
    /**
     * Handle an incoming request.
     *
     * @param  string  $resource
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $resource)
    {
        $user = Auth::user();
        // Check if the user is a superadmin or any other role that should bypass the check
        if ($user->role != 'employer') {
            // If the user is a superadmin or other roles that bypass, skip the checks and proceed
            return $next($request);
        }
        // Find the employer_id related to the user (assuming you have this relationship in place)
        $userPlan = UserPlan::where('employer_id', $user->employer->id)->first();

        if (! $userPlan) {
            return redirect()->back()->with('error', 'No plan found for your please buy a plan.');
        }

        // Check the limits based on the resource type
        switch ($resource) {
            case 'employee':
                if ($userPlan->employee_limit <= $user->employer->employee()->count()) {
                    return redirect()->back()->with('error', "You cannot add more than ($userPlan->employee_limit) employee(s). Please upgrade your plan to add more employees");
                }
                break;

            case 'client':
                if ($userPlan->client_limit <= $user->employer->client()->count()) {
                    return redirect()->back()->with('error', 'Client limit reached.');

                    return redirect()->back()->with('error', "You cannot add more than ($userPlan->client_limit) client(s). Please upgrade your plan to add more clients");

                }
                break;

            case 'project':
                if ($userPlan->project_limit <= $user->employer->project()->count()) {
                    return redirect()->back()->with('error', "You cannot add more than ($userPlan->project_limit) project(s). Please upgrade your plan to add more projects");

                }
                break;
        }

        // If all checks pass, allow the request to proceed
        return $next($request);
    }
}
