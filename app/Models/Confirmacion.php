<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confirmacion extends Model
{
    protected $table = 'confirmacion';
    protected $fillable = ['idpostulante','dni','fecha','iduser','idmodalidad','idespecialidad','idespecialidad2','idespecialidad3','comentario','acepto'];
    public $timestamps = false;

}
