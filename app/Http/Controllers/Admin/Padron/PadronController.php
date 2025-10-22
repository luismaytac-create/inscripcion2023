<?php

namespace App\Http\Controllers\Admin\Padron;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use App\Models\RegistroDni;
use App\Models\Verficador;
use App\Models\Verficadorlog;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
use DB;
use Response;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Auth;
class PadronController extends Controller
{
    public function index()
    {

    	return view('admin.padron.index');
    }

    public function tabla(){
        $Lista = DB::table("padron_vista")->get();
        $res['data'] = $Lista;
        return $res;
    }

    public function indexverificador()
    {

        return view('admin.padron.verificador');
    }

    public function tablaverificador(){
        $Lista = DB::table("padron_verificador")->get();
        $res['data'] = $Lista;
        return $res;
    }


    public function observacion(Request $request) {
        $coun = Verficador::where('dni', $request->dni)->count();


        if($coun > 0 ){
            $getx = Verficador::where('dni', $request->dni)->first();

            $obs = $getx->observacion;
            $foto = $getx->foto;
            $vacuna = $getx->vacuna;
            $correcto = $getx->correcto;
            $otorga = $getx->estados;

            return Response::json(['obs' => $obs,'foto'=>$foto,'vacuna'=>$vacuna,'otorga'=>$otorga]);
        }else {

            return '';
        }



    }

    public function datos(Request $request) {

        $postulante = Postulante::select('paterno','materno','nombres','fecha_nacimiento','numero_identificacion')->where('numero_identificacion',$request->dni)->first();





        return $postulante;


    }

    public function savedatos(Request $request) {

        $dni = $request->dnidatos;
        $paterno = $request->paterno;
        $materno = $request->materno;
        $nombres = $request->nombres;
        $fechsin = $request->fecha_nacimiento;
        $arryfech = explode('/',$fechsin);


        $fecha = $arryfech[2].'-'.$arryfech[1].'-'.$arryfech[0];



        $xxx = false;


        if ($request->otorga == 'CORRECTO') {
            $xxx = true;


        }
        if ($request->otorga == 'INCORRECTO') {
            $xxx = false;


        }

        if ($request->otorga == 'FALTA VACUNA') {
            $xxx = false;
        }





        $data = Postulante::where('numero_identificacion',$dni)->update([

            'paterno' => $paterno,
            'materno' => $materno,
            'nombres' => $nombres,
             'fecha_nacimiento' => $fecha


        ]);


        $coun = Verficador::where('dni', $request->dnidatos)->count();
        if ($coun > 0) {
            $data = Verficador::where('dni',$request->dnidatos)->update([

                'correcto' => $xxx,
                'observacion' => $request->observacion,
                'estados'=>$request->otorga

            ]);

        }else {
            $nuevo = new Verficador();
            $nuevo->dni = $request->dnidatos;
            $nuevo->observacion = $request->observacion;
            $nuevo->correcto = $xxx;
            $nuevo->estados= $request->otorga;

            $nuevo->save();
        }


        $nuevolog = new Verficadorlog();
        $nuevolog->dni = $request->dnidatos;
        $nuevolog->observacion = $request->observacion;
        $nuevolog->correcto = $xxx;
        $nuevolog->estados= $request->otorga;
        $nuevolog->paterno=$paterno;
        $nuevolog->materno=$materno;
        $nuevolog->nombres=$nombres;
        $nuevolog->usuario=Auth::user()->id;
        $nuevolog->fecha=Carbon::now();
        $nuevolog->fecha_nacimiento=$fecha;
        $nuevolog->save();


        return redirect('admin/padronverificador');
    }


    public function saveverificador(Request $request)
    {


        $xxx = false;
        if ($request->otorga == 'CORRECTO') {
            $xxx = true;


        }
        if ($request->otorga == 'INCORRECTO') {
            $xxx = false;


        }

        $coun = Verficador::where('dni', $request->dni)->count();
        if ($coun > 0) {

            if ($request->hasFile('file')) {
                $nombre=$request->file('file')->store('carnet','public');
                $data = Verficador::where('dni',$request->dni)->update([

                    'correcto' => $xxx,
                    'observacion' => $request->observacion,
                    'vacuna'=> $request->vacuna,
                    'foto'=>$nombre,
                    'estados'=>$request->otorga

                ]);
                Alert::success('Registrado con exito');
                return redirect('admin/padronverificador');
            }else {
                $data = Verficador::where('dni',$request->dni)->update([

                    'correcto' => $xxx,
                    'observacion' => $request->observacion,
                    'vacuna'=> $request->vacuna,
                    'estados'=>$request->otorga

                ]);
                Alert::success('Registrado con exito');
                return redirect('admin/padronverificador');
            }




        }else {
            if ($request->hasFile('file')) {
                $nombre=$request->file('file')->store('carnet','public');

                $nuevo = new Verficador();
                $nuevo->dni = $request->dni;
                $nuevo->observacion = $request->observacion;
                $nuevo->correcto = $xxx;
                $nuevo->vacuna = $request->vacuna;
                $nuevo->foto = $nombre;
                $nuevo->estados= $request->otorga;
                $nuevo->save();
                Alert::success('Registrado con exito');
                return redirect('admin/padronverificador');
            }else {
                Alert::warning('DEBE SUBIR LA FOTO DEL CARNET.');
                return redirect('admin/padronverificador');
            }

        }










    }


    public function getfilesdni(Request $request) {

        $dni = $request->dni;


        $coun = RegistroDni::where('dni',$dni)->count();

        if($coun > 0) {
            $lista = RegistroDni::where('dni',$dni)->get();
            return $lista;
        }else {

            $postulante = Postulante::where('numero_identificacion',$dni)->first();

            return $postulante->foto_dni;


        }







    }

}
