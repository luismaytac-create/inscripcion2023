<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ingresante extends Model
{
    protected $table = 'ingresante';
    protected $guarded = [];
    public $timestamps = false;
    /**
    * Atributos Facultad
    */
    public function getFacultadAttribute()
    {
        $facultad = Facultad::find($this->idfacultad);
        return $facultad->nombre;
    }
    /**
    * Atributos especialidad
    */
    public function getCodigoEspecialidadAttribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad);
        return $especialidad->codigo;
    }
    /**
    * Atributos Codigo especialidad
    */
    public function getEspecialidadAttribute()
    {
        $especialidad = Especialidad::find($this->idespecialidad);
        return $especialidad->nombre;
    }
    /**
    * Atributos Modalidad
    */
    public function getModalidadAttribute()
    {
        $modalidad = Modalidad::find($this->idmodalidad);
        return $modalidad->nombre;
    }
    /**
    * Atributos codigo de modalidad
    */
    public function getCodigoModalidadAttribute()
    {
        $modalidad = Modalidad::find($this->idmodalidad);
        return $modalidad->codigo;
    }
    /**
    * Atributos reglamento de modalidad
    */
    public function getReglamentoModalidadAttribute()
    {
        $modalidad = Modalidad::find($this->idmodalidad);
        return $modalidad->reglamento;
    }
    /**
    * Atributos Foto Ingresante
    */
    public function getFotoAttribute()
    {
    	$postulante = Postulante::find($this->idpostulante);
        $fotoing = 'fotoIng/'.$postulante->numero_identificacion.'.JPG';
        if(Storage::exists('public/'.$fotoing))$foto = asset('/storage/'.$fotoing);
        else $foto = false;

        return $foto;
    }
    /**
    * Atributos Huella del Ingresante
    */
    public function getHuellaAttribute()
    {
    	$postulante = Postulante::find($this->idpostulante);
        #$huellabmp = 'huella/'.$postulante->numero_identificacion.'.bmp';
        $huella = 'huella/'.$postulante->numero_identificacion.'.jpg';
	if(Storage::exists('public/'.$huella)){

	$imagen = asset('/storage/'.$huella);
	}else{
	$imagen = false;
	}

        return $imagen;
    }
    /**
    * Atributos Huella del Ingresante
    */
    public function getFirmaAttribute()
    {
    	$postulante = Postulante::find($this->idpostulante);
        $firma = 'huella/'.$postulante->numero_identificacion.'.jpgxx';
        if(Storage::exists('public/'.$firma))$imagen = asset('/storage/'.$firma);
        else $imagen = false;

        return $imagen;
    }
    /**
    * Atributos NotaComa
    */
    public function getNotaComaAttribute()
    {
        return number_format($this->nota_ingreso, 2, ',', ' ');
    }
    /**
    * Atributos NotaComa
    */
    public function getNotaEquivalenteAttribute()
    {
        $nota = ($this->nota_ingreso*100)/20;
        return number_format($nota, 2, ',', ' ');
    }
}
