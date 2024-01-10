<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\Pagos\PagosController;

class CreateFilePay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ocad:paygenerate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera archivo de pagos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        (new PagosController)->createbcp();
        $this->info('Archivo generado');
    }
}
