<?php

namespace App\Models;

use ClassPreloader\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
class Aula extends Model
{
    protected $table = 'aula';
    protected $guarded = [];
    public $timestamps = false;
    /**
     * Atributos sector
     */
    public function setSectorAttribute($value)
    {
        $this->attributes['sector'] = strtoupper($value);
    }
    /**
     * Atributos codigo
     */
    public function setCodigoAttribute($value)
    {
        $this->attributes['codigo'] = strtoupper($value);
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeActivas($cadenaSQL,$estado = true){
    	return $cadenaSQL->where('activo',$estado);
    }
    /**
    * Devuelve los valores Activos
    * @param  [type]  [description]
    * @return [type]            [description]
    */
    public function scopeObtenerAula($cadenaSQL,$dia,$especial = false,$facultad = null){


      #  Log::info('ENTRO OBTENER : '.$dia. '-'.$especial.'-'.$facultad);

        if ($dia=='voca' && !$especial) {
           # Log::info('ENTRO VOCA : ');

            return $cadenaSQL->select('id')
                            ->where('activo',true)
                            ->where('habilitado',true)
                            ->where('disponible_voca','>',0)
                            ->inRandomOrder();




        }elseif ($especial) {

           # Log::info('ENTRO ESPECI : ');


                return $cadenaSQL->select('id')
                    ->where('activo',true)
                    ->where('habilitado',true)
                    ->where('especial',true)
                    ->where('disponible_0'.$dia,'>',0)
                    ->inRandomOrder();









        }else {




            $idpermitidas = ConfiguracionAula::select('idaula')->where('idfacultad',$facultad)->where('activo',1)->get();
        #    Log::info('FACU: '.$facultad);


        #    Log::info($idpermitidas);

            return $cadenaSQL->select('id')
                            ->where('activo',true)
                            ->where('habilitado',true)
                            ->where('especial',false)
                            ->where('disponible_0'.$dia,'>',0)
                            ->inRandomOrder();
        }

    }
}
