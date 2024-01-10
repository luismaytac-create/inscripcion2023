<?php

namespace App\Http\Controllers\Admin\Estadisticas;

use App\Http\Controllers\Controller;
use App\Models\Postulante;
use App\Models\Recaudacion;
use App\Models\Solicitante;
use DB;
use Illuminate\Http\Request;
use Excel;
use App;
use Illuminate\Support\Facades\Log;
class EstadisticasController extends Controller
{
   public function index()
    {
        $Inscritos = Postulante::select('fecha_conformidad',DB::raw('count(*) as cantidad'))
                            ->where('datos_ok',1)
                            ->IsNull(0)
                            ->Activos()
                            ->groupBy('fecha_conformidad')
                            ->orderBy('fecha_conformidad','desc')
                            ->paginate(5);

    	$Lista = Postulante::select('fecha_registro',DB::raw('count(*) as cantidad'))
    						->IsNull(0)
    						->Activos()
    						->groupBy('fecha_registro')
    						->orderBy('fecha_registro','desc')
    						->paginate(5);
        $Pagantes = Postulante::select('fecha_pago',DB::raw('count(*) as cantidad'))
                            ->where('pago',1)
                            ->IsNull(0)
                            ->groupBy('fecha_pago')
                            ->orderBy('fecha_pago','desc')
                            ->paginate(5);
        $Modalidades = Postulante::select('m.nombre as modalidad',DB::raw('count(*) as cantidad'))
                            ->join('modalidad as m','m.id','=','postulante.idmodalidad')
                            ->IsNull(0)
                            ->groupBy('m.nombre')
                            ->orderBy('m.nombre')
                            ->paginate(100);
        $ModalidadesIns = Postulante::select('m.nombre as modalidad',DB::raw('count(*) as cantidad'))
                            ->join('modalidad as m','m.id','=','postulante.idmodalidad')
                            ->where('datos_ok',1)
                            ->IsNull(0)
                            ->groupBy('m.nombre')
                            ->orderBy('m.nombre')
                            ->paginate(5);
		$ModalidadesPag = Postulante::select('m.nombre as modalidad',DB::raw('count(*) as cantidad'))
                            ->join('modalidad as m','m.id','=','postulante.idmodalidad')
                            ->where('pago',1)
                            ->IsNull(0)
                            ->groupBy('m.nombre')
                            ->orderBy('m.nombre')
                            ->paginate(5);
        $Pagos = Recaudacion::select('s.descripcion as descripcion',DB::raw('count(*) as cantidad'))
                            ->join('servicio as s','s.codigo','=','recaudacion.servicio')
                            ->groupBy('s.descripcion')
                            ->orderBy('descripcion')
                            ->get();
        $Fotos = Postulante::select('foto_estado',DB::raw('count(*) as cantidad'))->Activos()->groupBy('foto_estado')->get();

        $Semibecas = Solicitante::select('otorga',DB::raw('count(*) as cantidad'))->Activo()->groupBy('otorga')->get();

        $Preinscritos_provincia = DB::table('est_pre_ins_region')
                                    ->select('region',DB::raw("sum(cantidad) as cantidad"))
                                    ->groupBy('region')->paginate(10);
        $Inscritos_provincia = DB::table('est_ins_region')
                                    ->select('region',DB::raw("sum(cantidad) as cantidad"))
                                    ->groupBy('region')->paginate(10);

        $CepreUniPre = Postulante::where('idmodalidad',16)->IsNull(0)->Activos()->get()->count();
        $CepreUniIns = Postulante::where('idmodalidad',16)->IsNull(0)->where('datos_ok',1)->Activos()->get()->count();
        $CepreUniPag = Postulante::where('idmodalidad',16)->IsNull(0)->where('pago',1)->Activos()->get()->count();

        $CepreUniPreVoca = Postulante::where('idmodalidad',16)->where('idespecialidad',1)
                                ->IsNull(0)->Activos()->get()->count();
        $CepreUniInsVoca = Postulante::where('idmodalidad',16)->where('idespecialidad',1)
                                ->IsNull(0)->where('datos_ok',1)->Activos()->get()->count();
        $CepreUniPagVoca = Postulante::where('idmodalidad',16)->where('idespecialidad',1)
                                ->IsNull(0)->where('pago',1)->Activos()->get()->count();
        $CepreUniModalidad = DB::table('est_cepre_modalidad')->get();

        $PreVoca = Postulante::where('idespecialidad',1)->IsNull(0)->Activos()->get()->count();
        $InsVoca = Postulante::where('idmodalidad','<>',16)->where('idespecialidad',1)->IsNull(0)->where('datos_ok',1)->Activos()->get()->count();
        $PagVoca = Postulante::where('idmodalidad','<>',16)->where('idespecialidad',1)->IsNull(0)->where('pago',1)->Activos()->get()->count();
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
        $list_ins = Postulante::select('fecha_conformidad',DB::raw('count(*) as cantidad'))
            ->where('datos_ok',1)
            ->IsNull(0)
            ->Activos()
            ->groupBy('fecha_conformidad')
            ->orderBy('fecha_conformidad','asc')
            ->get();

        $estad_departamento = DB::table('vista_estadistica_departamentos')->get();
        $estad_provincias = DB::table('vista_estadistica_provincias')->get();

		
        return view('admin.estadisticas.index',compact(
            'Inscritos','Lista','Pagantes','Modalidades','Pagos','Fotos',
            'Semibecas','Preinscritos_provincia','Inscritos_provincia',
            'CepreUniPre','CepreUniIns','CepreUniPag','CepreUniPreVoca',
            'CepreUniInsVoca','CepreUniPagVoca','CepreUniModalidad',
            'PreVoca','InsVoca','PagVoca','ModalidadesIns','ModalidadesPag','estad_departamento','estad_provincias'
            ,'list_preins','list_pagante','list_ins'
            ));
    }
	
	
	public function descargaReporte() {
		
		$excel = App::make('excel');
		
		
		
		Excel::create('Estadisticas', function($excel) {
			
	$excel->sheet('PRE INSCRITOS', function($sheet) {

        // Sheet manipulation
		
		
		$sheet->setColumnFormat(array(
    'B' => '0'
));

			
							
      $dd = $Lista = Postulante::select('fecha_registro',DB::raw('CAST ( count(fecha_registro) AS INTEGER)'))
    						->IsNull(0)
    						->Activos()
    						->groupBy('fecha_registro')
    						->orderBy('fecha_registro','desc')
    						->get();    
	

			
				$sheet->cell('C2', function($cell) {

				// manipulate the cell
			$cell->setValue('PRE INSCRITOS POR FECHA');
			$cell->setFontWeight('bold');

		});
						
                $sheet->fromArray($dd,null, 'C5', false, false);

    });
	$excel->sheet('PAGANTES', function($sheet) {

        $pagan_Arr = Postulante::select('fecha_pago',DB::raw('CAST (count(fecha_pago) as INTEGER) '))
                            ->where('pago',1)
                            ->IsNull(0)
                            ->groupBy('fecha_pago')
                            ->orderBy('fecha_pago','desc')
                            ->get();
							
							
		$sheet->cell('C2', function($cell) {

				// manipulate the cell
			$cell->setValue('PAGANTES POR FECHA');
			$cell->setFontWeight('bold');

		});
			$sheet->fromArray($pagan_Arr,null, 'C5', false, false);
    });
	
	
	
	
	
	
	
    // Set the title
    $excel->setTitle('Estadisticas Concurso de Admision');

    // Chain the setters
    $excel->setCreator('lmayta')
          ->setCompany('DIAD');

    // Call them separately
    $excel->setDescription('Estadísticas del Concurso de Admisión');

})->store('xlsx');
		
	}
	
	
	
	
	
	
}
