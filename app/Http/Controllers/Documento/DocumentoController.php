<?php


namespace App\Http\Controllers\Documento;

use App\Models\DeclaracionEva;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\DocumentVictima;
use App\Models\Postulante;
use App\Models\SolicitanteVictima;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    public function index() {
        $dni = Auth::user()->dni;
        $email = Auth::user()->email;
        $id = Auth::user()->id;

        $postulante = Postulante::where('idusuario',$id)->first();

        if(  $postulante->idmodalidad !=1 ){

            if( $postulante->idmodalidad == 16){

                if( $postulante->idmodalidad2 != 1){
                    $swp = !is_null($postulante);
                    $doctodos=DocumentVictima::where('dni',Auth::user()->dni)->where('activo',true)->get();

                    $count = SolicitanteVictima::where('idpostulante',$postulante->id)->count();
                    $bloque = false;
                    if($count> 0){
                        $estado= '';
                        $observacion ='';
                        $solicitante = $count = SolicitanteVictima::where('idpostulante',$postulante->id)->first();
                        $estado = $solicitante->estado;
                        $observacion = $solicitante->observaciones;
                        $bloque= true;

                        return view('documento.index',compact('postulante','swp','doctodos','bloque','estado','observacion'));
                    }else{
                        return view('documento.index',compact('bloque','postulante','swp','doctodos'));
                    }
                }else{
                    return redirect()->to('/');
                }



            }else {
                $swp = !is_null($postulante);
                $doctodos=DocumentVictima::where('dni',Auth::user()->dni)->where('activo',true)->get();

                $count = SolicitanteVictima::where('idpostulante',$postulante->id)->count();
                $bloque = false;
                if($count> 0){
                    $estado= '';
                    $observacion ='';
                    $solicitante = $count = SolicitanteVictima::where('idpostulante',$postulante->id)->first();
                    $estado = $solicitante->estado;
                    $observacion = $solicitante->observaciones;
                    $bloque= true;

                    return view('documento.index',compact('postulante','swp','doctodos','bloque','estado','observacion'));
                }else{
                    return view('documento.index',compact('bloque','postulante','swp','doctodos'));
                }

            }



        }else {
            return redirect()->to('/');
        }


    }

    public function load(Request $request)
    {
        $file = $request->file('carga');

        $postulante = Postulante::Usuario()->first();

        $count = SolicitanteVictima::where('idpostulante',$postulante->id)->count();


        if($count > 0 ){
            $declaraeva = SolicitanteVictima::where('idpostulante',$postulante->id)->first();


            if( $declaraeva->estado =='DENEGADO'){
                SolicitanteVictima::where('idpostulante',$postulante->id)->update([
                    'estado' => 'PENDIENTE'
                ]);
            }

        }else {

            $nuevo= new SolicitanteVictima();

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

            $countarch=DocumentVictima::where('dni',Auth::user()->dni)->where('activo',true)->count();
            $countarchtwo=DocumentVictima::where('dni',Auth::user()->dni)->where('activo',false)->count();
            if( $countarch <= 20 && $countarchtwo<=40) {
                $nombre=$request->file('carga')->store('doc','public');
                $data = new DocumentVictima();
                $data->dni = Auth::user()->dni;
                $data->documento = $nombre;

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
        $countarch=DocumentVictima::where('dni',Auth::user()->dni)->where('id',$request->id)->count();

        if($countarch > 0 ){
            DocumentVictima::where('id',$request->id)->update([
                'activo' => false
            ]);

            return redirect('documentos');
        }else {

            Alert::info('PERMISO DENEGADO');
            return redirect('documentos');
        }



    }

}