<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personas extends Model
{
    //
    protected $fillable=['id','nombres','apellidos','dir','tel','nomCom'];
    public $timestamps=false;
    
}
