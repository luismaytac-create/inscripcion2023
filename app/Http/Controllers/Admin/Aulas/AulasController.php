<?php

namespace App\Http\Controllers\Admin\Aulas;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAulaRequest;
use App\Models\Aula;
use App\Models\ConfiguracionAula;
use App\Models\Facultad;
use App\Models\Postulante;
use DB;
use Illuminate\Http\Request;
use Styde\Html\Facades\Alert;
use Illuminate\Support\Facades\Log;
class AulasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$resumen = Aula::select('sector',DB::raw("sum(capacidad) as cnt"))
                        ->Activas(1)
                        ->groupBy('sector')
                        ->orderBy('sector')
                        ->get();


        $lista_aulas = DB::table("vista_resumen_facu_conf")->get();


        $lista_aula_m = DB::table("vista_estado_turno_manana")->get();

        $lista_aula_t = DB::table("vista_estado_turno_tarde")->get();


        $cantidad_turno_m = DB::table("vista_cantidad_turno_manana")->first();
        $cantidad_turno_t = DB::table("vista_cantidad_turno_tarde")->first();

        $capacidad_turno_m = DB::table("vista_capacidad_manana")->first();
        $capacidad_turno_t = DB::table("vista_capacidad_tarde")->first();




        return view('admin.aulas.index',compact('resumen',
            'lista_aulas','lista_aula_m','lista_aula_t',
            'cantidad_turno_m', 'cantidad_turno_t',
            'capacidad_turno_m','capacidad_turno_t'));
    }

    public function asignarfacultad($id)
    {

        $facu = Facultad::where('id',$id)->first();
        $sigla = $facu->sigla;

        $conf = DB::table("configuracion_facultad")->where('idfacultad',$id)->first();

        $turno = $conf->turno;

        $cantidafacu = DB::table("vista_resumen_facus")->where('facultad',$id)->first();
        $numpostulantes = $cantidafacu->count;











        $aulas = DB::table('vista_resumen_aula_config')->where('idfacultad',$id)->get();

        $aulasconf = ConfiguracionAula::select('idaula')->where('idfacultad',$id)->get();

        if( $turno == 'M'){
            $aulasbyfacultad = DB::table("vista_estado_turno_manana")
                ->whereIn('id',$aulasconf->toArray())->get();
        }else {
            $aulasbyfacultad = DB::table("vista_estado_turno_tarde")
                ->whereIn('id',$aulasconf->toArray())->get();
        }



        return view('admin.aulas.asignar',
            compact('sigla','turno','numpostulantes','aulasbyfacultad'));

    }



        public function ordenar()
    {
        $aulas = Aula::Activas()->orderBy('sector','asc')->orderBy('codigo','asc')->get();
        $k = 1;
        $sector = $aulas->first()->sector;
        $varAulas = $aulas->toArray();
        for ($i=0; $i < $aulas->count(); $i++) {
            if ($sector!=$varAulas[$i]['sector']){$k=1;$sector=$varAulas[$i]['sector'];}
            Aula::where('id',$varAulas[$i]['id'])->update(['orden'=>$k]);
            $k++;
        }

        return back();
    }

    public function activaraulas(Request $request)
    {
        $data = $request->all();
        $aulas = Aula::whereIn('id',$data['idaulas'])->update(['activo'=>true]);

        Alert::success('Aulas activadas con exito');
        return redirect()->route('admin.aulas.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAulaRequest $request)
    {
        Aula::create($request->all());
        Alert::success('Aula Registrada con exito');
        return back();
    }

    public function disponible(Request $request)
    {
        $data = $request->all();

        Aula::where('sector',$data['sector'])->Activas()->update([
            'capacidad'=>$data['disponible'],
            'disponible_01'=>$data['disponible'],
            'disponible_02'=>$data['disponible'],
            'disponible_03'=>$data['disponible'],
            ]);
        return back();
    }

    public function liberar()
    {
        $ingresantes = Postulante::has('ingresantes')->where('idmodalidad',16)->get();
        if (!$ingresantes->isEmpty()) {
            #Dia 1
            $ingresantes->sortBy('idaula1');
            $dia1 = $ingresantes->where('idaula1','>',0)->groupBy('idaula1');
            foreach ($dia1 as $key => $item) {
                $ids = $item->implode('id',',');

                $cantidad = count($item);
                Postulante::whereIn('id',explode(',',$ids))->update(['idaula1'=>null]);
                Aula::where('id',$key)->decrement('asignado_01',$cantidad);
                Aula::where('id',$key)->increment('disponible_01',$cantidad);
            }
            #Dia 2
            $ingresantes->sortBy('idaula2');
            $dia2 = $ingresantes->where('idaula2','>',0)->groupBy('idaula2');
            foreach ($dia2 as $key => $item) {
                $ids = $item->implode('id',',');

                $cantidad = count($item);
                Postulante::whereIn('id',explode(',',$ids))->update(['idaula2'=>null]);
                Aula::where('id',$key)->decrement('asignado_02',$cantidad);
                Aula::where('id',$key)->increment('disponible_02',$cantidad);
            }
            #Dia 3
            $ingresantes->sortBy('idaula3');
            $dia3 = $ingresantes->where('idaula3','>',0)->groupBy('idaula3');
            foreach ($dia3 as $key => $item) {
                $ids = $item->implode('id',',');

                $cantidad = count($item);
                Postulante::whereIn('id',explode(',',$ids))->update(['idaula3'=>null]);
                Aula::where('id',$key)->decrement('asignado_03',$cantidad);
                Aula::where('id',$key)->increment('disponible_03',$cantidad);
            }
            #Voca
            $ingresantes->sortBy('idaulavoca');
            $voca = $ingresantes->where('idaulavoca','>',0)->groupBy('idaulavoca');
            foreach ($voca as $key => $item) {
                $ids = $item->implode('id',',');

                $cantidad = count($item);
                Postulante::whereIn('id',explode(',',$ids))->update(['idaulavoca'=>null]);
                Aula::where('id',$key)->decrement('asignado_voca',$cantidad);
                Aula::where('id',$key)->increment('disponible_voca',$cantidad);
            }
        }else{
            Alert::success('No hay mas aulas que liberar');
        }
        return back();
    }

    public function asignar(Request $request)
    {

        $postulante = Postulante::where('numero_identificacion',$request->input('dni'))->first();
        #Asigno Aulas
        Postulante::AsignarAula($postulante->id);
        Alert::success('Aulas asignadas con exito');
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aula = Aula::find($id);
        return view('admin.aulas.edit',compact('aula'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editaraulaactiva($id)
    {
        $aula = Aula::find($id);
        return view('admin.aulas.activas.edit',compact('aula'));
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
        $aula = Aula::find($id);
        $data = $request->all();
        $aula->capacidad = $data['capacidad'];
        $aula->save();
        Alert::success('Aula actualizada con exito');
        return redirect()->route('admin.aulas.index');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizaraulaactiva(Request $request, $id)
    {
        $aula = Aula::find($id);
        $aula->fill($request->all());
        $aula->save();
        Alert::success('Aula actualizada con exito');
        return redirect()->route('admin.activas.aulas');
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

    public function lista_aulas()
    {
        $Lista = Aula::all();
        $res['data'] = $Lista;
        return $res;
    }
    public function lista_aulas_activas()
    {
        $Lista = Aula::Activas(1)->get();
        $res['data'] = $Lista;
        return $res;
    }
    public function lista_aulas_habilitadas()
    {
        $Lista = Aula::Activas(1)->where('habilitado',1)->get();
        $res['data'] = $Lista;
        return $res;
    }
    public function activar($id)
    {
        $aula = Aula::find($id);
        $aula->activo = !$aula->activo;
        $aula->save();

        Alert::success('Se realizo el proceso');
        return back();
    }
    public function habilitar($id)
    {
        $aula = Aula::find($id);
        $aula->habilitado = !$aula->habilitado;
        $aula->save();

        Alert::success('Se realizo el proceso');
        return back();
    }
    public function delete($id)
    {
        /*Aula::destroy($id);*/
        Alert::success('No se puede eliminar el aula');
        return redirect()->route('admin.aulas.index');
    }
    public function activas()
    {
        $resumen = Aula::select('sector',DB::raw("sum(capacidad) as cnt"))
                        ->Activas(1)
                        ->groupBy('sector')
                        ->orderBy('sector')
                        ->get();
        return view('admin.aulas.activas',compact('resumen'));
    }
    public function habilitadas()
    {
        return view('admin.aulas.habilitadas');
    }
    public function control()
    {
        return view('admin.aulas.control');
    }
}
