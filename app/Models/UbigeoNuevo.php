<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class UbigeoNuevo extends Model
{
    protected $table = 'ubigeo_new';
    protected $fillable = ['codigo','descripcion','depa','idpais','prov','distrito','iddepartamento'];
    public $timestamps = false;
    public function Paises()
    {
        return $this->hasOne(Pais::class,'id','idpais');
    }

}
