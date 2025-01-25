<?php

namespace App\Http\Controllers;

use App\Repositories\Dashboard\TimeReportRepository;
use App\Repositories\Dashboard\EarningRepository;

/**
 * Controller for handling dashboard views and data
 * Uses repository pattern for data access
 */
class DashboardController extends Controller
{
    /** @var TimeReportRepository */
    protected $timeReportRepo;
    
    /** @var EarningRepository */
    protected $earningRepo;

    /**
     * Initialize controller with required repositories
     * @param TimeReportRepository $timeReportRepo Repository for time report data
     * @param EarningRepository $earningRepo Repository for earnings data
     */
    public function __construct(TimeReportRepository $timeReportRepo, EarningRepository $earningRepo)
    {
        $this->timeReportRepo = $timeReportRepo;
        $this->earningRepo = $earningRepo;
    }

    /**
     * Display the dashboard view with role-specific data
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get authenticated user from web guard
        $user = auth('web')->user();

        // For employees, show time reports
        if ($user->role == 'employee') {
            $timeReports = $this->timeReportRepo->getByUserId($user->id);
            return view('pages/dashboard/dashboard', compact('timeReports'));
        }

        // For employers and admins, show transactions
        if ($user->role === 'employer') {
            // Employers see only their company's transactions
            $transactions = $this->earningRepo->getEmployerTransactions($user->employer->id);
        } else {
            // Admins see all transactions
            $transactions = $this->earningRepo->getAllTransactions();
        }

        return view('pages/dashboard/dashboard', compact('transactions'));
    }
}
