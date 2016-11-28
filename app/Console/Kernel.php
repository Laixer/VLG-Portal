<?php

namespace App\Console;

use \DB;
use App\Session;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // 
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Remove old sessions
        $schedule->call(function () {
            foreach(Session::all() as $session) {
                if ($session->isInvalid()) {
                    $session->delete();
                }
            }
        })->everyTenMinutes();

        // Remove expired reset tokens
        $schedule->call(function () {
            DB::table('password_resets')->whereRaw('created_at < DATE_SUB(NOW(), INTERVAL 1 HOUR)')->delete();
        })->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
