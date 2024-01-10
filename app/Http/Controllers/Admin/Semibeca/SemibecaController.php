<?php

namespace App\Http\Controllers\Admin\Semibeca;

use App\Http\Controllers\Controller;
use App\Models\Aula;
use App\Models\Postulante;
use App\Models\Recaudacion;
use App\Models\SemibecaActivo;
use App\Models\Servicio;
use App\Models\Solicitante;
use App\Models\Descuento;
use App\Models\Document;
use DB;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
use Illuminate\Support\Facades\Log;
class SemibecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	 
	 public function save( Request $request)
    {
		
		
		
		
		
		if($request->otorga == 'SEMIBECA')
        { $tipo_descuento = '';
            $var_otor = 'SEMIBECA';
			  
        }else if($request->otorga == 'BECA')
        {
            $tipo_descuento = '';
			 $var_otor = 'BECA';
			 
			 
        }else if($request->otorga == 'DENEGADO')
        {
            $tipo_descuento = '';
			 $var_otor = 'DENEGADO';
        }
		
		$data = Solicitante::where('idpostulante',$request->idpostulante)->update([
        
            'otorga' => $var_otor,
			'observaciones'=> $request->observaciones,
            'proceso' => "2023-2",
            'gestion'   => $request->gestion,
            'dni'   => $request->dni,
            'tipo_descuento' => $tipo_descuento,
            'iduser' => $request->iduser
        ]);


	
	
        return view('admin.semibeca.index' );
    }
	 
    public function index()
    {
	

	
        return view('admin.semibeca.index' );
    }


    public function activar(Request $request)
    {



            $soliti = Solicitante::where ( 'id' ,$request->id)->first();


		$postulante = Postulante::where('id',$soliti->idpostulante)->first();
        $conta = SemibecaActivo::where('idpostulante',$postulante->id)->count();
        if($conta == 0) {
            $data = SemibecaActivo::create(['idpostulante'=> $postulante->id, 'activo'=> true]);
        }else {
            $dataa = SemibecaActivo::where('idpostulante',$postulante->id)->update(['activo'=>true]);
        }

        Alert::info('Postulante Actualizado.');
        return redirect()->route('admin.semibeca.index');

    }

    public function desactivar(Request $request)
    {



        $soliti = Solicitante::where ( 'id' ,$request->id)->first();


        $postulante = Postulante::where('id',$soliti->idpostulante)->first();
        $conta = SemibecaActivo::where('idpostulante',$postulante->id)->count();
        if($conta == 0) {
            $data = SemibecaActivo::create(['idpostulante'=> $postulante->id, 'activo'=> false]);
        }else {
            $dataa = SemibecaActivo::where('idpostulante',$postulante->id)->update(['activo'=>false]);
        }

        Alert::info('Postulante Actualizado.');
        return redirect()->route('admin.semibeca.index');

    }
	public function evaluar(Request $request)
    {
		
		$soliti = Solicitante::where ( 'id' ,$request->id)->first();
		
		
		$postulante = Postulante::where('id',$soliti->idpostulante)->first();
		
        if( $postulante->idmodalidad ==5 || $postulante->idmodalidad ==6 || $postulante->idmodalidad ==7 || $postulante->idmodalidad ==10 || $postulante->idmodalidad ==12 || $postulante->idmodalidad ==14 || $postulante->idmodalidad ==15 ) {
            $data = Postulante::ValidarDNI($postulante->numero_identificacion)->with(['solicitante'])->first();
        }else {
            $data = Postulante::ValidarDNI($postulante->numero_identificacion)->with(['solicitante','Colegios.Distrito'])->first();
        }
	
	
	




	Log::info('MENSAJE LOG DESDE SEMIBECACONTROLLER: '. $data);
	
       $documentos = Document::Validar($postulante->numero_identificacion)->join('Semibecas.tipos', 'Semibecas.documentos.tipo', '=', 'Semibecas.tipos.id')->Activo()->get();
		
		 return view('admin.semibeca.evaluar', ['data' => $data ,'documentos' => $documentos]);
    }
	
	
	public function lista()
    {
        $Lista2 = DB::table("vista_semibecas")->get();	
	    $res['data'] = $Lista2;
	    return $res;
    }
    
}
