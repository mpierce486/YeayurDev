<?php

namespace Yeayurdev\Console;

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
        \Yeayurdev\Console\Commands\Inspire::class,
        \Yeayurdev\Console\Commands\WeeklyEmail::class,
        \Yeayurdev\Console\Commands\DailyEmail::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();

        $schedule->command('email:daily-posts')->daily();

        $schedule->command('email:weekly-posts')->weekly();
    }
}
