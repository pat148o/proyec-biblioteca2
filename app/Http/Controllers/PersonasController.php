<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Personas;

class PersonasController extends Controller
{
    //
    public function getPersona(Request $request){
        $persona=Personas::orderBy('nombres','asc')->get();
        return[
            'persona'=>$persona
        ];
    }
}
