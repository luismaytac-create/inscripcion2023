<?php

namespace App\Http\Controllers\Resultados;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;

class ResultadosController extends Controller
{
    public function index()
    {
    	$postulante = Postulante::Usuario()->with('Resultados')->first();
    	if(isset($postulante))
    		return view('resultados.index',compact('postulante'));
    	else{
    		Alert::warning('Debe registrar sus datos para acceder a esta opción');
    		return back();
    	}
    }
}
