<?php

namespace App\Repositories\Dashboard;

use App\Models\TimeReport;

class TimeReportRepository
{
    public function getByUserId($userId, $pagination = 10)
    {
        return TimeReport::where('user_id', $userId)->paginate($pagination);
    }
}
