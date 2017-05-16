<?php

namespace App\Console;

use App\FinalTransactions;
use Illuminate\Console\Scheduling\Schedule;
use DB;
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
        // $schedule->command('inspire')
        //          ->hourly();


//        $schedule->call(function () {
//            $tstudent = DB::select("select * from `transactions` where `reserved_date` is not null");
//            dd($tstudent);
//
//            $Finaltransaction = new FinalTransactions();
//            $Finaltransaction->student_id ='12345';
//
//            $Finaltransaction->book_id ='12345';
//            $Finaltransaction->save();
//
//
//        })->daily();;
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
