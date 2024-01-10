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

            if($facultad== 4 || $facultad== 5 || $facultad== 6 || $facultad== 7 || $facultad== 9){
                return $cadenaSQL->select('id')
                    ->where('activo',true)
                    ->where('habilitado',true)
                    ->where('especial',true)
                    ->where('disponible_0'.$dia,'>',0)
                    ->inRandomOrder();
            }


            if($facultad== 1 || $facultad== 2 || $facultad== 3 || $facultad== 8 || $facultad== 10 || $facultad== 11 ){

                return $cadenaSQL->select('id')
                    ->where('activo',true)
                    ->where('habilitado',true)
                    ->where('especial',true)
                    ->where('disponible_0'.$dia.'_tarde','>',0)
                    ->inRandomOrder();

            }





        }else {




            $idpermitidas = ConfiguracionAula::select('idaula')->where('idfacultad',$facultad)->where('activo',1)->get();
        #    Log::info('FACU: '.$facultad);


        #    Log::info($idpermitidas);
            # TURNO MAÑANA
            if( $facultad == 4 || $facultad == 9 || $facultad == 1 || $facultad == 7 || $facultad == 5){

            }

            # TURNO TARDE
            if( $facultad == 10 || $facultad == 3 || $facultad== 6 || $facultad == 8 || $facultad == 11 || $facultad == 2){

                $dia = $dia.'_tarde';
            }
            return $cadenaSQL->select('id')
                            ->where('activo',true)
                            ->where('habilitado',true)
                            ->where('especial',false)
                            ->where('disponible_0'.$dia,'>',0)
                            ->whereIn('id',$idpermitidas)

                            ->inRandomOrder();
        }

    }
}
