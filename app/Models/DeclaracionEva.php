<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class DeclaracionEva extends Model{
    protected $table = 'declaracion_evaluacion';
    protected $fillable = ['id','idpostulante','dni','iduser','observaciones','estado'];
    public $timestamps = false;
}