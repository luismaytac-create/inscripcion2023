<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Document extends Model
{
    protected $table = "Semibecas.documentos";
    
    public function tipos()
    {
        return $this->hasOne(Tipo::class,'id','tipo');
    }
    public function scopeValidar($cadenaSQL, $dni)
    {
        return $cadenaSQL->where('dni',$dni);
    }
    public function scopeActivo($cadenaSQL)
    {
        return $cadenaSQL->where('Semibecas.documentos.activo',true);
    }
}