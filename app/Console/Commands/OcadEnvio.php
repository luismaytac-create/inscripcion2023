<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Pagos\PagosController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use ZipArchive;
use Storage;
class OcadEnvio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ocad:enviomul';

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

        $data = array(
            'name' => 'xxx'
       );


        $pag = new PagosController();
        $pag->create();
        $public_dir=storage_path();
        $zipFileName = 'UNIADMIS.zip';
        $zip = new ZipArchive;

        if ($zip->open($public_dir . '/app/carteras/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
            // Add File in ZipArchive
            $zip->addFile($public_dir.'/app/carteras/'.'UNIADMIS.txt','UNIADMIS.txt');
            // Close ZipArchive
            $zip->close();
        }


        Mail::send('emails.test', $data, function ($message) {

            $message->from('informes@admisionuni.edu.pe');
            $public_dir=storage_path();
            $zipFileName = 'UNIADMIS.zip';
            $message->to(array("ctucto@admisionuni.edu.pe","jcampos@admisionuni.edu.pe","jmorales@admisionuni.edu.pe","mabarrera@uni.edu.pe"))->subject('CONCURSO DE ADMISIÓN 2019-2');
            $message->attach($public_dir . '/app/carteras/' . $zipFileName);
        });


    }
}
