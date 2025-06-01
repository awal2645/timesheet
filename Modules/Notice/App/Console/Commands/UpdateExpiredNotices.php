<?php

namespace Modules\Notice\App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Notice\App\Models\Notice;
use Carbon\Carbon;

class UpdateExpiredNotices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notices:update-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of expired notices to ended';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredNotices = Notice::where('status', '!=', 'ended')
            ->where('end_date', '<', Carbon::now())
            ->get();

        foreach ($expiredNotices as $notice) {
            $notice->update(['status' => 'ended']);
            $this->info("Notice ID {$notice->id} has been marked as ended.");
        }

        $this->info('All expired notices have been updated.');
    }
} 