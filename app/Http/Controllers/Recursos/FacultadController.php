<?php


namespace App\Http\Controllers\Recursos;



use App\Http\Controllers\Controller;
use App\Models\Postulante;
use DB;
use Auth;

class FacultadController extends Controller
{
    public function facultades(){

        $Lista = DB::table("facultad")->select('id','sigla','nombre')->get();
        $res['data'] = $Lista;
        return $res;
    }
    public function especialidades() {
        $Lista = DB::table("especialidad")->select('id','idfacultad','codigo','nombre')->where('activo',true)->get();
        $res['data'] = $Lista;
        return $res;
    }

    public function getSeleccion() {


        $existe = Postulante::where('idusuario',Auth::user()->id)->count();
        if($existe > 0 ){
            $Lista = DB::table("postulante")->select('idfacultad','idfacultad2','idespecialidad','idespecialidad2','idespecialidad3','idespecialidad4','idespecialidad5','idespecialidad6','idmodalidad2 as moda2')->where('idusuario',Auth::user()->id)->get();
            $res['datos'] = $Lista;

            $ListaFac = DB::table("facultad")->select('id','sigla','nombre')->get();
            $res['facus'] = $ListaFac;

            $ListaEsp = DB::table("especialidad")->select('id','idfacultad','codigo','nombre')->where('activo',true)->get();
            $res['data'] = $ListaEsp;

            return $res;
        }else {
            return null;
        }



    }
}