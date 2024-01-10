<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostulanteSinPago extends Model
{
    protected $table = 'postulante_sin_pago';
    protected $fillable = ['idpostulante', 'voucher', 'atendido'];
    /**
     * Establecemos el la relacion con catalogo
     * @return [type] [description]
     */
    public function Postulantes()
    {
        return $this->hasOne(Postulante::class,'id','idpostulante');
    }
}
