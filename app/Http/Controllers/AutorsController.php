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
        $autors=Autors::all();
        $pais=Pais::all();
        return $autors;
    }
    public function store(Request $request)
    {
        //
        $autors=new Autors();
        $autors->nombre=$request->nombre;
        $autors->save();
    }
    public function update(Request $request, $id)
    {
        //
        $autors=Autors::findOrdFail($request->id);
        $autors->nombre=$request->nombre;
        $autors->save();
    }
    public function destroy(Request $request)
    {
        //
        $autors=Autors::findOrdFail($request->id);
        $autors->delete();
    }
}
