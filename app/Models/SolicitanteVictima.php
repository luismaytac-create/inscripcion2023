<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SolicitanteVictima extends Model{
    protected $table = 'solicitantes_documentos';
    protected $fillable = ['id','idpostulante','dni','iduser','observaciones','estado'];
    public $timestamps = false;
}