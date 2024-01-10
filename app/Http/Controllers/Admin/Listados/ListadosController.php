<?php

namespace App\Http\Controllers\Admin\Listados;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use Illuminate\Http\Request;
use DB;
use Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Log;
use Styde\Html\Facades\Alert;
class ListadosController extends Controller
{
	public function index()
	{
    	return view('admin.listados.index');
	}
	public function listado1()
	{
    	return view('admin.listados.listado1');
	}
	public function listado2()
	{
        $lista = Postulante::select(
                        'postulante.codigo',
                        'postulante.numero_identificacion',
                        'postulante.paterno',
                        'postulante.materno',
                        'postulante.nombres',
                        'postulante.email',
                        'postulante.telefono_fijo',
                        'postulante.telefono_celular',
                        'declaracion_evaluacion.observaciones',
                        'declaracion_evaluacion.updated'
                        )
                        ->join('declaracion_evaluacion','postulante.numero_identificacion','=','declaracion_evaluacion.dni')
                        ->where('declaracion_evaluacion.estado','=','DENEGADO')
                        ->orderBy('declaracion_evaluacion.updated','ASC')
                        ->get();
    	return view('admin.listados.listado2',compact('lista'));
	}
	public function listado3()
	{
        $lista = Postulante::select(
                        'postulante.codigo',
                        'postulante.numero_identificacion',
                        'postulante.paterno',
                        'postulante.materno',
                        'postulante.nombres',
                        'postulante.email',
                        'postulante.telefono_fijo',
                        'postulante.telefono_celular',
                        'foto_observacion.observacion',
                        'foto_fecha_rechazo'
                        )
                        ->join('foto_observacion','postulante.id','=','foto_observacion.idpostulante')
                        ->where('foto_estado','=','RECHAZADO')
                        ->orderBy('foto_fecha_rechazo','ASC')
                        ->get();
    	return view('admin.listados.listado3',compact('lista'));
	}
	public function listado4()
	{
        $lista = Postulante::select(
                        'postulante.codigo',
                        'postulante.numero_identificacion',
                        'postulante.paterno',
                        'postulante.materno',
                        'postulante.nombres',
                        'orden_pago.servicio',
                        'orden_pago.descripcion',
                        'orden_pago.created_at'
                        )
                        ->join('orden_pago','postulante.id','=','orden_pago.idpostulante')
                        ->orderBy('created_at','DESC')
                        ->get();
    	return view('admin.listados.listado4',compact('lista'));
	}
    public function listado5()
	{
        $lista = Postulante::select(
                        'postulante.id',
                        'postulante.codigo',
                        'postulante.numero_identificacion',
                        'postulante.paterno',
                        'postulante.materno',
                        'postulante.nombres'
                        )
                        ->where('pago',true)
                        ->where('datos_ok',true)
                        ->where('verificado_api',false)
                        ->orderBy('created_at','ASC')
                        ->get();
    	return view('admin.listados.listado5',compact('lista'));
	}
    public function listado5Verifica($id)
	{
        Postulante::where('id',$id)->update(['verificado_api'=>true]);
        return back();
	}
    public function listado6()
	{
        $lista = DB::table('deben_ddjj')->get();;
    	return view('admin.listados.listado6',compact('lista'));
	}
    public function listado7()
	{
        $lista = DB::table('aprobado_ddjj_no_pagan')->get();
        $titulo = 'Relación de postulantes que se les aprobo declaración jurada y no pagan';
    	return view('admin.listados.listado7',compact('lista','titulo'));
	}
    public function listado8()
	{
        $lista = DB::table('no_aptos_extraordinario')->get();
        $titulo = 'Relación de postulantes que se les observo los documentos';
    	return view('admin.listados.listado7',compact('lista','titulo'));
	}
    public function listado9()
	{
        $lista = DB::table('no_aptos_extraordinario')->get();
        $titulo = 'Relación de postulantes que se les aprobo los documentos y no pagan';
    	return view('admin.listados.listado7',compact('lista','titulo'));
	}
    public function listado10()
	{
        $lista = DB::table('cepre_uni_no_preinscrito')->get();
        $titulo = 'Relación de cepre uni que no se han pre-inscritos';
    	return view('admin.listados.listado7',compact('lista','titulo'));
	}
    public function listado11()
	{
        $lista = DB::table('cepre_uni_preinscrito_y_no_pago')->get();
        $titulo = 'Relación de cepre uni que se han pre-inscritos y no pagan';
    	return view('admin.listados.listado7',compact('lista','titulo'));
	}


    public function table()
    {
        $Lista = DB::table("preinscritos")->get();

        $res['data'] = $Lista;
        return $res;
    }
	
	
	public function todo()
	{

        $varrole=Auth::user()->role->nombre;

        if( $varrole=='root' || $varrole=='Sistemas' ) {
            return view('admin.listados.llamar');
        }else{
            Alert::info('No tiene privilegios para realizar esta acción');
            return redirect()->route('home.index');
        }
	}
    public function inscrito()
    {
        return view('admin.listados.inscrito');
    }

    public function inscritotable(){
        $Lista = DB::table("listado_postulantes_inscrito")->get();
        $res['data'] = $Lista;
        return $res;
    }

	public function todotable()
    {
        $Lista = DB::table("listado_postulantes")->get();
        $res['data'] = $Lista;
        return $res;
    }
}
