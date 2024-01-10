<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistroUser extends Model
{
    protected $table = 'registo_usuarios_login';
    protected $fillable = ['idusuario','ip','date'];
    public $timestamps = false;

}
