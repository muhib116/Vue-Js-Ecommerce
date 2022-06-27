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
        Commands\Jowarbhata::class,
		Commands\Updatebhata::class,
		Commands\UpdateAI::class,
		Commands\Quiz::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('jowar:bhata')
            ->everyMinute()->appendOutputTo(storage_path('logs/jowarbhata.log'));
			$schedule->command('update:bhata')
            ->dailyAt('00:01')->appendOutputTo(storage_path('logs/restartjb.log'));
           $schedule->command('update:quiz')
            ->dailyAt('00:01')->appendOutputTo(storage_path('logs/quiz.log'));
            $schedule->command('update:ai')
            ->everyMinute()->appendOutputTo(storage_path('logs/ai.log'));
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
