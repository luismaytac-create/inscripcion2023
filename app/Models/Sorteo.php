<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Sorteo extends Model
{
    protected $table = 'sorteo';
 public $timestamps = false;

    /**
    * Atributos Facultad
    */
    public function scopeSorteado($cadenaSQL)
    {
        return $cadenaSQL->where('sorteo', true);
    }
}
