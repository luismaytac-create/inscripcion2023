<?php

namespace App\Http\Controllers\Datos;

use App\Events\AfterUpdatingDataPersonal;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSecundariosRequest;
use App\Models\Postulante;
use App\Models\RegistroDni;
use App\Models\Verficador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Styde\Html\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Auth;
class DatosSecundariosController extends Controller
{
    public function index()
    {
    	$postulante = Postulante::Usuario()->first();
		
		$tipoiden =Auth::user()->idtipo_identificacion;
		$emailus=Auth::user()->email;
		
    	return view('datos.secundarios.index',compact('postulante','tipoiden','emailus'));

    }
    public function update(UpdateSecundariosRequest $request,$id)
    {
        $data = $request->all();
        $date = Carbon::now();
    	$postulante = Postulante::find($id);

        $postulante->fill($data);

        if ($postulante->save()) {
            event(new AfterUpdatingDataPersonal($postulante));
        }

        Alert::success('Se actualizaron sus datos con éxito.');
        return redirect()->route('datos.index');
    }


    public function  uploadfoto(Request $request ){
        $postulante = Postulante::Usuario()->first();
        $date = Carbon::now();
        if ($request->hasFile('file') && $postulante->foto_estado!='ACEPTADO') {
            if(!str_contains($postulante->foto_cargada,'nofoto'))
                Storage::delete("/public/$postulante->foto_cargada");

            $data['foto_cargada'] = $request->file('file')->store('fotos','public');
            $data['foto_estado']='CARGADO';
            $data['foto_fecha_carga']=$date;
            $data['foto_fecha_subida'] = Carbon::now();
            $named=$request->file('file')->getClientOriginalName();
            $postulante->fill($data);
            $postulante->save();
            return response()->json(['upload' => '/upload/'.$named]);
        }else {
            return response()->json(['error' => 'ERROR en la subida los archivos']);
        }


    }


    public function uploaddni(Request $request){

        $postulante = Postulante::Usuario()->first();

        if($request->hasFile('filedni')){


            $data['foto_dni'] =  $request->file('filedni')->store('fotosdni','public');


            $nombre = $data['foto_dni'];


            $nuevo= new RegistroDni();
            $nuevo->dni = $postulante->numero_identificacion;
            $nuevo->archivo = $nombre;
            $nuevo->save();

            $cantidverif = Verficador::where('dni',$postulante->numero_identificacion)->count();
            if($cantidverif>0){

            Verficador::where('dni',$postulante->numero_identificacion)->update([
                'estados' => 'PENDIENTE'
            ]);
            }

            $named=$request->file('filedni')->getClientOriginalName();
            $postulante->fill($data);
            $postulante->save();
            return response()->json(['upload' => '/upload/'.$named]);
        }else{
            return response()->json(['error' => 'ERROR en la subida los archivos']);
        }




    }
}

