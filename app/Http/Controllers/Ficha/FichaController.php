<?php

namespace App\Http\Controllers\Ficha;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Pago\PagoController;
use App\Models\Confirmacion;
use App\Models\DeclaracionEva;
use App\Models\Evaluacion;
use App\Models\CapacidadPiloto;
use App\Models\ClavesCepre;
use App\Models\FichaFecha;
use App\Models\MensajeTexto;
use App\Models\Postulante;
use App\Models\Proceso;
use App\Models\LogEmailPiloto;
use App\Models\Recaudacion;
use App\Models\Servicio;
use App\Models\SolicitanteVictima;
use App\Models\PostulanteClave;
use App\Models\Validacion;
use App\Mail\PilotoMail;
use App\User;
use Mail;
use App\Models\IngreCepp;
use Auth;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Http\Request;
use PDF;
use Styde\Html\Facades\Alert;
use Illuminate\Support\Facades\Log;

class FichaController extends Controller
{
    /**
     * Mostrar la ficha
     * 1.- La foto debe estar editada y aprobada
     * 2.- Debe haber pagado
     * 3.- Debe haber llenado todos sus datos
     * @return view
     */
	 
	 
	 
    public function index($id = null)
    {

        $postulante = Postulante::Usuario()->first();
        $idus = Auth::user()->id;
        $user = User::find($idus);
      // $validacion = Validacion::where('codigo',$postulante->codigo_verificacion)->first();

        if (isset($postulante)) {
            $correcto_foto = false;
            $correcto_dni = false;
            $correcto_datos_i = false;
            $correcto_datos_p = false;
            $correcto_datos_f = false;
            $correcto_datos_e = false;
            $correcto_pagos = false;
            $correcto_email = false;
            $correcto_decla = false;
	        $correcto_terro = false;
            $msj = collect([]);
            ################### INICIO VALIDACION DOCUMENTOS
	         #Valida si esta aprobado victima
            # VALIDA SI ES CEPRE
            $swp = !is_null($postulante);


            if( !isset($postulante->idespecialidad) ){

                if(isset($postulante->ficha_fecha)){
                    return view('ficha.falso',compact('id','postulante','swp'));
                }


              return view('datos.personal.modalidad',compact('id','postulante','swp'));


            }





            if( !isset($postulante->idespecialidad) ){

         //      return view('ficha.falso',compact('id','postulante','swp'));


            }


            if( !is_null($postulante->idmodalidad2) ){

                if(isset($postulante->idmodalidad)){
                    if($postulante->idmodalidad2 <> 1 and $postulante->idmodalidad2 <> 17 and $postulante->idmodalidad2 <> 23){
                        $terr = SolicitanteVictima::where('idpostulante',$postulante->id)->where('estado','APROBADO')->count();
                        if($terr>0){
                            $correcto_terro = true;
                        }else{
                            $msj->push(['titulo'=>'Falta Presentar o Aprobar Documentos',
                                'mensaje'=>'Debes escanear tus documentos y subirlo en el siguiente enlace, si ya los subiste espera la aprobación para continuar con tu inscripción.'
                                ,'link'=>'documentos.index','boton'=>'VER DOCUMENTOS']);

                        }
                    }else {
                        $correcto_terro = true;
                    }

                }else{
                    $correcto_terro = true;
                }




            }else{


                if(isset($postulante->idmodalidad)){
                    if($postulante->idmodalidad <> 1 and  $postulante->idmodalidad <> 16 and $postulante->idmodalidad <> 17 and $postulante->idmodalidad <> 23 ){
                        $terr = SolicitanteVictima::where('idpostulante',$postulante->id)->where('estado','APROBADO')->count();
                        if($terr>0){
                            $correcto_terro = true;
                        }else{

                            $msj->push(['titulo'=>'Falta Presentar o Aprobar Documentos',
                                'mensaje'=>'Debes escanear tus documentos y subirlo en el siguiente enlace, si ya los subiste espera la aprobación para continuar con tu inscripción.'
                                ,'link'=>'documentos.index','boton'=>'VER DOCUMENTOS']);

                        }
                    }else {

                        $correcto_terro = true;
                    }

                }else{
                    $correcto_terro = true;


                }





            }

            ################### FIN VALIDACION DOCUMENTOS

            ################### INICIO VALIDACION DECLARACION
            $countdeclaracion = DeclaracionEva::where('idpostulante',$postulante->id)->count();
            if( $countdeclaracion > 0){
                $estadodeclar = DeclaracionEva::where('idpostulante',$postulante->id)->first();
                if($estadodeclar->estado == 'APROBADO'){

                    $correcto_decla = true;

                }else{
                    $msj->push(['titulo'=>'Falta Presentar o Aprobar Declaracón Jurada','mensaje'=>'Debes escanear tu declaración jurada y subirlo en el siguiente enlace, si ya los subiste espera la aprobación para continuar con tu inscripción.'
                        ,'link'=>'declaracion.index','boton'=>'VER DECLARACIÓN JURADA']);
                }
            }else {
                $msj->push(['titulo'=>'Falta Presentar o Aprobar Declaración Jurada','mensaje'=>'Debes escanear tu declaración jurada y subirlo en el siguiente enlace, si ya los subiste espera la aprobación para continuar con tu inscripción.'
                    ,'link'=>'declaracion.index','boton'=>'VER DECLARACIÓN JURADA']);
            }
            ################### FIN VALIDACION DECLARACION

            ################### INICO VALIDACION EMAIL
            if( !$user->confirmo ){
                $msj->push(['titulo'=>'Falta Confirmar Correo Electrónico','mensaje'=>'Debes confirmar tu correo electrónico para continuar con tu inscripción.'
                    ,'link'=>'email.index','boton'=>'CONFIRMAR EMAIL']);

            }else{
                $correcto_email=true;
            }
            ################### FIN VALIDACION EMAIL


            ################### INICIO VALIDACION DNI

            if(isset($postulante) && isset($postulante->foto_dni)){
                $correcto_dni=true;


            }else{
                $correcto_dni = false;
                $msj->push(['titulo'=>'DNI NO SUBIDO','mensaje'=>'No haz subido tu DNI escaneado.',
                    'link'=>'datos.foto.foto','boton'=>'SUBIR DNI']);

            }

            ################### FIN VALIDACION EMAIL


            ################### INICIO VALIDACION FOTO

            if(isset($postulante) && $postulante->foto_estado == 'ACEPTADO'){
                $correcto_foto = true;
            }elseif (isset($postulante) && $postulante->foto_estado == 'SIN FOTO') {
                $correcto_foto = false;
                $msj->push(['titulo'=>'Falta Foto','mensaje'=>'Usted no ha cargado su foto'
                ,'link'=>'datos.foto.foto','boton'=>'CARGAR FOTO']);
            }elseif (isset($postulante) && $postulante->foto_estado == 'RECHAZADO') {
                $correcto_foto = false;
                $msj->push(['titulo'=>'Foto Rechazada','mensaje'=>'La foto que usted ha cargado en el sistema ha sido rechazada, vuelva a cargar una foto nítida con fondo blanco sin lentes, si tiene problemas puede enviar su foto al correo informes@admisionuni.edu.pe'
                    ,'link'=>'datos.foto.foto','boton'=>'VER ESTADO DE FOTO']);
            }elseif(isset($postulante) && $postulante->foto_estado == 'CARGADO') {
                $correcto_foto = false;
                $msj->push(['titulo'=>'Edición de Foto','mensaje'=>'Se recibió su foto, se confirmará por correo cuando pueda descargar su ficha.'
                    ,'link'=>'datos.foto.foto','boton'=>'VER ESTADO DE FOTO']);
            }
            ################### FIN VALIDACION FOTO




            ################### INICIO VALIDACION DATOS DEL POSTULANTE
            $proceso = Proceso::where('idpostulante',$postulante->id)->first();

            if ($proceso->preinscripcion)$correcto_datos_i = true;
            else {
                $correcto_datos_i = false;
                $msj->push(['titulo'=>'Faltan datos','mensaje'=>'Usted no ha ingresado sus datos de Preinscripcion'
                    ,'link'=>'datos.postulante.index','boton'=>'VER PREINSCRIPCIÓN']);
            }
            if ($proceso->datos_personales)$correcto_datos_p = true;
            else {
                $correcto_datos_p = false;
                $msj->push(['titulo'=>'Faltan datos','mensaje'=>'Usted no ha ingresado sus datos personales'
                    ,'link'=>'datos.secundarios.index','boton'=>'VER DATOS PERSONALES']);
            }

            if ($proceso->datos_familiares)$correcto_datos_f = true;
            else {
                $correcto_datos_f = false;
                $msj->push(['titulo'=>'Faltan datos','mensaje'=>'Usted no ha ingresado sus datos familiares'
                    ,'link'=>'datos.familiares.index','boton'=>'VER DATOS FAMILIARES']);
            }

            if ($proceso->encuesta)$correcto_datos_e = true;
            else {
                $correcto_datos_e = false;
                $msj->push(['titulo'=>'Faltan datos','mensaje'=>'Usted no ha ingresado los datos complementarios'
                    ,'link'=>'datos.complementarios.index','boton'=>'VER DATOS COMPLEMENTARIOS']);
            }
            ################### FIN VALIDACION DATOS



            ################### INICIO VALIDACION PAGOS



            $pagos = new PagoController();
            $pagos = $pagos->CalculoServiciosFicha();

            $recaudacion = Recaudacion::select('servicio','monto')->where('idpostulante',$postulante->id)->get();
            $pagos_realizados = $recaudacion->implode('servicio', ', ');
            $debe = false;
            $debecepre = false;
            foreach ($pagos as $key => $item) {

                if($postulante->idmodalidad ==16 ) {
                    $servicio = Servicio::where('codigo',$item)->first();
                    if($servicio->codigo == '475'){
                       
                    }
                if(str_contains($pagos_realizados,$item)){
                            $correcto_pagos = true;
                        } else{
                            $correcto_pagos = false;
                            $servicio = Servicio::where('codigo',$item)->first();
                            $msj->push(['titulo'=>'Falta pago (Los pagos realizado el fin de semana se cargaran el primer día habil)','mensaje'=>'No esta registrado el pago de '.$servicio->descripcion.' por S/ '.$servicio->monto.' soles, si usted acaba de realizar el pago el sistema se actualizara en 24 horas, de lo contrario comuniquese con nosotros al correo informes@admisionuni.edu.pe']);
                            $debe = true;
                        }


                    if($servicio->codigo == '474'){
                        if($postulante->idespecialidad ==1 && $postulante->idespecialidad4 !=1) {
                            if (str_contains($pagos_realizados, $item)) {
                                $correcto_pagos = true;
                            } else {
                                $correcto_pagos = false;
                                $servicio = Servicio::where('codigo', $item)->first();
                                $msj->push(['titulo' => 'Falta pago (Los pagos realizado el fin de semana se cargaran el primer día habil)', 'mensaje' => 'No esta registrado el pago de ' . $servicio->descripcion . ' por S/ ' . $servicio->monto . ' soles, si usted acaba de realizar el pago el sistema se actualizara en 24 horas, de lo contrario comuniquese con nosotros al correo informes@admisionuni.edu.pe']);
                                $debe = true;
                            }
                        }

                        if($postulante->idespecialidad ==1 && $postulante->idespecialidad4 ==1 ) {
                            if (str_contains($pagos_realizados, $item)) {
                                if (date('Y-m-d') >= env('FINAL_CEPRE')) {
                                    $ccc = DB::table("arquitectura_cepre_pagos")->where('codigo', $postulante->numero_identificacion)->count();
                                    // CAMBIAR AQUI CEPRE DOBLE 160
                                    if ($ccc > 1) {
                                        $correcto_pagos = true;
                                    } else {

                                        $correcto_pagos = false;
                                        $debe = true;
                                        $debecepre = true;

                                        $ingresante_arqui = DB::table("vista_cepre_arqui_ingresantes")->where('numero_identificacion', $postulante->numero_identificacion)->count();
                                        if ($ingresante_arqui == 1) {
                                            $correcto_pagos = true;
                                            $debe = false;
                                            $debecepre = false;
                                        }
                                    }
                                } else {
                                    $correcto_pagos = true;
                                }
                            } else {
                                $correcto_pagos = false;
                                $servicio = Servicio::where('codigo', $item)->first();
                                $msj->push(['titulo' => 'Falta pago (Los pagos realizado el fin de semana se cargaran el primer día habil)', 'mensaje' => 'No esta registrado el pago de ' . $servicio->descripcion . ' por S/ ' . $servicio->monto . ' soles, si usted acaba de realizar el pago el sistema se actualizara en 24 horas, de lo contrario comuniquese con nosotros al correo informes@admisionuni.edu.pe']);
                                $debe = true;
                            }

                        }
                    }//




                }//fin

                if($postulante->idmodalidad !=16 ){


                    if(str_contains($pagos_realizados,$item))$correcto_pagos = true;
                    else{
                        $correcto_pagos = false;
                        $servicio = Servicio::where('codigo',$item)->first();
                        $msj->push(['titulo'=>'Falta pago (Los pagos realizado el fin de semana se cargaran el primer día habil)','mensaje'=>'No esta registrado el pago de '.$servicio->descripcion.' por S/ '.$servicio->monto.' soles, si usted acaba de realizar el pago el sistema se actualizara en 24 horas, de lo contrario comuniquese con nosotros al correo informes@admisionuni.edu.pe']);
                        $debe = true;
                    }

                    // INICIO SEGUNDO PAGO CEPRE
                    $debeceprecount= DB::table("deden_voca_25")->where('dni', $postulante->numero_identificacion)->count();
                    $debecepre= DB::table("deden_voca_25")->where('dni', $postulante->numero_identificacion)->first();


                    if( $postulante->idespecialidad==1 and $debeceprecount>0){

                        if($debecepre->pago_voca_ordi <2 ){
                            $correcto_pagos = false;
                            $servicio = Servicio::where('codigo','474')->first();
                            $msj->push(['titulo'=>'Falta pago (Los pagos realizado el fin de semana se cargaran el primer día habil)','mensaje'=>'No esta registrado el pago de '.$servicio->descripcion.' por S/ '.$servicio->monto.' soles, si usted acaba de realizar el pago el sistema se actualizara en 24 horas, de lo contrario comuniquese con nosotros al correo informes@admisionuni.edu.pe']);
                            $debe = true;
                        }

                    }

                    // FIN SEGUNDO PAGO CEPRE


                }





            }



 $debecvocaseng= DB::table("vista_deben_voca_segunda_opc")->where('numero_identificacion', $postulante->numero_identificacion)->count();

            if($debecvocaseng>0){

                $correcto_pagos = false;
                $servicio = Servicio::where('codigo','474')->first();
                $msj->push(['titulo'=>'Falta pago (Los pagos realizado el fin de semana se cargaran el primer d�a habil)',
                    'mensaje'=>'No esta registrado el pago de '.$servicio->descripcion.' por S/ '.$servicio->monto.' soles, si usted acaba de realizar el pago el sistema se actualizara en 24 horas,
                             de lo contrario comuniquese con nosotros al correo informes@admisionuni.edu.pe']);
                $debe = true;

            }





            ################### FIN VALIDACION PAGOS

            $correcto_pagos = ($debe) ? false : true ;
            #Casos especiales a los que se les permite el ingreso sin pago
            $casos=[''];
            if(in_array($postulante->numero_identificacion,$casos))$correcto_pagos = true; 
            if($debecepre){
             //   $msj->push(['titulo'=>'Falta pago (Los pagos realizado el fin de semana se cargaran el primer día habil)','mensaje'=>'No esta registrado el pago de '.'VOCACIONAL'.' por S/ '.'160'.' soles, si usted acaba de realizar el pago el sistema se actualizara en 24 horas, de lo contrario comuniquese con nosotros al correo informes@admisionuni.edu.pe']);

            }


            if($postulante->idmodalidad ==16 ){

                if($postulante->idespecialidad !=1 && $postulante->idespecialidad4 !=1){

                    if ($correcto_pagos && !$postulante->pago ) {
                   //     Postulante::where('id',$postulante->id)->update(['pago'=>true,'fecha_pago'=>Carbon::now()]);
                    }
                }

                if($postulante->idespecialidad ==1 && $postulante->idespecialidad4 ==1){

                    if ($correcto_pagos && !$postulante->pago ) {
                    //    Postulante::where('id',$postulante->id)->update(['pago'=>true]);
                    }
                }
            }else {
                if ($correcto_pagos && !$postulante->pago ) {
                    Postulante::where('id',$postulante->id)->update(['pago'=>true,'fecha_pago'=>Carbon::now()]);
                }
            }




            #-------------------------------------------------------------------------------------------
      /*      if($correcto_foto && $correcto_datos_i && $correcto_datos_p && $correcto_datos_f && $correcto_datos_e && $correcto_pagos && $correcto_terro){
       */
	   if(  $correcto_foto && 
            $correcto_datos_i && 
            $correcto_datos_p && 
            $correcto_pagos && 
            $correcto_datos_f && 
            $correcto_datos_e  && 
            $correcto_terro && 
            $correcto_dni && 
            $correcto_email && 
            $correcto_decla
       ){
                 #Si los datos son correctos muestro el formulario de conformidad
                if ($postulante->datos_ok){

                    if($postulante->idmodalidad ==16){

                        // solo un pago NO APARECE AULA
                        if($postulante->idespecialidad==1 && $postulante->idespecialidad4 !=1 ){

                        }

                        //2 PAGOS APARECE AULA
                        if($postulante->idespecialidad ==1 && $postulante->idespecialidad4 ==1 ){

                            if(isset($postulante->idaulavoca)){

                            }else{

                                $value = IngreCepp::select('dni')->where('especialidad','A1')->get();

                                $counn = DB::table('recaudacion')
                                    ->join('postulante', 'postulante.id', '=', 'recaudacion.idpostulante')
                                    ->where('recaudacion.servicio','474')
                                    ->where('postulante.numero_identificacion',$postulante->numero_identificacion)
                                   ->whereNotIn('postulante.numero_identificacion',$value->toArray())
                                    ->count();


                                if( $counn > 0) {

                                    #SE DEBE ASIGNAR AULA VOCA
                                  ##  Postulante::AsignarAula($postulante->id);
                                }

                            }



                        }

                        #1 PAGO APARECE AULA
                        if( $postulante->idespecialidad !=1 && $postulante->idespecialidad4==1){

                            $value = IngreCepp::select('dni')->where('especialidad','A1')->get();

                            $counn = DB::table('recaudacion')
                                ->join('postulante', 'postulante.id', '=', 'recaudacion.idpostulante')
                                ->where('recaudacion.servicio','474')
                                ->where('postulante.numero_identificacion',$postulante->numero_identificacion)
                                ->whereNotIn('postulante.numero_identificacion',$value->toArray())
                                ->count();
                            if( $counn == 1) {

                                #SE DEBE ASIGNAR AULA VOCA
                               # Postulante::AsignarAula($postulante->id);
                            }

                        }


                        if( !isset($postulante->idaula1) || !isset($postulante->idaula2) || !isset($postulante->idaula3)  ){
                         #   Postulante::AsignarAula($postulante->id);
                        }
                         if( !isset($postulante->idaulavoca) ){
                         #    Postulante::AsignarAula($postulante->id);
                         }

                    }else {
                        if( !isset($postulante->idaula1) || !isset($postulante->idaula2) || !isset($postulante->idaula3)  ){
                            Postulante::AsignarAula($postulante->id);
                        }
                        if( !isset($postulante->idaulavoca) ){
                            Postulante::AsignarAula($postulante->id);
                        }
                    }

                    return view('ficha.index',compact('id','postulante'));
                 /*   $cuentaconfima=  DB::table("confirmacion")->where('dni',$postulante->numero_identificacion)->count();
                    if( $cuentaconfima >0 ){
                        return view('ficha.index',compact('id','postulante'));
                    }else {
                        return redirect()->to('/');
                    }
                */




                }
                else {
                   $turnospiloto = CapacidadPiloto::where('libre','>',0)->orderBy('id','asc')->get();
                    //return view('ficha.index',compact('id','postulante'));
                    return view('ficha.confirmacion',compact('id','postulante','turnospiloto'));

                }

            }else{
                return view('ficha.bloqueo',compact('msj'));
            }

        }else {
			Alert::warning('No registro su preinscripcion')
                    ->details('Debes ingresar a la opcion Datos y llenar el formularo de preinscripcion')
                    ->button('Lo puedes hacer haciendo clic aqui',route('datos.index'),'primary');
		return back();
        }

    }
    public function confirmar(Request $request)
    {
        /* se comento para evitar la confirmacion
        $msj ='';
        $postulante = Postulante::Usuario()->first();
        $cantid = MensajeTexto::where('idpostulante', $postulante->id)->find(\DB::table('mensaje_texto')->where('idpostulante', $postulante->id)->max('id'));
        if(is_null($cantid)){
            return Response::json(['data' => 'ERROR','msj'=>'CÓDIGO INCORRECTO' ]);
        }else {
            $codd = $cantid->codigo;
        }
        $codd = $cantid->codigo;
        */
        //if ($codd == strtoupper($request->codigo)) {
        $postulante = Postulante::Usuario()->first();
        if (true) {


            if(!$postulante->datos_ok){
                $postulante->datos_ok=true;
                $postulante->fecha_conformidad=Carbon::now();
                $postulante->ficha_fecha=Carbon::now();
                //Comentado porque es presencial
                // if( $postulante->idmodalidad == 16){
                //     $postulante->idturnopiloto= $request->turno;
                //     $capacidad = CapacidadPiloto::where('id',$request->turno)->first();
                //     CapacidadPiloto::where('id',$request->turno)->update([
                //         'libre' => ($capacidad->libre)-1,
                //         'asignado'=> ($capacidad->asignado)+1
                //     ]);
                // }else {
                // }

                $postulante->save();
                Postulante::AsignarCodigo($postulante->id,$postulante->canal,$postulante->codigo_modalidad);
                if( !isset($postulante->idaula1) ){
                    Postulante::AsignarAula($postulante->id);
                }
            }
            return redirect()->route('ficha.index');



            // Postulante::AsignarAula($postulante->id);
          #  Postulante::AsignarClave($postulante->id);
         #   $myEmail = Auth::user()->email;
         #   $tablaclave = PostulanteClave::where('idpostulante',$postulante->id)->first();
         #   $claveespa = ClavesCepre::where('id',$tablaclave->idclave)->first();
         #   Mail::to($myEmail)->send(new PilotoMail($postulante->numero_identificacion,$claveespa->clave,$capacidad->turno));
            
         //return Response::json(['data' => 'OK', 'confirmacion'=>'OK','confirmation_id'=>$postulante->id ]);



        }else{

            return Response::json(['data' => 'ERROR','msj'=>'CÓDIGO INCORRECTO' ]);
        }


        #if($this->validarConfirmacion()){
        if(true){

        }else {


            return Response::json(['data' => 'ERROR','msj'=>'No cumple los requisitos para generar su ficha.' ]);
        }









    }
    public function validarConfirmacion() {

        $postulante = Postulante::Usuario()->first();
        if (isset($postulante)) {
            $correcto_foto = false;
            $correcto_dni = false;
            $correcto_datos_i = false;
            $correcto_datos_p = false;
            $correcto_datos_f = false;
            $correcto_datos_e = false;
            $correcto_pagos = false;
            $correcto_terro = true;
            $msj = collect([]);







            #Valida si subio dni

            if(isset($postulante) && isset($postulante->foto_dni)){
                $correcto_dni=true;


            }else{
                $correcto_dni = false;
                $msj->push(['titulo'=>'DNI NO SUBIDO','mensaje'=>'No haz subido tu DNI escaneado.']);

            }


            #Valida Foto Editada

            if(isset($postulante) && $postulante->foto_estado == 'ACEPTADO'){
                $correcto_foto = true;
            }elseif (isset($postulante) && $postulante->foto_estado == 'SIN FOTO') {
                $correcto_foto = false;
                $msj->push(['titulo'=>'Falta Foto','mensaje'=>'Usted no ha cargado su foto']);
            }elseif (isset($postulante) && $postulante->foto_estado == 'RECHAZADO') {
                $correcto_foto = false;
                $msj->push(['titulo'=>'Foto Rechazada','mensaje'=>'La foto que usted ha cargado en el sistema ha sido rechazada, vuelva a cargar una foto mas nitida con fondo blanco sin lentes, si tiene problemas puede enviar su foto al correo informes@admisionuni.edu.pe']);
            }elseif(isset($postulante) && $postulante->foto_estado == 'CARGADO') {
                $correcto_foto = false;
                $msj->push(['titulo'=>'Edición de Foto','mensaje'=>'Se recibió su foto, se confirmará por correo cuando pueda descargar su ficha.']);
            }

            #Valida datos adicionales----------------------------------------
            $proceso = Proceso::where('idpostulante',$postulante->id)->first();

            if ($proceso->preinscripcion)$correcto_datos_i = true;
            else {
                $correcto_datos_i = false;
                $msj->push(['titulo'=>'Faltan datos','mensaje'=>'Usted no ha ingresado sus datos de Preinscripcion']);
            }
            if ($proceso->datos_personales)$correcto_datos_p = true;
            else {
                $correcto_datos_p = false;
                $msj->push(['titulo'=>'Faltan datos','mensaje'=>'Usted no ha ingresado sus datos personales']);
            }

            if ($proceso->datos_familiares)$correcto_datos_f = true;
            else {
                $correcto_datos_f = false;
                $msj->push(['titulo'=>'Faltan datos','mensaje'=>'Usted no ha ingresado sus datos familiares']);
            }

            if ($proceso->encuesta)$correcto_datos_e = true;
            else {
                $correcto_datos_e = false;
                $msj->push(['titulo'=>'Faltan datos','mensaje'=>'Usted no ha ingresado los datos complementarios']);
            }

            #Valida Pagos-------------------------------------------------------
            $pagos = new PagoController();
            $pagos = $pagos->CalculoServiciosFicha();


            $recaudacion = Recaudacion::select('servicio','monto')->where('idpostulante',$postulante->id)->get();
            $pagos_realizados = $recaudacion->implode('servicio', ', ');
            $debe = false;
            foreach ($pagos as $key => $item) {
                if(str_contains($pagos_realizados,$item))$correcto_pagos = true;
                else{
                    $correcto_pagos = false;
                    $servicio = Servicio::where('codigo',$item)->first();
                    $msj->push(['titulo'=>'Falta pago (Los pagos realizado el fin de semana se cargaran el primer día habil)','mensaje'=>'No esta registrado el pago de '.$servicio->descripcion.' por S/ '.$servicio->monto.' soles, si usted acaba de realizar el pago el sistema se actualizara en 24 horas, de lo contrario comuniquese con nosotros al correo informes@admisionuni.edu.pe']);
                    $debe = true;
                }
            }

            $correcto_pagos = ($debe) ? false : true ;


            if($postulante->idmodalidad ==16 ){

                if($postulante->idespecialidad !=1 && $postulante->idespecialidad2 !=1){

                    if ($correcto_pagos && !$postulante->pago ) {
                        Postulante::where('id',$postulante->id)->update(['pago'=>true,'fecha_pago'=>Carbon::now()]);
                    }
                }







            }else {
                if ($correcto_pagos && !$postulante->pago ) {
                    Postulante::where('id',$postulante->id)->update(['pago'=>true,'fecha_pago'=>Carbon::now()]);
                }
            }





            #-------------------------------------------------------------------------------------------
            /*      if($correcto_foto && $correcto_datos_i && $correcto_datos_p && $correcto_datos_f && $correcto_datos_e && $correcto_pagos && $correcto_terro){
             */
            if($correcto_foto && $correcto_datos_i && $correcto_datos_p && $correcto_pagos && $correcto_datos_f && $correcto_datos_e  && $correcto_terro && $correcto_dni){

                return true;

            }else{
                return false;
            }

        }else {
           return false;
        }



    }


    public function pdf($id = null)
    {




        if(true){

        if (isset($id)) {
            $postulante = Postulante::find($id);
        } else {
            $postulante = Postulante::Usuario()->first();
        }

        if($postulante->datos_ok){
            if($postulante->idmodalidad==16){


            }else{
                if( !isset($postulante->idaula1) || !isset($postulante->idaula2) || !isset($postulante->idaula3)  ){
                    Postulante::AsignarAula($postulante->id);
                }
                if( !isset($postulante->idaulavoca) ){
                    Postulante::AsignarAula($postulante->id);
                }

            }

        }

        
        if (isset($id)) {
            $postulante = Postulante::find($id);
        } else {
            $postulante = Postulante::Usuario()->first();
        }
        $evaluacion = Evaluacion::Activo()->first();
        /*
        $muestraficha = DB::table("vista_muestra_ficha")->where('numero_identificacion', $postulante->numero_identificacion)->where('ficha','MUESTRA')->count();
        if( $muestraficha >0){

        }else {
            return view('ficha.falso',compact('postulante'));
        }
        */



        PDF::SetTitle('FICHA DE INSCRIPCION');
        PDF::AddPage('U', 'A4');
        PDF::SetAutoPageBreak(false);
        $date = Carbon::now();
        FichaFecha::create([
                'idpostulante'=>$postulante->id,
                'dni'=>$postulante->numero_identificacion,
                'fecha'=>$date,
                'iduser'=>$postulante->idusuario,
                'idmodalidad'=>$postulante->idmodalidad,
                'idespecialidad'=>$postulante->idespecialidad,
                'idespecialidad2'=>$postulante->idespecialidad2,
                'idespecialidad3'=>$postulante->idespecialidad3,

            ]);


            # PDF::Rect(15,15, 180,170);
        #FONDO
        //

        if ($postulante->idmodalidad == 16) {
            $facultad = $postulante->idfacultad2;
        } else {
            $facultad = $postulante->idfacultad;
        }


     PDF::Image(storage_path('app/documentos/comunicado.jpg'), 0, 0, 210,297);
            PDF::AddPage('U', 'A4');

        PDF::Image(storage_path('app/documentos/ficha.jpg'), 0, 0, 210, 297, '', '', '', false, 0, '', false, false, 0);
        #    PDF::Image(storage_path('app/documentos/ficha.jpg'), 0, 0, 210, 297, '', '', '', false, '', '', false, false, 0);


        PDF::SetXY(5, 100 + 16 - 20 + 10 + 3 + 6 - 6);
        PDF::SetFont('helvetica', 'B', 13);
        PDF::Cell(60, 5, 'Cuarta Disposición :', 0, 0, 'L');
        PDF::SetXY(55, 100 + 16 - 20 + 10 + 3 + 6 - 6);

        PDF::SetFont('helvetica', '', 13);
        if ($postulante->cuarta_df == "postulante") {
            PDF::Cell(150, 5, 'Postulante con derecho a vacante', 0, 0, 'L');

        }
        if ($postulante->cuarta_df == "participante_sin_derecho") {

            PDF::Cell(150, 5, 'Participante sin derecho a vacante', 0, 0, 'L');
        }
        PDF::SetXY(95, 50 + 12 + 3 - 8);
        PDF::SetTextColor(255);
        PDF::SetFont('helvetica', '', 12);
        PDF::Cell(60, 5, 'DNI:', 0, 0);

        PDF::SetXY(95, 50 + 16 + 3 - 8);
        PDF::SetFont('helvetica', 'B', 20);
        PDF::Cell(60, 5, $postulante->numero_identificacion, 0, 0);
        PDF::SetXY(60, 35);
        PDF::SetFont('helvetica', 'B', 13);
        $nota = ($postulante->idmodalidad == 16 && $postulante->pago = 'FALSE' && (date('Y-m-d') <= env('FINAL_CEPRE'))) ? '' : ''; #PROVISIONAL
        PDF::MultiCell(80, 5, $nota, 1, 'C', true);

        PDF::SetXY(60, 40);
        $nota2 = ($postulante->idmodalidad == 16 && $postulante->pago = 'FALSE' && (date('Y-m-d') <= env('FINAL_CEPRE'))) ? '' : ''; #EXAMEN FINAL DE CEPRE-UNI
        PDF::MultiCell(80, 5, $nota2, 1, 'C', true);

        PDF::SetXY(29, 82);
        PDF::SetTextColor(0);
        PDF::SetFont('helvetica', 'B', 15);
        $notaAula = ''; #LAS AULAS APARECERÁN EL VIERNES 11/08
        #    PDF::MultiCell(160,5,$notaAula,0,0,'C',true);

        PDF::SetXY(166 + 4 + 3, 86 + 20 + 70 - 15);
        PDF::SetTextColor(0);
        PDF::SetFont('helvetica', 'B', 13);
        PDF::Cell(34, 5, 'Talla :' . $postulante->talla . ' m', 0, 0, 'C');


        PDF::SetXY(166 + 4 + 3, 90 + 20 + 70 - 15);
        PDF::SetTextColor(0);
        PDF::SetFont('helvetica', 'B', 13);
        PDF::Cell(34, 5, 'Peso :' . $postulante->peso . ' kg', 0, 0, 'C');

        PDF::SetXY(10, 87);
        PDF::SetTextColor(0, 0, 0);
        PDF::SetFont('helvetica', 'B', 15);
        #PDF::Cell(110,5,'Presenta esta ficha el día de Examen junto con tu DNI.',0,0,'L');
        PDF::SetTextColor(0);

        PDF::SetXY(130, 98.6 - 20);
        PDF::SetFont('helvetica', '', 20);
        #  PDF::Cell(60,5,'N° Ins :',0,0,'L');


        #FICHA DE INSCRIPCION
        PDF::SetXY(45, 27 - 8);
        PDF::SetTextColor(255);
        PDF::SetFont('helvetica', 'B', 22);
        PDF::Cell(50, 5, 'FICHA DE INSCRIPCIÓN', 0, 0, 'L');

        #NUMERO DE INSCRIPCION

        #

        PDF::SetXY(45, 50 + 12 + 3 - 8);
        PDF::SetTextColor(255);
        PDF::SetFont('helvetica', '', 12);
        PDF::Cell(50, 5, 'N° DE INSCRIPCIÓN', 0, 0, 'L');


        PDF::SetXY(45, 50 + 16 + 3 - 8);
        PDF::SetFont('helvetica', 'B', 20);
        PDF::Cell(110, 5, $postulante->codigo, 0, 0, 'L');

        #CODIGO ENCIMA DE LA FOTO


        #NOMBRES Y APELLIDOS
        PDF::SetTextColor(255);
        PDF::SetXY(45, 20 + 18 - 8);
        PDF::SetFont('helvetica', 'B', 13);
        PDF::Cell(30, 5, 'Apellidos y Nombres:', 0, 0, 'L');
        PDF::SetXY(45, 20 + 24 - 8);
        PDF::SetFont('helvetica', 'B', 13);
        # PDF::Cell(90,5,'',1,0,'L');

        PDF::SetXY(45, 20 + 24 - 8);
        PDF::SetFont('helvetica', 'B', 16);
        PDF::SetFillColor(255, 235, 235);
        PDF::MultiCell(90, 5, $postulante->nombre_completo, 1, 'L', 1, 2, '', '', true);

        PDF::SetTextColor(0, 0, 0);
        PDF::SetXY(5, 100 + 16 - 20 + 10 + 3 - 17 - 8);
        PDF::SetFont('helvetica', 'B', 17);


        #MODALIDAD

        PDF::SetXY(5, 100 + 16 - 20 + 10 + 3 + 6);
        PDF::SetFont('helvetica', 'B', 13);
        PDF::Cell(60, 5, 'Modalidad :', 0, 0, 'L');
        PDF::SetXY(31, 100 + 16 - 20 + 10 + 3 + 6);
        PDF::SetFont('helvetica', '', 13);
        PDF::Cell(150, 5, $postulante->nombre_modalidad, 0, 0, 'L');
        //    PDF::SetXY(65,105+17-20+10+3);
        //    PDF::SetFont('helvetica','B',10);
        if ($postulante->nombre_especialidad == "---") {


        }
        PDF::SetFont('helvetica', 'B', 10);
        if ($postulante->nombre_especialidad2 == "---" && $postulante->nombre_especialidad != "---") {
            PDF::SetXY(5, 105 + 17 - 20 + 10 + 3 + 6);
            PDF::Cell(120, 5, 'ESPECIALIDAD: ');
            PDF::SetFont('helvetica', '', 10);
            PDF::SetXY(34, 105 + 17 - 20 + 10 + 3 + 6);
            PDF::Cell(120, 5, $postulante->nombre_especialidad, 0, 0, 'L');
        }
        if ($postulante->nombre_especialidad3 == "---" && $postulante->nombre_especialidad2 != "---") {
            PDF::SetXY(5, 105 + 16 - 20 + 10 + 3 + 6);
            PDF::Cell(130, 5, 'PRIMERA PRIORIDAD: ', 0, 0, 'L');
            PDF::SetFont('helvetica', '', 10);
            PDF::SetXY(45, 105 + 16 - 20 + 10 + 3 + 6);
            PDF::Cell(130, 5, $postulante->nombre_especialidad, 0, 0, 'L');

            PDF::SetFont('helvetica', 'B', 10);
            PDF::SetXY(5, 105 + 21 - 20 + 10 + 3 + 6);
            PDF::Cell(130, 5, 'SEGUNDA PRIORIDAD: ', 0, 0, 'L');
            PDF::SetXY(45, 105 + 21 - 20 + 10 + 3 + 6);
            PDF::SetFont('helvetica', '', 10);
            PDF::Cell(130, 5, $postulante->nombre_especialidad2, 0, 0, 'L');

        }

        if ($postulante->nombre_especialidad != "---" && $postulante->nombre_especialidad2 != "---" && $postulante->nombre_especialidad3 != "---") {
            PDF::SetXY(5, 105 + 16 - 20 + 10 + 3 + 6);
            PDF::Cell(130, 5, 'PRIMERA PRIORIDAD: ', 0, 0, 'L');
            PDF::SetFont('helvetica', '', 10);
            PDF::SetXY(45, 105 + 16 - 20 + 10 + 3 + 6);
            PDF::Cell(130, 5, $postulante->nombre_especialidad, 0, 0, 'L');

            PDF::SetFont('helvetica', 'B', 10);
            PDF::SetXY(5, 105 + 21 - 20 + 10 + 3 + 6);
            PDF::Cell(130, 5, 'SEGUNDA PRIORIDAD: ', 0, 0, 'L');
            PDF::SetXY(45, 105 + 21 - 20 + 10 + 3 + 6);
            PDF::SetFont('helvetica', '', 10);
            PDF::Cell(130, 5, $postulante->nombre_especialidad2, 0, 0, 'L');

            /*
            PDF::SetFont('helvetica', 'B', 10);
            PDF::SetXY(5, 105 + 26 - 20 + 10 + 3 + 6);
            PDF::Cell(130, 5, 'TERCERA PRIORIDAD: ', 0, 0, 'L');
            PDF::SetFont('helvetica', '', 10);
            PDF::SetXY(45, 105 + 26 - 20 + 10 + 3 + 6);
            PDF::Cell(130, 5, $postulante->nombre_especialidad3, 0, 0, 'L');
            */


        }

        #PDF::Cell(110,5,,0,0,'L');
        if ($postulante->codigo_modalidad == 'ID-CEPRE') {
            #SEGUNDA MODALIDAD
            PDF::SetXY(5, 110 + 16 - 20 + 10 + 3 + 10 + 6);
            PDF::SetFont('helvetica', 'B', 13);
            PDF::Cell(60, 5, 'Modalidad 2 :', 0, 0, 'L');
            PDF::SetXY(34, 110 + 16 - 20 + 10 + 3 + 10 + 6);
            PDF::SetFont('helvetica', '', 13);
            PDF::Cell(110, 5, $postulante->nombre_modalidad2, 0, 0, 'L');


            if ($postulante->nombre_especialidad5 == "---" && $postulante->nombre_especialidad4 != "---") {
                PDF::SetFont('helvetica', 'B', 10);
                PDF::SetXY(5, 134 + 6);
                PDF::Cell(120, 5, 'ESPECIALIDAD: ', 0, 0, 'L');

                PDF::SetFont('helvetica', '', 10);
                PDF::SetXY(34, 134.3 + 6);
                PDF::Cell(120, 5, $postulante->nombre_especialidad4, 0, 0, 'L');


            }
            if ($postulante->nombre_especialidad6 == "---" && $postulante->nombre_especialidad5 != "---") {
                PDF::SetFont('helvetica', 'B', 10);
                PDF::SetXY(5, 134 + 6);

                PDF::Cell(130, 5, 'PRIMERA PRIORIDAD: ', 0, 0, 'L');
                PDF::SetFont('helvetica', '', 10);
                PDF::SetXY(45, 134 + 6);
                PDF::Cell(130, 5, $postulante->nombre_especialidad4, 0, 0, 'L');

                PDF::SetFont('helvetica', 'B', 10);
                PDF::SetXY(5, 134 + 5 + 6);
                PDF::Cell(130, 5, 'SEGUNDA PRIORIDAD: ', 0, 0, 'L');
                PDF::SetFont('helvetica', '', 10);
                PDF::SetXY(45, 134 + 5 + 6);
                PDF::Cell(130, 5, $postulante->nombre_especialidad5, 0, 0, 'L');

            }

            if ($postulante->nombre_especialidad4 != "---" && $postulante->nombre_especialidad5 != "---" && $postulante->nombre_especialidad6 != "---") {
                PDF::SetXY(5, 134 + 6);
                PDF::SetFont('helvetica', 'B', 10);
                PDF::Cell(130, 5, 'PRIMERA PRIORIDAD: ', 0, 0, 'L');
                PDF::SetFont('helvetica', '', 10);
                PDF::SetXY(45, 134 + 6);
                PDF::Cell(130, 5, $postulante->nombre_especialidad4, 0, 0, 'L');

                PDF::SetFont('helvetica', 'B', 10);
                PDF::SetXY(5, 134 + 5 + 6);
                PDF::Cell(130, 5, 'SEGUNDA PRIORIDAD: ', 0, 0, 'L');
                PDF::SetFont('helvetica', '', 10);
                PDF::SetXY(45, 134 + 5 + 6);
                PDF::Cell(130, 5, $postulante->nombre_especialidad5, 0, 0, 'L');
                /*
                PDF::SetFont('helvetica', 'B', 10);
                PDF::SetXY(5, 134 + 5 + 5 + 6);
                PDF::Cell(130, 5, 'TERCERA PRIORIDAD: ', 0, 0, 'L');

                PDF::SetFont('helvetica', '', 10);
                PDF::SetXY(45, 134 + 5 + 5 + 6);
                PDF::Cell(130, 5, $postulante->nombre_especialidad6, 0, 0, 'L');
                */
            }

        }
        #AULAS
        $arq = false;
        if (($postulante->codigo_especialidad == 'A1' || $postulante->codigo_especialidad2 == 'A1') && $postulante->codigo_modalidad != 'ID-CEPRE') {

            PDF::SetFillColor(119, 205, 238);
            PDF::SetXY(5, 91 + 6 - 5 - 8);
            PDF::SetFont('helvetica', 'B', 15);
            PDF::Cell(40, 7, 'SA 09/08  ', 0, 0, 'C', 1, '', 1);

            PDF::SetFont('helvetica', 'B', 25);

            PDF::SetXY(5, 97 + 6 - 5 - 8);
             PDF::Cell(40, 12, $postulante->datos_aula_voca->codigo . ' PUERTA N 4B', 0, 0, 'L', true, '', 1, true);
  #          PDF::Cell(40, 12, $postulante->datos_aula_dos->codigo . ' ' . $puerta2, 0, 0, 'L', true, '', 1, true);


            $arq = true;
        } else {
            if ($postulante->codigo_especialidad4 == 'A1' && $postulante->codigo_modalidad == 'ID-CEPRE') {
                PDF::SetFillColor(119, 205, 238);
                PDF::SetXY(5, 91 + 6 - 5 - 8);
                PDF::SetFont('helvetica', 'B', 15);
                PDF::Cell(40, 7, 'SA 09/08 ', 0, 0, 'C', 1, '', 1);
                PDF::SetFont('helvetica', 'B', 35);
                PDF::SetXY(5, 97 + 6 - 5 - 8);
                PDF::Cell(40, 12, $postulante->datos_aula_voca->codigo. ' PUERTA N�4B', 0, 0, 'L', true, '', 1, true);
                $arq = true;
            }


        }

        $varxx = 0;
        if ($arq) {
            $varxx = 50;
        } else {

        }
        $puerta1 = '';
        $puerta2 = '';
        $puerta3 = '';
        if ($postulante->datos_aula_uno->codigo == 'DIAD') {
            $puerta1 = 'PUERTA N°4-B';
        } elseif (str_contains($postulante->datos_aula_uno->codigo, ['A', 'C', 'D'])) {
            $puerta1 = 'PUERTA N°3';
        } elseif (str_contains($postulante->datos_aula_uno->codigo, ['G', 'H'])) {
            $puerta1 = 'PUERTA N°4';
        } elseif (str_contains($postulante->datos_aula_uno->codigo, ['I', 'Q', 'M','R1','J3'])) {
            $puerta1 = 'PUERTA N°5';
        } elseif (str_contains($postulante->datos_aula_uno->codigo, ['S', 'R5'])) {
            $puerta1 = 'PUERTA N°6';
        } elseif (str_contains($postulante->datos_aula_uno->codigo, ['T'])) {
            $puerta1 = 'PUERTA N°7';

        }
        if ($postulante->datos_aula_dos->codigo == 'DIAD') {
            $puerta2 = 'PUERTA N°4-B';
        } elseif (str_contains($postulante->datos_aula_dos->codigo, ['A', 'C', 'D'])) {
            $puerta2 = 'PUERTA N°3';
        } elseif (str_contains($postulante->datos_aula_dos->codigo, ['G', 'H'])) {
            $puerta2 = 'PUERTA N°4';
        } elseif (str_contains($postulante->datos_aula_dos->codigo, ['I', 'Q', 'M','R1','J3'])) {
            $puerta2 = 'PUERTA N°5';
        } elseif (str_contains($postulante->datos_aula_dos->codigo, ['S', 'R5'])) {
            $puerta2 = 'PUERTA N°6';
        } elseif (str_contains($postulante->datos_aula_dos->codigo, ['T'])) {
            $puerta2 = 'PUERTA N°7';
        } elseif (str_contains($postulante->datos_aula_dos->codigo, ['DIAD'])) {
            $puerta3 = 'PUERTA N°4-B';
        }
        if ($postulante->datos_aula_tres->codigo == 'DIAD') {
            $puerta3 = 'PUERTA N°4-B';
        } elseif (str_contains($postulante->datos_aula_tres->codigo, ['A', 'C', 'D'])) {
            $puerta3 = 'PUERTA N°3';
        } elseif (str_contains($postulante->datos_aula_tres->codigo, ['G', 'H'])) {
            $puerta3 = 'PUERTA N°4';
        } elseif (str_contains($postulante->datos_aula_tres->codigo, ['I', 'Q', 'M','R1','J3'])) {
            $puerta3 = 'PUERTA N°5';
        } elseif (str_contains($postulante->datos_aula_tres->codigo, ['S', 'R5'])) {
            $puerta3 = 'PUERTA N°6';
        } elseif (str_contains($postulante->datos_aula_tres->codigo, ['T'])) {
            $puerta3 = 'PUERTA N°7';

        }


        if (str_contains($postulante->codigo_modalidad, ['O', 'E1PDI', 'E1DPA', 'E1DCAN', 'E1VTI', 'E1CABI', 'E1DB', 'ID-CEPRE'])) {
            #  PDF::SetTextColor(0);
            PDF::SetFillColor(143, 238, 87);

            PDF::SetFont('helvetica', 'B', 15);
            PDF::SetXY(5 + $varxx, 91 + 6 - 8 - 5);

            PDF::Cell(40, 7, 'MI 13/08 ', 0, 0, 'C', true);
            PDF::SetXY(5 + $varxx, 97 + 6 - 8 - 5);
            PDF::SetFont('helvetica', 'B', 25);

            PDF::Cell(40, 12, $postulante->datos_aula_uno->codigo . ' ' . $puerta1, 0, 0, 'L', true, '', 1, true);
            #DIA 2

            PDF::SetFillColor(243, 218, 114);
            PDF::SetFont('helvetica', 'B', 15);
            PDF::SetXY(55 + $varxx, 91 + 6 - 8 - 5);
            PDF::Cell(40, 7, 'VI 15/08 ', 0, 0, 'C', 1, '', 1);
            PDF::SetXY(55 + $varxx, 120 + 9 + 8 - 40 + 6 - 8 - 5);
            PDF::SetFont('helvetica', 'B', 25);
            PDF::Cell(40, 12, $postulante->datos_aula_dos->codigo . ' ' . $puerta2, 0, 0, 'L', true, '', 1, true);
            #DIA 3
            PDF::SetFillColor(247, 176, 203);
            PDF::SetXY(105 + $varxx, 88 + 3 + 6 - 8 - 5);
            PDF::SetFont('helvetica', 'B', 15);
            PDF::Cell(40, 7, 'DO 17/08 ', 0, 0, 'C', 1, '', 1);

            PDF::SetFont('helvetica', 'B', 25);
            PDF::SetXY(105 + $varxx, 94 + 3 + 6 - 8 - 5);
            PDF::Cell(40, 12, $postulante->datos_aula_tres->codigo . ' ' . $puerta3, 0, 0, 'L', true, '', 1, true);

        } else {
            PDF::SetFillColor(243, 218, 114);
            PDF::SetFont('helvetica', 'B', 15);
            PDF::SetXY(5 + $varxx, 91 + 6 - 8 - 5);
            PDF::Cell(40, 7, 'MI 13/08 ', 0, 0, 'C', 1, '', 1);
            PDF::SetXY(5 + $varxx, 97 + 6 - 8 - 5);
            PDF::SetFont('helvetica', 'B', 25);
            PDF::Cell(40, 12, $postulante->datos_aula_dos->codigo . ' ' . $puerta2, 0, 0, 'L', true, '', 1, true);

        }
        #


        PDF::SetFont('helvetica', 'B', 12);
        #MENSAJE
        PDF::SetFillColor(255);
        PDF::SetFont('helvetica', 'B', 13);
        PDF::SetTextColor(68, 98, 168);
        PDF::SetXY(18, 89.5 - 8 - 8);

        $puerta = '';

        if (str_contains($postulante->datos_aula_uno->codigo, 'C')) {
            $puerta = 'PUERTA N°3';
        }

        if (str_contains($postulante->datos_aula_uno->codigo, 'D')) {
            $puerta = 'PUERTA N°3';
        }
        if (str_contains($postulante->datos_aula_uno->codigo, 'A')) {
            $puerta = 'PUERTA N°3';
        }
        if (str_contains($postulante->datos_aula_uno->codigo, 'DIAD')) {
            $puerta = 'PUERTA N°4-B';
        }


        if (str_contains($postulante->datos_aula_uno->codigo, 'G')) {
            $puerta = 'PUERTA N°4A';
        }
        if (str_contains($postulante->datos_aula_uno->codigo, 'H')) {
            $puerta = 'PUERTA N°4A';
        }


        if (str_contains($postulante->datos_aula_uno->codigo, 'I')) {
            $puerta = 'PUERTA N°5';
        }
        if (str_contains($postulante->datos_aula_uno->codigo, 'Q')) {
            $puerta = 'PUERTA N°5';
        }

        if (str_contains($postulante->datos_aula_uno->codigo, 'S')) {
            $puerta = 'PUERTA N°6';
        }

        if (str_contains($postulante->datos_aula_uno->codigo, 'T')) {
            $puerta = 'PUERTA N°7';
        }


        if (str_contains($postulante->codigo_modalidad, ['E1CABC', 'E1TE', 'E1TG', 'E1PDC', 'E1VTC'])) {

            if ($facultad == 4 || $facultad == 5 || $facultad == 6 || $facultad == 7 || $facultad == 9) {
                $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES POR PUERTA N°3 DE 07H00 A 08H00';
            }
            if ($facultad == 1 || $facultad == 2 || $facultad == 3 || $facultad == 8 || $facultad == 10 || $facultad == 11) {
                $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES POR PUERTA N°3 DE 07H00 A 08H00';
            }


        } else {
            if ($facultad == 1 || $facultad == 7 || $facultad == 5) {
                $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES POR ' . $puerta . '  DE 07H00 A 08H00';
            }
            if ($facultad == 4 || $facultad == 9 || $facultad == 10 || $facultad == 3 || $facultad == 6 || $facultad == 8 || $facultad == 11 || $facultad == 2) {

                #    $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES POR '.$puerta.'  DE 14H00 A 15H00';
            }
        }

        $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES DE 07H00 A 08H30';

        PDF::SetFillColor(0, 0, 0, 12);
        PDF::Cell(180, 3, $texto, 0, 1, 'C', 1, '', 1);
        PDF::SetTextColor(0);
        #LUGAR DE NACIMIENTO
        PDF::SetXY(5, 150 + 6);
        PDF::SetFont('helvetica', 'B', 11);
        PDF::Cell(60, 5, 'Lugar de Nacimiento :', 0, 0, 'L');
        PDF::SetXY(65 - 17, 150 + 6);
        PDF::SetFont('helvetica', '', 10);
        PDF::Cell(110, 5, $postulante->descripcion_ubigeo_nacimiento, 0, 0, 'L');
        #FECHA DE NACIMIENTO
        PDF::SetXY(5, 155 + 6);
        PDF::SetFont('helvetica', 'B', 11);
        PDF::Cell(60, 5, 'Fecha de Nacimiento :', 0, 0, 'L');
        PDF::SetXY(65 - 17, 155 + 6);
        PDF::SetFont('helvetica', '', 10);
        PDF::Cell(110, 5, Carbon::parse($postulante->fecha_nacimiento)->format('d/m/Y'), 0, 0, 'L');


        #DIRECCIÓN
        PDF::SetXY(5, 165 - 4 + 6);
        PDF::SetFont('helvetica', 'B', 11);
        PDF::Cell(60, 5, 'Dirección :', 0, 0, 'L');
        PDF::SetXY(65 - 17, 165 - 4 + 6);
        PDF::SetFont('helvetica', '', 10);
        PDF::Cell(110, 5, $postulante->direccion, 0, 0, 'L');
        #
        PDF::SetXY(65 - 17, 170 - 4 + 6);
        PDF::SetFont('helvetica', '', 10);
        PDF::Cell(110, 5, $postulante->descripcion_ubigeo, 0, 0, 'L');
        #DOCUMENTO DE IDENTIDAD
        PDF::SetXY(5, 175 - 4 + 6);
        PDF::SetFont('helvetica', 'B', 11);
        PDF::Cell(60, 5, 'Teléfonos :', 0, 0, 'L');
        PDF::SetXY(65 - 17, 175 - 4 + 6);
        PDF::SetFont('helvetica', '', 10);
        PDF::Cell(110, 5, $postulante->telefonos, 0, 0, 'L');
        #EMAIL
        PDF::SetXY(5, 180 - 4 + 6);
        PDF::SetFont('helvetica', 'B', 11);
        PDF::Cell(60, 5, 'Email :', 0, 0, 'L');
        PDF::SetXY(65 - 17, 180 - 4 + 6);
        PDF::SetFont('helvetica', '', 10);
        PDF::Cell(110, 5, $postulante->email, 0, 0, 'L');
        #COLEGIO
        PDF::SetXY(5, 185 - 4 + 6);
        PDF::SetFont('helvetica', 'B', 11);
        PDF::Cell(60, 5, 'Institución Educativa :', 0, 0, 'L');
        PDF::SetXY(65 - 17, 185 - 4 + 7);
        PDF::SetFont('helvetica', '', 10);
        PDF::SetFillColor(255, 255, 127);
        #PDF::Cell(110,5,$postulante->institucion_educativa."-". $postulante->gestion_ie . "-"  .$postulante->institucion_educa->descripcion_ubigeo ,0,0,'L');

        PDF::MultiCell(125, 10, $postulante->institucion_educativa . "-" . $postulante->gestion_ie . "-" . $postulante->institucion_educa->descripcion_ubigeo, 0, 'L');


        $style = array('width' => 0.3, 'cap' => 'round', 'join' => 'miter', 'dash' => '0', 'phase' => 34, 'color' => array(181));
        PDF::Line(0, 192 + 5, 210, 192 + 5, $style);

        PDF::Rect(168, 200, 33, 45, 'D');
        PDF::SetXY(150 + 15, 245 + 1 + 5);
        PDF::SetFont('helvetica', 'B', 8);
        PDF::Cell(20, 5, 'HUELLA DEL POSTULANTE', 0, 0);


        PDF::SetXY(150 + 15, 245 + 9);
        PDF::SetFont('helvetica', 'B', 8);
        #PDF::Cell(20,5,'SE REGISTRARÁ EN EL AULA',0,0);


        #DECLARACION JURADA
        PDF::SetXY(18, 192 + 6);
        PDF::SetFont('helvetica', '', 20);
        PDF::Cell(170, 5, 'DECLARACIÓN JURADA', 0, 0, 'C');

        PDF::SetXY(5, 203 + 5);
        PDF::SetFont('helvetica', '', 10);
        $texto = "Declaro bajo juramento que toda la información registrada es auténtica, no estar impedido de postular, no ser alumno de la UNI y además que mi foto registrada en el sistema es actual. En caso de faltar a la verdad, acepto mi descalificación del presente Concurso de Admisión, y me someto a las sanciones reglamentarias y/o legales que correspondan. Asimismo, declaro no tener antecedentes policiales y autorizo a la Dirección de Admisión de la Universidad Nacional de Ingeniería, el uso de mis datos personales, que libremente proporciono, para los fines que involucran las actividades propias de la Dirección de Admisión y la publicación de mis calificaciones en los medios que la Universidad dispone para dar a conocer los resultados.";
        $text2 = "Declaro haber leído y conocer el Reglamento de Admisión para estudios de Antegrado y aceptar íntegramente su contenido.";
        PDF::MultiCell(155, 5, $texto, 1, 'J', false);
        PDF::SetXY(5, 203 + 5 + 36);
        PDF::MultiCell(155, 5, $text2, 1, 'L', false);
        #
        #
        $persona = 'Apoderado';
        PDF::SetXY(18, 272);
        PDF::SetFont('helvetica', '', 10);
        PDF::Cell(70, 5, 'Firma del  ' . $persona, 'T', 0, 'C');
        #
        PDF::SetXY(18, 277);
        PDF::SetFont('helvetica', '', 10);
        PDF::Cell(70, 5, 'DNI del ' . $persona . ':', 'B', 0, 'L');


        $persona = 'Postulante';
        PDF::SetXY(18 + 90 - 10, 272);
        PDF::SetFont('helvetica', '', 10);
        PDF::Cell(70, 5, 'Firma del  ' . $persona, 'T', 0, 'C');
        #
        PDF::SetXY(18 + 90 - 10, 277);
        PDF::SetFont('helvetica', '', 10);
        PDF::Cell(70, 5, 'DNI del ' . $persona . ':', 'B', 0, 'L');


        PDF::SetXY(5, 287 - 4);
        PDF::SetFont('helvetica', '', 8);
        $ahoraes = Carbon::now() . '';
        $piedepagina = 'Hora de Impresión: ' . $ahoraes;
        PDF::Cell(10, 5, $piedepagina, 0, 'L');
        $style = array(

            'vpadding' => 'auto',
            'hpadding' => 'auto',

        );
        $msjbarcode = $postulante->numero_identificacion . '|' . $postulante->nombre_especialidad . '|' . $postulante->datos_colegio->descripcion_ubigeo . '|' . $ahoraes;
        PDF::write2DBarcode($msjbarcode, 'QRCODE,H', 185 - 13, 278 - 15, 25, 25, array(), 'N');


        #FOTO
        if ($postulante->mostrar_foto_editada == null) {#32
        } else {
            PDF::Image($postulante->mostrar_foto_editada, 9.4 - 2, 52.8 - 24 - 10.5, 32.2 + 3.5, 43.9 + 5 + 1.6);
        }

        #Mapa
        PDF::AddPage('U', 'A4');
    PDF::Image(storage_path('app/documentos/mapa.jpg'), 0, 0, 210,297);
      #  PDF::StartTransform();
      #  PDF::Rotate(90, 140, 135);
      #  PDF::Image(asset('assets/pages/img/mapa-uni.jpg'), 0, 0, 270);
      #  PDF::StopTransform();


        #    PDF::AddPage('U','A4');
        #    PDF::Image(asset('assets/pages/img/anuncio.jpg'),5,5,200);
        #COMUNICADO
        /*PDF::AddPage('U','A4');
        PDF::StartTransform();
        PDF::Rotate(0.3,100,135);
        PDF::Image(asset('assets/pages/img/aviso.jpg'),-10,0,235);
        PDF::StopTransform();*/


        #EXPORTO
        PDF::Output(public_path('storage/tmp/') . 'Ficha_2025_2_' . $postulante->numero_identificacion . '.pdf', 'FI');




    }
        // END FIN

    }

    /*
    public function pdfMasivo($id = null)
    {
        if (isset($id)) {
           $postulante = Postulante::find($id);
        } else {
           $postulante = Postulante::Usuario()->first();
        }

        $evaluacion = Evaluacion::Activo()->first();
        #if(isset($postulante) && $postulante->foto_estado=='ACEPTADO'){


            PDF::SetTitle('FICHA DE INSCRIPCION');
            PDF::AddPage('U','A4');
            PDF::SetAutoPageBreak(false);
            PDF::Rect(15,15, 180,170);
            #FONDO
            //

        if($postulante->idmodalidad == 16) {
            $facultad = $postulante->idfacultad2;
        }else {
            $facultad = $postulante->idfacultad;
        }

        if (str_contains($postulante->codigo_modalidad,['E1CABC','E1TE','E1TG','E1PDC','E1VTC'])) {


            PDF::Image(asset('assets/pages/img/ficha-23-2.jpg'),0,0+9,210,297,'', '', '', false, 300, '', false, false, 0);


        }else {
            PDF::Image(asset('assets/pages/img/ficha-23-2.jpg'),0,0+9,210,297,'', '', '', false, 300, '', false, false, 0);
        }





            #CCOLOR DEL TEXTO

            
            #TITULO
            #PDF::SetXY(10,73);
            # PDF::SetFont('helvetica','B',19);
            #PDF::Cell(60,5,$evaluacion->codigo,0,0,'C');


            PDF::SetXY(95,50+12);
            PDF::SetTextColor(250);
            PDF::SetFont('helvetica','',12);
            PDF::Cell(60,5,'DNI:' ,0,0);

            PDF::SetXY(95,50+16);
            PDF::SetFont('helvetica','B',20);
            PDF::Cell(60,5,$postulante->numero_identificacion ,0,0);
            PDF::SetXY(60,35);
            PDF::SetFont('helvetica','B',13);
            $nota = ($postulante->idmodalidad == 16 && $postulante->pago = 'FALSE' && (date('Y-m-d')<= env('FINAL_CEPRE')) ) ? '' : '' ; #PROVISIONAL
            PDF::MultiCell(80,5,$nota,1,'C',true);

            PDF::SetXY(60,40);
            $nota2 = ($postulante->idmodalidad == 16 && $postulante->pago = 'FALSE' && (date('Y-m-d')<= env('FINAL_CEPRE'))) ? '' : '' ; #EXAMEN FINAL DE CEPRE-UNI
            PDF::MultiCell(80,5,$nota2,1,'C',true);

            PDF::SetXY(29,82);
            PDF::SetTextColor(0);
            PDF::SetFont('helvetica','B',15);
            $notaAula = 'LAS AULAS APARECERÁN EL VIERNES 11/08 A PARTIR DE LAS 14H00'; #LAS AULAS APARECERÁN EL VIERNES 11/08
            #PDF::MultiCell(160,5,$notaAula,0,0,'C',true);

            PDF::SetXY(166+4+3,86+20+70-15);
            PDF::SetTextColor(0);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(34,5,'Talla :'.$postulante->talla.' m' ,0,0,'C');


            PDF::SetXY(166+4+3,90 +20+70-15);
            PDF::SetTextColor(0);
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


            #FICHA DE INSCRIPCION
            PDF::SetXY(55,27);
            PDF::SetTextColor(250);
            PDF::SetFont('helvetica','B',22);
            PDF::Cell(50,5,'FICHA DE INSCRIPCIÓN',0,0,'L');

            #NUMERO DE INSCRIPCION

            #
            PDF::SetXY(45,50+12);
            PDF::SetTextColor(250);
            PDF::SetFont('helvetica','',12);
            PDF::Cell(50,5,'N° DE INSCRIPCIÓN',0,0,'L');


            PDF::SetXY(45,50+16);
            PDF::SetFont('helvetica','B',20);
            PDF::Cell(110,5,$postulante->codigo,0,0,'L');

            #CODIGO ENCIMA DE LA FOTO



            #NOMBRES Y APELLIDOS
            PDF::SetTextColor(250);
            PDF::SetXY(45,20+18);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(30,5,'Apellidos y Nombres:',0,0,'L');
            PDF::SetXY(45,20+24);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(30,5,'',0,0,'L');

            PDF::SetXY(45,20+24);
            PDF::SetFont('helvetica','B',16);

            PDF::MultiCell(112,5,$postulante->nombre_completo,1,'L',true);
            
            PDF::SetTextColor(0,0,0);
            PDF::SetXY(5,100+16-20+10+3-17);
            PDF::SetFont('helvetica','B',17);






            #MODALIDAD
            
            PDF::SetXY(5,100+16-20+10+3+6);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(60,5,'Modalidad :',0,0,'L');
            PDF::SetXY(31,100+16-20+10+3+6);
            PDF::SetFont('helvetica','',13);
            PDF::Cell(150,5,$postulante->nombre_modalidad,0,0,'L');
        //    PDF::SetXY(65,105+17-20+10+3);
        //    PDF::SetFont('helvetica','B',10);
            if ( $postulante->nombre_especialidad == "---"){


            }
            PDF::SetFont('helvetica','B',10);
            if( $postulante->nombre_especialidad2 == "---" && $postulante->nombre_especialidad != "---") {
                PDF::SetXY(5,105+17-20+10+3+6);
                PDF::Cell(120,5,'ESPECIALIDAD: ');
                PDF::SetFont('helvetica','',10);
                PDF::SetXY(34,105+17-20+10+3+6);
                PDF::Cell(120,5,$postulante->nombre_especialidad,0,0,'L');
            }
            if( $postulante->nombre_especialidad3 == "---" && $postulante->nombre_especialidad2 != "---") {
                PDF::SetXY(5,105+16-20+10+3+6);
                PDF::Cell(130,5,'PRIMERA PRIORIDAD: ',0 ,0,'L');
                PDF::SetFont('helvetica','',10);
                PDF::SetXY(45,105+16-20+10+3+6);
                PDF::Cell(130,5,$postulante->nombre_especialidad,0,0,'L');

                PDF::SetFont('helvetica','B',10);
                PDF::SetXY(5,105+21-20+10+3+6);
                PDF::Cell(130,5,'SEGUNDA PRIORIDAD: ',0,0,'L');
                PDF::SetXY(45,105+21-20+10+3+6);
                PDF::SetFont('helvetica','',10);
                PDF::Cell(130,5,$postulante->nombre_especialidad2,0,0,'L');

            }

            if( $postulante->nombre_especialidad != "---" && $postulante->nombre_especialidad2 != "---" && $postulante->nombre_especialidad3 != "---" ){
                PDF::SetXY(5,105+16-20+10+3+6);
                PDF::Cell(130,5,'PRIMERA PRIORIDAD: ',0 ,0,'L');
                PDF::SetFont('helvetica','',10);
                PDF::SetXY(45,105+16-20+10+3+6);
                PDF::Cell(130,5,$postulante->nombre_especialidad,0,0,'L');

                PDF::SetFont('helvetica','B',10);
                PDF::SetXY(5,105+21-20+10+3+6);
                PDF::Cell(130,5,'SEGUNDA PRIORIDAD: ',0,0,'L');
                PDF::SetXY(45,105+21-20+10+3+6);
                PDF::SetFont('helvetica','',10);
                PDF::Cell(130,5,$postulante->nombre_especialidad2,0,0,'L');

                PDF::SetFont('helvetica','B',10);
                PDF::SetXY(5,105+26-20+10+3+6);
                PDF::Cell(130,5,'TERCERA PRIORIDAD: ',0,0,'L');
                PDF::SetFont('helvetica','',10);
                PDF::SetXY(45,105+26-20+10+3+6);
                PDF::Cell(130,5,$postulante->nombre_especialidad3,0,0,'L');
            }

            #PDF::Cell(110,5,,0,0,'L');
            if ($postulante->codigo_modalidad == 'ID-CEPRE') {
                #SEGUNDA MODALIDAD
                PDF::SetXY(5,110+16-20+10+3+10+6);
                PDF::SetFont('helvetica','B',13);
                PDF::Cell(60,5,'Modalidad 2 :',0,0,'L');
                PDF::SetXY(34,110+16-20+10+3+10+6);
                PDF::SetFont('helvetica','',13);
                PDF::Cell(110,5,$postulante->nombre_modalidad2,0,0,'L');



                if( $postulante->nombre_especialidad5 == "---" && $postulante->nombre_especialidad4 != "---") {
                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+6);
                    PDF::Cell(120,5,'ESPECIALIDAD: ',0,0,'L');

                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(34,134.3+6);
                    PDF::Cell(120,5,$postulante->nombre_especialidad4,0,0,'L');


                }
                if( $postulante->nombre_especialidad6 == "---" && $postulante->nombre_especialidad5 != "---") {
                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+6);

                    PDF::Cell(130,5,'PRIMERA PRIORIDAD: ',0,0,'L');
                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+6);
                    PDF::Cell(130,5,$postulante->nombre_especialidad4,0,0,'L');

                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+5+6);
                    PDF::Cell(130,5,'SEGUNDA PRIORIDAD: ',0,0,'L');
                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+5+6);
                    PDF::Cell(130,5,$postulante->nombre_especialidad5,0,0,'L');

                }

                if( $postulante->nombre_especialidad4 != "---" && $postulante->nombre_especialidad5 != "---" && $postulante->nombre_especialidad6 != "---" ){
                    PDF::SetXY(5,134+6);
                    PDF::SetFont('helvetica','B',10);
                    PDF::Cell(130,5,'PRIMERA PRIORIDAD: ',0,0,'L');
                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+6);
                    PDF::Cell(130,5,$postulante->nombre_especialidad4,0,0,'L');

                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+5+6);
                    PDF::Cell(130,5,'SEGUNDA PRIORIDAD: ',0,0,'L');
                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+5+6);
                    PDF::Cell(130,5,$postulante->nombre_especialidad5,0,0,'L');

                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+5+5+6);
                    PDF::Cell(130,5,'TERCERA PRIORIDAD: ',0,0,'L');

                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+5+5+6);
                    PDF::Cell(130,5,$postulante->nombre_especialidad6,0,0,'L');
                }

            }
            #AULAS
         $arq =false;
         if(($postulante->codigo_especialidad=='A1' || $postulante->codigo_especialidad4=='A1') && $postulante->codigo_modalidad != 'ID-CEPRE'){
            
             PDF::SetFillColor(119,205,238);
             PDF::SetXY(5,91+6);
             PDF::SetFont('helvetica','B',15);
             PDF::Cell(40,7,'SA 12/08  ',0,0,'C',1,'',1);

             PDF::SetFont('helvetica','B',35);
             PDF::SetXY(5,97+6);
             PDF::Cell(40,12,$postulante->datos_aula_voca->codigo.'',0,0,'L',true,'',1,true);

             $arq = true;
         }else{
            //FECHA VOCACIONAL CEPRE INTENSIVO
            $validacion = Validacion::where('codigo',$postulante->codigo_verificacion)->first();
             if($postulante->codigo_especialidad=='A1' && $validacion->intensivo==TRUE){
                 PDF::SetFillColor(119,205,238);
                 PDF::SetXY(5,91+6);
                 PDF::SetFont('helvetica','B',15);
                 PDF::Cell(40,7,'SA 12/08 ',0,0,'C',1,'',1);
                 PDF::SetFont('helvetica','B',35);
                 PDF::SetXY(5,97+6);
                 PDF::Cell(40,12,$postulante->datos_aula_voca->codigo,0,0,'L',true,'',1,true);
                 $arq = true;
             }
             else {
                if ($postulante->codigo_especialidad=='A1' && $validacion->intensivo==FALSE) {
                 PDF::SetFillColor(119,205,238);
                 PDF::SetXY(5,91+6);
                 PDF::SetFont('helvetica','B',15);
                 PDF::Cell(40,7,'SA 12/08 ',0,0,'C',1,'',1);
                 PDF::SetFont('helvetica','B',35);
                 PDF::SetXY(5,97+6);
                 PDF::Cell(40,12,$postulante->datos_aula_voca->codigo,0,0,'L',true,'',1,true);
                 $arq = true;
                }
                else {
                    if ($postulante->codigo_especialidad4=='A1' && $postulante->codigo_modalidad == 'ID-CEPRE') {
                     PDF::SetFillColor(119,205,238);
                     PDF::SetXY(5,91+6);
                     PDF::SetFont('helvetica','B',15);
                     PDF::Cell(40,7,'SA 12/08 ',0,0,'C',1,'',1);
                     PDF::SetFont('helvetica','B',35);
                     PDF::SetXY(5,97+6);
                     PDF::Cell(40,12,$postulante->datos_aula_voca->codigo,0,0,'L',true,'',1,true);
                     $arq = true;
                    }
                     
                 }
             }
         }

         $varxx = 0;
         if($arq){
             $varxx= 50;
         }else{

         }
         $puerta1='';$puerta2='';$puerta3='';
        if($postulante->datos_aula_uno->codigo=='DIAD'){
            $puerta1 = 'PUERTA N°4-B';
        }elseif (str_contains($postulante->datos_aula_uno->codigo, ['A','C','D'])) {
            $puerta1 = 'PUERTA N°3';
        }elseif (str_contains($postulante->datos_aula_uno->codigo, ['G','H'])) {
            $puerta1 = 'PUERTA N°4';
         }elseif (str_contains($postulante->datos_aula_uno->codigo, ['I','Q','M'])) {
            $puerta1 = 'PUERTA N°5';
         }elseif (str_contains($postulante->datos_aula_uno->codigo, ['S'])) {
            $puerta1 = 'PUERTA N°6';
         }elseif (str_contains($postulante->datos_aula_uno->codigo, ['T'])) {
            $puerta1 = 'PUERTA N°7';
       
         }
         if($postulante->datos_aula_dos->codigo=='DIAD'){
            $puerta2 = 'PUERTA N°4-B';
        }elseif (str_contains($postulante->datos_aula_dos->codigo, ['A','C','D'])) {
            $puerta2 = 'PUERTA N°3';
        }elseif (str_contains($postulante->datos_aula_dos->codigo, ['G','H'])) {
            $puerta2 = 'PUERTA N°4';
         }elseif (str_contains($postulante->datos_aula_dos->codigo, ['I','Q','M'])) {
            $puerta2 = 'PUERTA N°5';
         }elseif (str_contains($postulante->datos_aula_dos->codigo, ['S'])) {
            $puerta2 = 'PUERTA N°6';
         }elseif (str_contains($postulante->datos_aula_dos->codigo, ['T'])) {
            $puerta2 = 'PUERTA N°7';
         }elseif (str_contains($postulante->datos_aula_dos->codigo, ['DIAD'])) {
            $puerta3 = 'PUERTA N°4-B';
         }
         if($postulante->datos_aula_tres->codigo=='DIAD'){
            $puerta3 = 'PUERTA N°4-B';
        }elseif (str_contains($postulante->datos_aula_tres->codigo, ['A','C','D'])) {
            $puerta3 = 'PUERTA N°3';
        }elseif (str_contains($postulante->datos_aula_tres->codigo, ['G','H'])) {
            $puerta3 = 'PUERTA N°4';
         }elseif (str_contains($postulante->datos_aula_tres->codigo, ['I','Q','M'])) {
            $puerta3 = 'PUERTA N°5';
         }elseif (str_contains($postulante->datos_aula_tres->codigo, ['S'])) {
            $puerta3 = 'PUERTA N°6';
         }elseif (str_contains($postulante->datos_aula_tres->codigo, ['T'])) {
            $puerta3 = 'PUERTA N°7';
         
         }


        if (str_contains($postulante->codigo_modalidad,['O', 'E1PDI', 'E1DPA', 'E1DCAN', 'E1VTI', 'E1CABI', 'E1DB', 'ID-CEPRE'])) {
            #  PDF::SetTextColor(0);
            PDF::SetFillColor(143, 238, 87);

            PDF::SetFont('helvetica', 'B', 15);
            PDF::SetXY(5 + $varxx, 91 + 6);

            PDF::Cell(40, 7, 'LU 14/08 ', 0, 0, 'C', true);
            PDF::SetXY(5 + $varxx, 97 + 6);
            PDF::SetFont('helvetica', 'B', 25);

            PDF::Cell(40, 12, $postulante->datos_aula_uno->codigo . ' ' . $puerta1, 0, 0, 'L', true, '', 1, true);
            #DIA 2

            PDF::SetFillColor(243, 218, 114);
            PDF::SetFont('helvetica', 'B', 15);
            PDF::SetXY(55 + $varxx, 91 + 6);
            PDF::Cell(40, 7, 'MI 16/08 ', 0, 0, 'C', 1, '', 1);
            PDF::SetXY(55 + $varxx, 120 + 9 + 8 - 40 + 6);
            PDF::SetFont('helvetica', 'B', 25);
            PDF::Cell(40, 12, $postulante->datos_aula_dos->codigo . ' ' . $puerta2, 0, 0, 'L', true, '', 1, true);
            #DIA 3
            PDF::SetFillColor(247, 176, 203);
            PDF::SetXY(105 + $varxx, 88 + 3 + 6);
            PDF::SetFont('helvetica', 'B', 15);
            PDF::Cell(40, 7, 'VI 18/08 ', 0, 0, 'C', 1, '', 1);

            PDF::SetFont('helvetica', 'B', 25);
            PDF::SetXY(105 + $varxx, 94 + 3 + 6);
            PDF::Cell(40, 12, $postulante->datos_aula_tres->codigo . ' ' . $puerta3, 0, 0, 'L', true, '', 1, true);

        }else {
            PDF::SetFillColor(243, 218, 114);
            PDF::SetFont('helvetica', 'B', 15);
            PDF::SetXY(55 + $varxx, 91 + 6);
            PDF::Cell(40, 7, 'MI 16/08 ', 0, 0, 'C', 1, '', 1);
            PDF::SetXY(55 + $varxx, 120 + 9 + 8 - 40 + 6);
            PDF::SetFont('helvetica', 'B', 25);
            PDF::Cell(40, 12, $postulante->datos_aula_dos->codigo . ' ' . $puerta2, 0, 0, 'L', true, '', 1, true);

        }
            #


            PDF::SetFont('helvetica','B',12);
            #MENSAJE
            PDF::SetFillColor(255);
            PDF::SetFont('helvetica','B',13);
            PDF::SetTextColor(68,98,168);
            PDF::SetXY(18,89.5);

            $puerta = '';

         if( str_contains($postulante->datos_aula_uno->codigo, 'C') ) {
             $puerta = 'PUERTA N°3';
         }

         if( str_contains($postulante->datos_aula_uno->codigo, 'D') ) {
             $puerta = 'PUERTA N°3';
         }
         if( str_contains($postulante->datos_aula_uno->codigo, 'A') ) {
             $puerta = 'PUERTA N°3';
         }
         if( str_contains($postulante->datos_aula_uno->codigo, 'DIAD') ) {
            $puerta = 'PUERTA N°4-B';
        }


         if( str_contains($postulante->datos_aula_uno->codigo, 'G') ) {
             $puerta = 'PUERTA N°4A';
         }
         if( str_contains($postulante->datos_aula_uno->codigo, 'H') ) {
             $puerta = 'PUERTA N°4A';
         }



         if( str_contains($postulante->datos_aula_uno->codigo, 'I') ) {
             $puerta = 'PUERTA N°5';
         }
         if( str_contains($postulante->datos_aula_uno->codigo, 'Q') ) {
             $puerta = 'PUERTA N°5';
         }

         if( str_contains($postulante->datos_aula_uno->codigo, 'S') ) {
             $puerta = 'PUERTA N°6';
         }

         if( str_contains($postulante->datos_aula_uno->codigo, 'T') ) {
             $puerta = 'PUERTA N°7';
         }


         if (str_contains($postulante->codigo_modalidad,['E1CABC','E1TE','E1TG','E1PDC','E1VTC'])) {

             if($facultad== 4 || $facultad== 5 || $facultad== 6 || $facultad== 7 || $facultad== 9){
                 $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES POR PUERTA N°3 DE 07H00 A 08H00';
             }
             if($facultad== 1 || $facultad== 2 || $facultad== 3 || $facultad== 8 || $facultad== 10 || $facultad== 11 ){
                 $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES POR PUERTA N°3 DE 07H00 A 08H00';
             }


         }else {
             if(  $facultad == 1 || $facultad == 7 || $facultad == 5){
                 $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES POR '.$puerta.'  DE 07H00 A 08H00';
             }
             if( $facultad == 4 || $facultad == 9 || $facultad == 10 || $facultad == 3 || $facultad== 6 || $facultad == 8 || $facultad == 11 || $facultad == 2){

                 $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES POR '.$puerta.'  DE 14H00 A 15H00';
             }
         }

             $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES DE 07H00 A 08H30';
             
            PDF::SetFillColor(0, 0, 0, 12);
            PDF::Cell(180,3,$texto,0,1,'C',1,'',1);
            PDF::SetTextColor(0);
            #LUGAR DE NACIMIENTO
            PDF::SetXY(5,150+6);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Lugar de Nacimiento :',0,0,'L');
            PDF::SetXY(65-17,150+6);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->descripcion_ubigeo_nacimiento,0,0,'L');
            #FECHA DE NACIMIENTO
            PDF::SetXY(5,155+6);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Fecha de Nacimiento :',0,0,'L');
            PDF::SetXY(65-17,155+6);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5, Carbon::parse($postulante->fecha_nacimiento)->format('d/m/Y'),0,0,'L');



            #DIRECCIÓN
            PDF::SetXY(5,165-4+6);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Dirección :',0,0,'L');
            PDF::SetXY(65-17,165-4+6);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->direccion,0,0,'L');
            #
            PDF::SetXY(65-17,170-4+6);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->descripcion_ubigeo,0,0,'L');
            #DOCUMENTO DE IDENTIDAD
            PDF::SetXY(5,175-4+6);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Teléfonos :',0,0,'L');
            PDF::SetXY(65-17,175-4+6);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->telefonos,0,0,'L');
            #EMAIL
            PDF::SetXY(5,180-4+6);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Email :',0,0,'L');
            PDF::SetXY(65-17,180-4+6);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->email,0,0,'L');
            #COLEGIO
            PDF::SetXY(5,185-4+6);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Institución Educativa :',0,0,'L');
            PDF::SetXY(65-17,185-4+7);
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
            #PDF::Cell(20,5,'SE REGISTRARÁ EN EL AULA',0,0);


            #DECLARACION JURADA
            PDF::SetXY(18,192+6);
            PDF::SetFont('helvetica','',20);
            PDF::Cell(170,5,'DECLARACIÓN JURADA',0,0,'C');

            PDF::SetXY(5,203+5);
            PDF::SetFont('helvetica','',10);
            $texto = "Declaro bajo juramento que toda la información registrada es auténtica, no estar impedido de postular, no ser alumno de la UNI y además que mi foto registrada en el sistema es actual. En caso de faltar a la verdad, acepto mi descalificación del presente Concurso de Admisión, y me someto a las sanciones reglamentarias y/o legales que correspondan. Asimismo, declaro no tener antecedentes policiales y autorizo a la Dirección de Admisión de la Universidad Nacional de Ingeniería, el uso de mis datos personales, que libremente proporciono, para los fines que involucran las actividades propias de la Dirección de Admisión y la publicación de mis calificaciones en los medios que la Universidad dispone para dar a conocer los resultados.";
            $text2= "Declaro haber leído y conocer el Reglamento de Admisión para estudios de Antegrado y aceptar íntegramente su contenido.";
            PDF::MultiCell(155,5,$texto,1,'J',false);
            PDF::SetXY(5,203+5+36);
            PDF::MultiCell(155,5,$text2,1,'L',false);
            #
            #
            $persona='Apoderado';
            PDF::SetXY(18,272);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(70,5,'Firma del  '.$persona,'T',0,'C');
            #
            PDF::SetXY(18,277);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(70,5,'DNI del '.$persona.':','B',0,'L');



            $persona='Postulante';
            PDF::SetXY(18+90-10,272);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(70,5,'Firma del  '.$persona,'T',0,'C');
            #
            PDF::SetXY(18+90-10,277);
            PDF::SetFont('helvetica','',10);
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
            PDF::AddPage('U','A4');
            PDF::StartTransform();
            PDF::Rotate(90,140,135);
            PDF::Image(asset('assets/pages/img/mapa-uni.jpg'),0,0,270);
            PDF::StopTransform();




        #    PDF::AddPage('U','A4');
        #    PDF::Image(asset('assets/pages/img/anuncio.jpg'),5,5,200);
			#COMUNICADO
			/*PDF::AddPage('U','A4');
			PDF::StartTransform();
            PDF::Rotate(0.3,100,135);
			PDF::Image(asset('assets/pages/img/aviso.jpg'),-10,0,235);
			PDF::StopTransform();
			
			
            #EXPORTO
            PDF::Output(public_path('storage/fichas/').$postulante->numero_identificacion.'.pdf','F');

    }

    public function pdfMasivo1($id = null)
    {
        if (isset($id)) {
           $postulante = Postulante::find($id);
        } else {
           $postulante = Postulante::Usuario()->first();
        }

        $evaluacion = Evaluacion::Activo()->first();
        #if(isset($postulante) && $postulante->foto_estado=='ACEPTADO'){


            PDF::SetTitle('FICHA DE INSCRIPCION');
            PDF::AddPage('U','A4');
            PDF::SetAutoPageBreak(false);
            PDF::Rect(15,15, 180,170);
            #FONDO
            //

        if($postulante->idmodalidad == 16) {
            $facultad = $postulante->idfacultad2;
        }else {
            $facultad = $postulante->idfacultad;
        }

        if (str_contains($postulante->codigo_modalidad,['E1CABC','E1TE','E1TG','E1PDC','E1VTC'])) {


            PDF::Image(asset('assets/pages/img/ficha-23-2.jpg'),0,0+9,210,297,'', '', '', false, 300, '', false, false, 0);


        }else {
            PDF::Image(asset('assets/pages/img/ficha-23-2.jpg'),0,0+9,210,297,'', '', '', false, 300, '', false, false, 0);
        }





            #CCOLOR DEL TEXTO

            
            #TITULO
            #PDF::SetXY(10,73);
            # PDF::SetFont('helvetica','B',19);
            #PDF::Cell(60,5,$evaluacion->codigo,0,0,'C');


            PDF::SetXY(45,50+9);
            PDF::SetTextColor(250);
            PDF::SetFont('helvetica','',12);
            PDF::Cell(60,5,'DNI:' ,0,0);

            PDF::SetXY(45,50+13);
            PDF::SetFont('helvetica','B',20);
            PDF::Cell(60,5,$postulante->numero_identificacion ,0,0);
            PDF::SetXY(60,35);
            PDF::SetFont('helvetica','B',13);
            $nota = ($postulante->idmodalidad == 16 && $postulante->pago = 'FALSE' && (date('Y-m-d')<= env('FINAL_CEPRE')) ) ? '' : '' ;
            PDF::MultiCell(80,5,$nota,1,'C',true);

            PDF::SetXY(60,40);
            $nota2 = ($postulante->idmodalidad == 16 && $postulante->pago = 'FALSE' && (date('Y-m-d')<= env('FINAL_CEPRE'))) ? 'EXAMEN FINAL DE CEPRE-UNI' : '' ;
            PDF::MultiCell(80,5,$nota2,1,'C',true);



            PDF::SetXY(166+4+3,86+20+70-15);
            PDF::SetTextColor(0);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(34,5,'Talla :'.$postulante->talla.' m' ,0,0,'C');


            PDF::SetXY(166+4+3,90 +20+70-15);
            PDF::SetTextColor(0);
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


            #FICHA DE INSCRIPCION
            PDF::SetXY(55,27);
            PDF::SetTextColor(250);
            PDF::SetFont('helvetica','B',22);
            PDF::Cell(50,5,'FICHA DE INSCRIPCIÓN',0,0,'L');

            #NUMERO DE INSCRIPCION

            #
            PDF::SetXY(45,30+17);
            PDF::SetTextColor(250);
            PDF::SetFont('helvetica','',12);
            PDF::Cell(50,5,'N° DE INSCRIPCIÓN',0,0,'L');


            PDF::SetXY(45,42+9);
            PDF::SetFont('helvetica','B',20);
            PDF::Cell(110,5,$postulante->codigo,0,0,'L');

            #CODIGO ENCIMA DE LA FOTO



            #NOMBRES Y APELLIDOS
            PDF::SetTextColor(0,0,0);
            PDF::SetXY(5,105-25-1+1);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(30,5,'Apellidos y',0,0,'L');
            PDF::SetXY(5,105-25-1+6);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(30,5,'Nombres: ',0,0,'L');

            PDF::SetXY(65-10-10-10,105-20-5);
            PDF::SetFont('helvetica','B',16);

            PDF::MultiCell(170,5,$postulante->nombre_completo,1,'L',true);

            PDF::SetXY(5,100+16-20+10+3-17);
            PDF::SetFont('helvetica','B',17);






            #MODALIDAD

            PDF::SetXY(5,100+16-20+10+3+6);
            PDF::SetFont('helvetica','B',13);
            PDF::Cell(60,5,'Modalidad :',0,0,'L');
            PDF::SetXY(31,100+16-20+10+3+6);
            PDF::SetFont('helvetica','',13);
            PDF::Cell(150,5,$postulante->nombre_modalidad,0,0,'L');
        //    PDF::SetXY(65,105+17-20+10+3);
        //    PDF::SetFont('helvetica','B',10);
            if ( $postulante->nombre_especialidad == "---"){


            }
            PDF::SetFont('helvetica','B',10);
            if( $postulante->nombre_especialidad2 == "---" && $postulante->nombre_especialidad != "---") {
                PDF::SetXY(5,105+17-20+10+3+6);
                PDF::Cell(120,5,'ESPECIALIDAD: ');
                PDF::SetFont('helvetica','',10);
                PDF::SetXY(34,105+17-20+10+3+6);
                PDF::Cell(120,5,$postulante->nombre_especialidad,0,0,'L');
            }
            if( $postulante->nombre_especialidad3 == "---" && $postulante->nombre_especialidad2 != "---") {
                PDF::SetXY(5,105+16-20+10+3+6);
                PDF::Cell(130,5,'PRIMERA PRIORIDAD: ',0 ,0,'L');
                PDF::SetFont('helvetica','',10);
                PDF::SetXY(45,105+16-20+10+3+6);
                PDF::Cell(130,5,$postulante->nombre_especialidad,0,0,'L');

                PDF::SetFont('helvetica','B',10);
                PDF::SetXY(5,105+21-20+10+3+6);
                PDF::Cell(130,5,'SEGUNDA PRIORIDAD: ',0,0,'L');
                PDF::SetXY(45,105+21-20+10+3+6);
                PDF::SetFont('helvetica','',10);
                PDF::Cell(130,5,$postulante->nombre_especialidad2,0,0,'L');

            }

            if( $postulante->nombre_especialidad != "---" && $postulante->nombre_especialidad2 != "---" && $postulante->nombre_especialidad3 != "---" ){
                PDF::SetXY(5,105+16-20+10+3+6);
                PDF::Cell(130,5,'PRIMERA PRIORIDAD: ',0 ,0,'L');
                PDF::SetFont('helvetica','',10);
                PDF::SetXY(45,105+16-20+10+3+6);
                PDF::Cell(130,5,$postulante->nombre_especialidad,0,0,'L');

                PDF::SetFont('helvetica','B',10);
                PDF::SetXY(5,105+21-20+10+3+6);
                PDF::Cell(130,5,'SEGUNDA PRIORIDAD: ',0,0,'L');
                PDF::SetXY(45,105+21-20+10+3+6);
                PDF::SetFont('helvetica','',10);
                PDF::Cell(130,5,$postulante->nombre_especialidad2,0,0,'L');

                PDF::SetFont('helvetica','B',10);
                PDF::SetXY(5,105+26-20+10+3+6);
                PDF::Cell(130,5,'TERCERA PRIORIDAD: ',0,0,'L');
                PDF::SetFont('helvetica','',10);
                PDF::SetXY(45,105+26-20+10+3+6);
                PDF::Cell(130,5,$postulante->nombre_especialidad3,0,0,'L');
            }

            #PDF::Cell(110,5,,0,0,'L');
            if ($postulante->codigo_modalidad == 'ID-CEPRE') {
                #SEGUNDA MODALIDAD
                PDF::SetXY(5,110+16-20+10+3+10+6);
                PDF::SetFont('helvetica','B',13);
                PDF::Cell(60,5,'Modalidad 2 :',0,0,'L');
                PDF::SetXY(34,110+16-20+10+3+10+6);
                PDF::SetFont('helvetica','',13);
                PDF::Cell(110,5,$postulante->nombre_modalidad2,0,0,'L');



                if( $postulante->nombre_especialidad5 == "---" && $postulante->nombre_especialidad4 != "---") {
                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+6);
                    PDF::Cell(120,5,'ESPECIALIDAD: ',0,0,'L');

                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(34,134.3+6);
                    PDF::Cell(120,5,$postulante->nombre_especialidad4,0,0,'L');



                }
                if( $postulante->nombre_especialidad6 == "---" && $postulante->nombre_especialidad5 != "---") {
                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+6);

                    PDF::Cell(130,5,'PRIMERA PRIORIDAD: ',0,0,'L');
                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+6);
                    PDF::Cell(130,5,$postulante->nombre_especialidad4,0,0,'L');

                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+5+6);
                    PDF::Cell(130,5,'SEGUNDA PRIORIDAD: ',0,0,'L');
                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+5+6);
                    PDF::Cell(130,5,$postulante->nombre_especialidad5,0,0,'L');

                }

                if( $postulante->nombre_especialidad4 != "---" && $postulante->nombre_especialidad5 != "---" && $postulante->nombre_especialidad6 != "---" ){
                    PDF::SetXY(5,134+6);
                    PDF::SetFont('helvetica','B',10);
                    PDF::Cell(130,5,'PRIMERA PRIORIDAD: ',0,0,'L');
                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+6);
                    PDF::Cell(130,5,$postulante->nombre_especialidad4,0,0,'L');

                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+5+6);
                    PDF::Cell(130,5,'SEGUNDA PRIORIDAD: ',0,0,'L');
                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+5+6);
                    PDF::Cell(130,5,$postulante->nombre_especialidad5,0,0,'L');

                    PDF::SetFont('helvetica','B',10);
                    PDF::SetXY(5,134+5+5+6);
                    PDF::Cell(130,5,'TERCERA PRIORIDAD: ',0,0,'L');

                    PDF::SetFont('helvetica','',10);
                    PDF::SetXY(45,134+5+5+6);
                    PDF::Cell(130,5,$postulante->nombre_especialidad6,0,0,'L');
                }

            }
            #AULAS
         $arq =false;
         if(($postulante->codigo_especialidad=='A1' || $postulante->codigo_especialidad4=='A1') && $postulante->codigo_modalidad != 'ID-CEPRE'){
            
             PDF::SetFillColor(119,205,238);
             PDF::SetXY(5,91+6);
             PDF::SetFont('helvetica','B',15);
             PDF::Cell(40,7,'SA 11/02  ',0,0,'C',1,'',1);

             PDF::SetFont('helvetica','B',35);
             PDF::SetXY(5,97+6);
             PDF::Cell(40,12,$postulante->datos_aula_voca->codigo.'',0,0,'L',true,'',1,true);

             $arq = true;
         }else{
            //FECHA VOCACIONAL CEPRE INTENSIVO
            $validacion = Validacion::where('codigo',$postulante->codigo_verificacion)->first();
             if($postulante->codigo_especialidad=='A1' && $validacion->intensivo==TRUE){
                 PDF::SetFillColor(119,205,238);
                 PDF::SetXY(5,91+6);
                 PDF::SetFont('helvetica','B',15);
                 PDF::Cell(40,7,'SA 11/02 ',0,0,'C',1,'',1);
                 PDF::SetFont('helvetica','B',35);
                 PDF::SetXY(5,97+6);
                 PDF::Cell(40,12,$postulante->datos_aula_voca->codigo,0,0,'L',true,'',1,true);
                 $arq = true;
             }
             else {
                if ($postulante->codigo_especialidad=='A1' && $validacion->intensivo==FALSE) {
                 PDF::SetFillColor(119,205,238);
                 PDF::SetXY(5,91+6);
                 PDF::SetFont('helvetica','B',15);
                 PDF::Cell(40,7,'SA 12/08 ',0,0,'C',1,'',1);
                 PDF::SetFont('helvetica','B',35);
                 PDF::SetXY(5,97+6);
                 PDF::Cell(40,12,$postulante->datos_aula_voca->codigo,0,0,'L',true,'',1,true);
                 $arq = true;
                }
                else {
                    if ($postulante->codigo_especialidad4=='A1' && $postulante->codigo_modalidad == 'ID-CEPRE') {
                     PDF::SetFillColor(119,205,238);
                     PDF::SetXY(5,91+6);
                     PDF::SetFont('helvetica','B',15);
                     PDF::Cell(40,7,'SA 11/02 ',0,0,'C',1,'',1);
                     PDF::SetFont('helvetica','B',35);
                     PDF::SetXY(5,97+6);
                     PDF::Cell(40,12,$postulante->datos_aula_voca->codigo,0,0,'L',true,'',1,true);
                     $arq = true;
                    }
                     
                 }
             }
         }

         $varxx = 0;
         if($arq){
             $varxx= 50;
         }else{

         }
         $puerta1='';$puerta2='';$puerta3='';
        if(str_contains($postulante->datos_aula_uno->codigo, ['A','C','D'])){
            $puerta1 = 'PUERTA N°3';
        }elseif (str_contains($postulante->datos_aula_uno->codigo, ['G','H'])) {
            $puerta1 = 'PUERTA N°4';
         }elseif (str_contains($postulante->datos_aula_uno->codigo, ['I','Q'])) {
            $puerta1 = 'PUERTA N°5';
         }elseif (str_contains($postulante->datos_aula_uno->codigo, ['S'])) {
            $puerta1 = 'PUERTA N°6';
         }elseif (str_contains($postulante->datos_aula_uno->codigo, ['T'])) {
            $puerta1 = 'PUERTA N°7';
         }
         if(str_contains($postulante->datos_aula_dos->codigo, ['A','C','D'])){
            $puerta2 = 'PUERTA N°3';
        }elseif (str_contains($postulante->datos_aula_dos->codigo, ['G','H'])) {
            $puerta2 = 'PUERTA N°4';
         }elseif (str_contains($postulante->datos_aula_dos->codigo, ['I','Q'])) {
            $puerta2 = 'PUERTA N°5';
         }elseif (str_contains($postulante->datos_aula_dos->codigo, ['S'])) {
            $puerta2 = 'PUERTA N°6';
         }elseif (str_contains($postulante->datos_aula_dos->codigo, ['T'])) {
            $puerta2 = 'PUERTA N°7';
         }
         if(str_contains($postulante->datos_aula_tres->codigo, ['A','C','D'])){
            $puerta3 = 'PUERTA N°3';
        }elseif (str_contains($postulante->datos_aula_tres->codigo, ['G','H'])) {
            $puerta3 = 'PUERTA N°4';
         }elseif (str_contains($postulante->datos_aula_tres->codigo, ['I','Q'])) {
            $puerta3 = 'PUERTA N°5';
         }elseif (str_contains($postulante->datos_aula_tres->codigo, ['S'])) {
            $puerta3 = 'PUERTA N°6';
         }elseif (str_contains($postulante->datos_aula_tres->codigo, ['T'])) {
            $puerta3 = 'PUERTA N°7';
         }
         

         
          #  PDF::SetTextColor(0);
            PDF::SetFillColor(143,238,87);

            PDF::SetFont('helvetica','B',15);
            PDF::SetXY(5+$varxx,91+6);

             PDF::Cell(40,7,'LU 14/08 ',0,0,'C',true);
            PDF::SetXY(5+$varxx,97+6);
            PDF::SetFont('helvetica','B',25);

            PDF::Cell(40,12,$postulante->datos_aula_uno->codigo.' '.$puerta1,0,0,'L',true,'',1,true);
            #DIA 2

            PDF::SetFillColor(243,218,114);
            PDF::SetFont('helvetica','B',15);
            PDF::SetXY(55+$varxx,91+6);
           PDF::Cell(40,7,'MI 16/08 ',0,0,'C',1,'',1);
            PDF::SetXY(55+$varxx,120+9+8-40+6);
            PDF::SetFont('helvetica','B',25);
            PDF::Cell(40,12,$postulante->datos_aula_dos->codigo.' '.$puerta2,0,0,'L',true,'',1,true);
            #DIA 3
            PDF::SetFillColor(247,176,203);
            PDF::SetXY(105+$varxx,88+3+6);
            PDF::SetFont('helvetica','B',15);
            PDF::Cell(40,7,'VI 18/08 ',0,0,'C',1,'',1);

            PDF::SetFont('helvetica','B',25);
            PDF::SetXY(105+$varxx,94+3+6);
            PDF::Cell(40,12,$postulante->datos_aula_tres->codigo.' '.$puerta3,0,0,'L',true,'',1,true);

            #

            PDF::SetFont('helvetica','B',12);
            #MENSAJE
            PDF::SetFillColor(255);
            PDF::SetFont('helvetica','B',13);
            PDF::SetTextColor(68,98,168);
            PDF::SetXY(18,89.5);

            $puerta = '';

         if( str_contains($postulante->datos_aula_uno->codigo, 'C') ) {
             $puerta = 'PUERTA N°3';
         }

         if( str_contains($postulante->datos_aula_uno->codigo, 'D') ) {
             $puerta = 'PUERTA N°3';
         }
         if( str_contains($postulante->datos_aula_uno->codigo, 'A') ) {
             $puerta = 'PUERTA N°3';
         }


         if( str_contains($postulante->datos_aula_uno->codigo, 'G') ) {
             $puerta = 'PUERTA N°4A';
         }
         if( str_contains($postulante->datos_aula_uno->codigo, 'H') ) {
             $puerta = 'PUERTA N°4A';
         }



         if( str_contains($postulante->datos_aula_uno->codigo, 'I') ) {
             $puerta = 'PUERTA N°5';
         }
         if( str_contains($postulante->datos_aula_uno->codigo, 'Q') ) {
             $puerta = 'PUERTA N°5';
         }

         if( str_contains($postulante->datos_aula_uno->codigo, 'S') ) {
             $puerta = 'PUERTA N°6';
         }

         if( str_contains($postulante->datos_aula_uno->codigo, 'T') ) {
             $puerta = 'PUERTA N°7';
         }


         if (str_contains($postulante->codigo_modalidad,['E1CABC','E1TE','E1TG','E1PDC','E1VTC'])) {

             if($facultad== 4 || $facultad== 5 || $facultad== 6 || $facultad== 7 || $facultad== 9){
                 $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES POR PUERTA N°3 DE 07H00 A 08H00';
             }
             if($facultad== 1 || $facultad== 2 || $facultad== 3 || $facultad== 8 || $facultad== 10 || $facultad== 11 ){
                 $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES POR PUERTA N°3 DE 07H00 A 08H00';
             }


         }else {
             if(  $facultad == 1 || $facultad == 7 || $facultad == 5){
                 $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES POR '.$puerta.'  DE 07H00 A 08H00';
             }
             if( $facultad == 4 || $facultad == 9 || $facultad == 10 || $facultad == 3 || $facultad== 6 || $facultad == 8 || $facultad == 11 || $facultad == 2){

                 $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES POR '.$puerta.'  DE 14H00 A 15H00';
             }
         }

             $texto = 'EL INGRESO AL CAMPUS DE LA UNI ES DE 07H00 A 08H30';
             
            PDF::SetFillColor(0, 0, 0, 12);
            PDF::Cell(180,3,$texto,0,1,'C',1,'',1);
            PDF::SetTextColor(0);
            #NUMERO DE DNI
            PDF::SetXY(5,150+6);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Lugar de Nacimiento :',0,0,'L');
            PDF::SetXY(65-17,150+6);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->descripcion_ubigeo_nacimiento,0,0,'L');
            #FECHA DE NACIMIENTO
            PDF::SetXY(5,155+6);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Fecha de Nacimiento :',0,0,'L');
            PDF::SetXY(65-17,155+6);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5, Carbon::parse($postulante->fecha_nacimiento)->format('d/m/Y'),0,0,'L');



            #DIRECCIÓN
            PDF::SetXY(5,165-4+6);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Dirección :',0,0,'L');
            PDF::SetXY(65-17,165-4+6);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->direccion,0,0,'L');
            #
            PDF::SetXY(65-17,170-4+6);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->descripcion_ubigeo,0,0,'L');
            #DOCUMENTO DE IDENTIDAD
            PDF::SetXY(5,175-4+6);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Teléfonos :',0,0,'L');
            PDF::SetXY(65-17,175-4+6);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->telefonos,0,0,'L');
            #EMAIL
            PDF::SetXY(5,180-4+6);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Email :',0,0,'L');
            PDF::SetXY(65-17,180-4+6);
            PDF::SetFont('helvetica','',10);
            PDF::Cell(110,5,$postulante->email,0,0,'L');
            #COLEGIO
            PDF::SetXY(5,185-4+6);
            PDF::SetFont('helvetica','B',11);
            PDF::Cell(60,5,'Institución Educativa :',0,0,'L');
            PDF::SetXY(65-17,185-4+7);
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
            #PDF::Cell(20,5,'SE REGISTRARÁ EN EL AULA',0,0);


            #DECLARACION JURADA
            PDF::SetXY(18,192+5);
            PDF::SetFont('helvetica','',20);
            PDF::Cell(170,5,'DECLARACIÓN JURADA',0,0,'C');

            PDF::SetXY(5,203+5);
            PDF::SetFont('helvetica','',11);
            $texto = "Declaro bajo juramento que toda la información registrada es auténtica, no estar impedido de postular, no ser alumno de la UNI y además mi foto registrada en el sistema es actual. En caso de faltar a la verdad, acepto mi descalificación del presente Concurso de Admisión, y me someto a las sanciones reglamentarias y/o legales que correspondan. Asimismo, declaro no tener antecedentes policiales y autorizo a la Dirección de Admisión de la Universidad Nacional de Ingeniería, el uso de mis datos personales, que libremente proporciono, para los fines que involucran las actividades propias de la Dirección de Admisión y la publicación en los medios de comunicación que estime convenientes, respecto a mis calificaciones de las pruebas rendidas.";
            $text2= "Declaro haber leído y conocer el Reglamento de Admisión para estudios de Antegrado y aceptar íntegramente su contenido.";
            PDF::MultiCell(155,5,$texto,1,'J',false);
            PDF::SetXY(5,203+5+39+5);
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
            PDF::AddPage('U','A4');
            PDF::StartTransform();
            PDF::Rotate(90,140,135);
            PDF::Image(asset('assets/pages/img/mapa-uni.jpg'),0,0,270);
            PDF::StopTransform();




        #    PDF::AddPage('U','A4');
        #    PDF::Image(asset('assets/pages/img/anuncio.jpg'),5,5,200);
			#COMUNICADO
			/*PDF::AddPage('U','A4');
			PDF::StartTransform();
            PDF::Rotate(0.3,100,135);
			PDF::Image(asset('assets/pages/img/aviso.jpg'),-10,0,235);
			PDF::StopTransform();
			
			
            #EXPORTO
            PDF::Output(public_path('storage/fichas/').$postulante->numero_identificacion.'.pdf','F');

    }
    public function pdfcepre($id = null)
    {
        if (isset($id)) {
            $postulante = Postulante::find($id);
        } else {
            $postulante = Postulante::Usuario()->first();
        }

        $evaluacion = Evaluacion::Activo()->first();
        #if(isset($postulante) && $postulante->foto_estado=='ACEPTADO'){


        PDF::SetTitle('FICHA DE INSCRIPCION');
        PDF::AddPage('U','A4');
        PDF::SetAutoPageBreak(false);
        PDF::Rect(15,15, 180,170);
        #FONDO
        PDF::Image(asset('assets/pages/img/ficha-cepre.jpg'),0,0+9,210,297,'', '', '', false, 300, '', false, false, 0);
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
        # PDF::Cell(50,5,'N° DE INSCRIPCIÓN',0,0,'L');


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

        PDF::SetXY(5,100+16-20+10+3-17);
        PDF::SetFont('helvetica','B',17);




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
        /*
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
        */
        #AULAS
        #  PDF::SetTextColor(0);
      /*
        PDF::SetFillColor(143,238,87);

        PDF::SetFont('helvetica','B',15);
        PDF::SetXY(5,91);

        PDF::Cell(40,7,'MA 01/03: ',0,0,'C',true);
        PDF::SetXY(5,97);
        PDF::SetFont('helvetica','B',35);

        PDF::Cell(40,12,$postulante->datos_aula_uno->codigo,0,0,'L',true,'',1,true);
        #DIA 2

        PDF::SetFillColor(243,218,114);
        PDF::SetFont('helvetica','B',15);
        PDF::SetXY(55,91);
        PDF::Cell(40,7,'JUE 03/03: ',0,0,'C',1,'',1);
        PDF::SetXY(55,120+9+8-40);
        PDF::SetFont('helvetica','B',35);
        PDF::Cell(40,12,$postulante->datos_aula_dos->codigo,0,0,'L',true,'',1,true);
        #DIA 3
        PDF::SetFillColor(247,176,203);
        PDF::SetXY(105,88+3);
        PDF::SetFont('helvetica','B',15);
        PDF::Cell(40,7,'SAB 05/03: ',0,0,'C',1,'',1);

        PDF::SetFont('helvetica','B',35);
        PDF::SetXY(105,94+3);
        PDF::Cell(40,12,$postulante->datos_aula_tres->codigo,0,0,'L',true,'',1,true);


        */
        /*
                #
                if(($postulante->codigo_especialidad=='A1' || $postulante->codigo_especialidad4=='A1') && $postulante->codigo_modalidad != 'ID-CEPRE'){

                    PDF::SetFillColor(119,205,238);
                    PDF::SetXY(155,91);
                    PDF::SetFont('helvetica','B',15);
                    PDF::Cell(40,7,'SAB 26/02: ',0,0,'C',1,'',1);

                    PDF::SetFont('helvetica','B',35);
                    PDF::SetXY(155,97);
                    PDF::Cell(40,12,$postulante->datos_aula_voca->codigo.'',0,0,'L',true,'',1,true);



                }else{

                    if($postulante->codigo_especialidad4=='A1'){


                        PDF::SetFillColor(119,205,238);
                        PDF::SetXY(155,91);
                        PDF::SetFont('helvetica','B',15);
                        PDF::Cell(40,7,'SAB 26/02: ',0,0,'C',1,'',1);

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
        PDF::SetXY(18,135);

        $texto = 'EXAMEN FINAL CEPRE-UNI DOMINGO 05 DE FEBRERO DE 2023.';


        PDF::SetFillColor(0, 0, 0, 12);
         PDF::Cell(180,7,$texto,0,1,'C',1,'',1);
        PDF::SetTextColor(0);
        PDF::SetTextColor(68,98,168);
        PDF::SetFillColor(0, 0, 0, 12);
        PDF::SetXY(18,143);
        $texto2 = 'PRUEBA DE APTITUD VOCACIONAL CEPRE-UNI SÁBADO 28 DE ENERO DE 2023.';
        if($postulante->idespecialidad == 1){


        PDF::Cell(180,7,$texto2,0,1,'C',1,'',1);
        }
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
        #PDF::Cell(20,5,'SE REGISTRARÁ EN EL AULA',0,0);


        #DECLARACION JURADA
        PDF::SetXY(18,192+5);
        PDF::SetFont('helvetica','',20);
        PDF::Cell(170,5,'DECLARACIÓN JURADA',0,0,'C');

        PDF::SetXY(5,203+5);
        PDF::SetFont('helvetica','',11);
        $texto = "Declaro bajo juramento que toda la información registrada es auténtica, de no estar impedido de postular, no ser alumno de la UNI y que además mi foto registrada en el sistema es la actual. En caso de faltar a la verdad perderé mi derecho a postular, sometiéndome a las sanciones reglamentarias y legales que correspondan. Así mismo, declaro no tener antecedentes policiales, y autorizo a la Oficina Central de Admisión (OCAD – UNI) el uso de mis datos personales, que libremente proporciono, para los fines que involucran las actividades propias de la OCAD – UNI, y la publicación de mis calificaciones en los medios que la Universidad dispone para dar a conocer los resultados. Declaro haber leído y ";
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
        #   PDF::AddPage('U','A4');
        PDF::StartTransform();
        PDF::Rotate(90,140,135);
        #  PDF::Image(asset('assets/pages/img/mapa-uni.jpg'),0,0,270);
        PDF::StopTransform();




        #    PDF::AddPage('U','A4');
        #    PDF::Image(asset('assets/pages/img/anuncio.jpg'),5,5,200);
        #COMUNICADO
        /*PDF::AddPage('U','A4');
        PDF::StartTransform();
        PDF::Rotate(0.3,100,135);
        PDF::Image(asset('assets/pages/img/aviso.jpg'),-10,0,235);
        PDF::StopTransform();


        #EXPORTO
        PDF::Output(public_path('storage/tmp/').'Ficha_'.$postulante->numero_identificacion.'.pdf','FI');

    }

    public function enviaremailpiloto(){
        $postulante = Postulante::Usuario()->first();

        $ahora = Carbon::now();
        $count = LogEmailPiloto::where('idpostulante',$postulante->id)->count();
        if ( $count> 0 ){
            $logemailmax = LogEmailPiloto::where('idpostulante',$postulante->id)->max('id');
            $logemail= LogEmailPiloto::where('id',$logemailmax)->first();
            $anterior = $logemail->creacion;
            $diferencia = Carbon::now()->diffInMinutes($anterior);
            if($diferencia >= 10 ){

                $capacidad = CapacidadPiloto::where('id',$postulante->idturnopiloto)->first();
                $myEmail = Auth::user()->email;
                $tablaclave = PostulanteClave::where('idpostulante',$postulante->id)->first();
                $claveespa = ClavesCepre::where('id',$tablaclave->idclave)->first();
                //Mail::to($myEmail)->send(new PilotoMail($postulante->numero_identificacion,$claveespa->clave,$capacidad->turno));
                LogEmailPiloto::insert([
                    'idpostulante'=> $postulante->id,
                    'email'=>$myEmail,
                    'creacion'=>$ahora
                ]);
                return Response::json(['data' => 'OK','envio'=>'OK' ]);
            }else {
                $nuevafech = Carbon::parse($anterior)->addMinutes(10);
                return Response::json(['data' => 'ERROR', 'envio'=>'FALSE','msj'=>'PUEDES ENVIAR OTRO MENSAJE A PARTIR DE: '.$nuevafech->format('d-m-Y H:i')]);
            }


        }else{

            $capacidad = CapacidadPiloto::where('id',$postulante->idturnopiloto)->first();
            $myEmail = Auth::user()->email;
            $tablaclave = PostulanteClave::where('idpostulante',$postulante->id)->first();
            $claveespa = ClavesCepre::where('id',$tablaclave->idclave)->first();
            //Mail::to($myEmail)->send(new PilotoMail($postulante->numero_identificacion,$claveespa->clave,$capacidad->turno));
            LogEmailPiloto::insert([
                'idpostulante'=> $postulante->id,
                'email'=>$myEmail,
                'creacion'=>$ahora
            ]);
            return Response::json(['data' => 'OK','envio'=>'OK' ]);
        }








    }
*/


    public function asignarcodigosmasivo()
    {



        $lista = DB::table("v_asinar_masivo")->get(); // Obtiene la lista de postulantes

        foreach ($lista as $pos) {


            $postulante = Postulante::find($pos->id);

            Postulante::AsignarCodigo($postulante->id, $postulante->canal, $postulante->codigo_modalidad);

            Postulante::AsignarCodigo($postulante->id,$postulante->canal,$postulante->codigo_modalidad);
            if( !isset($postulante->idaula1) ){
                Postulante::AsignarAula($postulante->id);
            }
        }




    }

    public function confirmardatos(Request $request){

        $postulante = Postulante::Usuario()->first();
        $mensaje = $request->input('mensaje');
        $resulta = $request->input('resultado');
        $date = Carbon::now();
        Confirmacion::create([
            'idpostulante'=>$postulante->id,
            'dni'=>$postulante->numero_identificacion,
            'fecha'=>$date,
            'iduser'=>$postulante->idusuario,
            'idmodalidad'=>$postulante->idmodalidad,
            'idespecialidad'=>$postulante->idespecialidad,
            'idespecialidad2'=>$postulante->idespecialidad2,
            'idespecialidad3'=>$postulante->idespecialidad3,
            'comentario'=>$mensaje,
            'acepto'=>$resulta
        ]);


        return redirect()->to('/');


    }


}
