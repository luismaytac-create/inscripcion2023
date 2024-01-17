<?php

namespace App\Providers;

use App\Models\Catalogo;
use App\Models\Colegio;
use App\Models\Cronograma;
use App\Models\Modalidad;
use App\Models\Postulante;
use App\Models\SinVacante;
use App\Models\Validacion;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
class RulesServiceProvider extends ServiceProvider
{
    public $Mensaje;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->RequiredSchool();
        $this->UniqueSchool();
        $this->RequiredCodCepre();
        $this->RequiredModCepre();
        $this->RequiredEspCepre();
        $this->ValidaCodeCepre();
        $this->ValidaTGUNI();
        $this->ValidaFechaInscripcion();
        $this->ValidaNumeroIdentificacion();
        $this->ValidaNumIdenUsuario();
        $this->ValidaVacantes();
		$this->ValidaDniRegistro();
        #Validacion de datos de familiares
        $this->DniSize();
        $this->DniNumeric();
		
		$this->ValidaNombresString();
		$this->ValidaDniSegunTipo();
		#$this->ValidaDniSegunOrce();
		$this->ValidaFechaNacimiento();
		$this->ValidaNombresFamiString();
		$this->ValidaApoderado();
		$this->ValidaDireccion();
		$this->ValidaTipoDocVal();
        $this->ValidaCelularLong();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function ValidaVacantes()
    {
        Validator::extend('required_vacante', function ($attribute, $value, $parameters, $validator) {
            $sin_vacante = SinVacante::where('idespecialidad',$value)->where('idmodalidad',$parameters[0])->get();
            return $sin_vacante->IsEmpty();
        },"No existe Vacante de esta especialidad en la modalidad que escogio");
    }

	public function ValidaModUniGrad()
    {
        Validator::extend('required_modunigrad', function ($attribute, $value, $parameters, $validator) {
          	 $modauni=Modalidad::where('id',$parameters[0])->first();
		
		
		$correcto=false;
		if($modauni->id =='6'){
		
		$correcto=false;

		}else{
			$correcto=true;

			
			
		}

		return $correcto;
        },"Las inscripciones en esta modalidad empezara hoy");
    }
    public function UniqueSchool()
    {
        Validator::extend('unique_school', function ($attribute, $value, $parameters, $validator) {

            $colegio = Colegio::where('anexo',$value)->where('codigo_modular',$parameters[0])->get();

            return $colegio->IsEmpty();;

        },"El colegio que desea ingresar ya existe");
    }
    public function CodigoExist()
    {
        Validator::extend('codigo_exist', function ($attribute, $value, $parameters, $validator) {
            $correcto = true;
            if (is_array($value)) {
                foreach ($value as $key => $item) {
                    if(strlen($item)<8){
                        $correcto = false;
                        break;
                    }
                }
            } else if(strlen($value)<8)$correcto = false;

            return $correcto;

        },"Uno de los DNI Ingresado no tiene 8 digitos");
    }
    public function DniSize()
    {
        Validator::extend('dni_size', function ($attribute, $value, $parameters, $validator) {
            $correcto = true;
            if (is_array($value)) {
                foreach ($value as $key => $item) {
                    if(strlen($item)<8){
                        $correcto = false;
                        break;
                    }
                }
            } else if(strlen($value)<8)$correcto = false;

            return $correcto;

        },"Uno de los DNI Ingresado no tiene 8 digitos o no has llenado los datos completo de
        (Papá, Mamá o apoderado) los tres registros son obligatorios");
    }
    public function DniNumeric()
    {
        Validator::extend('dni_numeric', function ($attribute, $value, $parameters, $validator) {
            $correcto = true;
            foreach ($value as $key => $item) {
                if(!is_numeric($item)){
                    $correcto = false;
                    break;
                }
            }
            return $correcto;


        },"Uno de los DNI Ingresado contiene un caracter que no es numerico o no has llenado los datos completo de
        (Papá, Mamá o apoderado) los tres registros son obligatorios");
    }
    /**
     * Valido la institucion educativa que requiere la modalidad
     */
    public function ValidaNumIdenUsuario()
    {
        Validator::extend('num_ide_usu', function ($attribute, $value, $parameters, $validator) {

            if (Auth::user()->dni !=$value) return false;
            return true;

        },"El DNI Ingresado es diferente al DNI que usted creo al inicio");
    }
    /**
     * Valido la institucion educativa que requiere la modalidad
     */
    public function ValidaNumeroIdentificacion()
    {
        Validator::extend('num_ide_max', function ($attribute, $value, $parameters, $validator) {
            if (isset($parameters[0])) {
                $tipo = Catalogo::find($parameters[0]);
                if ($tipo->nombre == 'DNI' && strlen($value)!=8) return false;
                return true;
            } else return false;


        },"El DNI ingresado debe contener 8 digitos");
    }
	
	public function ValidaDireccion()
    {
        Validator::extend('direcvalid', function ($attribute, $value, $parameters, $validator) {
            if (isset($parameters[0])) {
               
                if ($parameters[0]==1) return false;
                return true;
            } else return false;


        },"El DNI ingresado debe contener 8 digitos");
    }
	
	
	
	
	public function ValidaNombresString()
    {
        Validator::extend('no_es_numero', function ($attribute, $value, $parameters, $validator) {
			
			
			

           $correcto = true;
		   for($i=0;$i<strlen($value);$i++){ 
				
				if(is_numeric($value{$i})){
					$correcto = false;
                    break;
				}
				
				
			} 
		   
		  
            return $correcto;


        },"Debe ingresar solo letras en sus apellidos y nombres.");
    }
	
	public function ValidaNombresFamiString()
    {
        Validator::extend('letra_fami', function ($attribute, $value, $parameters, $validator) {
			
			
			

           $correcto = true;
		   foreach ($value as $key => $item) {
			   
			  
			   
			   
                if(is_numeric($item)){
                    $correcto = false;
					
                     break;
                }
				
				
				
            }
		   
		   
		   
		   
		   /*for($i=0;$i<strlen($value);$i++){ 
				
				if(is_numeric($value{$i})){
					$correcto = false;
                    break;
				}
				
				
			} */
		   
		  
            return $correcto;


        },"Debe ingresar solo letras en los apellidos y nombres.");
    }
	
	public function ValidaApoderado()
    {
        Validator::extend('apoderado', function ($attribute, $value, $parameters, $validator) {
			
			
			

           $correcto = true;
		   foreach ($value as $key => $item) {
			   
			  
			   
			   
                if(strlen($item)<1){
                    $correcto = false;
					
                     break;
                }
				
				
				
            }
		   
		   
		   
		   
		   /*for($i=0;$i<strlen($value);$i++){ 
				
				if(is_numeric($value{$i})){
					$correcto = false;
                    break;
				}
				
				
			} */
		   
		  
            return $correcto;


        },"Seleccione el parentesco del apoderado.");
    }
	
	
	public function ValidaDniRegistro()
    {
        Validator::extend('dni_regis_val', function ($attribute, $value, $parameters, $validator) {
           $cor=true;
		   
		  
		   if($value>10000){
			   return true;
		   }else {
			   return false;
		   }
		   
		   


        },"El DNI ingresado debe ser válido");
    }
	
	
	public function ValidaDniSegunTipo()
    { 
        Validator::extend('dni_lon_val', function ($attribute, $value, $parameters, $validator) {
           $cor=true;
		  
		   $pamm=$parameters[0];
			if($pamm==1){
				if(strlen($value)==8){
					return true;
				}else { 
				
				return false; }
				
				
				
			}
			if($pamm==2 or $pamm==3 or  $pamm==4 or $pamm==5  ){
				
				if(strlen($value)>8 &&  strlen($value)<13){
					return true;
				}else {
						
				return false; }
				
			}
		   
		   


        },"Verificar el número de dígitos del documento");
    }

    public function ValidaDniSegunOrce()
    { 
        Validator::extend('dni_orce', function ($attribute, $value, $parameters, $validator) {
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://api.examenvirtualuni.com/api/v1/orce',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS =>'{
                "dni":'.$value.'
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 1|18eoY8nfY7F4oCLeEB1GOVVBPqW7RvJAt5XwCc3H',
                'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);
            $r = json_decode($response);
        
            curl_close($curl);
            if($r->result != "Restringido"){
                return true;
            }

        },"Restringido por ORCE");
    }
	
	
    /**
     * Valido la institucion educativa que requiere la modalidad
     */
    public function ValidaFechaInscripcion()
    {
        Validator::extend('fecha_ins', function ($attribute, $value, $parameters, $validator) {
            $date = Carbon::now()->toDateString();
            $fecha_inicio = Cronograma::FechaInicio('INSC');
            $fecha_fin = Cronograma::FechaFin('INEX');

            if($date>=$fecha_inicio && $date<=$fecha_fin) return true;

        },"No esta habilitada la inscripción");
    }
    /**
     * Valido la institucion educativa que requiere la modalidad
     */
    public function RequiredSchool()
    {
        Validator::extend('required_ie', function ($attribute, $value, $parameters, $validator) {

            $modalidad = Modalidad::find($value);
            $retval = false;
            if ($modalidad->colegio && is_numeric($parameters[0])) {
                $retval = true;
            }elseif (!$modalidad->colegio && is_numeric($parameters[1])) {
                $retval = true;
            }

            return $retval;
        },"No escogio institución educativa ");
    }
    /**
     * Valido la institucion educativa que requiere la modalidad
     */
    public function ValidaCodeCepre()
    {

        Validator::extend('valida_cod_cepre', function ($attribute, $value, $parameters, $validator)  {
            if(isset($parameters[0])){
                $modalidad = Modalidad::find($parameters[0]);
                if ($modalidad->codigo =='ID-CEPRE') {
                    $cepre = Validacion::where('codigo',strtoupper($value))->Activos()->first();
                    return !is_null($cepre);
                } else {
                    return true;
                }
            }else{
                return false;
            }


        },"No existe este codigo de cepreuni");
    }
    /**
     * Valido la institucion educativa que requiere la modalidad
     */
    public function ValidaTGUNI()
    {

        Validator::extend('valida_tguni', function ($attribute, $value, $parameters, $validator)  {
            $restringe_modalidad = [5,6,7,10,14,19];
            $restringe_especialidad_6 = [32,33];
            $restringe_especialidad_5 = [2,32,33];
            $restringe_especialidad_7 = [2,32,33];
            $restringe_especialidad_19 = [7,32,33];
            $restringe_especialidad_10 = [2,32,33];
            $restringe_especialidad_14 = [32,33];
            if (in_array($parameters[0], $restringe_modalidad)) {

                switch ($parameters[0]) {
                   // case 7:
                    case 10:
                    case 5:
                        if (in_array($value, $restringe_especialidad_5)) {
                            return false;
                        }else return true;
                        break;
                    case 6:
                        if (in_array($value, $restringe_especialidad_6)) {
                            return false;
                        }else return true;
                        break;
                    case 14:
                        if (in_array($value, $restringe_especialidad_14)) {
                            return false;
                        }else return true;
                        break;
                    case 19:
                        if (in_array($value, $restringe_especialidad_19)) {
                            return false;
                        }else return true;
                        break;
                    
                    default:
                        return true;
                        break;
                }

        

            } else {
                return true;
            }
          
        },"Usted esta escogiendo una especialidad sin vacantes");
    }
    /**
     * Valido si se ha escogido la segunda modalidad
     */
    public function RequiredModCepre()
    {

        Validator::extend('required_mod_cepre', function ($attribute, $value, $parameters, $validator)  {

            $modalidad1 = Modalidad::find($value);
            $modalidad2 = Modalidad::find($parameters[0]);

            $retVal = true;
            if ($modalidad1->codigo =='ID-CEPRE') {
                return !is_null($modalidad2);
            } else {
                $retVal = true;
            }

            return $retVal;

        },"No escogio su segunda modalidad");
    }

    public function ValidaCelularLong()
    {
        Validator::extend('celular_length', function ($attribute, $value, $parameters, $validator) {

            if(strlen($value)==9){
                return true;
            }else {

                return false; }






        },"Verificar el número de dígitos del celular");
    }
    /**
     * Valido si ha ingresado el codigo
     */
    public function RequiredCodCepre()
    {

        Validator::extend('required_cod_cepre', function ($attribute, $value, $parameters, $validator)  {

            $modalidad1 = Modalidad::find($value);

            $retVal = true;
            if ($modalidad1->codigo =='ID-CEPRE') {
                return !is_null($parameters[0]);
            } else {
                $retVal = true;
            }

            return $retVal;

        },"El codigo de cepre UNI es obligatorio");
    }
    /**
     * Valido si ha ingresado la segunda especialidad
     */
    public function RequiredEspCepre()
    {

        Validator::extend('required_esp_cepre', function ($attribute, $value, $parameters, $validator)  {

            $modalidad1 = Modalidad::find($value);

            $retVal = true;
            if ($modalidad1->codigo =='ID-CEPRE') {
                return !is_null($parameters[0]);
            } else {
                $retVal = true;
            }

            return $retVal;

        },"No escogio su segunda especialidad");
    }
	
	
	
	public function ValidaFechaNacimiento()
    {
        Validator::extend('fecha_nacimiento', function ($attribute,$value , $parameters, $validator) {
            return true;
			/*
            $date = "01/01/2007";		
            $your_date = date("Y-m-d", strtotime($date));
            
            $ee = "01/01/1948";		
            $ff = date("Y-m-d", strtotime($ee));
						
            $menores_de_Edad = ['61061599','61054348'];
            if (in_array($parameters[0], $menores_de_Edad)) {
                return true;
            } else {
                if($value>$ff && $value<$your_date) {
                    return true;
                }else {
                    return false;
                }
            }
            */
			
		
        },"Fecha de nacimiento fuera de rango.");
    }


	
	public function ValidaTipoDocVal()
    {
        Validator::extend('tipo_doc_val', function ($attribute, $value, $parameters, $validator) {
           
		   
		  
		   if($value==1 || $value==2 || $value==3 || $value==4 || $value==5 ){
			   return true;
		   }else {
			   return false;
		   }
		   
		   


        },"El tipo de documento no es valido");
    }

}
