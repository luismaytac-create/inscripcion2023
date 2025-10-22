<?php

namespace App\Http\Controllers;

use App\Models\Ingresante;
use App\Models\Postulante;
use App\Models\Recaudacion;
use Auth;
use Alert;
use App\Models\ReglasIp;
use DB;
use App\Models\Catalogo;
use App\Models\Confirmacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        switch (Auth::user()->role->nombre) {
            case 'Alumno':
                $postulante = Postulante::Usuario()->first();
                $swp = !is_null($postulante);
                $victima = false;
                $meet = false;
                if( $swp ){


                    if( !is_null($postulante->idmodalidad2) ){


                        if($postulante->idmodalidad2==5 || $postulante->idmodalidad2==6 || $postulante->idmodalidad2==7 || $postulante->idmodalidad2==8
                                || $postulante->idmodalidad2== 11 || $postulante->idmodalidad2==12 || $postulante->idmodalidad2== 13
                                || $postulante->idmodalidad2== 14 || $postulante->idmodalidad2==18 || $postulante->idmodalidad2==19
                        ){
                            $victima= true;
                        }


                    }else {

                        if($postulante->idmodalidad==5 || $postulante->idmodalidad==6 || $postulante->idmodalidad==7 || $postulante->idmodalidad==8
                                || $postulante->idmodalidad== 11 || $postulante->idmodalidad==12 || $postulante->idmodalidad== 13
                                || $postulante->idmodalidad== 14 || $postulante->idmodalidad==18 || $postulante->idmodalidad==19
                        ){
                            $victima= true;
                        }

                    }
                }
                if(Auth::user()->colegio == false){
                    Auth::logout();
                    Alert::danger('No cumple los requisitos')
                        ->details('Debe aceptar los terminos y condiciones.');
                    return redirect()->to('/');

                }else {
                    
				$meet = false;
				$datosmeet ='';
				return view('index',compact('swp','victima','meet','datosmeet'));
                   


                }


                break;
            default:

                $ip=$request->getClientIp();

                $userid=Auth::user()->id;


                $regla=ReglasIp::where('idusuario',$userid)->first();

                if($regla->externo == true){




                    $Lista = Postulante::select('fecha_registro',DB::raw('count(*) as cantidad'))
                        ->IsNull(0)
                        ->Activos()
                        ->groupBy('fecha_registro')
                        ->orderBy('fecha_registro','desc')
                        ->paginate(5);


                    $list_preins = Postulante::select('fecha_registro',DB::raw('count(*) as cantidad'))
                        ->IsNull(0)
                        ->Activos()
                        ->groupBy('fecha_registro')
                        ->orderBy('fecha_registro','asc')->get();

                    $list_pagante = Postulante::select('fecha_pago',DB::raw('count(*) as cantidad'))
                        ->where('pago',1)
                        ->IsNull(0)
                        ->groupBy('fecha_pago')
                        ->orderBy('fecha_pago','asc')
                        ->get();
                    $Pagantes = Postulante::select('fecha_pago',DB::raw('count(*) as cantidad'))
                        ->where('pago',1)
                        ->IsNull(0)
                        ->groupBy('fecha_pago')
                        ->orderBy('fecha_pago','desc')
                        ->paginate(5);

                    $Inscritos = Postulante::select('fecha_conformidad',DB::raw('count(*) as cantidad'))
                        ->where('datos_ok',1)
                        ->IsNull(0)
                        ->Activos()
                        ->groupBy('fecha_conformidad')
                        ->orderBy('fecha_conformidad','desc')
                        ->paginate(5);
                    $list_ins = Postulante::select('fecha_conformidad',DB::raw('count(*) as cantidad'))
                        ->where('datos_ok',1)
                        ->IsNull(0)
                        ->Activos()
                        ->groupBy('fecha_conformidad')
                        ->orderBy('fecha_conformidad','asc')
                        ->get();

                    $ve3 = DB::table("v_e3")->get();
                    $inscri_total = Postulante::where('datos_ok',true)->count();
                    $nopagantes = Catalogo::join('postulante as p','p.idsede','=','catalogo.id')
                        ->where('p.anulado',false)
                        ->where('pago','false')
                        ->count();
                    $pagantes = Postulante::where('pago',true)->count();
                    return view('admin.index',compact('list_preins','Lista','list_pagante','Pagantes','Inscritos','list_ins','ve3','nopagantes','pagantes','inscri_total'));


                }


                if($regla->ocad== true){

                    if(  substr( $ip ,'0' ,'10' ) =='172.20.68.' ){



                        $Lista = Postulante::select('fecha_registro',DB::raw('count(*) as cantidad'))
                            ->IsNull(0)
                            ->Activos()
                            ->groupBy('fecha_registro')
                            ->orderBy('fecha_registro','desc')
                            ->paginate(5);


                        $list_preins = Postulante::select('fecha_registro',DB::raw('count(*) as cantidad'))
                            ->IsNull(0)
                            ->Activos()
                            ->groupBy('fecha_registro')
                            ->orderBy('fecha_registro','asc')->get();

                        $list_pagante = Postulante::select('fecha_pago',DB::raw('count(*) as cantidad'))
                            ->where('pago',1)
                            ->IsNull(0)
                            ->groupBy('fecha_pago')
                            ->orderBy('fecha_pago','asc')
                            ->get();
                        $Pagantes = Postulante::select('fecha_pago',DB::raw('count(*) as cantidad'))
                            ->where('pago',1)
                            ->IsNull(0)
                            ->groupBy('fecha_pago')
                            ->orderBy('fecha_pago','desc')
                            ->paginate(5);

                        $Inscritos = Postulante::select('fecha_conformidad',DB::raw('count(*) as cantidad'))
                            ->where('datos_ok',1)
                            ->IsNull(0)
                            ->Activos()
                            ->groupBy('fecha_conformidad')
                            ->orderBy('fecha_conformidad','desc')
                            ->paginate(5);
                        $list_ins = Postulante::select('fecha_conformidad',DB::raw('count(*) as cantidad'))
                            ->where('datos_ok',1)
                            ->IsNull(0)
                            ->Activos()
                            ->groupBy('fecha_conformidad')
                            ->orderBy('fecha_conformidad','asc')
                            ->get();

                        $ve3 = DB::table("v_e3")->get();
                        $inscri_total = Postulante::where('datos_ok',true)->count();
                        $nopagantes = Catalogo::join('postulante as p','p.idsede','=','catalogo.id')
                            ->where('p.anulado',false)
                            ->where('pago','false')
                            ->count();
                        $pagantes = Postulante::where('pago',true)->count();
                        return view('admin.index',compact('list_preins','Lista','list_pagante','Pagantes','Inscritos','list_ins','ve3','nopagantes','pagantes','inscri_total'));


                    }else{
                        Auth::logout();
                        Alert::danger('Permiso Denegado')
                            ->details('No puede iniciar Sesión fuera de la red que fue asignada.');
                        return redirect()->to('/');
                    }
                }








                break;
        }
    }


}
