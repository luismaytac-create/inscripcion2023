<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $table = 'mensaje';
    protected $fillable = ['idpostulante', 'asunto', 'contenido','iduser','respuesta','read_at'];

    /**
    * Atributos Postulante
    */
    public function getPostulanteAttribute()
    {
        $postulante = Postulante::find($this->idpostulante);
        return $postulante->nombre_completo;
    }
    /**
    * Atributos Postulante
    */
    public function getPostulanteFotoAttribute()
    {
    	$postulante = Postulante::find($this->idpostulante);
    	return $postulante->mostrar_foto;
    }
    /**
    * Atributos Visto
    */
    public function getVistoAttribute()
    {
    	if (isset($this->read_at)) return '<img src="'.asset('assets/pages/img/Double-Check-Blue.png').'" width="3%">';
    	else return '<img src="'.asset('assets/pages/img/Double-Check.png').'" width="3%">';
    }
    /**
    * Atributos Visto Tabla
    */
    public function getVistoTablaAttribute()
    {
    	if (isset($this->respuesta)) return '';
    	else return 'class=danger';
    }
}
