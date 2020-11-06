<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetSolicitudes extends Model
{
    //
    protected $table ='det_solicitudes';
    protected $fillable=['id','id_solicitudes','id_libros','cant'];
    public $timestamps=false;
    
}
