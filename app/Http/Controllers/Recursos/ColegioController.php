<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateColegioRequest;
use App\Models\Colegio;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
use App\Models\UbigeoNuevo;

class ColegioController extends Controller
{
    public function index()
    {
        return view('admin.colegio.index');
    }
    public function store(CreateColegioRequest $request)
    {
        Colegio::create($request->all());
        Alert::success('Colegio Registrado con exito');
        return back();
    }
    public function lista()
    {
        $Lista = Colegio::with(['Distrito','Paises'])->orderBy('nombre')->get();
        $res['data'] = $Lista;
        return $res;
    }
    public function colegio(Request $request)
    {
        $name = $request->varschool ?:'';
		$varpol=strpos($name, '&depaBus=');
		$sta = strpos($name, '&depaBus=')+9;
		
        $name = trim(mb_strtoupper($name,'UTF-8'));
		$namef= substr($name,0, $varpol);
		$tamm = strlen($name);
		$iddepar = substr($name,$sta);
		
		


        $colegio = Colegio::select('colegio.id','colegio.nombre as text','colegio.gestion','colegio.idubigeo','colegio.direccion','colegio.idpais','colegio.codigo_modular')
            ->with(['Distrito','Paises'])->join('ubigeo_new', 'colegio.idubigeo', '=', 'ubigeo_new.id')
            ->where(function ($query) use ($namef,$iddepar) {
                $query->where('colegio.nombre','like',"%$namef%")->where('ubigeo_new.iddepartamento',$iddepar);
            })
            ->orwhere(function ($query) use ($namef,$iddepar) {
                $query->where('colegio.codigo_modular','like',"%$namef%")->where('ubigeo_new.iddepartamento',$iddepar);
            })
            ->get();
        return $colegio;
    }
    public function colegiopelado(Request $request)
    {
        $name = $request->varschool ?:'';



        $name = trim(mb_strtoupper($name,'UTF-8'));

        $tamm = strlen($name);





        $colegio = Colegio::select('colegio.id','colegio.nombre as text','colegio.gestion','colegio.idubigeo','colegio.direccion','colegio.idpais','colegio.codigo_modular')
            ->with(['Distrito','Paises'])->join('ubigeo_new', 'colegio.idubigeo', '=', 'ubigeo_new.id')
            ->get();
        return $colegio;
    }
    public function show(Request $request)
    {
        dd($request->all());
    }
}
