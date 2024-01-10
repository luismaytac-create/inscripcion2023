<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = 'evaluacion';
    protected $fillable = ['codigo', 'nombre', 'descripcion','fecha_inicio','fecha_fin','activo'];

    /**
    * Atributos Activo
    */
    public function getEsActivoAttribute()
    {
        if ($this->activo) {
            return '<a href="#" class="label label-sm label-info">Activo</a>';
        }else{
            return '<a href="#" class="label label-sm label-danger">Inactivo</a>';
        }
    }

    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeActivo($cadenaSQL){
    	return $cadenaSQL->where('activo',1);
    }
}
