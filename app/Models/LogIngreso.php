<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LogIngreso extends Model
{
    protected $table = 'log_ingreso';

    protected $fillable = [ 'idusuario','idpostulante','estado','observacion','date'];
    public $timestamps = false;


}