<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Sms\SmsController;
use Mail;
use App\Mail\DenegadoEmail;
use App\Models\Postulante;

class testCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //$postulante = Postulante::find(734);telefono_celular
        //Mail::to($postulante->email)->cc('luis.mayta@gmail.com')->send(new DenegadoEmail('foto'));
        (new SmsController)->metodo2('992949424','test');
        $this->info('Message');
    }
}
