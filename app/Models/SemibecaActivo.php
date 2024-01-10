<?php



namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class SemibecaActivo extends Model
{
    protected $fillable = ['idpostulante','activo','creacion'];
    protected $table = 'semibeca_activo';
    public $timestamps = false;


}