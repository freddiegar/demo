<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BankController;

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
        /*
         | Tarea programada para consultar y actualizar el estado de las transacciones
         | que tienen estado PENDING
        */ 
        $schedule->call(function(){
            $TransactionController = new TransactionController();
            $TransactionController->getTransactionStatus();
        })
        ->everyFiveMinutes();
        /*
         | Tarea programada para actualizar la lista de bancos disponibles para realizar
         | el pago, debe ser diario
        */ 
        $schedule->call(function(){
            $BankController = new BankController();
            $BankController->getBank();
        })
        ->daily();

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
