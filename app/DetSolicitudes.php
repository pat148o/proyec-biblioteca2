<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetSolicitudes extends Model
{
    //
    protected $table ='det_solicitudes';
    protected $fillable=['id','id_solicitud','id_libro','cant'];
    public $timestamps=false;
    
}
