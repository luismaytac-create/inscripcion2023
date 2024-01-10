<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pagg extends Model

{


    protected $table = 'vista_pagovocc';
    protected $fillable = ['dni'];
    public $timestamps = false;
}