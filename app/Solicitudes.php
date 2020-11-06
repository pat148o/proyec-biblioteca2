<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    //
    protected $table ='solicitudes';
    protected $fillable=['id','fec_sol','fec_entrega','id_persona'];
    public $timestamps=false;
    
}
