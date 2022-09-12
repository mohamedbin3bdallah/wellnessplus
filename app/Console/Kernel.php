<?php

namespace App\Console;

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
        Commands\appointmentReminder::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $storagePath = storage_path();

        $schedule->command('appointmentReminder')
            ->everyMinute()
            ->sendOutputTo($storagePath.'/logs/cron/appointmentReminder_'.date('Y-m-d H:i:s'));
            //->emailOutputTo('arafa.ezzat@gmail.com');



        $schedule->command('cancelNonPaymentAppointments')
            ->everyThirtyMinutes()
            ->withoutOverlapping()
            ->sendOutputTo($storagePath.'/logs/cron/cancelNonPaymentAppointments_'.date('Y-m-d H:i:s'));
            //->emailOutputTo('arafa.ezzat@gmail.com');


//        $schedule->command('MissingProfileData')
//            ->dailyAt('04:00')
//            ->withoutOverlapping()
//            ->sendOutputTo($storagePath.'/logs/cron/MissingProfileData_'.date('Y-m-d H:i:s'))
//            ->emailOutputTo('arafa.ezzat@gmail.com');
    }

    /**  $schedule->command('appointmentReminder')
            ->everyMinute();
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
