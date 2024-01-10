<?php


namespace App\Http\Controllers\Declaracion;

use App\Models\Declaracion;
use App\Models\DeclaracionEva;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;
use  Alert;
use Carbon\Carbon;

class DeclaracionController extends Controller
{
    public function index() {
        $dni = Auth::user()->dni;
        $email = Auth::user()->email;
        $id = Auth::user()->id;

        $existe = Postulante::where('idusuario',Auth::user()->id)->count();

        if($existe==0){
            Alert::warning('No registro su preinscripcion')
                ->details('Debes ingresar a la opcion Datos y llenar el formularo de preinscripcion')
                ->button('Lo puedes hacer haciendo clic aqui',route('datos.index'),'primary');

            return back();

        }else{


            $postulante = Postulante::where('idusuario',$id)->first();
            $swp = !is_null($postulante);
            $doctodos=Declaracion::where('dni',Auth::user()->dni)->where('activo',true)->get();
            $bloque= false;
            $count = DeclaracionEva::where('idpostulante',$postulante->id)->count();
            if($count> 0){
                $estado= '';
                $observacion ='';
                $solicitante = $count = DeclaracionEva::where('idpostulante',$postulante->id)->first();
                $estado = $solicitante->estado;
                $observacion = $solicitante->observaciones;
                $bloque= true;

                return view('declaracion.index',compact('postulante','swp','doctodos','bloque','estado','observacion'));
            }else{
                return view('declaracion.index',compact('bloque','postulante','swp','doctodos'));
            }
        }





    }

    public function load(Request $request)
    {
        $file = $request->file('carga');

        $postulante = Postulante::Usuario()->first();

        $count = DeclaracionEva::where('idpostulante',$postulante->id)->count();


        if($count > 0 ){

            $declaraeva = DeclaracionEva::where('idpostulante',$postulante->id)->first();


            if( $declaraeva->estado =='DENEGADO'){
                DeclaracionEva::where('idpostulante',$postulante->id)->update([
                    'estado' => 'PENDIENTE'
                ]);
            }

        }else {

            $nuevo= new DeclaracionEva();

            $nuevo->idpostulante = $postulante->id;
            $nuevo->dni = $postulante->numero_identificacion;
            $nuevo->iduser = $postulante->idusuario;

            $nuevo->estado = 'PENDIENTE';

            $nuevo->save();
        }






        if( pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpeg" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpg" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "png" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "PNG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPEG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "pdf" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "PDF" )
        {

            $countarch=Declaracion::where('dni',Auth::user()->dni)->where('activo',true)->count();
            $countarchtwo=Declaracion::where('dni',Auth::user()->dni)->where('activo',false)->count();
            if( $countarch <= 20 && $countarchtwo<=40) {
                $nombre=$request->file('carga')->store('doc','public');
                $data = new Declaracion();
                $data->dni = Auth::user()->dni;
                $data->documento = $nombre;
                $data->created_at = Carbon::now();

                $data->save();

                echo 1;
            }else {

                echo 2;

            }






        }else
        {
            echo 0;
        }
    }


    public function delete(Request $request)
    {

        $postulante = Postulante::Usuario()->first();
        $countarch=Declaracion::where('dni',Auth::user()->dni)->where('id',$request->id)->count();

        if($countarch > 0 ){
            Declaracion::where('id',$request->id)->update([
                'activo' => false
            ]);

            return redirect('declaracion');
        }else {

            Alert::info('PERMISO DENEGADO');
            return redirect('declaracion');
        }



    }

}