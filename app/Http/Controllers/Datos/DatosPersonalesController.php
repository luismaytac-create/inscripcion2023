<?php

namespace App\Http\Controllers\Datos;

use App\Http\Controllers\Controller;
use App\Http\Requests\DatosPersonalesRequest;
use App\Models\Modalidad;
use App\Models\Postulante;
use App\Models\Restriccion;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
use Illuminate\Support\Facades\Log;
class DatosPersonalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postulante = Postulante::Usuario()->first();
        if(is_null($postulante)){
            if(is_null($postulante))return view('datos.personal.index',compact('dni'));
        }else {
            $num = Restriccion::where('dni', $postulante->numero_identificacion)->count();
            if($num>0){
                Alert::info('Usted ya no puede modificar sus datos de Pre inscripción, puede seguir modificando sus datos personales, familiares o complementarios.');
                return redirect()->route('home.index');
            }else {

                return view('datos.personal.edit',compact('postulante'));

            }
        }
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
    public function store(DatosPersonalesRequest $request)
    {
        $data = $this->AnulaModalidad2($request);

        $date = Carbon::now();
        $data['idevaluacion'] = '1';
        $data['idusuario'] = Auth::user()->id;
        $data['fecha_registro'] = $date;
		
		$tipoiden =Auth::user()->idtipo_identificacion;
		$emailuser = Auth::user()->email;

        $data['email'] = $emailuser;
		$data['idtipoidentificacion'] = $tipoiden;


        $idmoda =$request->idmodalidad;
        if($idmoda == 16) {
            $data['idespecialidad'] = $request->especialidad;
            if( $request->especialidad2 != '') {
                $data['idespecialidad2'] = $request->especialidad2;
            }else {
                $data['idespecialidad2'] = null;
            }
            if( $request->especialidad3 != '') {
                $data['idespecialidad3'] = $request->especialidad3;
            }else {
                $data['idespecialidad3'] = null;

            }
            $data['idfacultad'] = $request->facultades;


            $data['idespecialidad4'] = $request->especialidad4;
            if( $request->especialidad5 != '') {
                $data['idespecialidad5'] = $request->especialidad5;
            }else {
                $data['idespecialidad5'] = null;
            }
            if( $request->especialidad6 != '') {
                $data['idespecialidad6'] = $request->especialidad6;
            }else {
                $data['idespecialidad6'] = null;

            }
            $data['idfacultad2'] = $request->facultades2;

        }else {
            $data['idespecialidad'] = $request->especialidad;
            if( $request->especialidad2 != '') {
                $data['idespecialidad2'] = $request->especialidad2;
            }else {
                $data['idespecialidad2'] = null;
            }
            if( $request->especialidad3 != '') {
                $data['idespecialidad3'] = $request->especialidad3;
            }else {
                $data['idespecialidad3'] = null;

            }
            $data['idfacultad'] = $request->facultades;

        }

        Postulante::create($data);
        Alert::success('Se registró tus datos con éxito, debes esperar la aprobación de la declaración jurada para que puedas realizar tus pagos.');
        return redirect()->route('home.index');
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
    public function update(DatosPersonalesRequest $request, $id)
    {
        $data = $this->AnulaModalidad2($request);
        $modalidad = Modalidad::find($data['idmodalidad']);

        if ($modalidad->colegio) {
            $data = array_except($data, ['iduniversidad']);
			$data['iduniversidad']=null;
			
			
        }else{
            $data = array_except($data, ['idcolegio']);
			
			$data['idcolegio']=null;
        }

        $postulante = Postulante::find($id);

        $idmoda =$request->idmodalidad;
        if($idmoda == 16) {

            $data['idespecialidad'] = $request->especialidad;
            if( $request->especialidad2 != '') {
                $data['idespecialidad2'] = $request->especialidad2;
            }else {
                $data['idespecialidad2'] = null;
            }
            if( $request->especialidad3 != '') {
                $data['idespecialidad3'] = $request->especialidad3;
            }else {
                $data['idespecialidad3'] = null;

            }
            $data['idfacultad'] = $request->facultades;


            $data['idespecialidad4'] = $request->especialidad4;
            if( $request->especialidad5 != '') {
                $data['idespecialidad5'] = $request->especialidad5;
            }else {
                $data['idespecialidad5'] = null;
            }
            if( $request->especialidad6 != '') {
                $data['idespecialidad6'] = $request->especialidad6;
            }else {
                $data['idespecialidad6'] = null;

            }
            $data['idfacultad2'] = $request->facultades2;

        }else {
            $data['idespecialidad'] = $request->especialidad;
            if( $request->especialidad2 != '') {
                $data['idespecialidad2'] = $request->especialidad2;
            }else {
                $data['idespecialidad2'] = null;
            }
            if( $request->especialidad3 != '') {
                $data['idespecialidad3'] = $request->especialidad3;
            }else {
                $data['idespecialidad3'] = null;

            }
            $data['idfacultad'] = $request->facultades;

        }
        $postulante->fill($data);
        $postulante->save();
        Alert::success('se actualizo sus datos con exito');
        return redirect()->route('datos.index');
    }

    public function confirmamoda(Request $request)
    {
        $data = $this->AnulaModalidad2($request);
        $modalidad = Modalidad::find($data['idmodalidad']);

        #Log::info('ENTRO DATA'. print_r($request,true) );

        $postulante = Postulante::Usuario()->first();

        $idmoda =$request->idmodalidad;
        if($idmoda == 16) {

            $data['idespecialidad'] = $request->especialidad;
            if( $request->especialidad2 != '') {
                $data['idespecialidad2'] = $request->especialidad2;
            }else {
                $data['idespecialidad2'] = null;
            }
            if( $request->especialidad3 != '') {
                $data['idespecialidad3'] = $request->especialidad3;
            }else {
                $data['idespecialidad3'] = null;

            }
            $data['idfacultad'] = $request->facultades;


            $data['idespecialidad4'] = $request->especialidad4;
            if( $request->especialidad5 != '') {
                $data['idespecialidad5'] = $request->especialidad5;
            }else {
                $data['idespecialidad5'] = null;
            }
            if( $request->especialidad6 != '') {
                $data['idespecialidad6'] = $request->especialidad6;
            }else {
                $data['idespecialidad6'] = null;

            }
            $data['idfacultad2'] = $request->facultades2;

        }else {
            $data['idespecialidad'] = $request->especialidad;
            if( $request->especialidad2 != '') {
                $data['idespecialidad2'] = $request->especialidad2;
            }else {
                $data['idespecialidad2'] = null;
            }
            if( $request->especialidad3 != '') {
                $data['idespecialidad3'] = $request->especialidad3;
            }else {
                $data['idespecialidad3'] = null;

            }
            $data['idfacultad'] = $request->facultades;

        }
        $postulante->fill($data);
        $postulante->save();
        Alert::success('Datos confirmados');
        return redirect()->route('ficha.index');
    }









    /**
     * Quita la modalidad 2 y sus derivados cuando solo se escoge una modalidad
     * @param [type] $request [description]
     */
    public function AnulaModalidad2($request)
    {
        $data = $request->all();
        if(!$request->has('idmodalidad2')){
			$data['idmodalidad2']=null;
			$data['idespecialidad4']=null;
            $data['idespecialidad5']=null;
            $data['idespecialidad6']=null;
			$data['codigo_verificacion']=null;
           
			
        }
        return $data;
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
