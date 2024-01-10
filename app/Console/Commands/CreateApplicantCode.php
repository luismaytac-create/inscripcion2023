<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Postulante;

class CreateApplicantCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ocad:codigo {idpostulante}';

    /**
     * The console Crea el codigo del postulante.
     *
     * @var string
     */
    protected $description = 'Crea el codigo del postulante';

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
        $idpostulante = $this->argument('idpostulante');
        $postulante = Postulante::whereNull('codigo')->where('id',$idpostulante)->first();
        if (is_object($postulante)) {
            Postulante::AsignarCodigo($idpostulante,$postulante->canal,$postulante->codigo_modalidad);
            $this->info('Creando codigo para el postulante '.$idpostulante);
        }
    }
}
