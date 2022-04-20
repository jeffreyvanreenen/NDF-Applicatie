<?php

namespace App\Console;

use App\Jobs\CleanupJob;
use App\Jobs\RSS_scraperJob;
use App\Jobs\SearchRSSJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new RSS_scraperJob)->everyFifteenMinutes();
        $schedule->job(new SearchRSSJob)->everyTenMinutes();
        $schedule->job(new CleanupJob())->everyThreeHours();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
