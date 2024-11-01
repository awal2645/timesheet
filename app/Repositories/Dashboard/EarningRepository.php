<?php

namespace App\Repositories\Dashboard;

use App\Models\Earning;

class EarningRepository
{
    public function getEmployerTransactions($employerId, $pagination = 6)
    {
        return Earning::with('plan:id,label')
            ->where('employer_id', $employerId)
            ->latest()
            ->paginate($pagination);
    }

    public function getAllTransactions($pagination = 10)
    {
        return Earning::with(['plan:id,label', 'employer.user'])
            ->latest()
            ->paginate($pagination);
    }
}
