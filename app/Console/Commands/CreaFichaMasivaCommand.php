<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Ficha\FichaController;

class CreaFichaMasivaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ocad:ficha-masiva {id}';

    /**
     * The console Crea Ficha en forma Masiva.
     *
     * @var string
     */
    protected $description = 'Crea Ficha en forma Masiva';

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
        $id = $this->argument('id');
        (new FichaController)->pdfMasivo($id);
        $this->info('Crea Ficha de '.$id);
    }
}
