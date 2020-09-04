<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use App\Event;
use Carbon\Carbon;

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
        $schedule->call(function () {

            $now = Carbon::now();

            $finishEvents = Event::where('start', '<', $now)->get();

            foreach($finishEvents as $finishEvent){

                $finishEvent->title = '受付終了';

                $finishEvent->save();
            }
          
        })
        ->everyMinute()
        ->timezone('Asia/Tokyo');
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
