<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autors;
use App\Pais;

class AutorsController extends Controller
{
  
    public function index()
    {
        //
        $autors=Autors::orderBy('nombre','asc')->get();
        return ['autors'=>$autors];
        $pais=Pais::orderBy('id')->get();
        return ['pais'=>$pais];
    }
    public function store(Request $request)
    {
        //
        $autors=new Autors();
        $autors->nombre=$request->nombre;
        $autors->save();
    }
    public function update(Request $request)
    {
        //
        $autors=Autors::findOrFail($request->id);
        $autors->nombre=$request->nombre;
        $autors->save();
    }
    public function destroy(Request $request)
    {
        //
        $autors=Autors::findOrFail($request->id);
        $autors->delete();
    }
}
