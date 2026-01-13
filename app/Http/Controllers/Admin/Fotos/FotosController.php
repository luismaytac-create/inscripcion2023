<?php

namespace App\Http\Controllers\Admin\Fotos;

use App\Http\Controllers\Controller;
use App\Models\Editorlog;
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
use Illuminate\Filesystem\Filesystem;
use Swift_TransportException;
use Illuminate\Validation\Rule;

class FotosController extends Controller
{
    private function motivosRechazo()
    {
        return [
            'Uso de lentes no permitido' => 'Uso de lentes no permitido',
            'El fondo debe ser de color blanco uniforme' => 'El fondo debe ser de color blanco uniforme',
            'No se permiten accesorios faciales (gorra, sombrero, etc.)' => 'No se permiten accesorios faciales (gorra, sombrero, etc.)',
            'No se aceptan fotografías tipo selfie' => 'No se aceptan fotografías tipo selfie',
            'No se aceptan fotografías del DNI ni copias del mismo' => 'No se aceptan fotografías del DNI ni copias del mismo',
            'La fotografía debe ser nítida y con el rostro al frente' => 'La fotografía debe ser nítida y con el rostro al frente',
            'Subir foto actualizada con fondo blanco' => 'Subir foto actualizada con fondo blanco',
        ];
    }

    private function ultimasFotosEditadas()
    {
        return Postulante::where('foto_estado', 'ACEPTADO')
            ->whereNotNull('foto_fecha_editor')
            ->orderBy('foto_fecha_editor', 'desc')
            ->take(5)
            ->get();
    }

    public function index()
    {
        $varrole=Auth::user()->role->nombre;
        $variduser=Auth::user()->id;

        $motivosRechazo = $this->motivosRechazo();
        $ultimasEditadas = $this->ultimasFotosEditadas();

       if($varrole == 'Informes' ||  $varrole=='Editor Foto' || $varrole=='root' || $varrole=='Sistemas' ){



           $postulante = Postulante::where('foto_estado','CARGADO')->inRandomOrder()->first();


            $resumen = Postulante::select('foto_estado',DB::raw('count(*) as cantidad'))->Activos()->groupBy('foto_estado')->get();
            if(isset($postulante)){
                return view('admin.fotos.index',compact('postulante','resumen','motivosRechazo','ultimasEditadas'));
            }else{
                Alert::success('No hay Foto por Editar');
                return view('admin.fotos.blank',compact('resumen','motivosRechazo','ultimasEditadas'));
            }
        }else {

           Alert::info('No tiene privilegios para realizar esta acci�n');
           return redirect()->route('home.index');
       }
    //    return view('admin.fotos.index',compact('resumen'));

    }
    public function exportar()
    {
        $postulantes = Postulante::where('foto_estado','CARGADO')->get();




        $archivos = Storage::files('public/fotos_pend_edit/');


        foreach ($archivos as $archivo) {
            Storage::delete($archivo);
        }

        foreach ($postulantes as $postulante) {

            $archivo = 'public/'.$postulante->foto;
            $nuevo_archivo = 'public/fotos_pend_edit/'.$postulante->numero_identificacion.extension($archivo);

            if(Storage::exists($archivo)){
                if(!Storage::exists($nuevo_archivo))Storage::copy($archivo, $nuevo_archivo);
            }

        }
        Alert::success('Archivos Copiados');
        return redirect()->route('admin.fotos.index');

    }
    public function importar()
    {

        $archivos = Storage::files('public/fotos_subir_new/');
        $i=0;

        foreach ($archivos as $archivo) {


            $nombreArchivo = pathinfo($archivo, PATHINFO_FILENAME);
            $postulantex  = Postulante::where('numero_identificacion',$nombreArchivo)->first();
            $postulante = Postulante::find($postulantex->id);
            $nuevo_archivo = 'public/fotosok/'.$postulante->numero_identificacion.extension($archivo);
            $postulante->foto_estado = 'ACEPTADO';
            $postulante->foto_fecha_edicion = Carbon::now();
            $postulante->foto_fecha_editor = Carbon::now();
            $nuevo_archivox = str_replace('public/','',$nuevo_archivo);
            $postulante->foto_editada = $nuevo_archivox;


            if(Storage::exists($archivo)){

                if(!Storage::exists($nuevo_archivo))Storage::copy($archivo, $nuevo_archivo);
            }

            $postulante->save();
            $i++;

            $nombresSinExtension[] = $nombreArchivo;
        }
        Alert::success('CANTIDAD DE ARCHIVOS: '.$i);
        return redirect()->route('admin.fotos.index');

    }
    public function buscar(Request $request)
    {
        $postulante = Postulante::where('numero_identificacion',$request->get('dni'))->first();
        $resumen = Postulante::select('foto_estado',DB::raw('count(*) as cantidad'))->Activos()->groupBy('foto_estado')->get();
        $motivosRechazo = $this->motivosRechazo();
        $ultimasEditadas = $this->ultimasFotosEditadas();
        return view('admin.fotos.index',compact('postulante','resumen','motivosRechazo','ultimasEditadas'));
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
                Alert::success('Foto aceptada con éxito');
                break;

                
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
                try {
                Mail::to($postulante->email)
                ->send(new DenegadoEmail('Foto','Su Foto ha sido observada debe subir una nueva'));
            
            } catch (Swift_TransportException $e) {
                // El correo falló, registramos el error y continuamos.
                Log::error('Error de SMTP al rechazar (update): ' . $e->getMessage());
            }
                // (new SmsController)->metodo2($postulante->telefono_celular,'ADMISION-UNI:Su Fotografia a sido observada revise su correo electronico');

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



        $nuevolog = new Editorlog();
        $nuevolog->dni = $postulante->numero_identificacion;
        $nuevolog->idpostulante = $postulante->id;
        $nuevolog->estado = 'ACEPTADO';
        $nuevolog->foto_ruta= $nuevo_archivo;
        $nuevolog->usuario=$idusuarioeditor;
        $nuevolog->fecha=Carbon::now();
        $nuevolog->save();




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

        $this->validate($request, [
            'motivo' => 'required',
            'dni' => 'required',
        ]);

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

       try {
        Mail::to($postulante->email)
            ->send(new DenegadoEmail('Foto',$motivo));
            
    } catch (Swift_TransportException $e) {
        // El correo falló, pero no queremos que la app crashee.
        // Opcional: Registramos el error en el log de Laravel para futura depuración.
        Log::error('Error de SMTP al rechazar foto: ' . $e->getMessage());
    }
        $nuevolog = new Editorlog();
        $nuevolog->dni = $postulante->numero_identificacion;
        $nuevolog->idpostulante = $postulante->id;
        $nuevolog->estado = 'RECHAZADO';
        $nuevolog->observacion=$motivo;
        $nuevolog->foto_ruta= $postulante->foto_rechazada;
        $nuevolog->usuario=$idusuarioeditor;
        $nuevolog->fecha=Carbon::now();
        $nuevolog->save();

        Alert::success('Foto rechazada con éxito');

        return redirect()->route('admin.fotos.index');
    }

    public function revertirAccion($id, $nuevoEstado)
    {
        $idusuarioeditor = Auth::user()->id;
        $postulante = Postulante::find($id);
        
        if (!$postulante) {
            Alert::danger('Postulante no encontrado');
            return redirect()->route('admin.fotos.index');
        }

        $archivo = 'public/'.$postulante->foto;
        $nuevo_archivo = 'public/fotosok/'.$postulante->numero_identificacion.'.jpg';
        $nuevo_archivo_tmp = 'public/fotosok/tmp/'.$postulante->numero_identificacion.'.jpg';

        if ($nuevoEstado == 'ACEPTADO') {
            // Cambiar de RECHAZADO a ACEPTADO
            // Restaurar foto si existe en rechazadas
            if ($postulante->foto_rechazada) {
                $archivo_rechazada = 'public/fotos_rechazadas/'.basename($postulante->foto_rechazada);
                if (Storage::exists($archivo_rechazada)) {
                    $postulante->foto = str_replace('public/', '', $archivo_rechazada);
                    $postulante->foto_cargada = str_replace('public/', '', $archivo_rechazada);
                }
            }
            
            $postulante->foto_estado = 'ACEPTADO';
            $postulante->foto_editada = str_replace('public/', '', $nuevo_archivo);
            $postulante->foto_fecha_edicion = Carbon::now();
            $postulante->foto_fecha_editor = Carbon::now();
            $postulante->idusuarioeditor = $idusuarioeditor;
            $postulante->save();
            
            // Copiar archivo a fotosok
            if (Storage::exists('public/'.$postulante->foto)) {
                if (!Storage::exists($nuevo_archivo)) Storage::copy('public/'.$postulante->foto, $nuevo_archivo);
                if (!Storage::exists($nuevo_archivo_tmp)) Storage::copy('public/'.$postulante->foto, $nuevo_archivo_tmp);
            }
            
            Alert::success('Foto cambiada a ACEPTADO con éxito');
            
        } elseif ($nuevoEstado == 'RECHAZADO') {
            // Cambiar de ACEPTADO a RECHAZADO - necesita motivo
            Alert::warning('Para rechazar use el modal de rechazo con motivo');
            return redirect()->route('admin.fotos.index');
            
        } elseif ($nuevoEstado == 'CARGADO') {
            // Revertir a CARGADO (pendiente de revisión)
            $postulante->foto_estado = 'CARGADO';
            $postulante->foto_fecha_editor = Carbon::now();
            $postulante->idusuarioeditor = $idusuarioeditor;
            $postulante->save();
            
            Alert::success('Foto revertida a CARGADO (pendiente de revisión)');
        }

        // Registrar en log
        $nuevolog = new Editorlog();
        $nuevolog->dni = $postulante->numero_identificacion;
        $nuevolog->idpostulante = $postulante->id;
        $nuevolog->estado = $nuevoEstado;
        $nuevolog->observacion = 'Acción revertida por el editor';
        $nuevolog->foto_ruta = $postulante->foto;
        $nuevolog->usuario = $idusuarioeditor;
        $nuevolog->fecha = Carbon::now();
        $nuevolog->save();

        return redirect()->route('admin.fotos.index');
    }

}
