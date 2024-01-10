<?php

namespace App\Http\Controllers\Datos;

use App\Http\Controllers\Controller;
use App\Models\Modalidad;
use App\Models\Postulante;
use Auth;
use Illuminate\Http\Request;
use App\Models\Validacionuni;
use App\Models\SinVacante;
use App\Models\Especialidad;

use Illuminate\Support\Facades\Log;
class DatosModalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dni = Auth::user()->dni;
        $id = Auth::user()->id;
        $postulante = Postulante::where('idusuario',$id)->first();

        if(is_null($postulante))return view('datos.modalidad.index',compact('dni'));
        else return view('datos.modalidad.edit',compact('postulante'));
    }
    /**
     * Devuelve los datos de la modalidad
     * @return [type] [description]
     */
    public function infomodalidad(Request $request)
    {
        $idmodalidad = $request->idmodalidad ?:'';
        if($request->idmodalidad > 0)$modalidad = Modalidad::findOrfail($idmodalidad);
        else{
            $modalidad = new Modalidad(['colegio'=>true]);
        }
        return $modalidad;
    }
	
	
	
	public function modalidadespecialidad(Request $request)
    {
        $idmodalidad = $request->idmodalidad ?:'';
		
		$sinvaca = SinVacante::select('idespecialidad')->where('idmodalidad',$idmodalidad)->get();
		
		$especialdad = Especialidad::whereNotIn('id', $sinvaca)->where('activo',true)->get();
		
		
		
		 
        return $especialdad;
    }
	
	
	
	
	public function infovacantesuni(Request $request)
	{
		$idmodalidad = $request->idmodalidad ?:'';
		if($request->idmodalidad > 0){
		$vacantes=Validacionuni::get(['idespecialidad', 'vacantes']);
		}
	return $vacantes;
	}




	public function infonumerouni(Request $request)
	{	
		$idespecialidad = $request->idespecialidad;
		
		if($request->idespecialidad> 0){

		$actualnum=Postulante::where('idmodalidad',6)->where('idespecialidad',$idespecialidad)->count();
		
		}
	return $actualnum;
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
