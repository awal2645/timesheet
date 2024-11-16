<?php

namespace App\Http\Controllers;

use App\Repositories\Dashboard\TimeReportRepository;
use App\Repositories\Dashboard\EarningRepository;

class DashboardController extends Controller
{
    protected $timeReportRepo;
    protected $earningRepo;

    public function __construct(TimeReportRepository $timeReportRepo, EarningRepository $earningRepo)
    {
        $this->timeReportRepo = $timeReportRepo;
        $this->earningRepo = $earningRepo;
    }

    public function index()
    {
        $user = auth('web')->user();

        if ($user->role == 'employee') {
            $timeReports = $this->timeReportRepo->getByUserId($user->id);

            return view('pages/dashboard/dashboard', compact('timeReports'));
        }

        // Fetch transactions based on role
        if ($user->role === 'employer') {
            $transactions = $this->earningRepo->getEmployerTransactions($user->employer->id);
        } else {
            $transactions = $this->earningRepo->getAllTransactions();
        }

        return view('pages/dashboard/dashboard', compact('transactions'));
    }
}
