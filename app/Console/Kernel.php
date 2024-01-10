<?php

namespace App\Console;

use App\Console\Commands\OcadEnvio;
use App\Console\Commands\CreateFilePay;
use App\Console\Commands\CreateApplicantCode;
use App\Console\Commands\ValidateApplicantsRegistration;
use App\Console\Commands\CreaFichaMasivaCommand;
use App\Console\Commands\testCommand;
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
        OcadEnvio::class,
        CreateFilePay::class,
        CreateApplicantCode::class,
        ValidateApplicantsRegistration::class,
        CreaFichaMasivaCommand::class,
        testCommand::class,

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('ocad:enviomul')
             ->everyMinute();
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
