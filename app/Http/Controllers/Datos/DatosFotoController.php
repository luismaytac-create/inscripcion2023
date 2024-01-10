<?php

namespace App\Http\Controllers\Datos;

use App\Http\Controllers\Controller;
use App\Http\Requests\DatosPersonalesRequest;
use App\Models\FotoObservacion;
use App\Models\Modalidad;
use App\Models\Postulante;
use App\Models\RegistroDni;
use App\Models\Restriccion;
use Auth;
use  Alert;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
class DatosFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $existe = Postulante::where('idusuario',Auth::user()->id)->count();
        if($existe==0){
            Alert::warning('No registro su preinscripcion')
                ->details('Debes ingresar a la opcion Datos y llenar el formularo de preinscripcion')
                ->button('Lo puedes hacer haciendo clic aqui',route('datos.index'),'primary');

            return back();

        }else {
            $postulante = Postulante::Usuario()->first();

            if( FotoObservacion::where('idpostulante',$postulante->id)->count() >0 ){
                $observacion = FotoObservacion::where('idpostulante',$postulante->id)->first();
                $obs = $observacion->observacion;
            }else {
                $obs = '';
            }





            $doctodos = RegistroDni::where('dni',$postulante->numero_identificacion)->get();
            return view('datos.foto.foto',compact('postulante','obs','doctodos'));



        }

    }


}
