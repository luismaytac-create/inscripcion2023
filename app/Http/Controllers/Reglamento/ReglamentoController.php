<?php

namespace App\Http\Controllers\Reglamento;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ReglamentoController extends Controller
{
    public function index()
    {
        $postulante = Postulante::Usuario()->first();
        if (isset($postulante)) {
           return view('reglamento.index');
        }else{
            Alert::warning('Debe realizar su Preinscripción para acceder a esta opción');
            return back();
        }
    }
   public function documento($doc)
    {
        $disk = Storage::disk('documentos');

        $filename = $doc . '.pdf';

        if ($doc == 'solucionario') {
            
            if ($disk->exists('solucionario.zip')) {
                $filename = 'solucionario.zip';
            }
        }
        if ($disk->exists($filename)) {
            $headers = [];
            return response()->download(
                storage_path('app/documentos/' . $filename),
                null,
                $headers
            );
        } else {
            Alert::info('Lo sentimos en este momento no podemos mostrarle este documento');
            return back();
        }
    }
}
