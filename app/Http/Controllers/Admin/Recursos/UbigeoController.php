<?php

namespace App\Http\Controllers\Admin\Recursos;

use App\Http\Controllers\Controller;
use App\Models\Colegio;
use App\Models\Ubigeo;
use App\Models\UbigeoNuevo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Styde\Html\Facades\Alert;


class UbigeoController extends Controller
{

    public function index()
    {
        $Lista = UbigeoNuevo::where('activo',true)->with(['Paises'])->get();
        return view('admin.ubigeo.index',compact('Lista'));
    }
    public function lista()
    {
        $Lista = UbigeoNuevo::where('activo',true)->with(['Paises'])->get();

        $res['data'] = $Lista;
        return $res;
    }


    public function store(Request $request){

        $idmax = Ubigeo::max('id');
        $idmaxnew = UbigeoNuevo::max('id');


        if( $idmax == $idmaxnew){
        $idsuma = $idmax+1;
        }else {
            Alert::success('Error al crear');
            return back();
        }
       // Log::info($idmax);


        $codigo = $request->codigo;
        $departamento = $request->depa;
        $provincia = $request->prov;
        $distrito = $request->distrito;
        $pais = $request->idpais;
        $iddepartamento = $request->iddepartamento;


    //    Log::info($request);
        $ubigeonuevo = new UbigeoNuevo();
        $ubigeonuevo->codigo = $codigo;
        $ubigeonuevo->depa = $departamento;
        $ubigeonuevo->prov = $provincia;
        $ubigeonuevo->distrito = $distrito;
        $ubigeonuevo->activo = true;
        $ubigeonuevo->idpais = $pais;
        $ubigeonuevo->iddepartamento = $iddepartamento;
        $ubigeonuevo->descripcion = $departamento.'/'.$provincia.'/'.$distrito;
        $ubigeonuevo->id = $idsuma;
        $ubigeonuevo->save();


        $ubigeonormal = new Ubigeo();
        $ubigeonormal->codigo = $codigo;
        $ubigeonormal->nombre = $distrito;
        $ubigeonormal->descripcion = $departamento.'/'.$provincia.'/'.$distrito;
        $ubigeonormal->activo = true;
        $ubigeonormal->idpais = $pais;
        $ubigeonormal->id = $idsuma;
        $ubigeonormal->save();

        Alert::success('Ubigeo creado con exito');
        return back();
    }


}