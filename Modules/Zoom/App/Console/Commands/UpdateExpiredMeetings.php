<?php

namespace Modules\Zoom\App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Modules\Zoom\App\Models\Meeting;

class UpdateExpiredMeetings extends Command
{
    protected $signature = 'meetings:update-expired';
    protected $description = 'Update status of expired meetings to ended';

    public function handle()
    {
        $now = Carbon::now();
        
        // Get all meetings that are not ended and have passed their date/time
        $meetings = Meeting::where('status', '!=', 'ended')
            ->where(function ($query) use ($now) {
                $query->whereDate('start_date', '<', $now->toDateString())
                    ->orWhere(function ($q) use ($now) {
                        $q->whereDate('start_date', '=', $now->toDateString())
                            ->whereTime('start_time', '<', $now->format('H:i:s'));
                    });
            })
            ->get();

        $count = 0;
        foreach ($meetings as $meeting) {
            $meeting->status = 'ended';
            $meeting->save();
            $count++;
        }

        $this->info("Updated {$count} expired meetings to ended status.");
    }
} 