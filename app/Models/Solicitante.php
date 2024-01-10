<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    protected $table = 'Semibecas.solicitantes';
    protected $guarded = [];

   /**
   * Devuelve los valores Activos
   * @param  [type]  [description]
   * @return [type]            [description]
   */
   public function scopeActivo($cadenaSQL){
   	return $cadenaSQL->where('activo',1);
   }
   
   public function Postulantes()
    {
        return $this->hasOne(Postulante::class,'id','idpostulante');
    }
    
    
    
    public function setOtorgaAttribute($value)
    {   
        if($value == 'BECA INTEGRAL')
            $this->attributes["tipo_descuento"] = 'Total';
        else if($value == 'SEMIBECA')
            $this->attributes["tipo_descuento"] = 'Parcial';
        else 
            $this->attributes["tipo_descuento"] = '';
    }

    public function scopeSemibeca($cadenaSQL)
    {
        return $cadenaSQL->where('otorga','SEMIBECA');
    }

    public function scopeIntegral($cadenaSQL)
    {
        return $cadenaSQL->where('otorga','BECA INTEGRAL');
    }

    public function scopeDenegado($cadenaSQL)
    {
        return $cadenaSQL->where('otorga','DENEGADO');
    }

    public function scopeInconcluso($cadenaSQL)
    {
        return $cadenaSQL->where('iduser','')
                        ->where('observaciones','')
                        ->where('promedio','')
                        ->where('otorga','');
    }

    public function colegio()
    {
        return $this->hasOne(Colegio::class, 'id', 'idcolegio');
    }

    public function documento()
    {
        return $this->hasMany(Document::class,'dni','dni');
    }

  



    public function sexo()
    {
        return $this->hasOne(Catalogo::class,'id','idsexo');
    }
}
