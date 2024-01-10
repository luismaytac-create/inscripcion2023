<?php

namespace App\Http\Controllers\Admin\Sorteo;

use App\Http\Controllers\Controller;
use App\Models\Asistencia;
use App\Models\Postulante;
use App\Models\Sorteo;
use Illuminate\Http\Request;

class SorteoController extends Controller{

    public function index(){
        return view('admin.sorteo.asistencia');
    }
    public function sorteo(){
        return view('admin.sorteo.sorteo');
    }

    public function aleatorio()
    {
        $ingresantes = Sorteo::Sorteado()
            ->select('p.numero_identificacion','p.paterno','p.materno','p.nombres','p.codigo','i.id','e.nombre as especialidad','p.foto_editada')
            ->join('postulante as p', 'p.numero_identificacion', '=', 'sorteo.dni')

            ->join('ingresante as i', 'i.idpostulante', '=', 'p.id')

            ->join('especialidad as e','e.id', '=', 'i.idespecialidad')
            ->inRandomOrder()
            ->take(1)->where('sorteo.activo',true)
            ->get();

        return $ingresantes;

    }
    public function premio(Request $request)
    {
        Sorteo::where('dni',$request->dni)->update(['activo'=>0]);

        $res['data'] ='OK';
        return $res;
    }

    public function asistencia(Request $request)
    {
        $dni = $request->dni;
        $con=Postulante::has('ingresantes')->where('numero_identificacion',$dni)->count();

        $reton='';
        $asisregis=Asistencia::where('dni',$dni)->count();

        if($asisregis==0){
            $asis = new Asistencia;

            $asis->dni=$dni;

            $asis->save();

        }


        if($con>0){
            $paterno = Postulante::select('paterno')->where('numero_identificacion',$dni)->first();

            $materno = Postulante::select('materno')->where('numero_identificacion',$dni)->first();
            $nombres = Postulante::select('nombres')->where('numero_identificacion',$dni)->first();
            $reton=$paterno->paterno.' '.$materno->materno.' '.$nombres->nombres;

            $sortasis=Sorteo::where('dni',$dni)->count();

            if($sortasis==0){
                $sorteo = new Sorteo;

                $sorteo->dni=$dni;
                $sorteo->sorteo=true;
                $sorteo->activo=true;
                $sorteo->save();

            }




        }else{
            $reton=$dni;
        }



        $res['data'] =$reton;
        return $res;
    }
}