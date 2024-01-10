<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restriccion extends Model
{
    protected $table = 'restriccion';
    protected $fillable = ['id','dni'];
    public $timestamps = false;
}
