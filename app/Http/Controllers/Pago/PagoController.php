<?php

namespace App\Http\Controllers\Pago;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\Cronograma;
use App\Models\DeclaracionEva;
use App\Models\Descuento;
use App\Models\Postulante;
use App\Models\Solicitante;
use App\Models\Servicio;
use App\Models\SolicitanteVictima;
use Auth;
use DB;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use PDF;
class PagoController extends Controller
{
    public function index($id = null)
    {
        $existe = Postulante::where('idusuario',Auth::user()->id)->count();
        $bloqueodoc = false;
        $bloqueodeclar = false;
        $msj = collect([]);

        if($existe==0){
            Alert::warning('No registro su preinscripción')
                    ->details('Debes ingresar a la opcion Datos y llenar el formularo de preinscripción')
                    ->button('Lo puedes hacer haciendo clic aqui',route('datos.index'),'primary');




            return back();
        }else{
            $postulante = Postulante::Usuario()->first();

            $sol= DB::table("semibeca_verificador")->where('dni',$postulante->numero_identificacion)->count();



#            if(false) {
            if($postulante->idmodalidad == 16){
                    // DESPUES DE PROCESO DE SEMIBECA
                if(false) {
                }else {




                    if( !is_null($postulante->idmodalidad2) ){

                        if($postulante->idmodalidad2 <> 1 and $postulante->idmodalidad2 <> 17 and $postulante->idmodalidad2 <> 23
                        ){

                            $count = SolicitanteVictima::where('idpostulante',$postulante->id)->count();
                            if( $count>0){
                                $solicitante = SolicitanteVictima::where('idpostulante',$postulante->id)->first();

                                $estado = $solicitante->estado;
                                if($estado == 'APROBADO'){

                                }else{


                                    $msj->push(['titulo'=>'Falta Presentar o Aprobar Documentos','mensaje'=>'Debes escanear tus documentos y subirlo en el siguiente enlace, si ya los subiste espera 24 horas la aprobación para continuar con tu inscripción.','link'=>'documentos']);
                                    $bloqueodoc = true;

                                }

                            }else{


                                $msj->push(['titulo'=>'Falta Presentar o Aprobar Documentos','mensaje'=>'Debes escanear tus documentos y subirlo en el siguiente enlace, si ya los subiste espera 24 horas la aprobación para continuar con tu inscripción.','link'=>'documentos']);
                                $bloqueodoc = true;
                            }



                        }else {

                        }


                    }else {



                        if($postulante->idmodalidad <> 1 and $postulante->idmodalidad <> 16 and $postulante->idmodalidad <> 17 and $postulante->idmodalidad <> 23
                        ){

                            $count = SolicitanteVictima::where('idpostulante',$postulante->id)->count();
                            if( $count>0){
                                $solicitante  = SolicitanteVictima::where('idpostulante',$postulante->id)->first();

                                $estado = $solicitante->estado;
                                if($estado == 'APROBADO'){

                                }else{


                                    $msj->push(['titulo'=>'Falta Presentar o Aprobar Documentos','mensaje'=>'Debes escanear tus documentos y subirlo en el siguiente enlace, si ya los subiste espera 24 horas la aprobación para continuar con tu inscripción.','link'=>'documentos']);
                                    $bloqueodoc=true;
                                }

                            }else{


                                $msj->push(['titulo'=>'Falta Presentar o Aprobar Documentos','mensaje'=>'Debes escanear tus documentos y subirlo en el siguiente enlace, si ya los subiste espera 24 horas la aprobación para continuar con tu inscripción.','link'=>'documentos']);
                                $bloqueodoc= true;
                            }




                        }else {

                        }

                    }



                    $countdeclaracion = DeclaracionEva::where('idpostulante',$postulante->id)->count();
                    if( $countdeclaracion > 0){

                        $estadodeclar = DeclaracionEva::where('idpostulante',$postulante->id)->first();
                        if($estadodeclar->estado == 'APROBADO'){

                        }else{
                            $msj->push(['titulo'=>'Falta Presentar o Aprobar Declaración Jurada','mensaje'=>'Debes escanear tu declaración jurada y subirlo en el siguiente enlace, si ya los subiste espera 24 horas y la aprobación para continuar con tu inscripción.','link'=>'declaracion']);
                            $bloqueodeclar = true;
                        }

                    }else {

                        $msj->push(['titulo'=>'Falta Presentar o Aprobar Declaración Jurada','mensaje'=>'Debes escanear tu declaración jurada y subirlo en el siguiente enlace, si ya los subiste espera 24 horas la aprobación para continuar con tu inscripción.','link'=>'declaracion']);
                        $bloqueodeclar = true;
                    }





                    if( $bloqueodoc || $bloqueodeclar ){

                        return view('pagos.bloqueo',compact('msj','id','pagos'));
                    }else {
                        $pagos = $this->CalculoServicios();


                        return view('pagos.list',compact('id','pagos'));
                    }




                }

            }else {
                if(false){
                #if($sol > 0) {


                    Alert::warning('INSCRIPCIÓN A SEMIBECA')
                        ->details('Debes esperar los resultados de semibeca para poder realizar el pago.');
                    #   $pagos = $this->CalculoServiciosSemibeca();
                    #    return view('pagos.list',compact('id','pagos'));
                    return back();



                }else {




                    if( !is_null($postulante->idmodalidad2) ){

                        if($postulante->idmodalidad2 <> 1 and $postulante->idmodalidad2 <> 17 and $postulante->idmodalidad2 <> 23
                        ){

                            $count = SolicitanteVictima::where('idpostulante',$postulante->id)->count();
                            if( $count>0){
                                $solicitante = SolicitanteVictima::where('idpostulante',$postulante->id)->first();

                                $estado = $solicitante->estado;
                                if($estado == 'APROBADO'){

                                }else{


                                    $msj->push(['titulo'=>'Falta Presentar o Aprobar Documentos','mensaje'=>'Debes escanear tus documentos y subirlo en el siguiente enlace, si ya los subiste espera 24 horas la aprobación para continuar con tu inscripción.','link'=>'documentos']);
                                    $bloqueodoc = true;

                                }

                            }else{


                                $msj->push(['titulo'=>'Falta Presentar o Aprobar Documentos','mensaje'=>'Debes escanear tus documentos y subirlo en el siguiente enlace, si ya los subiste espera 24 horas la aprobación para continuar con tu inscripción.','link'=>'documentos']);
                                $bloqueodoc = true;
                            }



                        }else {

                        }


                    }else {



                        if($postulante->idmodalidad <> 1 and $postulante->idmodalidad <> 16 and $postulante->idmodalidad <> 17 and $postulante->idmodalidad <> 23
                        ){

                            $count = SolicitanteVictima::where('idpostulante',$postulante->id)->count();
                            if( $count>0){
                                $solicitante  = SolicitanteVictima::where('idpostulante',$postulante->id)->first();

                                $estado = $solicitante->estado;
                                if($estado == 'APROBADO'){

                                }else{


                                    $msj->push(['titulo'=>'Falta Presentar o Aprobar Documentos','mensaje'=>'Debes escanear tus documentos y subirlo en el siguiente enlace, si ya los subiste espera 24 horas la aprobación para continuar con tu inscripción.','link'=>'documentos']);
                                    $bloqueodoc=true;
                                }

                            }else{


                                $msj->push(['titulo'=>'Falta Presentar o Aprobar Documentos','mensaje'=>'Debes escanear tus documentos y subirlo en el siguiente enlace, si ya los subiste espera 24 horas la aprobación para continuar con tu inscripción.','link'=>'documentos']);
                                $bloqueodoc= true;
                            }




                        }else {

                        }

                    }



                    $countdeclaracion = DeclaracionEva::where('idpostulante',$postulante->id)->count();
                    if( $countdeclaracion > 0){

                        $estadodeclar = DeclaracionEva::where('idpostulante',$postulante->id)->first();
                        if($estadodeclar->estado == 'APROBADO'){

                        }else{
                            $msj->push(['titulo'=>'Falta Presentar o Aprobar Declaración Jurada','mensaje'=>'Debes escanear tu declaración jurada y subirlo en el siguiente enlace, si ya los subiste espera 24 horas y la aprobación para continuar con tu inscripción.','link'=>'declaracion']);
                            $bloqueodeclar = true;
                        }

                    }else {

                        $msj->push(['titulo'=>'Falta Presentar o Aprobar Declaración Jurada','mensaje'=>'Debes escanear tu declaración jurada y subirlo en el siguiente enlace, si ya los subiste espera 24 horas la aprobación para continuar con tu inscripción.','link'=>'declaracion']);
                        $bloqueodeclar = true;
                    }





                    if( $bloqueodoc || $bloqueodeclar ){

                        return view('pagos.bloqueo',compact('msj','id','pagos'));
                    }else {
                        $pagos = $this->CalculoServicios();


                        return view('pagos.list',compact('id','pagos'));
                    }




                }

            }






        }
    }
    public function formato($servicio,$id = null)
    {
    	return view('pagos.index',compact('id','servicio'));
    }
    public function pdf($servicio,$id = null)
    {
        if (isset($id)) {
           $postulante = Postulante::find($id);
        } else {
           $postulante = Postulante::Usuario()->first();
        }

        if(isset($postulante)){
        $servicio = Servicio::where('codigo',$servicio)->first();
      # comentar la siguiente línea para deshabilitar formato pago Scotiabank
        #$this->FormatoScotiabank($servicio,$postulante,'Scotiabank');
        $this->FormatoScotiabank($servicio,$postulante,'Bcp');

        PDF::Output(public_path('storage/tmp/').'FormatoPago_'.$servicio->codigo.'_'.$postulante->numero_identificacion.'.pdf','FI');
        }//fin if
    }
    public function pdfRendAdmin($servi,$id = null)
    {
        if (isset($id)) {
           $postulante = Postulante::find($id);
        } else {
           $postulante = Postulante::Usuario()->first();
        }

        if(isset($postulante)){
	    $servicio = Servicio::where('activo',true)->where('codigo',$servi)->first();
        $this->FormatoScotiabank($servicio,$postulante,'Scotiabank');
        $this->FormatoScotiabank($servicio,$postulante,'Bcp');
        


        PDF::Output(public_path('storage/tmp/').'FormatoPago_'.$servicio->codigo.'_'.$postulante->numero_identificacion.'.pdf','FI');
	
        }//fin if
    }
    public function CalculoServicios($id = null)
    {
        // Obtiene el postulante (ya sea por ID si se pasa o el del usuario actual)
        $postulante = $id ? Postulante::find($id) : Postulante::Usuario()->first();

        if (!$postulante) {
             Log::warning("Postulante no encontrado en CalculoServicios para ID: " . ($id ?? Auth::id()));
             return collect([]);
        }

        #Pago de Prospecto (siempre requerido)
        $pagos = collect(['prospecto'=>'475']);

        // CEPRE-UNI (modalidad 16): Si es ingresante, solo paga prospecto
        // Si no es ingresante, recalcular según su segunda modalidad
        if ($postulante->idmodalidad == 16) {
            if ($postulante->ingresante == true) {
                // Es ingresante CEPRE-UNI, solo paga prospecto
                return $pagos;
            }
            // No es ingresante, usar la segunda modalidad para calcular el pago
            $idmoda = $postulante->idmodalidad2;
            if (is_null($idmoda)) {
                // No tiene segunda modalidad, solo paga prospecto
                return $pagos;
            }
        } else {
            $idmoda = $postulante->idmodalidad;
        }

        #Verificar becas activas
        $descuento_total = Descuento::where('dni',$postulante->numero_identificacion)->Activo()->where('tipo','Total')->first();
        $descuento_parcial = Descuento::where('dni',$postulante->numero_identificacion)->Activo()->where('tipo','Parcial')->first();

        #Determinar gestión (Pública/Privada)
        $gestion_ie = $postulante->gestion_ie ?? 'Pública';

        #Asignación según modalidad y becas
        if ($descuento_total) {
            // Beca total: no paga inscripción
        } elseif ($descuento_parcial) {
            // Semibecas (Servicios 466 y 467)
            if (str_contains($gestion_ie, 'Pública')) {
                $pagos->put('examen', '466'); // INSC. SEMIBECA ESTATAL
            } else {
                $pagos->put('examen', '467'); // INSC. SEMIBECA PRIVADA
            }
        } else {
            // Sin beca - Asignar según modalidad

            // Ordinario (O) / CNE - modalidades 1, 2, 3, 13, 14, 23
            if (in_array($idmoda, [1, 2, 3, 13, 14, 23])) {
                if (str_contains($gestion_ie, 'Pública')) {
                    $pagos->put('examen', '464'); // INST. EDUC. ESTATAL
                } else {
                    $pagos->put('examen', '465'); // INST. EDUC. PRIVADA
                }
            }
            // Modalidades Extraordinarias (E1DPA, E1DCAN, E1PDI) - modalidades 21, 22
            elseif (in_array($idmoda, [21, 22])) {
                if (str_contains($gestion_ie, 'Pública')) {
                    $pagos->put('examen', '514'); // MODAL.EXTRAOR.COLE.ESTAT
                } else {
                    $pagos->put('examen', '515'); // MODAL.EXTRAOR.COLE.PARTI
                }
            }
            // Traslado Externo (E1TE) - modalidades 7, 19
            elseif (in_array($idmoda, [7, 19])) {
                if (str_contains($gestion_ie, 'Pública')) {
                    $pagos->put('examen', '469'); // INSC. TRASLADO EXT. EST.
                } else {
                    $pagos->put('examen', '470'); // INSC. TRASLADO EXT.PRIV.
                }
                // Convalidación para Traslado
               // $pagos->put('convalidacion', '518'); // CONVAL.CURSO TRASL EXTERN
            }
            // Titulados y Graduados (E1TGU, E1TG) - modalidades 5, 6
            elseif (in_array($idmoda, [5, 6])) {
                $pagos->put('examen', '468'); // INSC. TIT. GRADUADOS
                // Convalidación para Titulados
                //$pagos->put('convalidacion', '519'); // CONVAL.CURSO TITUL/GRADU
            }
            // Bachiller Diplomado (E1DB, E1CABI, E1CD) - modalidades 4, 8, 9, 10
            elseif (in_array($idmoda, [4, 8, 9, 10])) {
                $pagos->put('examen', '473'); // INSC. BACH. DIPLOMADO
            }
        }

        #Pago Vocacional - Arquitectura (ID 1) en cualquiera de las 6 opciones
        $especialidades = [
            $postulante->idespecialidad,
            $postulante->idespecialidad2,
            $postulante->idespecialidad3,
            $postulante->idespecialidad4,
            $postulante->idespecialidad5,
            $postulante->idespecialidad6,
        ];

        if (in_array(1, $especialidades, true)) {
            $pagos->put('voca', '474'); // PRUEBA DE APT. VOCACIONAL
        }

        // Si es CEPRE-UNI y su segunda modalidad es ordinario, verificar vocacional en especialidades de segunda modalidad
        if ($postulante->idmodalidad == 16 && in_array($postulante->idmodalidad2, [1, 2, 3, 13, 14])) {
            $especialidades_segunda_modalidad = [
                $postulante->idespecialidad4,
                $postulante->idespecialidad5,
            ];
            if (in_array(1, $especialidades_segunda_modalidad, true)) {
                $pagos->put('voca', '474'); // PRUEBA DE APT. VOCACIONAL
            }
        }

        return $pagos;
    } // Fin de CalculoServicios

    public function CalculoServiciosSemibeca($id = null)
    {
        $postulante = Postulante::Usuario()->first();

        #Pago de Prospecto-----------------------------------------------------------------------------------------------
        $pagos = collect(['prospecto'=>475]);
        #Pago por derecho de examen---------------------------------------------------------------------------------------


        return $pagos;
    }


 public function CalculoServiciosTemp($id = null)
    {
        $postulante = Postulante::Usuario()->first();
        if (!$postulante) return collect([]);

        #Pago de Prospecto (siempre requerido)
        $pagos = collect(['prospecto'=>'475']);

        // CEPRE-UNI (modalidad 16): Si es ingresante, solo paga prospecto
        // Si no es ingresante, recalcular según su segunda modalidad
        if ($postulante->idmodalidad == 16) {
            if ($postulante->ingresante == true) {
                // Es ingresante CEPRE-UNI, solo paga prospecto
                return $pagos;
            }
            // No es ingresante, usar la segunda modalidad para calcular el pago
            $idmoda = $postulante->idmodalidad2;
            if (is_null($idmoda)) {
                // No tiene segunda modalidad, solo paga prospecto
                return $pagos;
            }
        } else {
            $idmoda = $postulante->idmodalidad;
        }

        #Verificar becas activas
        $descuento_total = Descuento::where('dni',$postulante->numero_identificacion)->Activo()->where('tipo','Total')->first();
        $descuento_parcial = Descuento::where('dni',$postulante->numero_identificacion)->Activo()->where('tipo','Parcial')->first();

        #Determinar gestión (Pública/Privada)
        $gestion_ie = $postulante->gestion_ie ?? 'Pública';

        #Asignación según modalidad y becas
        if ($descuento_total) {
            // Beca total: no paga inscripción
        } elseif ($descuento_parcial) {
            // Semibecas (Servicios 466 y 467)
            if (str_contains($gestion_ie, 'Pública')) {
                $pagos->put('examen', '466');
            } else {
                $pagos->put('examen', '467');
            }
        } else {
            // Sin beca - Asignar según modalidad

            if (in_array($idmoda, [1, 2, 3, 13, 14, 23])) {
                $pagos->put('examen', str_contains($gestion_ie, 'Pública') ? '464' : '465');
            } elseif (in_array($idmoda, [21, 22])) {
                $pagos->put('examen', str_contains($gestion_ie, 'Pública') ? '514' : '515');
            } elseif (in_array($idmoda, [7, 19])) {
                $pagos->put('examen', str_contains($gestion_ie, 'Pública') ? '469' : '470');
                //$pagos->put('convalidacion', '518');
            } elseif (in_array($idmoda, [5, 6])) {
                $pagos->put('examen', '468');
                //  $pagos->put('convalidacion', '519');
            } elseif (in_array($idmoda, [4, 8, 9, 10])) {
                $pagos->put('examen', '473');
            }
        }

        #Pago Vocacional - Arquitectura (ID 1) en cualquiera de las 6 opciones
        $especialidades = [
            $postulante->idespecialidad,
            $postulante->idespecialidad2,
            $postulante->idespecialidad3,
            $postulante->idespecialidad4,
            $postulante->idespecialidad5,
            $postulante->idespecialidad6,
        ];

        if (in_array(1, $especialidades, true)) {
            $pagos->put('voca', '474');
        }

        // Si es CEPRE-UNI y su segunda modalidad es ordinario, verificar vocacional en especialidades de segunda modalidad
        if ($postulante->idmodalidad == 16 && in_array($postulante->idmodalidad2, [1, 2, 3, 13, 14, 23])) {
            $especialidades_segunda_modalidad = [
                $postulante->idespecialidad4,
                $postulante->idespecialidad5,
            ];
            if (in_array(1, $especialidades_segunda_modalidad, true)) {
                $pagos->put('voca', '516'); // PRUEBA VOCACIONAL CEPRE-UNI NO INGRESANTE
            }
        }

        return $pagos;
    }


public function CalculoServiciosAd($postulante)
    {
        if (!$postulante) return collect([]);

        #Pago de Prospecto (siempre requerido)
        $pagos = collect(['prospecto'=>'475']);

        // CEPRE-UNI (modalidad 16): Si es ingresante, solo paga prospecto
        // Si no es ingresante, recalcular según su segunda modalidad
        if ($postulante->idmodalidad == 16) {
            if ($postulante->ingresante == true) {
                // Es ingresante CEPRE-UNI, solo paga prospecto
                return $pagos;
            }
            // No es ingresante, usar la segunda modalidad para calcular el pago
            $idmoda = $postulante->idmodalidad2;
            if (is_null($idmoda)) {
                // No tiene segunda modalidad, solo paga prospecto
                return $pagos;
            }
        } else {
            $idmoda = $postulante->idmodalidad;
        }

        #Verificar becas activas
        $descuento_total = Descuento::where('dni',$postulante->numero_identificacion)->Activo()->where('tipo','Total')->first();
        $descuento_parcial = Descuento::where('dni',$postulante->numero_identificacion)->Activo()->where('tipo','Parcial')->first();

        #Determinar gestión (Pública/Privada)
        $gestion_ie = $postulante->gestion_ie ?? 'Pública';

        #Asignación según modalidad y becas
        if ($descuento_total) {
            // Beca total: no paga inscripción
        } elseif ($descuento_parcial) {
            // Semibecas (Servicios 466 y 467)
            if (str_contains($gestion_ie, 'Pública')) {
                $pagos->put('examen', '466');
            } else {
                $pagos->put('examen', '467');
            }
        } else {
            // Sin beca - Asignar según modalidad

            if (in_array($idmoda, [1, 2, 3, 13, 14, 23])) {
                $pagos->put('examen', str_contains($gestion_ie, 'Pública') ? '464' : '465');
            } elseif (in_array($idmoda, [21, 22])) {
                $pagos->put('examen', str_contains($gestion_ie, 'Pública') ? '514' : '515');
            } elseif (in_array($idmoda, [7, 19])) {
                $pagos->put('examen', str_contains($gestion_ie, 'Pública') ? '469' : '470');
                // $pagos->put('convalidacion', '518');
            } elseif (in_array($idmoda, [5, 6])) {
                $pagos->put('examen', '468');
                // $pagos->put('convalidacion', '519');
            } elseif (in_array($idmoda, [4, 8, 9, 10])) {
                $pagos->put('examen', '473');
            }
        }

        #Pago Vocacional - Arquitectura (ID 1) en cualquiera de las 6 opciones
        $especialidades = [
            $postulante->idespecialidad,
            $postulante->idespecialidad2,
            $postulante->idespecialidad3,
            $postulante->idespecialidad4,
            $postulante->idespecialidad5,
            $postulante->idespecialidad6,
        ];

        if (in_array(1, $especialidades, true)) {
            $pagos->put('voca', '474');
        }

        // Si es CEPRE-UNI y su segunda modalidad es ordinario, verificar vocacional en especialidades de segunda modalidad
        if ($postulante->idmodalidad == 16 && in_array($postulante->idmodalidad2, [1, 2, 3, 13, 14, 23])) {
            $especialidades_segunda_modalidad = [
                $postulante->idespecialidad4,
                $postulante->idespecialidad5,
            ];
            if (in_array(1, $especialidades_segunda_modalidad, true)) {
                $pagos->put('voca', '516'); // PRUEBA VOCACIONAL CEPRE-UNI NO INGRESANTE
            }
        }

        return $pagos;
    }

    public function FormatoScotiabank($servicio,$postulante,$banco)
    {
        switch ($banco) {
            case 'Scotiabank':
                $imagen = public_path('assets/pages/img/scotiabank_logo.jpg');
                $lblconcepto = 'Concepto :';
                $lblservicio = ''/*($servicio->codigo+100).' - '*/;
                $lblinstruccion = '3. Debe indicar el pago es al servicio PAGO ESTUDIANTES, luego el DNI POSTULANTE.';
                break;
            case 'Bcp':
                $imagen = public_path('assets/pages/img/bcp_logo.jpg');
                $lblconcepto = 'Concepto :';
                $lblservicio = '';
                $lblinstruccion = '3. Si va a pagar en un Agente BCP, debe indicar el código 15226, luego el DNI POSTULANTE.';
                break;
            case 'Financiero':
                $imagen = public_path('assets/pages/img/financiero_logo.jpg');
                $lblconcepto = 'Partida :';
                $lblservicio = $servicio->partida.' - ';
                break;
        }
        PDF::SetTitle('RECIBO DE PAGO');
        PDF::AddPage('L','A5');
        #MARCO
        PDF::Rect(15,15, 180,92 );
        #IMAGEN YAPE - Reducida a 30mm y posicionada a la derecha
        #TITULO
        PDF::SetXY(18,17);
        PDF::SetFont('helvetica','B',18);
        PDF::SetTextColor(0);
        PDF::Cell(140,8,"FORMATO DE PAGO",0,0,'L');
        #COLOR DEL TEXTO
        PDF::SetTextColor(0);
        #INSTITUCION
        PDF::SetXY(18,27);
        PDF::SetFont('helvetica','B',9);
        PDF::Cell(54,4,'Cuenta :',1,0,'R');
        PDF::SetXY(72,27);
        PDF::SetFont('helvetica','',9);
        PDF::Cell(116,4,'PAGO ESTUDIANTES',1,0,'L');
        #ETIQUETA DNI
        PDF::SetXY(18,31);
        PDF::SetFont('helvetica','B',9);
        PDF::Cell(54,4,'DNI POSTULANTE',1,0,'R');
        PDF::SetXY(72,31);
        PDF::SetFont('helvetica','',9);
        PDF::Cell(116,4,$postulante->numero_identificacion,1,0,'L');
        #NOMBRE
        PDF::SetXY(18,35);
        PDF::SetFont('helvetica','B',9);
        PDF::Cell(54,4,'Nombre :',1,0,'R');
        PDF::SetXY(72,35);
        PDF::SetFont('helvetica','',9);
        PDF::Cell(116,4,$postulante->nombre_completo,1,0,'L');
        #CONCEPTO
        PDF::SetXY(18,39);
        PDF::SetFont('helvetica','B',9);
        PDF::Cell(54,4,'Concepto :',1,0,'R');
        PDF::SetXY(72,39);
        PDF::SetFont('helvetica','',9);
        PDF::Cell(116,4,$lblservicio.$servicio->descripcion,1,0,'L');
        #IMPORTE
        PDF::SetXY(18,43);
        PDF::SetFont('helvetica','B',9);
        PDF::Cell(54,4,"Importe :",1,0,'R');
        PDF::SetXY(72,43);
        PDF::SetFont('helvetica','',9);
        PDF::Cell(116,4,"S/. ".$servicio->monto,1,0,'L');
        
        #TITULO INSTRUCCIONES
        PDF::SetXY(18,49);
        PDF::SetFont('helvetica','B',11);
        PDF::SetTextColor(255,0,0);
        PDF::Cell(170,5,"Instrucciones para el postulante",0,0,'L');
        
        #INSTRUCCIONES - Compactadas
        PDF::SetXY(18,55);
        PDF::SetFont('helvetica','',9);
        PDF::SetTextColor(0);
        PDF::MultiCell(170,3.5,"1. Ingresa a la app de YAPE en tu celular y presiona el botón YAPEAR SERVICIOS.",0,'L',false);
        PDF::SetXY(18,58.5);
        PDF::MultiCell(170,3.5,"2. Busca la empresa: UNIVERSIDAD NACIONAL DE INGENIERIA y digitala.",0,'L',false);
        PDF::SetXY(18,62);
        PDF::MultiCell(170,3.5,"3. Presiona PAGO ESTUDIANTES e ingresa tu DNI y verifica el monto S/. ".$servicio->monto,0,'L',false);
        PDF::SetXY(18,65.5);
        PDF::MultiCell(170,3.5,"4. Confirma el pago y listo.",0,'L',false);
        
        PDF::SetXY(18,70);
        PDF::SetFont('helvetica','B',9);
        PDF::SetTextColor(255,0,0);
        
        PDF::SetXY(18,76);
        PDF::SetFont('helvetica','',8);
        PDF::SetTextColor(0);
        PDF::Cell(170,2.5,"El sistema confirmará tu pago dentro en el transcurso del día. Si tienes problemas, contacta a: informes.admision@uni.edu.pe",0,0,'L');
    }
	public function MensajeCepre($postulante,$servicio){
		$msj="";
		$moda=$postulante->idmodalidad;
		

		
		return $msj;
		
	}
	public function CalculoPago($postulante)
	{
		
		$msj="";
		#OBTENER FECHA Y HORA DE CREACION
        $declaracount = DeclaracionEva::where('idpostulante',$postulante->id)->where('estado','APROBADO')->count();

        if( $declaracount > 0){

            $creacion=$postulante->created_at;

            $declarac = DeclaracionEva::where('idpostulante',$postulante->id)->where('estado','APROBADO')->first();
            $creacion = $declarac->updated;
            $dt = Carbon::createFromFormat('Y-m-d H:i:s', $creacion);
            #SUMAMOS 4 HORAS

            $endDate = $dt->addHours(24);

            $horas=$endDate->hour;

            if($horas<6){

                $manday=$endDate->day;
                $mananio=$endDate->year;
                $manmes=$endDate->month;

                $msj='9 A.M. DEL DÍA '.$manday.'-'.$manmes.'-'.$mananio;

            }
            if($horas>=6 && $horas<=17){

                $mananio=$endDate->year;
                $manmes=$endDate->month;
                $manday= $endDate->day;
                $mahour=$endDate->hour;
                $esam=false;
                if($mahour>=12){
                    $esam=false;

                }else { $esam=true;}

                if($mahour>12){

                    $mahour=$mahour-12;

                }

                $manmin=$endDate->minute;

                if($manmin<10){

                    $manmin=$manmin.'0';
                }

                if($esam){

                    $msj=$mahour.':'.$manmin.' A.M. DEL DÍA '.$manday.'-'.$manmes.'-'.$mananio;

                }else {

                    $msj=$mahour.':'.$manmin.' P.M. DEL DÍA '.$manday.'-'.$manmes.'-'.$mananio;
                }






            }


            if($horas>17){


                $manana=$dt->addDays(1);
                $manday=$manana->day;
                $mananio=$manana->year;
                $manmes=$manana->month;

                $msj='9 A.M. DEL DÍA '.$manday.'-'.$manmes.'-'.$mananio;

            }




            return $msj;


        }else {


            return 'NO PUEDE PAGAR YA QUE LA DECLARACIÓN NO ESTÁ APROBADA';


        }

		
				
		
		
		
		
		
	}
	
public function CalculoServiciosFicha($id = null)
    {
        // Obtiene el postulante del usuario actualmente autenticado
        $postulante = Postulante::Usuario()->first();

        if (!$postulante) {
             Log::warning("Postulante no encontrado en CalculoServiciosFicha para Usuario ID: " . (Auth::id() ?? 'N/A'));
             return collect([]);
        }

        #Pago de Prospecto (siempre requerido)
        $pagos = collect(['prospecto'=>'475']);

        // CEPRE-UNI (modalidad 16): Si es ingresante, solo paga prospecto
        // Si no es ingresante, recalcular según su segunda modalidad
        if ($postulante->idmodalidad == 16) {
            if ($postulante->ingresante == true) {
                // Es ingresante CEPRE-UNI, solo paga prospecto
                return $pagos;
            }
            // No es ingresante, usar la segunda modalidad para calcular el pago
            $idmoda = $postulante->idmodalidad2;
            if (is_null($idmoda)) {
                // No tiene segunda modalidad, solo paga prospecto
                return $pagos;
            }
        } else {
            $idmoda = $postulante->idmodalidad;
        }

        #Verificar becas activas
        $descuento_total = Descuento::where('dni',$postulante->numero_identificacion)->Activo()->where('tipo','Total')->first();
        $descuento_parcial = Descuento::where('dni',$postulante->numero_identificacion)->Activo()->where('tipo','Parcial')->first();

        #Determinar gestión (Pública/Privada)
        $gestion_ie = $postulante->gestion_ie ?? 'Pública';

        #Asignación según modalidad y becas
        if ($descuento_total) {
            // Beca total: no paga inscripción
        } elseif ($descuento_parcial) {
            // Semibecas (Servicios 466 y 467)
            if (str_contains($gestion_ie, 'Pública')) {
                $pagos->put('examen', '466'); // INSC. SEMIBECA ESTATAL
            } else {
                $pagos->put('examen', '467'); // INSC. SEMIBECA PRIVADA
            }
        } else {
            // Sin beca - Asignar según modalidad

            // Ordinario (O) / CNE - modalidades 1, 2, 3, 13, 14,23
            if (in_array($idmoda, [1, 2, 3, 13, 14,23])) {
                if (str_contains($gestion_ie, 'Pública')) {
                    $pagos->put('examen', '464'); // INST. EDUC. ESTATAL
                } else {
                    $pagos->put('examen', '465'); // INST. EDUC. PRIVADA
                }
            }
            // Modalidades Extraordinarias (E1DPA, E1DCAN, E1PDI) - modalidades 21, 22, 23
            elseif (in_array($idmoda, [21, 22])) {
                if (str_contains($gestion_ie, 'Pública')) {
                    $pagos->put('examen', '514'); // MODAL.EXTRAOR.COLE.ESTAT
                } else {
                    $pagos->put('examen', '515'); // MODAL.EXTRAOR.COLE.PARTI
                }
            }
            // Traslado Externo (E1TE) - modalidades 7, 19
            elseif (in_array($idmoda, [7, 19])) {
                if (str_contains($gestion_ie, 'Pública')) {
                    $pagos->put('examen', '469'); // INSC. TRASLADO EXT. EST.
                } else {
                    $pagos->put('examen', '470'); // INSC. TRASLADO EXT.PRIV.
                }
                // Convalidación para Traslado
               // $pagos->put('convalidacion', '518'); // CONVAL.CURSO TRASL EXTERN
            }
            // Titulados y Graduados (E1TGU, E1TG) - modalidades 5, 6
            elseif (in_array($idmoda, [5, 6])) {
                $pagos->put('examen', '468'); // INSC. TIT. GRADUADOS
                // Convalidación para Titulados
                //$pagos->put('convalidacion', '519'); // CONVAL.CURSO TITUL/GRADU
            }
            // Bachiller Diplomado (E1DB, E1CABI, E1CD) - modalidades 4, 8, 9, 10
            elseif (in_array($idmoda, [4, 8, 9, 10])) {
                $pagos->put('examen', '473'); // INSC. BACH. DIPLOMADO
            }
        }

        #Pago Vocacional - Arquitectura (ID 1) en cualquiera de las 6 opciones
        $especialidades = [
            $postulante->idespecialidad,
            $postulante->idespecialidad2,
            $postulante->idespecialidad3,
            $postulante->idespecialidad4,
            $postulante->idespecialidad5,
            $postulante->idespecialidad6,
        ];

        if (in_array(1, $especialidades, true)) {
            $pagos->put('voca', '474'); // PRUEBA DE APT. VOCACIONAL
        }

        // Si es CEPRE-UNI y su segunda modalidad es ordinario, verificar vocacional en especialidades de segunda modalidad
        if ($postulante->idmodalidad == 16 && in_array($postulante->idmodalidad2, [1, 2, 3, 13, 14])) {
            $especialidades_segunda_modalidad = [
                $postulante->idespecialidad4,
                $postulante->idespecialidad5,
            ];
            if (in_array(1, $especialidades_segunda_modalidad, true)) {
                $pagos->put('voca', '516'); // PRUEBA VOCACIONAL CEPRE-UNI NO INGRESANTE
            }
        }

        return $pagos;
    } // Fin de CalculoServiciosFicha
	
}
