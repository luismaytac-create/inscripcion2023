<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistoIP extends Model
{
    protected $table = 'registo_ip_res';
    protected $fillable = ['dni','ip','date'];
    public $timestamps = false;

}
