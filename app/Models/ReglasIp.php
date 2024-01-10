<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReglasIp extends Model
{
    protected $table = 'permisos_ingreso';
    protected $fillable = ['idusuario','ip','fijo','externo','ocad'];
    public $timestamps = false;







}
