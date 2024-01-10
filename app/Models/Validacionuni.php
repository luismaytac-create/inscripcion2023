<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validacionuni extends Model
{
    protected $table = 'vacante_validacion';
protected $fillable = ['idespecialidad','vacantes'];
    public $timestamps = false;
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeGetRules($cadenaSQL,$idesp){
        
        return $cadenaSQL->where('idespecialidad',$idesp);
    }
}
