<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tipo extends Model
{
    protected $table = "Semibecas.tipos";
    
    public function documento()
    {
        return $this->hasMany(Document::class,'idtipo','id');
    }
}