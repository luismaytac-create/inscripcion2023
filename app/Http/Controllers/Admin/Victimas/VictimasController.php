<?php

namespace App\Http\Controllers\Admin\Victimas;

use App\Http\Controllers\Controller;
use App\Models\Victimas;
use App\Models\Postulante;
use App\Models\SolicitanteVictima;
use App\Models\DocumentVictima;
use Auth;
use DB;
use Illuminate\Http\Request;
use Alert;
class VictimasController extends Controller
{
    public function index()
    {

        $Lista = DB::table("listado_victimas")->get();
        return view('admin.victimas.index',compact('Lista'));
    }

    public function lista() {
        $Lista = DB::table("solicitantes_victimas_terro") ->get();
        return view('admin.victimas.lista',compact('Lista'));
    }


    public function evaluar($dni){

        $soliti = SolicitanteVictima::where ( 'dni' ,$dni)->first();
        $postulante = Postulante::where('id',$soliti->idpostulante)->first();
        $data = Postulante::ValidarDNI($postulante->numero_identificacion)->with(['solicitanteVictima'])->first();

        $documentos= DocumentVictima::where('dni',$dni)->where('activo',true)->get();

        return view('admin.victimas.evaluar',compact('data','documentos','soliti'));

    }



    public function desactivar($dni){
            Victimas::where('dni',$dni)->update(['activo'=>0]);
        Alert::success('Victima Desactivada con exito');
        return back();
    }


    public function activar($dni){
        Victimas::where('dni',$dni)->update(['activo'=>1]);
        Alert::success('Victima Activada con exito');
        return back();
    }
    public function store(Request $request){

        $coun = Victimas::where('dni',$request->dni)->count();

        if($coun>0) {

            Alert::danger('Ya existe el dni ingresado, verifique si se encuentra activo.');
            return back();
        }else {

            Victimas::create($request->all());
            Alert::success('Victima Registrada con exito.');
            return back();
        }

    }


    public function save( Request $request)
    {







        if($request->otorga == 'DENEGADO')
        {


            $var_otor = 'DENEGADO';

        }else if($request->otorga == 'APROBADO')
        {

            $var_otor = 'APROBADO';


        }else if($request->otorga == 'PENDIENTE')
        {

            $var_otor = 'PENDIENTE';
        }

        $data = SolicitanteVictima::where('idpostulante',$request->idpostulante)->update([

            'estado' => $var_otor,
            'observaciones'=> $request->observaciones,

            'dni'   => $request->dni,

            'iduser' => Auth::user()->id
        ]);


        $counxxx = Victimas::where('dni',$request->dni)->count();
        $dni = $request->dni;
        if($counxxx>0) {
            if($request->otorga == 'DENEGADO')
            {

                Victimas::where('dni',$dni)->update(['activo'=>0]);
                $var_otor = 'DENEGADO';

            }else if($request->otorga == 'APROBADO')
            {
                Victimas::where('dni',$dni)->update(['activo'=>1]);
                $var_otor = 'APROBADO';


            }else if($request->otorga == 'PENDIENTE')
            {
                Victimas::where('dni',$dni)->update(['activo'=>0]);
                $var_otor = 'PENDIENTE';
            }

        }else {

            if($request->otorga == 'DENEGADO')
            {


                $var_otor = 'DENEGADO';

            }else if($request->otorga == 'APROBADO')
            {


                $nuevo= new Victimas();


                $nuevo->dni = $dni;
                $nuevo->activo= true;


                $nuevo->save();



                $var_otor = 'APROBADO';


            }else if($request->otorga == 'PENDIENTE')
            {

                $var_otor = 'PENDIENTE';
            }
        }







        Alert::success('Victima Evaluada con éxito.');
        return redirect()->route('admin.victima.lista');
    }
}
