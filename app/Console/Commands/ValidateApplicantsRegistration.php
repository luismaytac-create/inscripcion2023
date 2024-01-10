<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Postulante;
use Storage;

class ValidateApplicantsRegistration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ocad:validate-applicants-registration {file}';

    /**
     * The console Valida si esta permitida la inscripcion de un postulante.
     *
     * @var string
     */
    protected $description = 'Valida si esta permitida la inscripcion de un postulante';

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
        $file = $this->argument('file');
        if (($open = fopen(storage_path() . "/app/".$file, "r")) !== FALSE) {

            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
        	$this->info('Postulante: '.$data[1]);
                Postulante::where('numero_identificacion', $data[0])->update(['orce' => $data[1]]);
            }

            fclose($open);
        }
    }
}
