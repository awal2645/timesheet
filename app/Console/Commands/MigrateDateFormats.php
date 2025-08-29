<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TimeReport;
use Carbon\Carbon;

class MigrateDateFormats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:date-formats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate existing date formats from m-d-y to Y-m-d in time reports';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting date format migration...');

        $timeReports = TimeReport::all();
        $migratedCount = 0;

        foreach ($timeReports as $timeReport) {
            $startDayUpdated = false;
            $endDayUpdated = false;

            // Check and update start_day if needed
            if ($timeReport->start_day && $this->isOldDateFormat($timeReport->start_day)) {
                $newStartDay = $this->convertDateFormat($timeReport->start_day);
                $timeReport->start_day = $newStartDay;
                $startDayUpdated = true;
            }

            // Check and update end_day if needed
            if ($timeReport->end_day && $this->isOldDateFormat($timeReport->end_day)) {
                $newEndDay = $this->convertDateFormat($timeReport->end_day);
                $timeReport->end_day = $newEndDay;
                $endDayUpdated = true;
            }

            // Save if any changes were made
            if ($startDayUpdated || $endDayUpdated) {
                $timeReport->save();
                $migratedCount++;
                $this->line("Migrated TimeReport ID: {$timeReport->id}");
            }
        }

        $this->info("Migration completed! {$migratedCount} records were updated.");
        return 0;
    }

    /**
     * Check if a date string is in the old m-d-y format
     *
     * @param string $date
     * @return bool
     */
    private function isOldDateFormat($date)
    {
        return preg_match('/^\d{1,2}-\d{1,2}-\d{2}$/', $date);
    }

    /**
     * Convert date from m-d-y format to Y-m-d format
     *
     * @param string $date
     * @return string
     */
    private function convertDateFormat($date)
    {
        $parts = explode('-', $date);
        if (count($parts) === 3) {
            $month = str_pad($parts[0], 2, '0', STR_PAD_LEFT);
            $day = str_pad($parts[1], 2, '0', STR_PAD_LEFT);
            $year = $parts[2];
            
            // Convert 2-digit year to 4-digit year
            // Assuming years 00-49 are 2000-2049, years 50-99 are 1950-1999
            $year = $year < 50 ? '20' . $year : '19' . $year;
            
            return $year . '-' . $month . '-' . $day;
        }
        
        return $date; // Return original if conversion fails
    }
}
