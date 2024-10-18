<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use App\Models\TimeReport;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        if (auth('web')->user()->role == 'employee') {
            $timeReports = TimeReport::where('user_id', auth('web')->user()->id)->paginate(10);

            return view('pages/dashboard/dashboard', compact('timeReports'));
        }

        // Fetch transactions with optional search functionality
        if (auth()->user()->role === 'employer') {

            $authUser = Auth::user();
            $transactions = Earning::with('plan:id,label')->where('employer_id', $authUser->employer->id)
                ->latest()
                ->paginate(6);
        } else {

            $transactions = Earning::with(['plan:id,label', 'employer.user'])
                ->latest()
                ->paginate(10);
        }

        return view('pages/dashboard/dashboard', compact('transactions'));
    }
}
