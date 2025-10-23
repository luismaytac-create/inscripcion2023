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
        $postulante = Postulante::Usuario()->first();
	
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
	elseif (str_contains($postulante->codigo_modalidad, ['IEN-UNI','TALBE','INTR','SBEC'])
            && str_contains($postulante->gestion_ie,'Pública')) {
            $pagos->put('examen',526);
        }
        elseif (str_contains($postulante->codigo_modalidad, ['IEN-UNI','TALBE','INTR','SBEC'])
            && str_contains($postulante->gestion_ie,'Privada')) {
            $pagos->put('examen',526);
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
        /* if (str_contains($postulante->codigo_modalidad, 'ID-CEPRE') && str_contains($postulante->codigo_especialidad, 'A1')){
            $pagos->put('voca',474);
        }
        if (!str_contains($postulante->codigo_modalidad, ['ID-CEPRE']) && str_contains($postulante->codigo_especialidad, 'A1')){
            $pagos->put('voca',474);
        }

        $date = Carbon::now()->toDateString();
        $fecha_cepere_voca= Cronograma::FechaFin('INCE');

        #if (str_contains($postulante->codigo_especialidad2, 'A1') && $date > $fecha_cepere_voca){

        if (str_contains($postulante->codigo_especialidad4, 'A1') ){
            $pagos->put('voca',474);
        }
            */
        #Pago extemporaneo---------------------------------------------------------------------------------------------------
      //  $date = Carbon::now()->toDateString();
      //  $fecha_inicio = Cronograma::FechaInicio('INEX');
      //  $fecha_fin = Cronograma::FechaFin('INEX');
       // if ($date>=$fecha_inicio && $date<=$fecha_fin && $postulante->fecha_registro>=$fecha_inicio)$pagos->put('extemporaneo',507);

        return $pagos;
    }


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
            $pagos->put('vocacepre',516);
        }

        if (!str_contains($postulante->codigo_modalidad, ['ID-CEPRE','E1VTI','E1VTC']) && str_contains($postulante->codigo_especialidad, 'A1')){
            $pagos->put('voca',474);
        }

        if (str_contains($postulante->codigo_especialidad2, 'A1')){
            #$pagos->put('voca',474);
        }
        #Pago extemporaneo---------------------------------------------------------------------------------------------------
   //     $date = Carbon::now()->toDateString();
    //    $fecha_inicio = Cronograma::FechaInicio('INEX');
     //   $fecha_fin = Cronograma::FechaFin('INEX');
      //  if ($date>=$fecha_inicio && $date<=$fecha_fin && $postulante->fecha_registro>=$fecha_inicio)$pagos->put('extemporaneo',507);

        return $pagos;
    }


public function CalculoServiciosAd($postulante)
    {
        
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
            $pagos->put('vocacepre',516);
        }

        if (!str_contains($postulante->codigo_modalidad, ['ID-CEPRE','E1VTI','E1VTC']) && str_contains($postulante->codigo_especialidad, 'A1')){
            $pagos->put('voca',474);
        }
        $date = Carbon::now()->toDateString();
        $fecha_cepere_voca= Cronograma::FechaFin('INCE');
        if (str_contains($postulante->codigo_especialidad2, 'A1') && $date > $fecha_cepere_voca){
            $pagos->put('voca',474);
        }
        #Pago extemporaneo---------------------------------------------------------------------------------------------------

      //  $fecha_inicio = Cronograma::FechaInicio('INEX');
      //  $fecha_fin = Cronograma::FechaFin('INEX');
      //  if ($date>=$fecha_inicio && $date<=$fecha_fin && $postulante->fecha_registro>=$fecha_inicio)$pagos->put('extemporaneo',507);

        return $pagos;
    }

    public function FormatoScotiabank($servicio,$postulante,$banco)
    {
        switch ($banco) {
            case 'Scotiabank':
                $imagen = asset('assets/pages/img/scotiabank_logo.jpg');
                $lblconcepto = 'Concepto :';
                $lblservicio = ''/*($servicio->codigo+100).' - '*/;
                $lblinstruccion = '3. Debe indicar el pago es al servicio PAGO ESTUDIANTES, luego el DNI POSTULANTE.';
                break;
            case 'Bcp':
                $imagen = asset('assets/pages/img/bcp_logo.jpg');
                $lblconcepto = 'Concepto :';
                $lblservicio = '';
                $lblinstruccion = '3. Si va a pagar en un Agente BCP, debe indicar el código 15226, luego el DNI POSTULANTE.';
                break;
            case 'Financiero':
                $imagen = asset('assets/pages/img/financiero_logo.jpg');
                $lblconcepto = 'Partida :';
                $lblservicio = $servicio->partida.' - ';
                break;
        }
        PDF::SetTitle('RECIBO DE PAGO');
        PDF::AddPage('L','A5');
        #MARCO
        PDF::Rect(15,15, 180,100 );
        #IMAGEN
        PDF::Image($imagen,18,20,40);
        #TITULO
        PDF::SetXY(20,15);
        PDF::SetFont('helvetica','',22);
        PDF::Cell(170,15,"FORMATO DE PAGO",0,0,'C');
        #CCOLOR DEL TEXTO
        PDF::SetTextColor(0);
        #INSTITUCION
        PDF::SetXY(18,40);
        PDF::SetFont('helvetica','B',11);
        PDF::Cell(60,5,'Cuenta :',1,0,'R');
        PDF::SetXY(78,40);
        PDF::SetFont('helvetica','B',10);
        PDF::Cell(110,5,'PAGO ESTUDIANTES',1,0,'L');
        #ETIQUETA NOMBRE DEL ALUMNO
        PDF::SetXY(18,45);
        PDF::SetFont('helvetica','B',11);
        PDF::Cell(60,5,'DNI POSTULANTE',1,0,'R');
        PDF::SetXY(78,45);
        PDF::SetFont('helvetica','',11);
        PDF::Cell(110,5,$postulante->numero_identificacion,1,0,'L');
        #CODIGO CNE
        PDF::SetXY(18,50);
        PDF::SetFont('helvetica','B',11);
        PDF::Cell(60,5,'Nombre del postulante :',1,0,'R');
        PDF::SetXY(78,50);
        PDF::SetFont('helvetica','',11);
        PDF::Cell(110,5,$postulante->nombre_completo,1,0,'L');
        #CONCEPTO
        PDF::SetXY(18,55);
        PDF::SetFont('helvetica','B',11);
        PDF::Cell(60,5,$lblconcepto,1,0,'R');
        PDF::SetXY(78,55);
        PDF::SetFont('helvetica','',11);
        PDF::Cell(110,5,$lblservicio.$servicio->descripcion,1,0,'L');
        #ETIQUETA IMPORTE
        PDF::SetXY(18,60);
        PDF::SetFont('helvetica','B',11);
        PDF::Cell(60,5,"Importe :",1,0,'R');
        PDF::SetXY(78,60);
        PDF::SetFont('helvetica','',11);
        PDF::Cell(110,5,"S/. $servicio->monto ",1,0,'L');
        $pagodatime=$this->CalculoPago($postulante);

		#ADVERTENCIA
		PDF::SetXY(18,65);
        PDF::SetFont('helvetica','B',15);
        PDF::SetTextColor(255,0,0);


        PDF::SetXY(18,70);

	#PDF::Cell(123,5,'PUEDES PAGAR DESDE: '.$pagodatime,0,0,'L');


        if( $pagodatime == 'NO PUEDE PAGAR YA QUE LA DECLARACIÓN NO ESTÁ APROBADA'){
            PDF::MultiCell(150,5,$pagodatime, 0, 'L', false);
         #  PDF::MultiCell(150,5,'ÚLTIMO DÍA DE PAGO 30/07/2021', 0, 'L', false);
        }else {

            if($postulante->idmodalidad==16){
           #     PDF::MultiCell(150,5,$pagodatime, 0, 'L', false);
           #    PDF::MultiCell(150,5,'ÚLTIMO DÍA DE PAGO 27/07/2023', 0, 'L', false);

            }else {
             #    PDF::MultiCell(150,5,'PUEDES PAGAR DESDE: '.$pagodatime, 0, 'L', false);
             #  PDF::MultiCell(150,5,'ÚLTIMO DÍA DE PAGO 27/07/2023', 0, 'L', false);
            }


        }


        PDF::SetXY(18,71);
        PDF::SetFont('helvetica','B',12);
        PDF::SetTextColor(255,0,0);



      #  PDF::MultiCell(170,5,'La aplicación de los exámenes del Concurso de Admisión 2021-1, se desarrollará en forma presencial; pudiéndose optar por otra forma diferente que contemple la situación de emergencia sanitaria y las disposiciones legales del Gobierno Central.',0,'L',false);
		#TITULO INSTRUCCIONES
        PDF::SetXY(18,86);
        PDF::SetFont('helvetica','',15);
        PDF::SetTextColor(255,0,0);
        PDF::Cell(123,5,"Instrucciones para el postulante",0,0,'L');
        #INSTRUCCIONES
        PDF::SetXY(18,92);
        PDF::SetFont('helvetica','',11);
        PDF::SetTextColor(0);
        PDF::Cell(123,0,"1. Verificar que los datos registrados en la parte superior sean los correctos.",0,0,'L');
        PDF::SetXY(18,97);
        PDF::Cell(123,0,"2. Verificar que el nombre sea del postulante y no del apoderado o de quien pague.",0,0,'L');
        PDF::SetXY(18,102);
        PDF::Cell(123,0,$lblinstruccion,0,0,'L');
        
		
		#ADVERTENCIA
		#$mansjCepr=$this->MensajeCepre($postulante,$servicio);
		
        
        
		#PDF::SetXY(18,93);
		#PDF::Cell(123,5,$mansjCepr,0,0,'L');
		#PDF::SetTextColor(255,0,0);
		#	PDF::SetFillColor(255);
		

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
        $postulante = Postulante::Usuario()->first();
    
        #Pago de Prospecto-----------------------------------------------------------------------------------------------
        $pagos = collect(['prospecto'=>'475']); 
        #Pago por derecho de examen---------------------------------------------------------------------------------------

        // Obtener gestión y departamento (Necesario para la lógica de códigos 526-529)
        $gestion_ie = $postulante->gestion_ie ?? 'Privada'; // Asume Privada si no está definido
        $departamento_cole = 'LIMA'; // Asume Lima por defecto
        
        // Verifica si la modalidad requiere info de colegio o universidad
        $modalidadInfo = \App\Models\Modalidad::find($postulante->idmodalidad); // Obtener info de la modalidad
        $usaColegio = $modalidadInfo ? $modalidadInfo->colegio : true; // Asume que usa colegio si no se encuentra modalidad
        
        if ($usaColegio && $postulante->colegio) { // Si usa colegio y la relación está cargada
             $gestion_ie = $postulante->colegio->gestion ?? $gestion_ie; // Usa la gestión del colegio si existe
             if ($postulante->colegio->ubigeo) { 
                $departamento_cole = $postulante->colegio->ubigeo->departamento;
             }
        } else if (!$usaColegio && $postulante->universidad) { // Si usa universidad y la relación está cargada
             $gestion_ie = $postulante->universidad->gestion ?? $gestion_ie; // Usa la gestión de la universidad
             // Para universidades, asumimos lógica de Lima/Callao por defecto en la SQL
             $departamento_cole = 'LIMA'; 
        }
        $grupo1_codigos = ['O','E1DPA','E1DCAN','E1PDI','E1PDC','ID-CEPRE', 'TALBE', 'IEN-UNI', /* Añade el código real para mod 23 aquí */];
        $grupo2_codigos = ['E1DB','E1CABC','E1CABI','E1CD'];
        $grupo3_codigos = ['E1TE']; // str_contains funciona aquí porque solo es una cadena
        $grupo4_codigos = ['E1TG','E1TGU'];

        // Grupo 1: Ordinario, CEPRE, ..., TALBE(21), IEN-UNI(17), Mod 23, etc. (Usan 526/528/527/529)
        if (in_array($postulante->codigo_modalidad, $grupo1_codigos)) { // <-- CORREGIDO a in_array() e incluye IEN-UNI
            if (str_contains($gestion_ie,'Pública')) {
                if ($departamento_cole == 'LIMA' || $departamento_cole == 'CALLAO') {
                     $pagos->put('examen','526'); // ING.DIR.ESC.EST.LIMA-CALL
                } else {
                     $pagos->put('examen','528'); // ING.DIR.ESC.EST.PROV
                }
            } elseif (str_contains($gestion_ie,'Privada')) {
                 // Según tu dd(), gestión es Privada y Depto es LIMA. Debería asignar 527.
                if ($departamento_cole == 'LIMA' || $departamento_cole == 'CALLAO') {
                     $pagos->put('examen','527'); // ING.DIR.ESC.PRI.LIMA-CALL
                } else {
                     $pagos->put('examen','529'); // ING.DIR.ESC.PRI.PROV
                }
            }
        }
        // Grupo 2: Diplomado, Convenios (usan 473)
        elseif (in_array($postulante->codigo_modalidad, $grupo2_codigos)) { // <-- CORREGIDO a in_array()
            $pagos->put('examen','473'); 
             // Pago de segunda modalidad si aplica
            if (!is_null($postulante->codigo_modalidad2) && in_array($postulante->codigo_modalidad2, $grupo2_codigos)) {
                $pagos->put('examen2','473');
            }
        }
        // Grupo 3: Traslado Externo (usan 469/470) - str_contains está bien aquí si el código SIEMPRE contiene 'E1TE'
        elseif (str_contains($postulante->codigo_modalidad, 'E1TE')) { 
            if (str_contains($gestion_ie,'Pública')) {
                $pagos->put('examen','469');
            } elseif (str_contains($gestion_ie,'Privada')) {
                 $pagos->put('examen','470');
            }
            // Pago de segunda modalidad si aplica
            if (!is_null($postulante->codigo_modalidad2) && str_contains($postulante->codigo_modalidad2, 'E1TE')) {
                if (str_contains($gestion_ie,'Pública')) {
                    $pagos->put('examen2','469');
                } elseif (str_contains($gestion_ie,'Privada')) {
                    $pagos->put('examen2','470');
                }
            }
        }
        // Grupo 4: Titulado o Graduado (usan 468)
        elseif (in_array($postulante->codigo_modalidad, $grupo4_codigos)) { // <-- CORREGIDO a in_array()
            $pagos->put('examen','468');
            // Pago de segunda modalidad si aplica (comentado en tu código original)
           # if (!is_null($postulante->codigo_modalidad2) && in_array($postulante->codigo_modalidad2, $grupo4_codigos))
             #   $pagos->put('examen2','468'); 
        }
        // Aquí podrías añadir un 'else' para modalidades no contempladas si fuera necesario

        #Descuentos (sin cambios)
        $descuento = Descuento::where('dni',$postulante->numero_identificacion)->Activo()->first();
        if (isset($descuento)) {
            $pagos->pull('examen'); 
            if($descuento->tipo=='Parcial')$pagos->put('examen',$descuento->servicio); 
        }

        #Pago por examen vocacional (sin cambios, pero revisa la lógica vs CalculoServicios)
        /*if (str_contains($postulante->codigo_modalidad, 'ID-CEPRE') && str_contains($postulante->codigo_especialidad, 'A1')){
            $pagos->put('vocacepre','474'); 
        }

        if (!str_contains($postulante->codigo_modalidad, ['ID-CEPRE']) && str_contains($postulante->codigo_especialidad, 'A1')){
            $pagos->put('voca','474'); 
        }

        if (str_contains($postulante->codigo_especialidad4, 'A1') && !str_contains($postulante->codigo_modalidad, 'ID-CEPRE') ){
            $pagos->put('voca','474'); 
        }*/
        
        #Pago extemporaneo (sin cambios)
        // ... (código comentado) ...

        return $pagos;
    }
	
}
