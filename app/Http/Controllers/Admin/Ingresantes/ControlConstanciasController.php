<?php

namespace App\Http\Controllers\Admin\Ingresantes;

use App\Http\Controllers\Controller;
use App\Models\Ingresante;
use App\Models\Postulante;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
class ControlConstanciasController extends Controller
{
    public function index()
    {
        $Lista = Postulante::with('ingresantes')->Has('ingresantes')->get();
        if ($Lista->count()==0) $Lista = [];

        $novino = Ingresante::where('estado_constancia','NO VINO')->count();
        $conforme = Ingresante::where('estado_constancia','CONFORME')->count();
        $noconforme = Ingresante::where('estado_constancia','NO CONFORME')->count();
        $obs = Ingresante::where('estado_constancia','CON OBSERVACIONES')->count();
        $conformesincm = Ingresante::where('estado_constancia','CONFORME SIN CERT MEDICO=')->count();



        return view('admin.ingresantes.control.index',compact('Lista','novino','conforme','noconforme','obs','conformesincm'));
    }
    public function store(Request $request)
    {
        $rules = array (
            'dni' => 'required'
        );
        $validator = Validator::make ( $request->all(), $rules );
        if ($validator->fails()) {
            return [
                'errors' => $validator->getMessageBag()->toArray()
            ];
        }else {
            $postulante = Postulante::where('numero_identificacion',$request->dni)->first();
            $date = Carbon::now();
            Ingresante::where('idpostulante',$postulante->id)->update([
                'estado_constancia'=>'ENTREGADO',
                'fecha_constancia'=>$date,
                'estado_constancia'=>$request->estado,
                'observacion'=>$request->observacion
            ]);
            $Lista = Postulante::with('ingresantes')->Has('ingresantes')->get();
            if ($Lista->count()==0) {
                return[
                    'errors'=> ['dni'=>'No constancias registradas']
                ];
            } else {
                return response ()->json ( $Lista );
            }

        }
    }
}