<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarterasEnviada extends Model
{
    protected $table = 'carteras_enviadas';
    protected $fillable = ['dni_ruc', 'descripcion', 'monto'];
}
