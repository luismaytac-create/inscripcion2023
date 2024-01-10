<?php

namespace App\Http\Controllers\Recursos;

use App\Http\Controllers\Controller;

use App\Models\RegistoIP;
use App\Models\ResulCep;
use App\Models\ResultadoVoca;
use App\Models\ResultadoUno;
use App\Models\ResultadoDos;
use App\Models\ResultadoTres;
use App\Models\ResultadoFake;
use App\Models\ResultadoCepre;
use App\Models\ListadoCepre;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
class ResultadoController extends Controller
{
  
    public function lista()
    {
     /*   $Lista = ResultadoVoca::get();
        $res['data'] = $Lista;
        return $res;*/
    }
	
	
	
	public function listadia1()
    {
       /* $Lista = ResultadoUno::get();
        $res['data'] = $Lista;
        return $res;*/
    }
	
	
	public function listadia2()
    {
      /*  $Lista = ResultadoDos::get();
        $res['data'] = $Lista;
        return $res;*/
    }
	
	
	public function listadia3(Request $request)
    {

      /*  $ip=$request->getClientIp();
        $dni= $request->dni;

        $veces=RegistoIP::where('ip',$ip)->count();


        if($ip== '181.176.71.66' || $ip== '54.155.159.22'  || $ip== '179.6.207.143' ){


            return '0';

        }else {




        if($veces<10){
            $hora= Carbon::now()->toDateTimeString();
            $data['date'] = $hora;

            $data['ip'] =  $ip;
            $data['dni'] = $dni;
            RegistoIP::create($data);
            $num_res=ResultadoFake::where('dni',$dni)->count();

            if($num_res>0){
                $res = ResultadoFake::where('dni',$dni)->first();

                return $res;
            }else {

                return '0';
            }

        }else {
            $term= RegistoIP::where('ip',$ip)->latest('date')->first();
            $inicio=new Carbon($term->date);
            $fin = Carbon::now();

            $dife = $inicio->diffInMinutes();


            if($dife>39){
                $hora= Carbon::now()->toDateTimeString();
                $data['date'] = $hora;
                $data['ip'] =  $ip;
                $data['dni'] = $dni;
                RegistoIP::create($data);
                $num_res=ResultadoFake::where('dni',$dni)->count();

                if($num_res>0){
                    $res = ResultadoFake::where('dni',$dni)->first();

                    return $res;
                }else {

                    return '0';
                }
            }else{
                return 'null';
            }


        }


        }

*/
    }
    public function listadia4(Request $request)
    {
/*
        $ip=$request->getClientIp();
        $dni= $request->dni;

        $veces=RegistoIP::where('ip',$ip)->count();


        if($veces<10){
            $hora= Carbon::now()->toDateTimeString();
            $data['date'] = $hora;

            $data['ip'] =  $ip;
            $data['dni'] = $dni;
            RegistoIP::create($data);
            $num_res=ResultadoTres::where('dni',$dni)->count();

            if($num_res>0){
                $res = ResultadoTres::where('dni',$dni)->first();

                return $res;
            }else {

                return '0';
            }

        }else {
            $term= RegistoIP::where('ip',$ip)->latest('date')->first();
            $inicio=new Carbon($term->date);
            $fin = Carbon::now();

            $dife = $inicio->diffInMinutes();


            if($dife>39){
                $hora= Carbon::now()->toDateTimeString();
                $data['date'] = $hora;
                $data['ip'] =  $ip;
                $data['dni'] = $dni;
                RegistoIP::create($data);
                $num_res=ResultadoTres::where('dni',$dni)->count();

                if($num_res>0){
                    $res = ResultadoTres::where('dni',$dni)->first();

                    return $res;
                }else {

                    return '0';
                }
            }else{
                return 'null';
            }


        }



*/

    }
    public function cepre(Request $request)
    {

        /*
        $Lista = ResulCep::get();

        Log::info('Showing user profile for user: '.$request);

        $res['data'] = $Lista;
        return $res;

        */
    }


    public function prueba(Request $request){


        Log::info('Showing user profile for user:');
        Log::info('Showing user profile for user:'.$request);

        $client = new Client();

        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>'6Ldv-a0UAAAAABFAAmBFoDDg7WfaDVtxTYsLYhR3',
                    'response'=>$request->response
                ]
            ]
        );

        $body = json_decode((string)$response->getBody());
		
		#Log::info('Showing user profile for user:'.print_r($body, true));
		
		if( $body->success != 1) {
	
		Log::info('Showing user profile for user:'.print_r($body, true));
			return response()->json([
				'error' => 'true',
				'ok' => 'false',
				'mensaje'=>'Error en el captcha',
				'captcha'=>false
				],400);
			
		}
		
		
		if( $body->success == 1 ){
			
			$codva = strtoupper($request->codigo);
			$patva = strtoupper($this->normaliza($request->apellido));
			Log::info('Showing user profile for user:'.$patva);
			
			$coun = DB::table("listado_cepre")->where('codigo',$codva)->where('paterno',$patva)->where('activo',true)->count();
			
			if( $coun > 0 ) {
				$resul = ResultadoCepre::select('codigo','puntaje_vocacional','nota_vocacional','merito_vocacional')->where('codigo',$codva)->first();
				
			
				
				
				return response()->json([
				'error' => 'false',
				'ok' => 'true',
				'captcha'=>true,
				'estadocodigo'=>true,
				'codigo'=>$resul->codigo,
				'puntaje'=>$resul->puntaje_vocacional,
				'nota'=>$resul->nota_vocacional,
				'merito'=>$resul->merito_vocacional
				
				]);
			}else {
				
				return response()->json([
				'error' => 'true',
				'ok' => 'false',
				'captcha'=>true,
				'estadocodigo'=> false
				
				]);
				
			}


	
			
			
			
			
		}
		
		
		
		
		
		
        

        

    }
	
	
	
	public function pruebafinal(Request $request){


       

        $client = new Client();

        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>'6Ldv-a0UAAAAABFAAmBFoDDg7WfaDVtxTYsLYhR3',
                    'response'=>$request->response
                ]
            ]
        );

        $body = json_decode((string)$response->getBody());
		
		#Log::info('Showing user profile for user:'.print_r($body, true));
		
		if( $body->success != 1) {
	
		
			return response()->json([
				'error' => 'true',
				'ok' => 'false',
				'mensaje'=>'Error en el captcha',
				'captcha'=>false
				],400);
			
		}
		
		
		if( $body->success == 1 ){
			
			$codva = strtoupper($request->codigo);
			$patva = strtoupper($this->normaliza($request->apellido));
			Log::info('Showing user profile for user:'.$patva);
			
			$coun = DB::table("listado_cepre")->where('codigo',$codva)->where('paterno',$patva)->where('activo',true)->count();
			
			if( $coun > 0 ) {
				$resul = ResultadoCepre::select('codigo','nota_vocacional','nota_ef','nota_id','nota_ad','ingreso')->where('codigo',$codva)->first();
				
			
				
				
				return response()->json([
				'error' => 'false',
				'ok' => 'true',
				'captcha'=>true,
				'estadocodigo'=>true,
				'codigo'=>$resul->codigo,
				'nota_final'=>$resul->nota_ef,
				'nota_promedio'=>$resul->nota_id,
				'nota_vocacional'=>$resul->nota_vocacional,
				'nota_prom_arq'=>$resul->nota_ad,
				
				'resultado'=>$resul->ingreso,
				
				
				
				]);
			}else {
				
				return response()->json([
				'error' => 'true',
				'ok' => 'false',
				'captcha'=>true,
				'estadocodigo'=> false
				
				]);
				
			}


	
			
			
			
			
		}
		
		
		
		
		
		
        

        

    }
	
	
	
	
	
	
	public function normalizaXX ($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidoooooouuuuybsaaaaaaaceeeeiiiidoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

function normaliza($cadena){

    //Codificamos la cadena en formato utf8 en caso de que nos de errores
   // $cadena = utf8_encode($cadena);

    //Ahora reemplazamos las letras
    $cadena = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $cadena
    );

    $cadena = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $cadena );

    $cadena = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $cadena );

    $cadena = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $cadena );

    $cadena = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $cadena );

    $cadena = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('Ñ', 'Ñ', 'c', 'C'),
        $cadena
    );

    return $cadena;
}




    public function pruebavoca(Request $request){


        $client = new Client();

        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>'6Ldv-a0UAAAAABFAAmBFoDDg7WfaDVtxTYsLYhR3',
                    'response'=>$request->response
                ]
            ]
        );

        $body = json_decode((string)$response->getBody());

        #Log::info('Showing user profile for user:'.print_r($body, true));

        if( $body->success != 1) {


            return response()->json([
                'error' => 'true',
                'ok' => 'false',
                'mensaje'=>'Error en el captcha',
                'captcha'=>false
            ],400);

        }


        if( $body->success == 1 ){

            $codva = strtoupper($request->codigo);
            $patva = strtoupper($this->normaliza($request->apellido));


            $coun = DB::table("vista_vocacional_datos")->where('codigo',$codva)->where('paterno',$patva)->count();

            if( $coun > 0 ) {
                $resul = ResultadoVoca::select('numero_inscripcion','puntaje','nota_vigesimal','merito')->where('numero_inscripcion',$codva)->first();




                return response()->json([
                    'error' => 'false',
                    'ok' => 'true',
                    'captcha'=>true,
                    'estadocodigo'=>true,
                    'codigo'=>$resul->numero_inscripcion,
                    'puntaje'=>$resul->puntaje,
                    'nota'=>$resul->nota_vigesimal,
                    'merito'=>$resul->merito

                ]);
            }else {

                return response()->json([
                    'error' => 'true',
                    'ok' => 'false',
                    'captcha'=>true,
                    'estadocodigo'=> false

                ]);

            }







        }










    }



    public function pruebavocacepre(Request $request){


        $client = new Client();

        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>'6Ldv-a0UAAAAABFAAmBFoDDg7WfaDVtxTYsLYhR3',
                    'response'=>$request->response
                ]
            ]
        );

        $body = json_decode((string)$response->getBody());

        #Log::info('Showing user profile for user:'.print_r($body, true));

        if( $body->success != 1) {


            return response()->json([
                'error' => 'true',
                'ok' => 'false',
                'mensaje'=>'Error en el captcha',
                'captcha'=>false
            ],400);

        }


        if( $body->success == 1 ){

            $codva = strtoupper($request->codigo);
            $patva = strtoupper($this->normaliza($request->apellido));


            $coun = DB::table("vista_cepre_validador")->where('codigo',$codva)->where('paterno',$patva)->count();

            if( $coun > 0 ) {
                $resul =DB::table("resultados.vocacional_cepre")->select('codigo','puntaje','nota_vigesimal','merito')->where('codigo',$codva)->first();




                return response()->json([
                    'error' => 'false',
                    'ok' => 'true',
                    'captcha'=>true,
                    'estadocodigo'=>true,
                    'codigo'=>$resul->codigo,
                    'puntaje'=>$resul->puntaje,
                    'nota'=>$resul->nota_vigesimal,
                    'merito'=>$resul->merito

                ]);
            }else {

                return response()->json([
                    'error' => 'true',
                    'ok' => 'false',
                    'captcha'=>true,
                    'estadocodigo'=> false

                ]);

            }







        }










    }






    public function pruebaprimera(Request $request){


        $client = new Client();

        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>'6Ldv-a0UAAAAABFAAmBFoDDg7WfaDVtxTYsLYhR3',
                    'response'=>$request->response
                ]
            ]
        );

        $body = json_decode((string)$response->getBody());

        #Log::info('Showing user profile for user:'.print_r($body, true));

        if( $body->success != 1) {


            return response()->json([
                'error' => 'true',
                'ok' => 'false',
                'mensaje'=>'Error en el captcha',
                'captcha'=>false
            ],400);

        }


        if( $body->success == 1 ){

            $codva = strtoupper($request->codigo);
            $patva = strtoupper($this->normaliza($request->apellido));


            $coun = DB::table("vista_primera_datos")->where('codigo',$codva)->where('paterno',$patva)->count();

            if( $coun > 0 ) {
                $resul = ResultadoUno::select('numero_inscripcion','puntaje')->where('numero_inscripcion',$codva)->first();




                return response()->json([
                    'error' => 'false',
                    'ok' => 'true',
                    'captcha'=>true,
                    'estadocodigo'=>true,
                    'codigo'=>$resul->numero_inscripcion,
                    'puntaje'=>$resul->puntaje


                ]);
            }else {

                return response()->json([
                    'error' => 'true',
                    'ok' => 'false',
                    'captcha'=>true,
                    'estadocodigo'=> false

                ]);

            }







        }










    }












    public function pruebasegunda(Request $request){


        $client = new Client();

        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>'6Ldv-a0UAAAAABFAAmBFoDDg7WfaDVtxTYsLYhR3',
                    'response'=>$request->response
                ]
            ]
        );

        $body = json_decode((string)$response->getBody());

        #Log::info('Showing user profile for user:'.print_r($body, true));

        if( $body->success != 1) {


            return response()->json([
                'error' => 'true',
                'ok' => 'false',
                'mensaje'=>'Error en el captcha',
                'captcha'=>false
            ],400);

        }


        if( $body->success == 1 ){

            $codva = strtoupper($request->codigo);
            $patva = strtoupper($this->normaliza($request->apellido));


            $coun = DB::table("vista_primera_datos")->where('codigo',$codva)->where('paterno',$patva)->count();

            if( $coun > 0 ) {
                $resul = DB::table("resultados.segundodia")->select('numero_inscripcion','puntaje_dia1','puntaje_dia2','puntaje_acumulado')->where('numero_inscripcion',$codva)->first();




                return response()->json([
                    'error' => 'false',
                    'ok' => 'true',
                    'captcha'=>true,
                    'estadocodigo'=>true,
                    'codigo'=>$resul->numero_inscripcion,
                    'puntaje1'=>$resul->puntaje_dia1,
                    'puntaje2'=>$resul->puntaje_dia2,
                    'puntajea'=>$resul->puntaje_acumulado,



                ]);
            }else {

                return response()->json([
                    'error' => 'true',
                    'ok' => 'false',
                    'captcha'=>true,
                    'estadocodigo'=> false

                ]);

            }







        }










    }







    public function pruebatercera(Request $request){


        $client = new Client();

        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>'6Ldv-a0UAAAAABFAAmBFoDDg7WfaDVtxTYsLYhR3',
                    'response'=>$request->response
                ]
            ]
        );

        $body = json_decode((string)$response->getBody());

        #Log::info('Showing user profile for user:'.print_r($body, true));

        if( $body->success != 1) {


            return response()->json([
                'error' => 'true',
                'ok' => 'false',
                'mensaje'=>'Error en el captcha',
                'captcha'=>false
            ],400);

        }


        if( $body->success == 1 ){

            $codva = strtoupper($request->codigo);
            $patva = strtoupper($this->normaliza($request->apellido));


            $coun = DB::table("vista_primera_datos")->where('codigo',$codva)->where('paterno',$patva)->count();

            if( $coun > 0 ) {
                $resul = DB::table("resultados.tercerdia")->select(



                    'numero_inscripcion',
                    'modalidad',
                    'especialidad_postulacion',
                    'primera_prueba',
                    'segunda_prueba',
                    'tercera_prueba',
                    'acumulado',
                    'nota_final',
                    'nota_vigesimal_vocacional',
                    'nota_final_arquitectura',
                    'resultado',
                    'especialidad_ingreso',
                    'ingresante'


                )->where('numero_inscripcion',$codva)->first();




                return response()->json([
                    'error' => 'false',
                    'ok' => 'true',
                    'captcha'=>true,
                    'estadocodigo'=>true,
                    'numero_inscripcion'=>$resul->numero_inscripcion,
                    'modalidad'=>$resul->modalidad,
                    'especialidad_postulacion'=>$resul->especialidad_postulacion,
                    'primera_prueba'=>$resul->primera_prueba,
                    'segunda_prueba'=>$resul->segunda_prueba,
                    'tercera_prueba'=>$resul->tercera_prueba,
                    'acumulado'=>$resul->acumulado,
                    'nota_final'=>$resul->nota_final,
                    'nota_vigesimal_vocacional'=>$resul->nota_vigesimal_vocacional,
                    'nota_final_arquitectura'=>$resul->nota_final_arquitectura,
                    'resultado'=>$resul->resultado,
                    'especialidad_ingreso'=>$resul->especialidad_ingreso,
                    'ingresante'=>$resul->ingresante



                ]);
            }else {

                return response()->json([
                    'error' => 'true',
                    'ok' => 'false',
                    'captcha'=>true,
                    'estadocodigo'=> false

                ]);

            }







        }










    }









}
