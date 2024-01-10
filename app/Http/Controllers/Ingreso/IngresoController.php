<?php


namespace App\Http\Controllers\Ingreso;


use App\Models\Ingresante;
use App\Models\IngresoDocumentos;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;
use  Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
class IngresoController extends Controller
{
    public function index() {
        $dni = Auth::user()->dni;
        $email = Auth::user()->email;
        $id = Auth::user()->id;

        $existe = Postulante::where('idusuario',Auth::user()->id)->count();

        if($existe==0){
            Alert::warning('No registro su preinscripcion')
                ->details('Debes ingresar a la opcion Datos y llenar el formularo de preinscripcion')
                ->button('Lo puedes hacer haciendo clic aqui',route('home .index'),'primary');

            return back();

        }else{


            $postulante = Postulante::where('idusuario',$id)->first();
            $swp = !is_null($postulante);
            $doctodos=IngresoDocumentos::where('dni',Auth::user()->dni)->where('activo',true)->get();


            return view('ingreso.index',compact('postulante','swp','doctodos'));

        }





    }

    public function load(Request $request)
    {

      // Log::info($request);
        $tipo = "0";
        if($request->nombre == "1"){
            $tipo = "1";
            $file = $request->file('carga');
        }
        if($request->nombre == "2"){
            $tipo = "2";
            $file = $request->file('carga7');
        }
        if($request->nombre == "3"){
            $tipo = "3";
            $file = $request->file('carga8');
        }
        if($request->nombre == "4"){
            $tipo = "4";
            $file = $request->file('carga9');
        }
        if($request->nombre == "5"){
            $tipo = "5";
            $file = $request->file('carga10');
        }

        $postulante = Postulante::Usuario()->first();

        if( pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpeg" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "jpg" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "png" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "PNG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPEG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "JPG" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "pdf" ||
            pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION) == "PDF" )
        {

            $countarch=IngresoDocumentos::where('dni',Auth::user()->dni)->where('activo',true)->count();
            $countarchtwo=IngresoDocumentos::where('dni',Auth::user()->dni)->where('activo',false)->count();
            if( $countarch <= 40 && $countarchtwo<=60) {
                $nombre=$file->store('doc','public');
                $data = new IngresoDocumentos();
                $data->dni = Auth::user()->dni;
                $data->documento = $nombre;
                $data->tipo = $tipo;

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
        $countarch=IngresoDocumentos::where('dni',Auth::user()->dni)->where('id',$request->id)->count();

        if($countarch > 0 ){
            IngresoDocumentos::where('id',$request->id)->update([
                'activo' => false
            ]);

            return redirect('documentos-ingresante');
        }else {

            Alert::info('PERMISO DENEGADO');
            return redirect('documentos-ingresante');
        }



    }

    public function pdf(Request $request)
    {

        $postulante = Postulante::Usuario()->first();

        $ingresante = Ingresante::where('idpostulante',$postulante->id)->first();
        if( $ingresante->estado_constancia == 'CONFORME' || $ingresante->estado_constancia=='CONFORME Y RESERVA'){
            $exists = Storage::disk('constancia')->exists($postulante->numero_identificacion.'.pdf');
            if ($exists) {
                $headers = [];
                return response()->download(
                    storage_path('app/constancia/'.$postulante->numero_identificacion.'.pdf'),
                    null,
                    $headers
                );
            } else {
                Alert::info('Lo sentimos en este momento no podemos mostrarle este documento');
                return back();
            }
        }else {
            Alert::info('Lo sentimos en este momento no podemos mostrarle este documento');
            return back();
        }




    }





}