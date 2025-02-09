<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaFecha extends Model
{
    protected $table = 'ficha_ficha';
    protected $fillable = ['idpostulante','dni','fecha','iduser','idmodalidad','idespecialidad','idespecialidad2','idespecialidad3'];
    public $timestamps = false;

}
