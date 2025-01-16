<?php

namespace App\Http\Controllers\Admin\Pagos;

use App\Http\Controllers\Controller;
use App\Http\Requests\PagoUnitarioRequest;
use App\Http\Requests\PagosRequest;
use App\Models\Catalogo;
use App\Models\Colegio;
use App\Models\Cronograma;
use App\Models\Descuento;
use App\Models\Evaluacion;
use App\Models\Postulante;
use App\Models\Recaudacion;
use App\Models\Servicio;
use App\Models\Proceso;
use App\Models\Archivo;
use App\Models\OrdenPago;
use App\Models\PagosForce;
use PDF;
use App\Http\Controllers\Pago\PagoController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Storage;
use Alert;
use DB;
use App\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Log;
class PagosController extends Controller
{
	private $cuentaUNI;


	function __construct()
	{
		$this->cuentaUNI = '978853000001';
	}
    public function index()
    {
        #$this->pdf();
    	return view('admin.pagos.index');
    }
    public function show()
    {
        return view('admin.pagos.show');
    }
    public function lista()
    {
	    /**$Lista = Recaudacion::with('Postulantes')->get();**/
		$Lista = Recaudacion::all();
	    $res['data'] = $Lista;
	    return $res;
    }
    public function pagocreate(PagoUnitarioRequest $request)
    {

        $varxx=Auth::user()->id;
        $varyyy=Auth::user()->password;

        if(
            Auth::user()->dni == 'jcampos'  || Auth::user()->dni == 'juanro' || Auth::user()->dni == 'mbarrera' || Auth::user()->dni == 'ctucto'
        ){

        #if(true){
            $servicio = Servicio::find($request->servicio);
            $pos = Postulante::Activos()->where('numero_identificacion',$request->input('codigo'))->first();


            $ser = $servicio->codigo;
            $cod = $request->input('codigo');
            $banco = $request->input('banco');
            $ref = $request->input('referencia');
            $des = $servicio->descripcion;
            $mon = $servicio->monto;
            $date = Carbon::now();
            $recibo = $ser.$cod;
            $validator = Validator::make(['recibo'=>$recibo], [
                'recibo' => 'unique:recaudacion,recibo',
            ],[
                'recibo.unique'=>'Este pago ya ha sido registrado'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            $pago = Recaudacion::create([
                                'servicio'=>$ser,
                                'recibo'=>$recibo,
                                'descripcion'=>$des,
                                'monto'=>$mon,
                                'fecha'=>$date,
                                'codigo'=>$cod,
                                'nombrecliente'=>$pos->nombre_cliente,
                                'banco'=>$banco,
                                'referencia'=>$ref,
                                'idpostulante'=>$pos->id,
                    'usuario'=>$varxx
                                ]);

            $this->validartodoslospagos($pos->id);
            Alert::success('Pago Registrado con exito');
            return back();


        }else{
        Alert::success('No tiene Privilegios para realizar esta accion.');
            return back();
        }
    }
    public function pagochange(Request $request)
    {


        $varxx=Auth::user()->id;
        $varyyy=Auth::user()->password;


        if( ($varxx==106655 && $varyyy=='$2y$10$kKPm/.HX3d.ZkNY8LGvebuHxw6s.yzvO8A84fyieYlT09FH.2ls3K') ||
            ($varxx==106656 && $varyyy=='$2y$10$FwzQc0vlk1IkyuA.XnQHnesb3YXDH0sYSyQwdcdlYUCygUTx.srky') ||
            ($varxx==106657 && $varyyy=='$2y$10$m27Nyb3QYOmv/7vsXE/I8eYFNf0MSnDloQqt7vhcvsVnl0uoQKiEq') ||
            ($varxx==70012665 && $varyyy=='$2y$10$CfUERk.xou6.9EQT6eEi6uPnIAw/3JWx07ZB5sJknqQsNUcgSsRtC')){
            /**
                $servicio_ini = Servicio::find($request->servicio_ini);
                $servicio_fin = Servicio::find($request->servicio_fin);
                $recibo = $servicio_ini->codigo.$request->codigo;
                $pos = Postulante::Activos()->where('numero_identificacion',$request->input('codigo'))->first();
                Recaudacion::where('recibo',$recibo)->update([
                    'servicio'=>$servicio_fin->codigo,
                    'descripcion'=>$servicio_fin->descripcion,
                    'monto'=>$servicio_fin->monto,
                    ]);
            **/
            Alert::success('Pago Registrado con exito');
            return back();

        }else{
        Alert::success('No tiene Privilegios para realizar esta accion.');
            return back();
        }


    }
    public function store(PagosRequest $request)
    {
        #Guardo el archivo
        $varxx=Auth::user()->id;

        if(   Auth::user()->dni == 'jcampos'  || Auth::user()->dni == 'juanro' || Auth::user()->dni == 'mbarrera'){
            $file = $request->file('file');
            $nombre = $file->getClientOriginalName();
            $archivo = '';
            $banco = '';
            if (str_contains($nombre,'datos')) {

                $request->file('file')->storeAs('pagos/ocef',$nombre);
                $archivo = storage_path('app/pagos/ocef/').$nombre;
                $archivo = file($archivo);
                $banco = 'ocef';
            }else{
                Alert::success('Este Archivo no es valido');
                return back();
            }
            #Subo todas las columnas como vienen

            $this->StorePagos($archivo,$banco,$nombre);

            #Preparo la data antes de subir a la DB
            $data = $this->PreparaData($archivo,$banco);



            #valido pagos
            #Si los datos son correctos ejecuto la subida de datos
            $datafiltrada = $this->ValidoPagosNew($data);


          #  Log::info('ENTRO DATA '. print_r($datafiltrada['correcto']['data'],true) );

            if ($datafiltrada['correcto']) {

                if (count($datafiltrada['correcto']['data'])>0) {
                    Alert::success(count($datafiltrada['correcto']['data']).' Pagos Nuevos se han registrado');
                    foreach ( $datafiltrada['correcto']['data'] as $key => $item) {

                        if($item['servicio'] !='No ubicado') {
                            Recaudacion::create([
                                'recibo'=>$item['recibo'],
                                'servicio'=>$item['servicio'],
                                'descripcion'=>$item['descripcion'],
                                'monto'=>$item['monto'],
                                'fecha'=>$item['fecha'],
                                'codigo'=>$item['codigo'],
                                'nombrecliente'=>$item['nombrecliente'],
                                'banco'=>$item['banco'],
                                'referencia'=>$item['referencia'],
                                'usuario'=>$varxx,
                                'operacion'=>$item['operacion']
                            ]);
                        }




                            $count = PagosForce::where('dni_ruc',$item['codigo'])->where('monto',$item['monto'])->where('activo',true)->count();


                            if($count>0){
                                PagosForce::where('dni_ruc',$item['codigo'])->where('monto',$item['monto'])->where('activo',true)->update(['activo'=>false]);
                            }







                            $this->validartodarchivo($item['codigo'],$item['fecha']);
                    }
                } else {
                    Alert::success('No hay Pagos Nuevos');
                }


            } else {



            }

            if ($datafiltrada['incorrecto']['data']) {
                $diferencia = array_pluck($datafiltrada['incorrecto']['data'],'codigo') ;

                Alert::danger('Error de Codigos')->details('Los siguientes DNI no existen')->items($diferencia);

            }


            return back();
        }else{
        Alert::success('No tiene Privilegios para realizar esta accion.');
            return back();
        }



    }

    public function ValidoPagosNew($data)
    {
       # Log::info('ENTRO DATA'. print_r($data,true) );
        $collection = collect();

        # Obtenego DNI con codigo recaudacion
        $postulantescru = Postulante::select('numero_identificacion as codigo')
            ->whereIn('numero_identificacion',array_pluck($data,'codigo'))->IsNull(0)->pluck('codigo')->toArray();

        $diferencia = array_diff(array_pluck($data,'codigo'),$postulantescru);
        $diferencia = implode(",", $diferencia);
        $dataincorrect = array_where($data, function ($value, $key) use($diferencia) {
            if (str_contains($diferencia,$value['codigo']))
                return $value;
        });


        $collection['incorrecto'] = collect(['data'=>$dataincorrect]);


        $postulantescruce = Postulante::select('numero_identificacion as codigo')
            ->whereIn('numero_identificacion',array_pluck($data,'codigo'))->IsNull(0)->pluck('codigo')->toArray();
        $codigosexisten = implode(",", $postulantescruce);
        $datacorrectas = array_where($data, function ($value, $key) use($codigosexisten) {
            if (str_contains($codigosexisten,$value['codigo']))
                return $value;
        });


        $collection['correcto'] = collect(['data'=>$datacorrectas]);

        return $collection;
    }


    public function oldValidoPagos($data)
    {
        #Valido existencia de codigo
        $postulantes = Postulante::select('numero_identificacion as codigo')
                                 ->whereIn('numero_identificacion',array_pluck($data,'codigo'))->IsNull(0)->pluck('codigo');
        $codigo = array_diff(array_pluck($data,'codigo'),$postulantes->toArray());

        if(count($codigo)>0)$collection = collect(['correcto'=>false,'tipo_error'=>'Codigo','data'=>$codigo]);
        else $collection = collect(['correcto'=>true,'data'=>$data]);

        if(!$collection['correcto'])return $collection;

        #Valido coherencia de partida y monto depositado
        $servicios = Servicio::Activo()->get();

        foreach ($data as $key => $item) {
            $servicio = $servicios->where('codigo', $item['servicio'])->where('monto',$item['monto']);

            if($servicio->count()==0){
                $collection = collect([
                                        'correcto'=>false,'tipo_error'=>'Partida',
                                        'codigo'=>$item['codigo'],'servicio'=>$item['servicio'],'monto'=>$item['monto'],'partida'=>$item['partida']
                                        ]);
                break;
            }
        }
        if(!$collection['correcto'])return $collection;

        return $collection;
    }
    public function PreparaData($archivo,$banco)
    {
        $i = 0;
        $data = [];
        switch ($banco) {
            case 'financiero':
                $servicios = Servicio::Activo()->get();
                foreach ($archivo as $key => $value) {
                    if (strlen(trim($value)) > 0 ) {
                        $operacion = substr(trim(strtok($value, "\t")), -6);
                        $recibo = substr(trim(strtok("\t")),-8);
                        $tmp = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $banco = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $dni = trim(strtok("\t"));
                        $cliente = trim(strtok("\t"));
                        $monto = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $fecha = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $tmp = trim(strtok("\t"));
                        $descripcion_banco = trim(strtok("\t"));

                        $partida = trim(strtok($descripcion_banco,"|"));

                        $servicio = $servicios->where('partida', $partida);

                        if(!$servicio->isEmpty()){
                            $key = $servicio->keys()[0];
                        }else{
                            $key = 0;
                            $servicio[$key] = new Servicio(['codigo'=>'No ubicado','descripcion'=>'---']);
                        }
                        $data[$i]['recibo'] = $servicio[$key]->codigo.$dni;
                        $data[$i]['servicio'] = $servicio[$key]->codigo;
                        $data[$i]['descripcion'] = $servicio[$key]->descripcion;
                        $data[$i]['monto'] = (float)$monto/100;
                        $data[$i]['fecha'] = str_replace('/','-',$fecha);
                        $data[$i]['codigo'] = $dni;
                        $data[$i]['nombrecliente'] = $cliente;
                        $data[$i]['banco'] = $banco;
                        $data[$i]['partida'] = $partida;
                        $data[$i]['referencia'] = 'recibo:'.$recibo.'- operacion:'.$operacion;
                        $i++;
                    }
                }
                break;

            case 'bcp':
                $servicios = Servicio::Activo()->get();
                foreach ($archivo as $key => $value) {
                    if (substr($value, 0 ,1) == 'D' && substr($value, 196 ,1)!= 'E') {

                        $partida = (int)substr($value, 27 ,8);

						$servicio = $servicios->where('partida', $partida);

                        if(!$servicio->isEmpty()){
                            $key = $servicio->keys()[0];
                        }else{
                            $key = 0;
                            $servicio[$key] = new Servicio(['codigo'=>'No ubicado','descripcion'=>'---']);
                        }
						$codigopostul="";
						$nombcl="";
						$poscod1=substr($value, 15 ,12);
						$valid1 = Postulante::where('numero_identificacion',$poscod1)->count();
						if($valid1==1){$codigopostul=$poscod1;      }



						$poscod2=substr($value, 16 ,11);
						$valid2 = Postulante::where('numero_identificacion',$poscod2)->count();

						if($valid2==1){$codigopostul=$poscod2;}

						$poscod3=substr($value, 17 ,10);
						$valid3 = Postulante::where('numero_identificacion',$poscod3)->count();

						if($valid3==1){$codigopostul=$poscod3;}
						$poscod4=substr($value, 18 ,9);
						$valid4 = Postulante::where('numero_identificacion',$poscod4)->count();

						if($valid4==1){$codigopostul=$poscod4;}
						$poscod5=substr($value, 19 ,8);
						$valid5 = Postulante::where('numero_identificacion',$poscod5)->count();

						if($valid5==1){$codigopostul=$poscod5;}

						$sumvalx=$valid1+$valid2+$valid3+$valid4+$valid5;

						if($sumvalx==0){
							$codigopostul=substr($value, 15 ,12);

						}


						if($sumvalx==1){

							$xas = Postulante::where('numero_identificacion',$codigopostul)->first();
							$nombcl=$xas->nombre_cliente;

						}

						if($sumvalx>1){

							$codigopostul=substr($value, 15 ,12).'COINCIDE EN MAS DE 1 POSTULANTE';
						}




                        $data[$i]['recibo'] = $servicio[$key]->codigo.$codigopostul.substr($value, 225 ,8);
                        $data[$i]['servicio'] = $servicio[$key]->codigo;
                        $data[$i]['descripcion'] = $servicio[$key]->descripcion;
                        $data[$i]['monto'] = (float)substr($value, 113 ,5)/100;
                        $data[$i]['fecha'] = substr($value, 57 ,4).'-'.substr($value, 61 ,2).'-'.substr($value, 63 ,2);
                        $data[$i]['codigo'] = $codigopostul;
                        $data[$i]['nombrecliente'] = $nombcl;
                        $data[$i]['banco'] = $banco;
                        $data[$i]['partida'] = $partida;
                        $data[$i]['referencia'] = 'OP '.substr($value, 225 ,8);
                        $data[$i]['operacion'] = substr($value, 225 ,8);
                        $i++;
                    }
                }

                break;
            case 'ocef':
                $servicios = Servicio::Activo()->get();

                foreach ($archivo as $key => $value) {

                    $separador = (str_contains($value,','))?',':';';
                    $fila=explode($separador,$value);
                    if( str_contains($fila[0],'codigo')){

                    } else {
                        $codigo = $fila[0];
                        $nombrecliente = $fila[1];
                        $servicioc = $fila[2];
                        $descripcion = $fila[3];
                        $monto = $fila[4];
                        $operacion = $fila[5];
                        $fecha = $fila[6];
                        $recibo = $fila[7];
                        $banco =  str_replace("\r\n", "",  $fila[8]);
                        $servicio = $servicios->where('codigo', $servicioc);

                        if(!$servicio->isEmpty()){
                            $key = $servicio->keys()[0];
                        }else{
                            $key = 0;
                            $servicio[$key] = new Servicio(['codigo'=>'No ubicado','descripcion'=>'---']);
                        }


                        $data[$i]['recibo'] =  $recibo;
                        $data[$i]['servicio'] = $servicio[$key]->codigo;
                        $data[$i]['descripcion'] = $descripcion;
                        $data[$i]['monto'] = (float)$monto;
                        $data[$i]['fecha'] = $fecha;
                        $data[$i]['codigo'] = $codigo;
                        $data[$i]['nombrecliente'] = $nombrecliente;
                        $data[$i]['banco'] = $banco;
                        $data[$i]['partida'] = $servicio[$key]->partida;
                        $data[$i]['referencia'] = '';
                        $data[$i]['operacion'] = $operacion ;
                        $i++;








                    }

                }

               # Log::info(print_r($data, true));
                break;

            default:
                foreach ($archivo as $key => $value) {
                    if (substr($value, 0 ,1) == 'D' && substr($value, 33 ,3)=='INS') {

                        $data[$i]['recibo'] = trim(substr($value, 15 ,15)).substr($value, 144 ,13);
                        $data[$i]['servicio'] = substr($value, 15 ,3);
                        $data[$i]['descripcion'] = substr($value, 157 ,22);
                        $data[$i]['monto'] = (float)substr($value, 76 ,3);
                        $data[$i]['fecha'] = substr($value, 134 ,4).'-'.substr($value, 138 ,2).'-'.substr($value, 140 ,2);
                        $data[$i]['codigo'] = trim(substr($value, 18 ,12));
                        $data[$i]['nombrecliente'] = substr($value, 48 ,20);
                        $data[$i]['banco'] = $banco;
                        $data[$i]['referencia'] = substr($value, 144 ,13);
                        $data[$i]['operacion'] = substr($value, 144 ,13);
                        $i++;
                    }
                }
                break;
        }
        $recaudacion = Recaudacion::select('recibo')->pluck('recibo')->toArray();
        $diferencia = array_diff(array_pluck($data,'recibo'),$recaudacion);
        $diferencia = implode(",", $diferencia);
        $data = array_where($data, function ($value, $key) use($diferencia) {
            if (str_contains($diferencia,$value['recibo']))
            return $value;
        });

        return $data;
    }
    public function StorePagos($archivo,$banco,$nombre)
    {
        $i = 0;
        $data = [];
        switch ($banco) {


            case 'bcp':

                foreach ($archivo as $key => $value) {
                    if (substr($value, 0 ,1) == 'D' ) {
                        $date = Carbon::now();
                        $varxx=Auth::user()->id;
                        Archivo::create([
                            'cadena'=>$value,
                            'fecha'=>$date,
                            'iduser'=>$varxx,
                            'banco'=>'BCP',
                            'archivo'=>$nombre
                        ]);
                    }
                }

                break;
            case 'ocef':

                    foreach ($archivo as $key => $value) {
                        $separador = (str_contains($value,','))?',':';';
                        $fila=explode($separador,$value);

                        $date = Carbon::now();
                        $varxx=Auth::user()->id;
                        Archivo::create([
                            'cadena'=>$value,
                            'fecha'=>$date,
                            'iduser'=>$varxx,
                            'banco'=>'ocef',
                            'archivo'=>$nombre
                        ]);

                    }

                    break;

            default:
                foreach ($archivo as $key => $value) {
                    if (substr($value, 0 ,1) == 'D' ) {
                        $date = Carbon::now();
                        $varxx=Auth::user()->id;
                        Archivo::create([
                            'cadena'=>$value,
                            'fecha'=>$date,
                            'iduser'=>$varxx,
                            'banco'=>'SCOTIABANK',
                            'archivo'=>$nombre
                        ]);
                    }
                }
                break;
        }



    }







    public function bot()
    {
        DB::select('call confirmar_cartera()');
        Alert::success('CARTERA CONFIRMADA');
        return back();
    }
    public function create()
    {
        $name = 'CARTERA_TOTAL'.'.txt';
        Storage::disk('carteras')->delete($name);
        DB::select('call procesar_lista_pagos()');


        $data = DB::table("pagos_cartera_postulante_ocef")
            ->select('bol', 'numero_identificacion', 'nombres', 'paterno', 'materno', 'direccion', 'email', 'descripcion', 'partida', 'proyecto', 'monto')
            ->orderBy('monto', 'asc')
            ->get()
            ->toArray();
        $dataArray = [];
        foreach ($data as $item) {
            $item = (array)$item;
            // Convertir monto a número
            $item['monto'] = (float)$item['monto'];
            $dataArray[] = $item;
        }
        $columns = ['BOL_FAC', 'DNI_RUC', 'NOMBRES_RAZ_SOCIAL', 'PATERNO', 'MATERNO', 'DIRECCION', 'CORREO', 'DESCRIPCION', 'PARTIDA', 'PROYECTO', 'MONTO'];
        // Guardar el archivo Excel en el servidor
        $filePath = storage_path('app/carteras/reporteocef.xls');
        Excel::create('reporteocef', function($excel) use ($dataArray, $columns) {
            $excel->sheet('Hoja1', function($sheet) use ($dataArray, $columns) {
                $sheet->row(1, $columns);
                $sheet->fromArray($dataArray, null, 'A2', false, false);
                $sheet->setColumnFormat(array(
                    'A:J' => '@',
                    'K' => '0',
                ));
            });
        })->store('xls', storage_path('app/carteras'));

        return response()->download($filePath)->deleteFileAfterSend(true);
    }



    public function createoldd()
    {
        //CREP0001-IVAN
    	$name = 'CARTERA_TOTAL'.'.txt';
        Storage::disk('carteras')->delete($name);


        $servicios = Servicio::where('activo',1)->get();
        foreach ($servicios->chunk(5) as $key => $items) {
            foreach ($items as $key => $servicio) {

                $postulantes = $this->PostulantesAPagar($servicio->codigo);
                if($postulantes->count()>0){
                    $codigo_servicio = $servicio->codigo;
                    $codigo_cronograma = ($servicio->codigo=='507') ? 'INEX' : 'INSC' ;

                    // $param = $this->Parametros($postulantes,$codigo_servicio,$codigo_cronograma);
                    $header='CC19302437633CUNIVERSIDAD NACIONAL DE INGENIERIA      '.date('Ymd').'000000296000000008443000A';

                    //Storage::disk('carteras')->append($name,$param['header']);
                   foreach ($postulantes->chunk(500) as $key => $Lista) {
                        foreach ($Lista as $key => $postulante) {
                            $detalle = $this->ParametrosDetalle($postulante,$codigo_servicio,$codigo_cronograma);
                            if(strlen($detalle)>0){
                               Storage::disk('carteras')->append($name, $detalle);
                            }

                        }
                     }
                }//end if
            }//end foreach
        }

        $pagosForce = PagosForce::where('activo',true)->get();

        //    Log::info( print_r($pagosForce,true));
        foreach ($pagosForce as $key => $pago) {

            $detalle = collect([
                $pago->bol_fac.';'. $pago->dni_ruc.';'. $pago->nombres_raz_social.';'. $pago->paterno.';'. $pago->materno.';'. $pago->direcccion.';'.
                $pago->correo.';'. $pago->descripcion.';'. $pago->partida.';'. $pago->proyecto.';'. $pago->monto
                ]);
               Storage::disk('carteras')->append($name, $detalle->implode(''));

        }

        Alert::success('Cartera Creada con exito');
        return back();
    }
    public function createbcpAntigua()
    {
        $name = 'BCP.txt';
        Storage::disk('carteras')->delete($name);

        $servicios = Servicio::where('activo',1)->get();

        foreach ($servicios->chunk(5) as $key => $items) {
            foreach ($items as $key => $servicio) {

                $postulantes = $this->PostulantesAPagarBCP($servicio->codigo);
                if($postulantes->count()>0){
                    $codigo_servicio = $servicio->codigo;
                    $codigo_cronograma = ($servicio->codigo=='507') ? 'INEX' : 'INSC' ;

                    $param = $this->Parametros($postulantes,$codigo_servicio,$codigo_cronograma);

                    Storage::disk('carteras')->append($name,$param['header']);
                    foreach ($postulantes->chunk(500) as $key => $Lista) {




                        foreach ($Lista as $key => $postulante) {



                                $detalle = $this->ParametrosDetalle($postulante,$codigo_servicio,$codigo_cronograma);
                                Storage::disk('carteras')->append($name, $detalle);


                        }
                    }






                    Storage::disk('carteras')->append($name, $param['footer']);
                }//end if
            }//end foreach
        }




        Alert::success('Cartera Creada con exito');
        return back();
    }
    public function createbcp()
    {
        $name = 'CREP-'.date('Ymd-Hi').'.txt';
        $cuenta = '19302437633';
        Storage::disk('carteras')->delete($name);

        $servicios = Servicio::where('activo',1)->get();
        #Header
        $cantidadtotal=0; $monto = 0; $cantidad = 0; $total = 0; $fecha=date('Ymd');
        foreach ($servicios as $key => $servicio) {
            $monto = number_format($servicio->monto,0);
            $cantidad = $this->PostulantesAPagarBCP($servicio->codigo)->count();
            $total += $monto * $cantidad;
            $cantidadtotal += $cantidad;
            \Log::info('info:'.$servicio->codigo.'-'.$monto.'-'.$cantidad);
        }
        $header='CC'.$cuenta.'CUNIVERSIDAD NACIONAL DE INGENIERIA      '.$fecha;
        $header .=str_pad($cantidadtotal, 9, "0", STR_PAD_LEFT);
        $header .=str_pad($total, 13, "0", STR_PAD_LEFT);
        $header .='00A';
        Storage::disk('carteras')->append($name,$header);
        #Detalle
        foreach ($servicios as $key => $servicio) {
            $postulantes = $this->PostulantesAPagarBCP($servicio->codigo);
            $detalle = '';
            foreach ($postulantes as $key => $postulante) {
                $nombres = str_replace(',', ' ', $postulante->nombre_cliente);
                $nombres = str_pad($nombres, 50, ' ');
                $nombres = substr($nombres, 0, 40);
                $descripcion_servicio = str_pad($servicio->descripcion, 21, ' ');
                $descripcion_servicio = substr($descripcion_servicio, 0, 21);
                $detalle .= 'DD';
                $detalle .= $cuenta;
                $detalle .= str_pad($postulante->numero_identificacion, 14, '0', STR_PAD_LEFT);
                $detalle .= $nombres;
                $detalle .= $servicio->partida;
                $detalle .= ' ';
                $detalle .= $descripcion_servicio;
                $detalle .= $fecha;
                $detalle .= '20230206';
                $detalle .= str_pad(number_format($servicio->monto,0), 13,0, STR_PAD_LEFT).'00';
                $detalle .= str_pad(number_format($servicio->monto,0), 22,0, STR_PAD_LEFT).'00';
                $detalle .= 'A';// A=agregar , E=eliminar
                $detalle .= str_pad($servicio->codigo.$postulante->id, 20,0, STR_PAD_LEFT);
                $detalle .= str_pad(' ', 61,' ');
                Storage::disk('carteras')->append($name,$detalle);
                $detalle = '';
                OrdenPago::create([
                    'idpostulante' => $postulante->id,
                    'dni'          => $postulante->numero_identificacion,
                    'nombres'      => $postulante->nombre_cliente,
                    'servicio' => $servicio->codigo,
                    'descripcion' => $servicio->descripcion,
                    'monto' => $servicio->monto,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => 1,
                ]);
            }
        }
        Alert::success('Cartera Creada con exito');
        return back();
    }

    public function PostulantesAPagarBCP($codigo)
    {
        switch ($codigo) {
                case '475':
                    $postulantes = Postulante::Prospecto()->IsNull(0)->Alfabetico()->get();
                    break;
                case '464':
                    $postulantes = Postulante::PagoGestion('Colegio',['Pública'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->IsNull(0)->Alfabetico()->get();
                    break;
                case '465':
                    $postulantes = Postulante::PagoGestion('Colegio',['Privada'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->IsNull(0)->get();
                    break;
                case '469':
                    $postulantes = Postulante::PagoTraslados('Pública',['E1TE'])->IsNull(0)->get();
                    break;
                case '470':
                    $postulantes = Postulante::PagoTraslados(['Privada'],['E1TE'])->IsNull(0)->get();
                    break;
                case '468':
                    $postulantes = Postulante::PagoTitulados(['Pública','Privada'],['E1TG','E1TGU'])->IsNull(0)->get();
                    break;
                case '473':
                    $postulantes = Postulante::PagoBachillerato()->IsNull(0)->get();
                    break;
                case '466':
                    $postulantes = Postulante::PagoDescuentoGestion('Colegio',['Pública'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->IsNull(0)->Alfabetico()->get();
                    break;
                case '467':
                    $postulantes = Postulante::PagoDescuentoGestion('Colegio',['Privada'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->IsNull(0)->get();
                    break;
                case '474'://PRUEBA DE APT. VOCACIONAL
                    $postulantes = Postulante::PagoVocacional()->IsNull(0)->get();
                    break;
                case '518'://CONVAL.CURSO TRASL EXTERNOS
                    $postulantes = Postulante::TrasladosIngresantes()->IsNull(0)->Alfabetico()->get();
                break;
                case '519'://CONVAL.CURSO TITUL/GRADUADOS
                    $postulantes = Postulante::TituladosIngresantes()->IsNull(0)->Alfabetico()->get();
                break;
            default:
                $postulantes = collect([]);
                break;
        }
        return $postulantes;
    }
    public function PostulantesAPagar($codigo)
    {


        switch ($codigo) {

       /*    case '517':
            //    $postulantes = Postulante::Ingreso()->IsNull(0)->Alfabetico()->get();
               $dni_pagos = Recaudacion::select('codigo')->where('servicio','517')->get();
               $postulantes = DB::table("ingreso_cartera") ->whereNotIn('numero_identificacion',$dni_pagos->toArray())->get();


                break;

			 case '518':
                $postulantes = Postulante::Traslados()->IsNull(0)->Alfabetico()->get();
                break;
				case '519':
                $postulantes = Postulante::Titulados()->IsNull(0)->Alfabetico()->get();
                break;
*/


			 case '475':
                $postulantes = Postulante::Prospecto()->IsNull(0)->Alfabetico()->get();
                break;
            case '464':
                $postulantes = Postulante::PagoGestion('Colegio',['Pública'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->IsNull(0)->Alfabetico()->get();
                break;
            case '465':
                $postulantes = Postulante::PagoGestion('Colegio',['Privada'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->IsNull(0)->get();
                break;
            case '466':
                $postulantes = Postulante::PagoDescuentoGestion('Colegio',['Pública'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->IsNull(0)->Alfabetico()->get();
                break;
            case '467':
                $postulantes = Postulante::PagoDescuentoGestion('Colegio',['Privada'],['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])->IsNull(0)->get();
                break;
            case '469':
                $postulantes = Postulante::PagoGestion('Universidad',['Pública'],['E1TE'])->IsNull(0)->get();
                break;
            case '470':
                $postulantes = Postulante::PagoGestion('Universidad',['Privada'],['E1TE'])->IsNull(0)->get();
                break;
            case '468':
                $postulantes = Postulante::PagoGestion('Universidad',['Pública','Privada'],['E1TG','E1TGU'])->IsNull(0)->get();
               break;
            case '473':
                $postulantes = Postulante::PagoGestion(null,['Pública','Privada'],['E1DB','E1CD','E1CABI','E1CABC'])->IsNull(0)->get();
               break;
            case '474':
                $postulantes = Postulante::PagoGestion(null,null,null,'A1',null)->IsNull(0)->get();
               break;



           /* case '516':
                $postulantes = Postulante::PagoGestion(null,null,null,'A1','ID-CEPRE')->IsNull(0)->get();
               break;*/
          /*  case '507':
                $extemporaneo = Cronograma::where('codigo','INEX')->first();
                $postulantes = Postulante::IsNull(0)->where('fecha_registro','>=',$extemporaneo->fecha_inicio)->get();
               break;*/
            /*case '521':
                $postulantes = Postulante::PagoFormatoSemibeca()->IsNull(0)->get();
               break;*/
            default:
                $postulantes = collect([]);
                break;
        }
        return $postulantes;
    }
    public function Parametros($postulantes,$servicio,$cronograma)
    {
    	$servicio = Servicio::where('codigo',$servicio)->first();
    	$cronograma = Cronograma::where('codigo',$cronograma)->first();
    	$cabecera = collect([
    		$tipoCabecera = 'H',
	    	$Cuenta = pad($this->cuentaUNI,14,' '),
			$Concepto = $servicio->codigo,
			$TotalAlumnos = pad($postulantes->count(),7,'0','L'),
			$TotalSoles = pad(pad($servicio->valor_entero*$postulantes->count(),15,'0','L'),17,'0'),
			$TotalDolares = pad(0,17,'0','L'),
			$RucEmpresa = '02016900400',
			$FechaEnvio = Carbon::now()->format('Ymd'),
			$FechaVigencia = $cronograma->end_date,
			$FillerInicio = pad('0',3,'0','L'),
			$Diasmora = pad('0',3,'0','L'),
			$Tipomora = pad('0',2,'0','L'),
			$Moraflat = pad('0',9,'0','L'),
			$Porcentajemora = pad('0',8,'0','L'),
			$Montofijo = pad('0',9,'0','L'),
			$Tipodescuento = pad('0',2,'0','L'),
			$Montoadescontar = pad('0',9,'0','L'),
			$Porcentajedescuento = pad('0',8,'0','L'),
			$Diasdescuento = pad('0',3,'0','L'),
			$FillerFin = pad(' ',111,' ','L'),
			$Finderegistro = '*'
    	]);
		$pie = collect([
			$TipoPie = 'C',
			$Cuenta = pad($this->cuentaUNI,14,' '),
			$Concepto = $servicio->codigo,
			$CodigoConcepto = '01',
			$DescripcionConcepto = pad($servicio->descripcion_recortada,30,' '),
			$AfectoPagoParcial = '0',
			$Cuenta = pad($this->cuentaUNI,14,' '),
			$FillerFinPie = pad(' ',188,' ','L'),
			$FinderegistroPie = '*'
	    ]);
    	return [
    		'header' => $cabecera->implode(''),
    		'footer' => $pie->implode('')
    	];
    }
    public function ParametrosDetalle($postulante,$servicio,$cronograma)
    {
        $servicio = Servicio::where('codigo',$servicio)->first();
        $pagosForce = PagosForce::where('dni_ruc',$postulante->numero_identificacion)->where('partida',$servicio->partida)->where('activo',true)->count();
        if($pagosForce > 0) {
            $detalle = collect([]);
        }else {
            $cronograma = Cronograma::where('codigo',$cronograma)->first();
            if($servicio->codigo ==521){

                $cronograma = Cronograma::where('codigo','INBE')->first();
            }
            $detalle = collect([
                '2',';',
                substr($postulante->numero_identificacion, strlen($postulante->numero_identificacion) - 8),';',
                strtoupper(str_clean($postulante->nombre_cliente)),';',
                strtoupper(str_clean($postulante->paterno)),';',
                strtoupper(str_clean($postulante->materno)),';',
                '',';',
                strtoupper($postulante->email),';',
                $servicio->descripcion_recortada,';',
                $servicio->partida,';',
                '09253',';',
                $servicio->monto


            ]);
        }



        /*
    	$detalle = collect([
	    	$TipoDetalle = 'D',
	    	$Cuenta = pad($this->cuentaUNI,14,' '),
	    	$Concepto = $servicio->codigo,
	    	$Codigo = pad($postulante->numero_identificacion,15,' '),
			$NroRecibo = 'INS'.pad($postulante->numero_identificacion,12,'0','L'),
			$CodigoAgrupacion = pad('',11,' '),
			$Situacion = '0',
			$MonedaCobro = '0000',
			$Cliente = pad(substr(  strtoupper(str_clean($postulante->nombre_cliente)),0,20),20,' '),
			$DescripcionConcepto = pad($servicio->descripcion_recortada,30,' '),
			$CodigoConcepto = '01',
			$ImporteConcepto = pad($servicio->valor,9,'0','L'),
			$CodigoConcepto2 = pad('',2,' '),
			$ImporteConcepto2 = pad('0',9,'0'),
			$CodigoConcepto3 = pad('',2,' '),
			$ImporteConcepto3 = pad('0',9,'0'),
			$CodigoConcepto4 = pad('',2,' '),
			$ImporteConcepto4 = pad('0',9,'0'),
			$CodigoConcepto5 = pad('',2,' '),
			$ImporteConcepto5 = pad('0',9,'0'),
			$CodigoConcepto6 = pad('',2,' '),
			$ImporteConcepto6 = pad('0',9,'0'),
			$ImporteConcepto = pad($servicio->valor,15,'0','L'),
			$ImporteConcepto = pad($servicio->valor,15,'0','L'),
			$PorcentajeMinimo = pad('0',8,'0','L'),
			$OrdenCronologico = '1',
			$FechaEnvio = Carbon::now()->format('Ymd'),




			$FechaVigencia = str_replace('-', '', $cronograma->fecha_fin),
			$DiasProrroga = '000',
			$FillerFinDetalle = pad(' ',15,' ','L'),
			$FinderegistroDetalle = '*'
		]);
        */
		return $detalle->implode('');
    }
    public function descarga()
    {
    	$headers = [];
    	return response()->download(
    			storage_path('app/carteras/CARTERA_TOTAL.txt'),
    			null,
    			$headers
    		);
    }

    public function descargabcp()
    {
        $headers = [];
        return response()->download(
            storage_path('app/carteras/BCP.txt'),
            null,
            $headers
        );
    }

	public function tttt($id = null)
    {
    	$existe = Postulante::where('id',$id)->count();

        if($existe==0){
            Alert::warning('No registro su preinscripcion')
                    ->details('Debes ingresar a la opcion Datos y llenar el formularo de preinscripcion')
                    ->button('Lo puedes hacer haciendo clic aqui',route('datos.index'),'primary');
            return back();
        }else{
            $pagos = $this->CalculoServiciosAd($id);

            return view('admin.pagos.listaadmin',compact('id','pagos'));
        }
    }

    public function CalculoServicios($id = null)
    {
        $postulante = Postulante::where('id',$id)->first();

        #Pago de Prospecto-----------------------------------------------------------------------------------------------
        $pagos = collect(['prospecto'=>475]);
        #Pago por derecho de examen---------------------------------------------------------------------------------------

        #Modalidad Ordinario, Dos primeros alumnos, Deportisca calificado (Iniciar),Cepre Uni
        if (str_contains($postulante->codigo_modalidad, ['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])
            && str_contains($postulante->gestion_ie,'Pública'))
            $pagos->put('examen',464);
        elseif (str_contains($postulante->codigo_modalidad, ['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])
            && str_contains($postulante->gestion_ie,'Privada')) {
            $pagos->put('examen',465);
         }

        #Diplomado con bachillerato, Andres bello (Continuar), convenio diplomatico
        if (str_contains($postulante->codigo_modalidad, ['E1DB','E1CABC','E1CABI','E1CD']))
            $pagos->put('examen',473);

            #Se repite los pagos si es segunda modalidad
            if (str_contains($postulante->codigo_modalidad2, ['E1DB','E1CABC','E1CABI','E1CD']))
                $pagos->put('examen2',473);



        #Traslado Externo
        if (str_contains($postulante->codigo_modalidad, 'E1TE')
            && str_contains($postulante->gestion_ie,'Pública'))
            $pagos->put('examen',469);
        elseif (str_contains($postulante->codigo_modalidad, 'E1TE')
            && str_contains($postulante->gestion_ie,'Privada')) {
             $pagos->put('examen',470);
         }
            #Se repite los pagos si es segunda modalidad
            if (str_contains($postulante->codigo_modalidad2, 'E1TE')
                && str_contains($postulante->gestion_ie,'Pública'))
                $pagos->put('examen2',469);
            elseif (str_contains($postulante->codigo_modalidad2, 'E1TE')
                && str_contains($postulante->gestion_ie,'Privada')) {
                 $pagos->put('examen2',470);
             }
        #Titulado o graduado
        if (str_contains($postulante->codigo_modalidad, ['E1TG','E1TGU']))
            $pagos->put('examen',468);
            #Se repite los pagos si es segunda modalidad
            if (str_contains($postulante->codigo_modalidad2, ['E1TG','E1TGU']))
                $pagos->put('examen2',468);

        #Descuentos por simulacro, semibeca o hijo de trabajador
        $descuento = Descuento::where('dni',$postulante->numero_identificacion)->Activo()->first();
        if (isset($descuento)) {
            $pagos->pull('examen');
            if($descuento->tipo=='Parcial')$pagos->put('examen',$descuento->servicio);
        }
        #Pago por examen vocacional---------------------------------------------------------------------------------------
        if (str_contains($postulante->codigo_modalidad, 'ID-CEPRE') && str_contains($postulante->codigo_especialidad, 'A1')){
            $pagos->put('vocacepre',474);
        }

        if (!str_contains($postulante->codigo_modalidad, ['ID-CEPRE','E1VTI','E1VTC']) && str_contains($postulante->codigo_especialidad, 'A1')){
            $pagos->put('voca',474);
        }

        if (str_contains($postulante->codigo_especialidad2, 'A1')){
            $pagos->put('voca',474);
        }
        #Pago extemporaneo---------------------------------------------------------------------------------------------------
        $date = Carbon::now()->toDateString();
        $fecha_inicio = Cronograma::FechaInicio('INEX');
        $fecha_fin = Cronograma::FechaFin('INEX');
       # if ($date>=$fecha_inicio && $date<=$fecha_fin && $postulante->fecha_registro>=$fecha_inicio)$pagos->put('extemporaneo',507);

        return $pagos;
    }
    public function CalculoServiciosAd($id)
    {
        $postulante = Postulante::where('id',$id)->first();
        #Pago de Prospecto-----------------------------------------------------------------------------------------------
        $pagos = collect(['prospecto'=>475]);
        #Pago por derecho de examen---------------------------------------------------------------------------------------

        #Modalidad Ordinario, Dos primeros alumnos, Deportisca calificado (Iniciar),Cepre Uni
        if (str_contains($postulante->codigo_modalidad, ['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])
            && str_contains($postulante->gestion_ie,'Pública'))
            $pagos->put('examen',464);
        elseif (str_contains($postulante->codigo_modalidad, ['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE'])
            && str_contains($postulante->gestion_ie,'Privada')) {
            $pagos->put('examen',465);
         }

        #Diplomado con bachillerato, Andres bello (Continuar), convenio diplomatico
        if (str_contains($postulante->codigo_modalidad, ['E1DB','E1CABC','E1CABI','E1CD']))
            $pagos->put('examen',473);

            #Se repite los pagos si es segunda modalidad
            if (str_contains($postulante->codigo_modalidad2, ['E1DB','E1CABC','E1CABI','E1CD']))
                $pagos->put('examen2',473);



        #Traslado Externo
        if (str_contains($postulante->codigo_modalidad, 'E1TE')
            && str_contains($postulante->gestion_ie,'Pública'))
            $pagos->put('examen',469);
        elseif (str_contains($postulante->codigo_modalidad, 'E1TE')
            && str_contains($postulante->gestion_ie,'Privada')) {
             $pagos->put('examen',470);
         }
            #Se repite los pagos si es segunda modalidad
            if (str_contains($postulante->codigo_modalidad2, 'E1TE')
                && str_contains($postulante->gestion_ie,'Pública'))
                $pagos->put('examen2',469);
            elseif (str_contains($postulante->codigo_modalidad2, 'E1TE')
                && str_contains($postulante->gestion_ie,'Privada')) {
                 $pagos->put('examen2',470);
             }
        #Titulado o graduado
        if (str_contains($postulante->codigo_modalidad, ['E1TG','E1TGU']))
            $pagos->put('examen',468);
            #Se repite los pagos si es segunda modalidad
            if (str_contains($postulante->codigo_modalidad2, ['E1TG','E1TGU']))
                $pagos->put('examen2',468);

        #Descuentos por simulacro, semibeca o hijo de trabajador
        $descuento = Descuento::where('dni',$postulante->numero_identificacion)->Activo()->first();
        if (isset($descuento)) {
            $pagos->pull('examen');
            if($descuento->tipo=='Parcial')$pagos->put('examen',$descuento->servicio);
        }
        #Pago por examen vocacional---------------------------------------------------------------------------------------
        if (str_contains($postulante->codigo_modalidad, 'ID-CEPRE') && str_contains($postulante->codigo_especialidad, 'A1')){
            $pagos->put('voca',474);
        }

        if (!str_contains($postulante->codigo_modalidad, ['ID-CEPRE','E1VTI','E1VTC']) && str_contains($postulante->codigo_especialidad, 'A1')){
            $pagos->put('voca',474);
        }

        if (str_contains($postulante->codigo_especialidad2, 'A1')){
            $pagos->put('voca',474);
        }
        #Pago extemporaneo---------------------------------------------------------------------------------------------------
        $date = Carbon::now()->toDateString();
        $fecha_inicio = Cronograma::FechaInicio('INEX');
        $fecha_fin = Cronograma::FechaFin('INEX');
        if ($date>=$fecha_inicio && $date<=$fecha_fin && $postulante->fecha_registro>=$fecha_inicio)$pagos->put('extemporaneo',507);

        return $pagos;
    }

    public function validartodoslospagos($id)
    {
        $correcto_pagos = false;
        $msj = collect([]);
        $debe = false;
        #Valida Pagos-------------------------------------------------------

             $postulante = Postulante::where('id',$id)->first();
            $pagos = $this->CalculoServicios($id);


            $recaudacion = Recaudacion::select('servicio','monto')->where('idpostulante',$postulante->id)->get();

            $pagos_realizados = $recaudacion->implode('servicio', ', ');

            $debe = false;
            foreach ($pagos as $key => $item) {
                if(str_contains($pagos_realizados,$item)){

				$correcto_pagos = true;


				}else{
                    $correcto_pagos = false;
                    $servicio = Servicio::where('codigo',$item)->first();
                    $msj->push(['titulo'=>'Falta pago (Los pagos realizado el fin de semana se cargaran el primer día habil)','mensaje'=>'No esta registrado el pago de '.$servicio->descripcion.' por S/ '.$servicio->monto.' soles, si usted acaba de realizar el pago el sistema se actualizara en 12 horas, de lo contrario comuniquese con nosotros al correo informes@admisionuni.edu.pe']);
                    $debe = true;

                }
            }

            $correcto_pagos = ($debe) ? false : true ;

            if( $postulante->idmodalidad==16 ){


                if( $postulante->idespecialidad !=1 && $postulante->idespecialidad4 !=1){
                    if ($correcto_pagos && !$postulante->pago) {

                        Postulante::where('id',$postulante->id)->update(['pago'=>true,'fecha_pago'=>Carbon::now()]);
                    }
                }
                if( $postulante->idespecialidad ==1 && $postulante->idespecialidad4 !=1){


                   $varpagg=  Recaudacion::where('idpostulante',$postulante->id)->where('servicio',474)->count();

                   if( $varpagg == 1){
                       if ($correcto_pagos && !$postulante->pago) {

                           Postulante::where('id',$postulante->id)->update(['pago'=>true,'fecha_pago'=>Carbon::now()]);
                       }
                   }
                }
                if( $postulante->idespecialidad !=1 && $postulante->idespecialidad4 ==1){

                    $varpagg=  Recaudacion::where('idpostulante',$postulante->id)->where('servicio',474)->count();
                    if( $varpagg == 1){
                        if ($correcto_pagos && !$postulante->pago) {

                            Postulante::where('id',$postulante->id)->update(['pago'=>true,'fecha_pago'=>Carbon::now()]);
                        }
                    }
                }

                if( $postulante->idespecialidad ==1 && $postulante->idespecialidad2 ==1){

                    $varpagg=  Recaudacion::where('idpostulante',$postulante->id)->where('servicio',474)->count();
                    if( $varpagg == 2){
                        if ($correcto_pagos && !$postulante->pago) {

                            Postulante::where('id',$postulante->id)->update(['pago'=>true,'fecha_pago'=>Carbon::now()]);
                        }
                    }
                }

            }else {
                if ($correcto_pagos && !$postulante->pago) {

                    Postulante::where('id',$postulante->id)->update(['pago'=>true,'fecha_pago'=>Carbon::now()]);
                }

            }
    }
    public function validartodarchivo($codigo,$fecha)
    {
        $correcto_pagos = false;
        $msj = collect([]);
        $debe = false;
        #Valida Pagos-------------------------------------------------------

             $postulante = Postulante::where('numero_identificacion',$codigo)->first();
            $pagos = $this->CalculoServicios($postulante->id);


            $recaudacion = Recaudacion::select('servicio','monto')->where('idpostulante',$postulante->id)->get();

            $pagos_realizados = $recaudacion->implode('servicio', ', ');

            $debe = false;
            foreach ($pagos as $key => $item) {
                if(str_contains($pagos_realizados,$item)){

				$correcto_pagos = true;


				}else{
                    $correcto_pagos = false;
                    $servicio = Servicio::where('codigo',$item)->first();
                    $msj->push(['titulo'=>'Falta pago (Los pagos realizado el fin de semana se cargaran el primer día habil)','mensaje'=>'No esta registrado el pago de '.$servicio->descripcion.' por S/ '.$servicio->monto.' soles, si usted acaba de realizar el pago el sistema se actualizara en 12 horas, de lo contrario comuniquese con nosotros al correo informes@admisionuni.edu.pe']);
                    $debe = true;

                }
            }

            $correcto_pagos = ($debe) ? false : true ;

            if ($correcto_pagos && !$postulante->pago) {

                Postulante::where('id',$postulante->id)->update(['pago'=>true,'fecha_pago'=>$fecha]);
				Proceso::where('idpostulante',$postulante->id)->update(['pago_examen'=>true]);
            }


    }
    public function test(PagosRequest $request)
    {
        #Guardo el archivo
        $varxx=Auth::user()->id;
        $varyyy=Auth::user()->password;
        if( ($varxx==215 && $varyyy=='$2y$10$B6Yeln3apIzjvlgrKa2ub.64DdYzUFoBcAElq2LurwboNXTsRMHgy') || ($varxx==45 && $varyyy=='$2y$10$POSRIbKezkijh0I5f/YpPu0FGPvPk0.j1aTPzgj5sEJmidjwYXCD2') ||($varxx==142 && $varyyy=='$2y$10$gVXhymZIiexPFRCiaPf8g.GU1EHy9VszmHg4xnaAAjyvAC4bwzvpK') || ($varxx==35 && $varyyy=='$2y$10$6bAqbbWzJkpSkgKz7My7X.tC0AGr7N7rXf7wpr8WE/MKS3vSQlB9q')){



            $file = $request->file('file');
            $nombre = $file->getClientOriginalName();
            $archivo = '';
            $banco = '';
            if (str_contains($nombre,'bws')) {

                $request->file('file')->storeAs('pagos/resumen_scotiabank/',$nombre);
                $archivo = storage_path('app/pagos/resumen_scotiabank/').$nombre;
                $archivo = file($archivo);
                $banco = 'scotiabank';

            }elseif (str_contains($nombre,'ConsMov')) {
                $request->file('file')->storeAs('pagos/financiero',$nombre);
                $archivo = storage_path('app/pagos/financiero/').$nombre;
                $archivo = file($archivo);
                $banco = 'financiero';
            }elseif (str_contains($nombre,'CREP4823')) {
                $request->file('file')->storeAs('pagos/bcp',$nombre);
                $archivo = storage_path('app/pagos/bcp/').$nombre;
                $archivo = file($archivo);
                $banco = 'bcp';
            }elseif (str_contains($nombre,'P')){
                $request->file('file')->storeAs('pagos/scotiabank',$nombre);
                $archivo = storage_path('app/pagos/scotiabank/').$nombre;
                $archivo = file($archivo);
                $banco = 'scotiabank';
            }else{
                Alert::success('Este Archivo no es valido');
                return back();
            }
            #Subo todas las columnas como vienen

            $this->StorePagos($archivo,$banco,$nombre);
            #Preparo la data antes de subir a la DB
            $data = $this->PreparaData($archivo,$banco);
            #valido pagos
            #Si los datos son correctos ejecuto la subida de datos
            $error = $this->ValidoPagos($data);
            if ($error['correcto']) {
                if (count($data)>0) {
                    Alert::success(count($data).' Pagos Nuevos se han registrado');
                    foreach ($data as $key => $item) {
                        Recaudacion::create([
                            'recibo'=>$item['recibo'],
                            'servicio'=>$item['servicio'],
                            'descripcion'=>$item['descripcion'],
                            'monto'=>$item['monto'],
                            'fecha'=>$item['fecha'],
                            'codigo'=>$item['codigo'],
                            'nombrecliente'=>$item['nombrecliente'],
                            'banco'=>$item['banco'],
                            'referencia'=>$item['referencia'],
                            'usuario'=>$varxx
                        ]);


                        $this->validartodarchivo($item['codigo'],$item['fecha']);
                    }
                } else {
                    Alert::success('No hay Pagos Nuevos');
                }
                return back();

            } else {
                switch ($error['tipo_error']) {
                    case 'Codigo':
                        Alert::danger('Error de Codigos')->details('Los siguientes codigos no existen')->items($error['data']);
                        break;
                    case 'Partida':
                        Alert::danger('Error de Partida')
                            ->details('El pago contiene una partida que no corresponde al monto pagado')
                            ->items([
                                'codigo postulante: '.$error['codigo'],
                                'Servicio: '.$error['servicio'],
                                'Partida: '.$error['partida'],
                                'Monto: '.$error['monto']
                            ]);
                        break;

                }
                return back();
            }


        }else{
            Alert::success('No tiene Privilegios para realizar esta accion.');
            return back();
        }



    }



    public function pdf($id = null)
    {

        $array = array(11001,
            8769,
            6229,
            9557,
            10421,
            10529,
            8079,
            7912,
            7239,
            9118,
            11266,
            11968,
            9940,
            11938,
            10357,
            10106,
            9468,
            12637,
            7551,
            11829, 6613, 12222, 13196, 8488,
            8499, 9253,
            7216, 10777,
            13414, 9247,
            8579,
            6813,
            10146,
            10598,
            7785
        );
        //saco el numero de elementos
        $longitud = count($array);
        for($i=0; $i<$longitud; $i++)
        {

            $postulante = Postulante::find($array[$i]);

            Log::info('FICHA '.$array[$i]);

            Log::info('PASO TRUE');
            PDF::SetTitle('FICHA DE INSCRIPCION');
            PDF::AddPage('U','A4');
            PDF::SetAutoPageBreak(false);
            PDF::Rect(15,15, 180,170);
            #FONDO
            PDF::Image(asset('assets/pages/img/ficha.jpg'),0,0+9,210,297,'', '', '', false, 300, '', false, false, 0);
            #CCOLOR DEL TEXTO
            PDF::SetTextColor(0);
            #TITULO
            #PDF::SetXY(10,73);
            # PDF::SetFont('helvetica','B',19);
            #PDF::Cell(60,5,$evaluacion->codigo,0,0,'C');


            PDF::SetXY(42,50+4);
            PDF::SetFont('helvetica','',15);
            PDF::Cell(60,5,'DNI:' ,0,0);

            PDF::SetXY(42,50+9);
            PDF::SetFont('helvetica','B',30);
            PDF::Cell(60,5,$postulante->numero_identificacion ,0,0);


            PDF::SetXY(166+4+3,86+20+70-15);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(34,5,'Talla :'.$postulante->talla.' m' ,0,0,'C');


            PDF::SetXY(166+4+3,90 +20+70-15);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(34,5,'Peso :'.$postulante->peso. ' kg',0,0,'C');



            PDF::SetXY(10,87);
            PDF::SetTextColor(255);
            PDF::SetFont('helvetica','B',15);
            #PDF::Cell(110,5,'Presenta esta ficha el día de Examen junto con tu DNI.',0,0,'L');


            PDF::SetTextColor(0);





            PDF::SetXY(130,98.6-20);
            PDF::SetFont('helvetica','',20);
            #  PDF::Cell(60,5,'N° Ins :',0,0,'L');




            #NUMERO DE INSCRIPCION

            #
            PDF::SetXY(42,30+3);

            PDF::SetFont('helvetica','',15);
            PDF::Cell(50,5,'NÚMERO DE INSCRIPCIÓN',0,0,'L');


            PDF::SetXY(42,38);

            PDF::SetFont('helvetica','B',30);
            PDF::Cell(110,5,$postulante->codigo,0,0,'L');

            #CODIGO ENCIMA DE LA FOTO



            #NOMBRES Y APELLIDOS
            PDF::SetTextColor(0,0,0);
            PDF::SetXY(5,105-25-1);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(30,5,'Apellidos y',0,0,'L');
            PDF::SetXY(5,105-25-1+5);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(30,5,'Nombres: ',0,0,'L');

            PDF::SetXY(65-10-10-10,105-20-5-2);
            PDF::SetFont('helvetica','B',16);

            PDF::MultiCell(170,5,$postulante->nombre_completo,1,'L',true);




            #MODALIDAD

            PDF::SetXY(5,100+16-20+10+3);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(60,5,'Modalidad :',0,0,'L');
            PDF::SetXY(31,100+16-20+10+3);
            PDF::SetFont('helvetica','',13);
            PDF::Cell(150,5,$postulante->nombre_modalidad,0,0,'L');
        //            #ESPECIALIDAD
        //            PDF::SetXY(5,105+17-20+10+3);
        //            PDF::SetFont('helvetica','',13);
        //            PDF::Cell(60,5,'Especialidad :',0,0,'L');
        //            PDF::SetXY(65,105+17-20+10+3);
        //            PDF::SetFont('helvetica','B',10);
            if ( $postulante->nombre_especialidad == "---"){


            }
            PDF::SetFont('helvetica','B',10);
            if( $postulante->nombre_especialidad2 == "---" && $postulante->nombre_especialidad != "---") {
                PDF::SetXY(5,105+17-20+10+3);
                PDF::Cell(120,5,'ESPECIALIDAD: ');
                PDF::SetFont('helvetica','',10);
                PDF::SetXY(34,105+17-20+10+3);
                PDF::Cell(120,5,$postulante->nombre_especialidad,0,0,'L');
            }
            if( $postulante->nombre_especialidad3 == "---" && $postulante->nombre_especialidad2 != "---") {
                PDF::SetXY(5,105+16-20+10+3);
                PDF::Cell(130,5,'PRIMERA PRIORIDAD: ',0 ,0,'L');
                PDF::SetFont('helvetica','',10);
                PDF::SetXY(45,105+16-20+10+3);
                PDF::Cell(130,5,$postulante->nombre_especialidad,0,0,'L');

                PDF::SetFont('helvetica','B',10);
                PDF::SetXY(5,105+21-20+10+3);
                PDF::Cell(130,5,'SEGUNDA PRIORIDAD: ',0,0,'L');
                PDF::SetXY(45,105+21-20+10+3);
                PDF::SetFont('helvetica','',10);
                PDF::Cell(130,5,$postulante->nombre_especialidad2,0,0,'L');

            }

            if( $postulante->nombre_especialidad != "---" && $postulante->nombre_especialidad2 != "---" && $postulante->nombre_especialidad3 != "---" ){
                PDF::SetXY(5,105+16-20+10+3);
                PDF::Cell(130,5,'PRIMERA PRIORIDAD: ',0 ,0,'L');
                PDF::SetFont('helvetica','',10);
                PDF::SetXY(45,105+16-20+10+3);
                PDF::Cell(130,5,$postulante->nombre_especialidad,0,0,'L');

                PDF::SetFont('helvetica','B',10);
                PDF::SetXY(5,105+21-20+10+3);
                PDF::Cell(130,5,'SEGUNDA PRIORIDAD: ',0,0,'L');
                PDF::SetXY(45,105+21-20+10+3);
                PDF::SetFont('helvetica','',10);
                PDF::Cell(130,5,$postulante->nombre_especialidad2,0,0,'L');

                PDF::SetFont('helvetica','B',10);
                PDF::SetXY(5,105+26-20+10+3);
                PDF::Cell(130,5,'TERCERA PRIORIDAD: ',0,0,'L');
                PDF::SetFont('helvetica','',10);
                PDF::SetXY(45,105+26-20+10+3);
                PDF::Cell(130,5,$postulante->nombre_especialidad3,0,0,'L');
            }

            #PDF::Cell(110,5,,0,0,'L');
            if ($postulante->codigo_modalidad == 'ID-CEPRE') {
                #SEGUNDA MODALIDAD
                PDF::SetXY(5,110+16-20+10+3+10);
                PDF::SetFont('helvetica','B',13);
                PDF::Cell(60,5,'Modalidad 2 :',0,0,'L');
                PDF::SetXY(34,110+16-20+10+3+10);
                PDF::SetFont('helvetica','',13);
                PDF::Cell(110,5,$postulante->nombre_modalidad2,0,0,'L');



                if( $postulante->nombre_especialidad5 == "---" && $postulante->nombre_especialidad4 != "---") {
                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134);
                    PDF::Cell(120,5,'ESPECIALIDAD: ',0,0,'L');

                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(34,134.3);
                    PDF::Cell(120,5,$postulante->nombre_especialidad4,0,0,'L');



                }
                if( $postulante->nombre_especialidad6 == "---" && $postulante->nombre_especialidad5 != "---") {
                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134);

                    PDF::Cell(130,5,'PRIMERA PRIORIDAD: ',0,0,'L');
                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134);
                    PDF::Cell(130,5,$postulante->nombre_especialidad4,0,0,'L');

                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+5);
                    PDF::Cell(130,5,'SEGUNDA PRIORIDAD: ',0,0,'L');
                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+5);
                    PDF::Cell(130,5,$postulante->nombre_especialidad5,0,0,'L');

                }

                if( $postulante->nombre_especialidad4 != "---" && $postulante->nombre_especialidad5 != "---" && $postulante->nombre_especialidad6 != "---" ){
                    PDF::SetXY(5,134);
                    PDF::SetFont('helvetica','B',10);
                    PDF::Cell(130,5,'PRIMERA PRIORIDAD: ',0,0,'L');
                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134);
                    PDF::Cell(130,5,$postulante->nombre_especialidad4,0,0,'L');

                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+5);
                    PDF::Cell(130,5,'SEGUNDA PRIORIDAD: ',0,0,'L');
                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+5);
                    PDF::Cell(130,5,$postulante->nombre_especialidad5,0,0,'L');

                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+5+5);
                    PDF::Cell(130,5,'TERCERA PRIORIDAD: ',0,0,'L');

                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+5+5);
                    PDF::Cell(130,5,$postulante->nombre_especialidad6,0,0,'L');
                }









            }



            #AULAS
            PDF::SetTextColor(0);
            PDF::SetFillColor(143,238,87);

            PDF::SetFont('helvetica','B',15);
            PDF::SetXY(5,91);

            PDF::Cell(40,7,'LU 10/02: ',0,0,'C',true);
            PDF::SetXY(5,97);
            PDF::SetFont('helvetica','B',35);

            PDF::Cell(40,12,$postulante->datos_aula_uno->codigo,0,0,'L',true,'',1,true);
            #DIA 2

            PDF::SetFillColor(243,218,114);
            PDF::SetFont('helvetica','B',15);
            PDF::SetXY(55,91);
            PDF::Cell(40,7,'MI 12/02: ',0,0,'C',1,'',1);
            PDF::SetXY(55,120+9+8-40);
            PDF::SetFont('helvetica','B',35);
            PDF::Cell(40,12,$postulante->datos_aula_dos->codigo,0,0,'L',true,'',1,true);
            #DIA 3
            PDF::SetFillColor(247,176,203);
            PDF::SetXY(105,88+3);
            PDF::SetFont('helvetica','B',15);
            PDF::Cell(40,7,'VI 14/02: ',0,0,'C',1,'',1);

            PDF::SetFont('helvetica','B',35);
            PDF::SetXY(105,94+3);
            PDF::Cell(40,12,$postulante->datos_aula_tres->codigo,0,0,'L',true,'',1,true);




            #
            if(($postulante->codigo_especialidad=='A1' || $postulante->codigo_especialidad4=='A1') && $postulante->codigo_modalidad != 'ID-CEPRE'){

                PDF::SetFillColor(119,205,238);
                PDF::SetXY(155,91);
                PDF::SetFont('helvetica','B',15);
                PDF::Cell(40,7,'SAB 08/02: ',0,0,'C',1,'',1);

                PDF::SetFont('helvetica','B',35);
                PDF::SetXY(155,97);
                PDF::Cell(40,12,$postulante->datos_aula_voca->codigo.'',0,0,'L',true,'',1,true);



            }else{

                if($postulante->codigo_especialidad4=='A1'){


                    PDF::SetFillColor(119,205,238);
                    PDF::SetXY(155,91);
                    PDF::SetFont('helvetica','B',15);
                    PDF::Cell(40,7,'SAB 08/02: ',0,0,'C',1,'',1);

                    PDF::SetFont('helvetica','B',35);
                    PDF::SetXY(155,97);
                    PDF::Cell(40,12,$postulante->datos_aula_voca->codigo,0,0,'L',true,'',1,true);


                }
            }



            PDF::SetFont('helvetica','B',12);
            #MENSAJE
            PDF::SetFillColor(255);
            PDF::SetFont('helvetica','B',13);
            PDF::SetTextColor(68,98,168);
            PDF::SetXY(18,134+55+1);

            $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES DE 6h30 A 8h30';


            PDF::SetFillColor(0, 0, 0, 12);
            PDF::Cell(180,7,$texto,0,1,'C',1,'',1);
            PDF::SetTextColor(0);











            #NUMERO DE DNI
            PDF::SetXY(5,150);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Lugar de Nacimiento :',0,0,'L');
            PDF::SetXY(65-17,150);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->descripcion_ubigeo_nacimiento,0,0,'L');
            #FECHA DE NACIMIENTO
            PDF::SetXY(5,155);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Fecha de Nacimiento :',0,0,'L');
            PDF::SetXY(65-17,155);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5, Carbon::parse($postulante->fecha_nacimiento)->format('d/m/Y'),0,0,'L');



            #DIRECCIÓN
            PDF::SetXY(5,165-4);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Dirección :',0,0,'L');
            PDF::SetXY(65-17,165-4);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->direccion,0,0,'L');
            #
            PDF::SetXY(65-17,170-4);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->descripcion_ubigeo,0,0,'L');
            #DOCUMENTO DE IDENTIDAD
            PDF::SetXY(5,175-4);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Teléfonos :',0,0,'L');
            PDF::SetXY(65-17,175-4);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->telefonos,0,0,'L');
            #EMAIL
            PDF::SetXY(5,180-4);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Email :',0,0,'L');
            PDF::SetXY(65-17,180-4);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->email,0,0,'L');
            #COLEGIO
            PDF::SetXY(5,185-4);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Institución Educativa :',0,0,'L');
            PDF::SetXY(65-17,185-4);
            PDF::SetFont('helvetica','',10);
            PDF::SetFillColor(255, 255, 127);
            #PDF::Cell(110,5,$postulante->institucion_educativa."-". $postulante->gestion_ie . "-"  .$postulante->institucion_educa->descripcion_ubigeo ,0,0,'L');

            PDF::MultiCell(125,10,$postulante->institucion_educativa."-". $postulante->gestion_ie . "-"  .$postulante->institucion_educa->descripcion_ubigeo , 0,'L');








            $style = array('width' => 0.3, 'cap' => 'round', 'join' => 'miter', 'dash' => '0', 'phase' => 34, 'color' => array(181));
            PDF::Line(0, 192+5, 210, 192+5,$style);

            PDF::Rect(168,200,33,45,'D');
            PDF::SetXY(150+15,245+1+5);
            PDF::SetFont('helvetica','B',8);
            PDF::Cell(20,5,'HUELLA DEL POSTULANTE',0,0);



            PDF::SetXY(150+15,245+9);
            PDF::SetFont('helvetica','B',8);
            PDF::Cell(20,5,'SE REGISTRARÁ EN EL AULA',0,0);


            #DECLARACION JURADA
            PDF::SetXY(18,192+5);
            PDF::SetFont('helvetica','',20);
            PDF::Cell(170,5,'DECLARACIÓN JURADA',0,0,'C');

            PDF::SetXY(5,203+5);
            PDF::SetFont('helvetica','',11);
            $texto = "Declaro bajo juramento que toda la información registrada es auténtica, de no estar impedido de postular, no ser alumno de la UNI y que además mi foto registrada en el sistema es la actual. En caso de faltar a la verdad perderé mi derecho a postular, sometiéndome a las sanciones reglamentarias y legales que correspondan. Así mismo, declaro no tener antecedentes policiales, y autorizo a la Oficina Central de Admisión (OCAD – UNI) el uso de mis datos personales, que libremente proporciono, para los fines que involucran las actividades propias de la OCAD – UNI, y la publicación en todo medio de comunicación de los resultados de las pruebas rendidas. Declaro haber leído y ";
            $text2= "conocer el Reglamento de Admisión para Estudios de Antegrado.";
            PDF::MultiCell(155,5,$texto,1,'J',false);
            PDF::SetXY(5,203+5+39);
            PDF::MultiCell(155,5,$text2,1,'L',false);
            #
            #
            $persona='Apoderado';
            PDF::SetXY(18,272);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(70,5,'Firma del  '.$persona,'T',0,'C');
            #
            PDF::SetXY(18,277);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(70,5,'DNI del '.$persona.':','B',0,'L');



            $persona='Postulante';
            PDF::SetXY(18+90-10,272);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(70,5,'Firma del  '.$persona,'T',0,'C');
            #
            PDF::SetXY(18+90-10,277);
            PDF::SetFont('helvetica','',11);
            PDF::Cell(70,5,'DNI del '.$persona.':','B',0,'L');



            PDF::SetXY(5,287);
            PDF::SetFont('helvetica','',8);
            $ahoraes=Carbon::now().'';
            $piedepagina='Hora de Impresión: '.$ahoraes;
            PDF::Cell(10,5,$piedepagina,0,'L');
            $style = array(

                'vpadding' => 'auto',
                'hpadding' => 'auto',

            );
            $msjbarcode=$postulante->numero_identificacion.'|'.$postulante->nombre_especialidad.'|'.$postulante->datos_colegio->descripcion_ubigeo.'|'.$ahoraes;
            PDF::write2DBarcode($msjbarcode, 'QRCODE,H', 185-13, 278-15, 25, 25, array(), 'N');




            #FOTO
            if($postulante->mostrar_foto_editada==null){#32
            }else{PDF::Image($postulante->mostrar_foto_editada,9.4-2,52.8-24,32.2+2.5,43.9+3.7);
            }

            #Mapa
           # PDF::AddPage('U','A4');
          #  PDF::StartTransform();
          #  PDF::Rotate(90,140,135);
         #   PDF::Image(asset('assets/pages/img/mapa-uni.jpg'),0,0,270);
        #    PDF::StopTransform();




      #      PDF::AddPage('U','A4');
           # PDF::Image(asset('assets/pages/img/anuncio.jpg'),5,5,200);
            #COMUNICADO
            /*PDF::AddPage('U','A4');
            PDF::StartTransform();
            PDF::Rotate(0.3,100,135);
            PDF::Image(asset('assets/pages/img/aviso.jpg'),-10,0,235);
            PDF::StopTransform();*/


            #EXPORTO

        }




        PDF::Output(public_path('storage/tmpx/').'Ficha_'.$postulante->numero_identificacion.'.pdf','FI');


        $evaluacion = Evaluacion::Activo()->first();
        #if(isset($postulante) && $postulante->foto_estado=='ACEPTADO'){
        if(true){

        }else{
            //dd('Todavia no se puede visualizar la ficha');
        }//fin if
    }

}
