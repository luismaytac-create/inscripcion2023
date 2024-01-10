<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostulanteSinAula extends Model
{
    protected $table = 'postulante_sin_aula';
    protected $fillable = ['idpostulante','activo'];
    public $timestamps = false;
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Postulantes()
    {
        return $this->hasOne(Postulante::class,'id','idpostulante');
    }
}
