<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'archivos';
    protected $fillable = ['cadena','fecha','iduser','banco','archivo'];
    public $timestamps = false;

}
