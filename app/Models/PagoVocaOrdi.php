<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PagoVocaOrdi extends Model
{


    protected $table = 'vista_pago_vocacional_nocepre';

    protected $fillable = [ 'codigo'];
    public $timestamps = false;
}