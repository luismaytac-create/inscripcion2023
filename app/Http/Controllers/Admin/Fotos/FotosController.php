<?php

namespace App\Http\Controllers\Admin\Fotos;

use App\Http\Controllers\Controller;
use App\Models\FotoObservacion;
use App\Models\Postulante;
use Carbon\Carbon;
use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Styde\Html\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Response;
use App\Mail\DenegadoEmail;
use Mail;
use App\Http\Controllers\Sms\SmsController;

class FotosController extends Controller
{
    public function index()
    {
        $varrole=Auth::user()->role->nombre;
        $variduser=Auth::user()->id;

       if($varrole == 'Informes' ||  $varrole=='Editor Foto' || $varrole=='root' || $varrole=='Sistemas' ){



           $postulante = Postulante::where('foto_estado','CARGADO')->where('pago',true)->orderBy('fecha_pago','asc')->orderBy('foto_fecha_carga','asc')->first();


            $resumen = Postulante::select('foto_estado',DB::raw('count(*) as cantidad'))->Activos()->groupBy('foto_estado')->get();
            if(isset($postulante)){
                return view('admin.fotos.index',compact('postulante','resumen'));
            }else{
                Alert::success('No hay Foto por Editar');
                return view('admin.fotos.blank',compact('resumen'));
            }
        }else {

           Alert::info('No tiene privilegios para realizar esta acción');
           return redirect()->route('home.index');
       }
    //    return view('admin.fotos.index',compact('resumen'));

    }
    public function buscar(Request $request)
    {
        $postulante = Postulante::where('numero_identificacion',$request->get('dni'))->first();
        $resumen = Postulante::select('foto_estado',DB::raw('count(*) as cantidad'))->Activos()->groupBy('foto_estado')->get();
        return view('admin.fotos.index',compact('postulante','resumen'));
    }
    public function update($id,$estado)
    {

        $idusuarioeditor=Auth::user()->id;
    	$postulante = Postulante::find($id);
    	$archivo = 'public/'.$postulante->foto;
        $nuevo_archivo = 'public/fotosok/'.$postulante->numero_identificacion.extension($archivo);
        $nuevo_archivo_tmp = 'public/fotosok/tmp/'.$postulante->numero_identificacion.extension($archivo);
        $nuevo_archivo_rechazo = 'public/fotos_rechazadas/'.$postulante->foto;
    	$nuevo_archivo_rechazo = str_replace('fotos/','',$nuevo_archivo_rechazo);
        switch ($estado) {
            case '1':
                if(!Storage::exists($nuevo_archivo))Storage::copy($archivo, $nuevo_archivo);
                if(!Storage::exists($nuevo_archivo_tmp))Storage::copy($archivo, $nuevo_archivo_tmp);

                

                $postulante->foto_estado = 'ACEPTADO';
                $nuevo_archivo = str_replace('public/','',$nuevo_archivo);
                $postulante->foto_editada = $nuevo_archivo;
                $postulante->foto_fecha_edicion = Carbon::now();
                $postulante->foto_fecha_editor = Carbon::now();
                $postulante->idusuarioeditor= $idusuarioeditor;
                $postulante->save();
                break;

            case '0':
                if (Storage::exists($archivo)) {
                    if(!Storage::exists($nuevo_archivo_rechazo))Storage::copy($archivo, $nuevo_archivo_rechazo);
                }
                $postulante->foto_estado = 'RECHAZADO';
                $postulante->foto_rechazada = $postulante->foto;
                $postulante->foto_cargada = 'avatar/nofoto.jpg';
                $postulante->foto_fecha_rechazo = Carbon::now();
                $postulante->foto_fecha_editor = Carbon::now();
                $postulante->idusuarioeditor= $idusuarioeditor;
                $postulante->save();
                Mail::to($postulante->email)
                ->send(new DenegadoEmail('Foto','Su Foto ha sido observada debe subir una nueva'));
                (new SmsController)->metodo2($postulante->telefono_celular,'ADMISION-UNI:Su Fotografia a sido observada revise su correo electronico');

    			break;
    	}
    	return redirect()->route('admin.fotos.index');
    }
    public function saveeditado(Request  $request){
        $idusuarioeditor=Auth::user()->id;
        $postulante = Postulante::find($request->name);
        $postulante->foto_estado = 'ACEPTADO';
        $fileContents = file_get_contents($request->data);
        $nuevo_archivo = 'fotosok/'.$postulante->numero_identificacion.extension('jpg');
        Storage::put('public/'.$nuevo_archivo,$fileContents);
        $postulante->foto_fecha_editor = Carbon::now();
        $postulante->foto_editada = $nuevo_archivo;
        $postulante->foto_fecha_edicion = Carbon::now();
        $postulante->idusuarioeditor= $idusuarioeditor;
        $postulante->save();


        return Response::json(['data' => 'OK']);
    }
    public function cargareditado(Request $request)
    {


      /*  $postulante = Postulante::find($request->idpostulante);
        $postulante->foto_estado = 'ACEPTADO';




/*
        $fileContents = file_get_contents($request->nueva_imagen);
        $nuevo_archivo = 'fotosok/'.$postulante->numero_identificacion.extension($postulante->foto);
        Storage::put('public/'.$nuevo_archivo,$fileContents);
        
        $postulante->foto_editada = $nuevo_archivo;
        $postulante->foto_fecha_edicion = Carbon::now();
        $postulante->save();*/
    }
    public function fotosrechazadas()
    {
        $Lista = Postulante::where('foto_estado','RECHAZADO')->get();
        return view('admin.fotos.list',compact('Lista'));
    }


    public function fotorechazomotivo(Request  $request){

        $idusuarioeditor=Auth::user()->id;
        $postulantex  = Postulante::where('numero_identificacion',$request->dni)->first();
        $postulante = Postulante::find($postulantex->id);
        $motivo = $request->motivo;

        if( FotoObservacion::where('idpostulante',$postulante->id)->count() >0 ){
            $observacion = FotoObservacion::where('idpostulante',$postulante->id)->update([
                'observacion'=>$motivo,
                'fecha'=>Carbon::now()

            ]);



        }else {


            $data['idpostulante']=$postulante->id;
            $data['observacion']=$motivo;
                $data['fecha']=Carbon::now();
            FotoObservacion::create($data);



            $obs = '';
        }

        $postulante->foto_estado = 'RECHAZADO';
        $postulante->foto_rechazada = $postulante->foto;
        $postulante->foto_cargada = 'avatar/nofoto.jpg';
        $postulante->foto_fecha_rechazo = Carbon::now();
        $postulante->idusuarioeditor= $idusuarioeditor;
        $postulante->foto_fecha_editor = Carbon::now();
        $postulante->save();


        return redirect()->route('admin.fotos.index');
    }

}
