<?php

namespace App\Http\Controllers\Admin\Cartera;

use App\Http\Controllers\Controller;
use App\Models\PagosForce;
use App\Models\Postulante;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Alert;
class CarteraController extends Controller
{
    public function index()
    {
        $Lista = PagosForce::all();
        return view('admin.cartera.index',compact('Lista'));
    }
    public function activate($id)
    {
        $force = PagosForce::find($id);
        $force->activo = !$force->activo;
        $force->save();
        Alert::success('El Registro se actualizo con exito');
        return back();
    }
    public function edit($id)
    {
        $force = PagosForce::find($id);
        return view('admin.cartera.edit',compact('force'));
    }

    public function update(Request $request,$id)
    {
        $force = PagosForce::find($id);

        if($request->idservicio!=''){
            $servicio = Servicio::where('id',$request->idservicio)->first();

            $descipcion= $servicio->descripcion;
            $partida= $servicio->partida;

            PagosForce::where('id',$id)->update(['monto'=>$request->monto,'descripcion'=>$descipcion,'partida'=>$partida]);

            Alert::success('SERVICIO Y MONTO MODIFICADO');
        }else {
            PagosForce::where('id',$id)->update(['monto'=>$request->monto]);
            Alert::success('MONTO MODIFICADO');
        }


      #

        return redirect()->route('admin.carteras.index');
    }


    public function store(Request $request)
    {

        $postulante = Postulante::where('numero_identificacion',$request->dni)->first();
        $servicio = Servicio::where('id',$request->servicio)->first();
        $dni='';
        $nombres = '';
        $paterno =  '';
        $materno = '';
        $correo='';
        $descipcion='';
        $partida='';
        $proyecto='09253';


        if(isset($servicio)){
            $descipcion= $servicio->descripcion;
            $partida= $servicio->partida;
        }

        if(isset($postulante)){
            $dni=$postulante->numero_identificacion;
            $nombres=$postulante->nombres;
            $paterno=$postulante->paterno;
            $materno=$postulante->materno;
            $correo=$postulante->email;
        }
        $data['bol_fac']='2';
        $data['dni_ruc']=$dni;
        $data['nombres_raz_social']=$nombres;
        $data['paterno']=$paterno;
        $data['materno']=$materno;
        $data['direcccion']='';
        $data['correo']=$correo;
        $data['descripcion']=$descipcion;
        $data['partida']=$partida;
        $data['proyecto']=$proyecto;
        $data['monto']=$request->monto;
        $data['activo']=true;

        PagosForce::create($data);
        Alert::success('CARTERA Registrado con exito');
        return back();
    }
}