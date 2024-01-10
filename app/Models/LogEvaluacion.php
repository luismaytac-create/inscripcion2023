<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LogEvaluacion extends Model
{
    protected $table = 'log_evaluacion_documentos';

    protected $fillable = [ 'idusuario','idpostulante','estado','observacion','date','modalidad'];
    public $timestamps = false;


}