<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FotoObservacion extends Model
{
    protected $table = 'foto_observacion';
    protected $fillable = ['idpostulante','observacion','fecha'];
    public $timestamps = false;
}