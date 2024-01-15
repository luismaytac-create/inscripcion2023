<?php

namespace App\Models;

use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class Postulante extends Model
{
    protected $table = 'postulante';
    protected $fillable = ['idevaluacion', 'codigo','codigo_verificacion','paterno','materno','nombres','idtipoidentificacion',
            'numero_identificacion','email','talla','peso','idsexo','telefono_celular','telefono_fijo','telefono_varios',
            'idmodalidad','idespecialidad','idmodalidad2','idespecialidad2','idpais','idubigeo','direccion','idcolegio','iduniversidad',
            'fecha_nacimiento','idpaisnacimiento','idubigeonacimiento',
            'idubigeoprovincia','direccion_provincia','telefono_provincia',
            'foto_cargada','foto_editada','foto_rechazada','foto_estado','foto_fecha_carga','foto_fecha_rechazo','foto_fecha_edicion',
            'idaula1','idaula2','idaula3','idaulavoca','anulado','datos_ok','fecha_registro','idusuario','inicio_estudios','fin_estudios','pago','fecha_pago','fecha_conformidad','idsede','foto_dni','idusuarioeditor','sisfoh','magisterio'
                ,'idespecialidad3','idespecialidad4','idespecialidad5','idespecialidad6','idfacultad','idfacultad2','idturnopiloto'
        ,'foto_fecha_subida','foto_fecha_editor','ficha_fecha','discapacidad','cuarta_df'];

    /**
    * Atributos Tipo de Identificacion
    */
    public function getTipoIdentificacionAttribute()
    {
        $tipo = Catalogo::find($this->idtipoidentificacion);
        return $tipo->nombre;
    }
    /**
     * Opciones del select de Inicio de secundaria
     * @return [type] [description]
     */
    public function getInicioEstudiosOptions()
    {
        $date = Carbon::now()->subYear(3);
        for ($i=1970; $i < $date->year+1; $i++) {
            $data[$i]= $i;
        }
        return $data;
    }
    /**
     * Opciones del select de fin de secundaria
     * @return [type] [description]
     */
    public function getFinEstudiosOptions()
    {
        $date = Carbon::now();
        for ($i=1970; $i <= $date->year+2; $i++) {
            $data[$i]= $i;
        }
        return $data;
    }
    /**
    * Atributos Telefonos
    */
    public function getTelefonosAttribute()
    {
        $telefonos = '';
        if(!is_null($this->telefono_celular))$telefonos .=$this->telefono_celular;
        if(!is_null($this->telefono_fijo))$telefonos .= ' - '.$this->telefono_fijo;
        if(!is_null($this->telefono_varios))$telefonos .= ' - '.$this->telefono_varios;

        return $telefonos;
    }
    /**
    * Atributos Tipo de identificacion
    */
    public function getIdentificacionAttribute()
    {
        $tipo = Catalogo::find($this->idtipoidentificacion);
        return $tipo->nombre.' N° '.$this->numero_identificacion;
    }
    /**
    * Atributos Foto
    */
    public function getFotoAttribute()
    {
        if(is_null($this->foto_editada)) return $this->foto_cargada;
        else return $this->foto_editada;
    }
    /**
    * Atributos Gestion IE
    */
    public function getGestionIeAttribute()
    {
        $modalidad = Modalidad::find($this->idmodalidad);
        if ($modalidad->colegio) $ie = Colegio::find($this->idcolegio);
        else $ie = Universidad::find($this->iduniversidad);

        return $ie->gestion;
    }
    /**
    * Atributos Gestion IE
    */
    public function getInstitucionEducativaAttribute()
    {
        $modalidad = Modalidad::find($this->idmodalidad);
        if ($modalidad->colegio) $ie = Colegio::find($this->idcolegio);
        else $ie = Universidad::find($this->iduniversidad);

        return $ie->nombre;
    }
	
	public function getInstitucionEducaAttribute()
    {
        $modalidad = Modalidad::find($this->idmodalidad);
        if ($modalidad->colegio) $ie = Colegio::find($this->idcolegio);
        else $ie = Universidad::find($this->iduniversidad);

        return $ie;
    }
	
	
    /**
    * Atributos Codigo Modalidad
    */
    public function getCodigoModalidadAttribute()
    {
        $modalidad = Modalidad::find($this->idmodalidad);
        return $modalidad->codigo;
    }
    /**
    * Atributos Codigo Modalidad 2
    */
    public function getCodigoModalidad2Attribute()
    {
        if(isset($this->idmodalidad2)){
            $modalidad = Modalidad::find($this->idmodalidad2);
            return $modalidad->codigo;
        }else return '---';
    }
    /**
    * Atributos Nombre Modalidad
    */
    public function getNombreModalidadAttribute()
    {
        $modalidad = Modalidad::find($this->idmodalidad);
        return $modalidad->nombre;
    }
    /**
    * Atributos Nombre Modalidad 2
    */
    public function getNombreModalidad2Attribute()
    {
        $modalidad = Modalidad::find($this->idmodalidad2);
        if(!isset($modalidad)){
            $modalidad = new Modalidad(['nombre'=>'---','gestion'=>'---']);
        }
        return $modalidad->nombre;
    }
    /**
    * Atributos Ha Pagado
    */
    public function getHaPagadoAttribute()
    {
        if($this->pago)return 'SI';
        else return 'NO';
    }
    /**
    * Atributos Datos Aula para el dia 1 del examen
    */
    public function getDatosAulaUnoAttribute()
    {
        $aula = Aula::find($this->idaula1);
        if(!isset($aula)){
            $aula = new Aula(['codigo'=>'--','sector'=>'--']);
        }
        return $aula;
    }
    /**
    * Atributos Datos Aula para el dia 2 del examen
    */
    public function getDatosAulaDosAttribute()
    {
        $aula = Aula::find($this->idaula2);
        if(!isset($aula)){
            $aula = new Aula(['codigo'=>'--','sector'=>'--']);
        }
        return $aula;
    }
    /**
    * Atributos Datos Aula para el dia 3 del examen
    */
    public function getDatosAulaTresAttribute()
    {
        $aula = Aula::find($this->idaula3);
        if(!isset($aula)){
            $aula = new Aula(['codigo'=>'--','sector'=>'--']);
        }
        return $aula;
    }
    /**
    * Atributos Datos Aula para el vocacional
    */
    public function getDatosAulaVocaAttribute()
    {
        $aula = Aula::find($this->idaulavoca);
        if(!isset($aula)){
            $aula = new Aula(['codigo'=>'--','sector'=>'--']);
        }
        return $aula;
    }
    /**
    * Atributos Datos Colegio
    */
    public function getDatosColegioAttribute()
    {
        if (isset($this->idcolegio)) {
            $colegio = Colegio::find($this->idcolegio);
        }else{
            $colegio = new Colegio(['nombre'=>'---']);
        }
        return $colegio;
    }
    /**
    * Atributos Datos Universidad
    */
    public function getDatosUniversidadAttribute()
    {
        if (isset($this->iduniversidad)) {
            $universidad = Universidad::find($this->iduniversidad);
        }else{
            $universidad = new Universidad(['nombre'=>'---']);
        }
        return $universidad;
    }
    /**
    * Atributos Nombre Especialidad
    */
    public function getNombreEspecialidadAttribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad);
        return $especialidad->nombre;
    }
    public function getNombreEspecialidad3Attribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad3);
        if(!isset($especialidad)){
            $especialidad = new Especialidad(['nombre'=>'---']);
        }

        return $especialidad->nombre;
    }

    public function getNombreEspecialidad4Attribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad4);
        if(!isset($especialidad)){
            $especialidad = new Especialidad(['nombre'=>'---']);
        }

        return $especialidad->nombre;
    }
    public function getNombreEspecialidad5Attribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad5);
        if(!isset($especialidad)){
            $especialidad = new Especialidad(['nombre'=>'---']);
        }

        return $especialidad->nombre;
    }
    public function getNombreEspecialidad6Attribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad6);
        if(!isset($especialidad)){
            $especialidad = new Especialidad(['nombre'=>'---']);
        }

        return $especialidad->nombre;
    }











    /**
    * Atributo Canal
    */
    public function getCanalAttribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad);

        return $especialidad->canal;
    }
    /**
    * Atributos Codigo Especialidad
    */
    public function getCodigoEspecialidadAttribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad);
        return $especialidad->codigo;
    }
    /**
    * Atributos Nombre Segunda Especialidad
    */
    public function getNombreEspecialidad2Attribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad2);
        if(!isset($especialidad)){
            $especialidad = new Especialidad(['nombre'=>'---']);
        }

        return $especialidad->nombre;
    }
    /**
    * Atributos Codigo Segunda Especialidad
    */
    public function getCodigoEspecialidad2Attribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad2);
        if(!isset($especialidad)){
            $especialidad = new Especialidad(['codigo'=>'---']);
        }
        return $especialidad->codigo;
    }


    public function getCodigoEspecialidad3Attribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad3);
        if(!isset($especialidad)){
            $especialidad = new Especialidad(['codigo'=>'---']);
        }
        return $especialidad->codigo;
    }
    public function getCodigoEspecialidad4Attribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad4);
        if(!isset($especialidad)){
            $especialidad = new Especialidad(['codigo'=>'---']);
        }
        return $especialidad->codigo;
    }
    public function getCodigoEspecialidad5Attribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad5);
        if(!isset($especialidad)){
            $especialidad = new Especialidad(['codigo'=>'---']);
        }
        return $especialidad->codigo;
    }
    public function getCodigoEspecialidad6Attribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad6);
        if(!isset($especialidad)){
            $especialidad = new Especialidad(['codigo'=>'---']);
        }
        return $especialidad->codigo;
    }
    /**
    * Atributos Ubigeo
    */
    public function getDescripcionUbigeoAttribute()
    {
        if (isset($this->idpais)) $pais = Pais::find($this->idpais);
        else $pais = new Pais(['nombre'=>'---']);

        $ubigeo = Ubigeo::find($this->idubigeo);
        $lugar = '';
        if(is_null($ubigeo)){
            $ubigeo = New Ubigeo(['descripcion'=>'']);
            $lugar = $pais->nombre;
        }else{
            $lugar = $pais->nombre.'/'.$ubigeo->descripcion;
            $lugar = str_replace('/',' / ',$lugar);
        }

        return $lugar;
    }
    /**
    * Atributos Ubigeo Nacimiento
    */
    public function getDescripcionUbigeoNacimientoAttribute()
    {
        if (isset($this->idpaisnacimiento)) $pais = Pais::find($this->idpaisnacimiento);
        else $pais = new Pais(['nombre'=>'---']);

        $ubigeo = Ubigeo::find($this->idubigeonacimiento);
        $lugar = '';
        if(is_null($ubigeo)){
            $ubigeo = New Ubigeo(['descripcion'=>'']);
            $lugar = $pais->nombre;
        }else{

            $lugar = $pais->nombre.'/'.$ubigeo->descripcion;
            $lugar = str_replace('/',' / ',$lugar);
        }

        return $lugar;
    }
    /**
    * Atributos Ubigeo Provincia
    */
    public function getDescripcionUbigeoProvinciaAttribute()
    {
        if (isset($this->idpais)) $pais = Pais::find($this->idpais);
        else $pais = new Pais(['nombre'=>'---']);

        $ubigeo = Ubigeo::find($this->idubigeoprovincia);
        $lugar = '';
        if(is_null($ubigeo)){
            $ubigeo = New Ubigeo(['descripcion'=>'']);
            $lugar = '---';
        }else{

            $lugar = $pais->nombre.'/'.$ubigeo->descripcion;
            $lugar = str_replace('/',' / ',$lugar);
        }

        return $lugar;
    }
    /**
    * Atributos Datos Evaluacion
    */
    public function getDatosEvaluacionAttribute()
    {
        $evaluacion = Evaluacion::find($this->idevaluacion);
        return $evaluacion;
    }
    /**
    * Atributos Sede
    */
    public function getSedeAttribute()
    {
        $sede = Catalogo::find($this->idsede);
        if(is_null($sede))$sede = New Catalogo(['nombre'=>'---']);
        return strtoupper($sede->nombre);
    }
    /**
    * Atributos Foto
    */
    public function getMostrarFotoEditadaAttribute()
    {
        if(Storage::exists('public/'.$this->foto_editada) && isset($this->foto_editada))
        $foto = asset('/storage/'.$this->foto_editada);
        else $foto = false;

        return $foto;
    }
    /**
    * Atributos Foto
    */
    public function getMostrarFotoCargadaAttribute()
    {
        if(Storage::exists('public/'.$this->foto_cargada) && isset($this->foto_cargada))
        $foto = asset('/storage/'.$this->foto_cargada);
        else $foto = false;

        return $foto;
    }
    /**
    * Atributos Foto
    */
    public function getMostrarFotoRechazadaAttribute()
    {
        if(Storage::exists('public/'.$this->foto_rechazada) && isset($this->foto_rechazada))
        $foto = asset('/storage/'.$this->foto_rechazada);
        else $foto = false;

        return $foto;
    }


    /**
    * Atributos Sexo
    */
    public function getPrefijoSexoAttribute()
    {
        if(isset($this->idsexo)){
            $sexo = Catalogo::find($this->idsexo);
            $prefijo = ($sexo->nombre=='Masculino') ? 'El Sr.' : 'La Srta.' ;
            return $prefijo;
        }else return '--';
    }
    /**
    * Atributos Sexo
    */
    public function getSexoAttribute()
    {
        if(isset($this->idsexo)){
            $sexo = Catalogo::find($this->idsexo);
            return $sexo->nombre;
        }else return '--';
    }
    /**
    * Atributos Nombre Completo
    */
    public function getNombreCompletoAttribute()
    {
        $nombre = $this->paterno.' '.$this->materno.','.$this->nombres;
        return $nombre;
    }

    public function getApellidosCompletoAttribute()
    {
        $nombre = $this->paterno.' '.$this->materno;
        return $nombre;
    }
    /**
    * Atributos Nombre Completo
    */
    public function getNombreClienteAttribute()
    {
        $paterno = strtoupper(str_clean($this->paterno));
        $materno = strtoupper(str_clean($this->materno));
        $nombres = strtoupper(str_clean($this->nombres));

        $nombre = $paterno.' '.$materno.' '.$nombres;
        return $nombre;
    }
    /**
    * Atributos Edad del postulante
    */
    public function getEdadAttribute()
    {
        if(isset($this->fecha_nacimiento))$edad = Carbon::createFromFormat('Y-m-d',$this->fecha_nacimiento)->age;
        else $edad = 0;

        return $edad;
    }
    /**
    * Atributos estado de  Alumno
    */
    public function getEstadoPagoAttribute()
    {
        if ($this->pago) {
           return '<span class="label label-sm label-info"> SI </span>';
        }else{
           return '<span class="label label-sm label-danger"> NO </span>';
        }
    }
    /**
    * Atributos estado de  Alumno
    */
    public function getEstadoAnuladoAttribute()
    {
        if ($this->anulado) {
           return '<span class="label label-sm label-info"> SI </span>';
        }else{
           return '<span class="label label-sm label-danger"> NO </span>';
        }
    }
    /**
     * Atributos Paterno
     */
    public function setPaternoAttribute($value)
    {
        $this->attributes['paterno'] = trim(mb_strtoupper($value, 'UTF-8'));
    }
    /**
     * Atributos Paterno
     */
    public function setMaternoAttribute($value)
    {
        $this->attributes['materno'] = trim(mb_strtoupper($value, 'UTF-8'));
    }
    /**
     * Atributos Paterno
     */
    public function setNombresAttribute($value)
    {
        $this->attributes['nombres'] = trim(mb_strtoupper($value, 'UTF-8'));
    }

    /**
     * Atributos Foto
     */
    public function setFotoCargadaAttribute($value)
    {
        $this->attributes['foto_cargada'] = $value;
        if (Auth::user()->idrole == IdRole('alum')) {
            User::where('id',Auth::user()->id)->update(['foto'=>$value]);
        }
    }
    /**
     * Atributos Email
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = $value;
         // User::where('id',Auth::user()->id)->update(['email'=>$value]);
    }
    #####################################################################################################################################################################
    #SCOPES
    #####################################################################################################################################################################
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeUsuario($cadenaSQL){
        $id = Auth::user()->id;
        return $cadenaSQL->where('idusuario',$id);
    }

	/**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeUsuarioxx($cadenaSQL,$id){
        
        return $cadenaSQL->where('id',$id);
    }
	
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeActivos($cadenaSQL){
        $evaluacion = Evaluacion::Activo()->first();
        return $cadenaSQL->where('idevaluacion',$evaluacion->id);
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeIsNull($cadenaSQL,$estado = 1){
        return $cadenaSQL->where('postulante.anulado',$estado);
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopePago($cadenaSQL,$sw = 1){
        return $cadenaSQL->where('pago',$sw);
    }
    /**
    * Devuelve los postulantes Activos no anulados
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopePagantes($cadenaSQL,$pago = 0){
        return $cadenaSQL->Activos()->isNull(0)->where('pago',$pago);
    }
    /**
    * Es llamado por el controlador HomeController
    *
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeResumen($cadenaSQL){
        return $cadenaSQL->select('fecha_registro',DB::raw('count(*) as cantidad'))
                         ->Activos()
                         ->isNull(0)
                         ->groupBy('fecha_registro');
    }
    /**
    * Es llamado por el controlador HomeController
    *
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeResumenPago($cadenaSQL,$pagos){
        return $cadenaSQL->select('fecha_registro',DB::raw('count(*) as cantidad'))
                         ->Pagantes($pagos)
                         ->groupBy('fecha_registro');
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeAlfabetico($cadenaSQL){
        return $cadenaSQL->orderBy('paterno')->orderBy('materno')->orderBy('nombres');
    }
    /**
    * Devuelve los postulantes que deben pagar prospecto
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeProspecto($cadenaSQL){
        $dni_pagos = Recaudacion::select('codigo')->where('servicio','475')->get();
        $declaracion = DeclaracionEva::select('idpostulante')->where('estado','APROBADO')->get();
        
        $documentos = SolicitanteVictima::select('idpostulante')->where('estado','<>','APROBADO')->get();
        $quitar_cartera = QuitarCartera::select('id')->get();
        $orden_pago = OrdenPago::select('idpostulante')->where('servicio','475')->get();

        return $cadenaSQL->select('postulante.*')
                        ->join('proceso as r','r.idpostulante','=','postulante.id')
                        ->whereIn('postulante.id',$declaracion->toArray())
                        ->whereNotIn('postulante.numero_identificacion',$dni_pagos->toArray())
                        ->whereNotIn('postulante.id',$orden_pago->toArray())
                        ->where('idmodalidad','<>',18)
                        ->where('r.pago_prospecto',0);
    }
    /**
    * Devuelve los postulantes que deben pagar Examen Vocacional
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopePagoVocacional($cadenaSQL){
        $dni_pagos = Recaudacion::select('codigo')->where('servicio','475')->get();
        $declaracion = DeclaracionEva::select('idpostulante')->where('estado','APROBADO')->get();
        $orden_pago = OrdenPago::select('idpostulante')->where('servicio','474')->get();

        return $cadenaSQL->select('postulante.*')
                        ->join('proceso as r','r.idpostulante','=','postulante.id')
                        ->whereIn('postulante.id',$declaracion->toArray())
                        ->whereNotIn('postulante.numero_identificacion',$dni_pagos->toArray())
                        ->whereNotIn('postulante.id',$orden_pago->toArray())
                        ->where('idespecialidad',1)
                        ->where('idmodalidad','<>',18);
    }

    public function scopePagoBachillerato($cadenaSQL){
        $dni_pagos = Recaudacion::select('codigo')->where('servicio','473')->get();
        $declaracion = DeclaracionEva::select('idpostulante')->where('estado','APROBADO')->get();
        $orden_pago = OrdenPago::select('idpostulante')->where('servicio','473')->get();
        $documentos = SolicitanteVictima::select('idpostulante')->where('estado','APROBADO')->get();

        return $cadenaSQL->select('postulante.*')
                        ->join('proceso as r','r.idpostulante','=','postulante.id')
                        ->whereIn('postulante.id',$declaracion->toArray())
                        ->whereIn('postulante.id',$documentos->toArray())
                        ->whereNotIn('postulante.numero_identificacion',$dni_pagos->toArray())
                        ->whereNotIn('postulante.id',$orden_pago->toArray())
                        ->whereIn('idmodalidad',[4,8,9,10])
                        ->where('idmodalidad','<>',18);
    }
	
	
	 public function scopeIngreso($cadenaSQL){
		 $dni_pagos = Recaudacion::select('codigo')->where('servicio','517')->get();
        return $cadenaSQL->select('postulante.*')
                         ->join('resultados.cartera_ingresantes as r','r.dni','=','postulante.numero_identificacion')
						 ->whereNotIn('postulante.numero_identificacion',$dni_pagos->toArray());
                         
    }
	
	public function scopePagoTraslados($cadenaSQL,$gestion,$modalidad){
		 $dni_pagos = Recaudacion::select('codigo')->whereIn('servicio',['469','470'])->get();
         $orden_pago = OrdenPago::select('idpostulante')->whereIn('servicio',['469','470'])->get();
         $declaracion = DeclaracionEva::select('idpostulante')->where('estado','APROBADO')->get();
         $documentos = SolicitanteVictima::select('idpostulante')->where('estado','APROBADO')->get();

        return $cadenaSQL->select('postulante.*')
                        ->join('universidad as u','u.id','=','postulante.iduniversidad')
                        ->join('modalidad as m','m.id','=','postulante.idmodalidad')
                        ->whereIn('m.codigo',$modalidad)
                        ->where('u.gestion',$gestion)
                        ->whereIn('postulante.id',$declaracion->toArray())
                        ->whereIn('postulante.id',$documentos->toArray())
                        ->whereNotIn('postulante.id',$orden_pago->toArray())
                        ->whereNotIn('postulante.numero_identificacion',$dni_pagos->toArray())
                        ->where('postulante.pago',0);
                         
    }
	public function scopePagoTitulados($cadenaSQL,$gestion,$modalidad){
		 $dni_pagos = Recaudacion::select('codigo')->where('servicio','468')->get();
         $orden_pago = OrdenPago::select('idpostulante')->where('servicio','468')->get();
         $declaracion = DeclaracionEva::select('idpostulante')->where('estado','APROBADO')->get();
         $documentos = SolicitanteVictima::select('idpostulante')->where('estado','APROBADO')->get();

        return $cadenaSQL->select('postulante.*')
                        ->join('universidad as u','u.id','=','postulante.iduniversidad')
                        ->join('modalidad as m','m.id','=','postulante.idmodalidad')
                        ->whereIn('m.codigo',$modalidad)
                        ->whereIn('u.gestion',$gestion)
                        ->whereIn('postulante.id',$declaracion->toArray())
                        ->whereIn('postulante.id',$documentos->toArray())
                        ->whereNotIn('postulante.id',$orden_pago->toArray())
                        ->whereNotIn('postulante.numero_identificacion',$dni_pagos->toArray())
                        ->where('postulante.pago',0);
                         
    }

	public function scopeTrasladosIngresantes($cadenaSQL){
		 $dni_pagos = Recaudacion::select('codigo')->where('servicio','518')->get();
         $orden_pago = OrdenPago::select('idpostulante')->where('servicio','518')->get();
        return $cadenaSQL->select('postulante.*')
                         #->join('resultados.cartera_ingresantes as r','r.dni','=','postulante.numero_identificacion')
			            #->where('r.adicional1','=','SI')
                         ->whereNotIn('postulante.id',$orden_pago->toArray())
						 ->whereNotIn('postulante.numero_identificacion',$dni_pagos->toArray());
                         
    }
	public function scopeTituladosIngresantes($cadenaSQL){
		$dni_pagos = Recaudacion::select('codigo')->where('servicio','519')->get();
        $orden_pago = OrdenPago::select('idpostulante')->whereIn('servicio',['519'])->get();
        return $cadenaSQL->select('postulante.*')
                         #->join('resultados.cartera_ingresantes as r','r.dni','=','postulante.numero_identificacion')
			 #			 ->where('r.adicional2','=','SI')
                         ->whereNotIn('postulante.id',$orden_pago->toArray())
                         ->whereNotIn('postulante.numero_identificacion',$dni_pagos->toArray());
                         
    }

	
    /**
    * Devuelve relacion de postulantes de un tipo de colegio y gestion
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopePagoGestion($cadenaSQL,$ie=null,$gestion=null,$modalidad = null,$codesp=null,$cep=null)
    {
        $dni_descuentos = Descuento::select('dni')->where('activo',1)->get();
		$dni_pagosarq = Recaudacion::select('codigo')->where('servicio','474')->get();
		$dni_pagoscolepriv = Recaudacion::select('codigo')->where('servicio','465')->get();
		$dni_pagoscolestatal = Recaudacion::select('codigo')->where('servicio','464')->get();
		$dni_pagosdiplomado = Recaudacion::select('codigo')->where('servicio','473')->get();
        $dni_solic_sem = Solicitante::select('dni')->whereNull('otorga')->get();
        $dnisss = Pagg::select('dni')->get();
        $arcarte = DB::table("vista_pagovocc")->select('dni')->get();
        #$pagararqqq = DB::table("deben_pagar_Arqui")->select('dni')->get();
        $pagos_arqui_nocepre = PagoVocaOrdi::select('codigo')->get();
        $declaracion = DeclaracionEva::select('idpostulante')->where('estado','APROBADO')->get();
        $documentos = SolicitanteVictima::select('idpostulante')->where('estado','<>','APROBADO')->get();
        $quitar_cartera = QuitarCartera::select('id')->get();
        $orden_pago = OrdenPago::select('idpostulante')->whereIn('servicio',['464','465'])->get();
        if($ie=='Colegio'){
            return $cadenaSQL->select('postulante.*')
                             ->join('colegio as c','c.id','=','postulante.idcolegio')
                             ->join('modalidad as m','m.id','=','postulante.idmodalidad')
                             ->whereIn('m.codigo',$modalidad)
                             ->whereIn('postulante.id',$declaracion->toArray())
                             ->whereNotIn('postulante.numero_identificacion',$dni_descuentos->toArray())
							 ->whereNotIn('postulante.numero_identificacion',$dni_pagoscolepriv->toArray())
							 ->whereNotIn('postulante.numero_identificacion',$dni_pagoscolestatal->toArray())
                             ->whereNotIn('postulante.id',$documentos->toArray())
                            ->whereNotIn('postulante.id',$orden_pago->toArray())
                             ->where('c.gestion',$gestion)
                            ->where('postulante.pago',0)
            ;
        }elseif ($ie=='Universidad' && isset($modalidad)) {
            return $cadenaSQL->select('postulante.*')
                             ->join('universidad as u','u.id','=','postulante.iduniversidad')
                             ->join('modalidad as m','m.id','=','postulante.idmodalidad')
                             ->whereIn('m.codigo',$modalidad)
                             ->whereIn('u.gestion',$gestion)
                             ->whereIn('postulante.id',$declaracion->toArray())
                             ->whereNotIn('postulante.numero_identificacion',$dni_descuentos->toArray())
                             ->whereNotIn('postulante.id',$documentos->toArray())
                            ->whereNotIn('postulante.id',$quitar_cartera->toArray())
                            ->whereNotIn('postulante.id',$orden_pago->toArray())
                             ->where('postulante.anulado',0)
                             ->where('postulante.pago',0);

        }elseif (!isset($ie) && isset($modalidad)) {
            return $cadenaSQL->select('postulante.*')
                             ->join('modalidad as m','m.id','=','postulante.idmodalidad')
                            ->whereIn('m.codigo',$modalidad)
                            ->whereIn('postulante.id',$declaracion->toArray())
                            ->whereNotIn('postulante.numero_identificacion',$dni_pagosdiplomado->toArray())
                            ->whereNotIn('postulante.numero_identificacion',$dni_descuentos->toArray())
                             ->whereNotIn('postulante.id',$documentos->toArray())
                             ->whereNotIn('postulante.id',$quitar_cartera->toArray())
                            ->whereNotIn('postulante.id',$orden_pago->toArray())
                            ->where('postulante.anulado',0)
                            ->where('postulante.pago',0);
        }elseif (isset($codesp) && !isset($cep) ) {
            $datexx = Carbon::now()->toDateString();
            $fecha_cepere_voca= Cronograma::FechaFin('INCE');
            if( false ){
                # if( $datexx <= $fecha_cepere_voca ){
                return $cadenaSQL->select('postulante.*')
                    ->join('especialidad as e',function($join){
                    $join->on('postulante.idespecialidad','=','e.id')->where('postulante.idmodalidad','<>',22);
                        })->where('e.codigo',$codesp)

                    #>whereNotIn('postulante.numero_identificacion',$dni_descuentos->toArray())
                    ->where('postulante.anulado',0)
                    ->whereNotIn('postulante.id',$declaracion->toArray())
                    ->whereIn('postulante.id',$documentos->toArray())
                    ->whereNotIn('postulante.numero_identificacion', $pagos_arqui_nocepre->toArray())
                    ->whereNotIn('postulante.id',$orden_pago->toArray())

                    ->whereNotIn('postulante.id',$quitar_cartera->toArray());
                    #->where('postulante.pago',0);
            }else {
                return $cadenaSQL->select('postulante.*')
                        ->join('especialidad as e',function($join){
                        $join->on('postulante.idespecialidad','=','e.id')
                            ->orOn('postulante.idespecialidad4','=','e.id');
                        })->where('e.codigo',$codesp)
                            ->whereNotIn('postulante.numero_identificacion',$dnisss->toArray())
                            ->whereIn('postulante.id',$declaracion->toArray())
                            #  ->whereNotIn('postulante.numero_identificacion', $pagos_arqui_nocepre->toArray())
                             ->whereNotIn('postulante.id',$documentos->toArray())
                             ->whereNotIn('postulante.id',$quitar_cartera->toArray())
                            ->whereNotIn('postulante.id',$orden_pago->toArray())
                            ->where('postulante.anulado',0);
                            #->where('postulante.pago',0);
            }
        }elseif (isset($codesp)  && $cep='ID-CEPRE') {
            return $cadenaSQL->select('postulante.*')
                            ->join('especialidad as e',function($join){
                                $join->on('postulante.idespecialidad','=','e.id');
                            })->where('e.codigo',$codesp)->where('postulante.idmodalidad',16)
                             #->whereNotIn('postulante.numero_identificacion',$dni_pagosceprearq->toArray())
                            ->where('postulante.anulado',0)
                            ->whereIn('postulante.id',$declaracion->toArray())
                            ->whereNotIn('postulante.id',$documentos->toArray())
                            ->whereNotIn('postulante.id',$quitar_cartera->toArray())
                            ->whereNotIn('postulante.id',$orden_pago->toArray())
							 #->where('postulante.pago',0)
						 ;

        }

    }
    /**
    * Devuelve relacion de postulantes con descuento de un tipo de colegio y gestion
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopePagoDescuentoGestion($cadenaSQL,$ie=null,$gestion=null,$modalidad = null,$codesp=null)
    {
        $dni_descuentos = Descuento::select('dni')->where('activo',1)->where('tipo','Parcial')->get();
		
		$dni_pagoscolestatalsemi = Recaudacion::select('codigo')->where('servicio','466')->get();
		$dni_pagoscoleprivsemi = Recaudacion::select('codigo')->where('servicio','467')->get();
        $declaracion = DeclaracionEva::select('idpostulante')->where('estado','APROBADO')->get();
        $documentos = SolicitanteVictima::select('idpostulante')->where('estado','<>','APROBADO')->get();
        $quitar_cartera = QuitarCartera::select('id')->get();
        $orden_pago = OrdenPago::select('idpostulante')->whereIn('servicio',['466','467'])->get();
        if($ie=='Colegio'){
            return $cadenaSQL->select('postulante.*')
                            ->join('colegio as c','c.id','=','postulante.idcolegio')
                            ->join('modalidad as m','m.id','=','postulante.idmodalidad')
                            ->join('proceso as r','r.idpostulante','=','postulante.id')
                            ->where('r.pago_examen',0)
                            ->whereIn('m.codigo',$modalidad)
                            ->where('c.gestion',$gestion)
                            ->whereIn('postulante.numero_identificacion',$dni_descuentos->toArray())
                            ->whereIn('postulante.id',$declaracion->toArray())
                            ->whereNotIn('postulante.numero_identificacion',$dni_pagoscolestatalsemi->toArray())
                            ->whereNotIn('postulante.numero_identificacion',$dni_pagoscoleprivsemi ->toArray())
                            ->whereNotIn('postulante.id',$orden_pago->toArray())
                            ->where('postulante.anulado',0);
        }
    }
    /**
    * Devuelve relacion de postulantes que han solicitado semibeca
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopePagoFormatoSemibeca($cadenaSQL)
    {
		$dni_pagantes = Recaudacion::select('codigo')->where('monto',5.00)->get();
        $solicitantes = Solicitante::select('idpostulante')->get();
        return $cadenaSQL->whereIn('postulante.id',$solicitantes->toArray())->whereNotIn('postulante.numero_identificacion',$dni_pagantes->toArray());
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeDatosOk($cadenaSQL){
        return $cadenaSQL->where('datos_ok',1);
    }
    ################################################################################
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Sexo()
    {
        return $this->hasOne(Catalogo::class,'id','idsexo');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Grado()
    {
        return $this->hasOne(Catalogo::class,'id','idgrado');
    }
    /**
     * Establecemos el la relacion con aula
     * @return [type] [description]
     */
    public function AulasD1()
    {
        return $this->hasOne(Aula::class,'id','idaula1');
    }
    /**
     * Establecemos el la relacion con aula
     * @return [type] [description]
     */
    public function AulasD2()
    {
        return $this->hasOne(Aula::class,'id','idaula2');
    }
    /**
     * Establecemos el la relacion con aula
     * @return [type] [description]
     */
    public function AulasD3()
    {
        return $this->hasOne(Aula::class,'id','idaula3');
    }
    /**
     * Establecemos el la relacion con aula
     * @return [type] [description]
     */
    public function AulasVoca()
    {
        return $this->hasOne(Aula::class,'id','idaulavoca');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Resultados()
    {
        return $this->hasOne(Resultado::class,'idpostulante','id');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Especialidades()
    {
        return $this->hasOne(Especialidad::class,'id','idespecialidad');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Ubigeos()
    {
        return $this->hasOne(Ubigeo::class,'id','idubigeo');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Colegios()
    {
        return $this->hasOne(Colegio::class,'id','idcolegio');
    }
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Evaluaciones()
    {
        return $this->hasOne(Evaluacion::class,'id','idevaluacion');
    }
    /**
     * Relacion de one to many
     * Obtener la dependencia que tiene esta persona
     */
    public function Recaudaciones()
    {
        return $this->hasmany(Recaudacion::class, 'idpostulante', 'id');
    }
    /**
     * Relacion de one to many
     * Obtener la dependencia que tiene esta persona
     */
    public function Usuarios()
    {
        return $this->hasOne(User::class, 'id', 'idusuario');
    }
    /**
     * Establecemos la relacion con la tabla de datos complementarios
     * @return [type] [description]
     */
    public function Complementarios()
    {
        return $this->hasOne(Complementario::class,'idpostulante','id');
    }
    /**
     * Establecemos la relacion con la de proceso
     * @return [type] [description]
     */
    public function Procesos()
    {
        return $this->hasOne(Proceso::class,'idpostulante','id');
    }
    /**
     * Establecemos la relacion con la de proceso
     * @return [type] [description]
     */
    public function Ingresantes()
    {
        return $this->hasOne(Ingresante::class,'idpostulante','id');
    }
	public function solicitante()
    {
        return $this->hasOne(Solicitante::class,'idpostulante','id');
    }

    public function solicitanteVictima()
    {
        return $this->hasOne(SolicitanteVictima::class,'idpostulante','id');
    }

    public function declaracionEva()
    {
        return $this->hasOne(DeclaracionEva::class,'idpostulante','id');
    }
	public function Documentos()
    {
        return $this->hasMany(Document::class,'dni','numero_identificacion');
    }
	
	public function scopeValidarDNI($cadenaSQL, $dni)
    {
        return $cadenaSQL->where('numero_identificacion',$dni);
    }
    /**
     * Operaciones estaticas
     * @param [type] $data [description]
     */
    public static function AsignarCodigo($id,$canal,$codigo_modalidad)
    {
        if(!isset($postulante->codigo) ){
            if($codigo_modalidad == 'E1TI') $canal = 'VII';
            
            $seq = strtolower($canal);
            $numero = DB::select("SELECT nextval('canal_".$seq."_seq')");
            $numero = $numero[0]->nextval;
            $codigo = NumeroInscripcion($seq,$numero);
            Postulante::where('id',$id)->whereNull('codigo')->update(['codigo'=>$codigo]);
        }
    }

    public static function AsignarAula($id)
    {




      #  Log::info('ENTRO ASIGNAR AULA : ');

        $postulante = Postulante::find($id);
        $cansin = SinAulas::where('dni',$postulante->numero_identificacion)->count();

        if( $cansin > 0 ){
            #NO SE ASIGNA AULAS
        }else {
            if($postulante->idmodalidad == 16) {
                $facultad = $postulante->idfacultad2;
            }else {
                $facultad = $postulante->idfacultad;
            }



            if(!isset($postulante->idaula1)  ){

                //SI ES NO TIT. GRADUADO UNO O TRASLADO INTERNO
                if(!str_contains($postulante->codigo_modalidad,['E1TGU','E1TI'])){

                    //
                    if (str_contains($postulante->codigo_modalidad,['E1CABC','E1TE','E1TG','E1PDC','E1VTC'])) {
                        #   Log::info('MODALIDAD CONTINUAR : ');





                        $aula2 = Aula::ObtenerAula(2,true,$facultad)->first();

                        #   Log::info('AULA OBTENIDA : '.$aula2);
                        if (isset($aula2)) {

                            if($facultad== 4 || $facultad== 5 || $facultad== 6 || $facultad== 7 || $facultad== 9){
                                if (Postulante::where('id',$id)->whereNull('idaula2')->update(['idaula2'=>$aula2->id])) {
                                    Aula::where('id',$aula2->id)->decrement('disponible_02');
                                    Aula::where('id',$aula2->id)->increment('asignado_02');
                                }
                            }

                            if($facultad== 1 || $facultad== 2 || $facultad== 3 || $facultad== 8 || $facultad== 10 || $facultad== 11 ){

                                if (Postulante::where('id',$id)->whereNull('idaula2')->update(['idaula2'=>$aula2->id])) {
                                    Aula::where('id',$aula2->id)->decrement('disponible_02_tarde');
                                    Aula::where('id',$aula2->id)->increment('asignado_02_tarde');
                                }

                            }


                        }


                    }else{

                        #    Log::info('MODALIDAD INICIAR : ');
                        $aula1 = Aula::ObtenerAula(1,false,$facultad)->first();
                        #    Log::info('AULA 1: '.$aula1);
                        if (isset($aula1)) {

                            if( $facultad == 4 || $facultad == 9 || $facultad == 1 || $facultad == 7 || $facultad == 5){
                                if (Postulante::where('id',$id)->whereNull('idaula1')->update(['idaula1'=>$aula1->id])) {
                                    Aula::where('id',$aula1->id)->decrement('disponible_01');
                                    Aula::where('id',$aula1->id)->increment('asignado_01');
                                }
                            }

                            if( $facultad == 10 || $facultad == 3 || $facultad== 6 || $facultad == 8 || $facultad == 11 || $facultad == 2){
                                if (Postulante::where('id',$id)->whereNull('idaula1')->update(['idaula1'=>$aula1->id])) {
                                    Aula::where('id',$aula1->id)->decrement('disponible_01_tarde');
                                    Aula::where('id',$aula1->id)->increment('asignado_01_tarde');
                                }

                            }


                        }


                        $aula2 = Aula::ObtenerAula(2,false,$facultad)->first();
                        #    Log::info('AULA 2: '.$aula2);
                        if (isset($aula2)) {
                            if( $facultad == 4 || $facultad == 9 || $facultad == 1 || $facultad == 7 || $facultad == 5){
                                if (Postulante::where('id',$id)->whereNull('idaula2')->update(['idaula2'=>$aula2->id])) {
                                    Aula::where('id',$aula2->id)->decrement('disponible_02');
                                    Aula::where('id',$aula2->id)->increment('asignado_02');
                                }
                            }

                            if( $facultad == 10 || $facultad == 3 || $facultad== 6 || $facultad == 8 || $facultad == 11 || $facultad == 2){

                                if (Postulante::where('id',$id)->whereNull('idaula2')->update(['idaula2'=>$aula2->id])) {
                                    Aula::where('id',$aula2->id)->decrement('disponible_02_tarde');
                                    Aula::where('id',$aula2->id)->increment('asignado_02_tarde');
                                }
                            }




                        }
                        $aula3 = Aula::ObtenerAula(3,false,$facultad)->first();
                        #   Log::info('AULA 3: '.$aula3);
                        if (isset($aula3)) {

                            if( $facultad == 4 || $facultad == 9 || $facultad == 1 || $facultad == 7 || $facultad == 5){
                                if (Postulante::where('id',$id)->whereNull('idaula3')->update(['idaula3'=>$aula3->id])) {
                                    Aula::where('id',$aula3->id)->decrement('disponible_03');
                                    Aula::where('id',$aula3->id)->increment('asignado_03');
                                }
                            }

                            if( $facultad == 10 || $facultad == 3 || $facultad== 6 || $facultad == 8 || $facultad == 11 || $facultad == 2){

                                if (Postulante::where('id',$id)->whereNull('idaula3')->update(['idaula3'=>$aula3->id])) {
                                    Aula::where('id',$aula3->id)->decrement('disponible_03_tarde');
                                    Aula::where('id',$aula3->id)->increment('asignado_03_tarde');
                                }
                            }


                        }



                    }

                }//fin del if

            }//fin del if de idaula1

            if(!isset($postulante->idaulavoca)  ){
                $voca = Aula::ObtenerAula('voca')->first();
                if (isset($voca) ) {
                    if (Postulante::where('id',$id)->whereNull('idaulavoca')->where('idespecialidad',1)->where('idmodalidad','<>',16)->update(['idaulavoca'=>$voca->id])) {
                        Aula::where('id',$voca->id)->decrement('disponible_voca');
                        Aula::where('id',$voca->id)->increment('asignado_voca');
                    }
                    if (Postulante::where('id',$id)->whereNull('idaulavoca')->where('idespecialidad4',1)->update(['idaulavoca'=>$voca->id])) {
                        Aula::where('id',$voca->id)->decrement('disponible_voca');
                        Aula::where('id',$voca->id)->increment('asignado_voca');
                    }
                }
            }





        }




    }




    public static function AsignarClave($id)
    {
        $postulante = Postulante::find($id);

        $cantidad = PostulanteClave:: where('idpostulante',$postulante->id)->count();
        if( $cantidad == 0 ){
            $clave = ClavesCepre::where('activo',true)->inRandomOrder()->first();
            ClavesCepre::where('id',$clave->id)->update(['activo'=>false]);


            PostulanteClave::insert([
                'idpostulante' => $postulante->id,
                'idclave'=> $clave->id

            ]);
        }



    }
}
