<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idiomas;

class IdiomasController extends Controller
{
  
    public function index()
    {
        //
        $idiomas=Idiomas::all();
        return $idiomas;
    }
    public function store(Request $request)
    {
        //
        $idiomas=new Idiomas();
        $idiomas->nombre=$request->nombre;
        $idiomas->save();
    }

    public function update(Request $request, $id)
    {
        //
        $idomas=Idiomas::findOrdFail($request->id);
        $idiomas->nombre=$request->nombre;
        $idiomas->save();
    }
    public function destroy(Request $request)
    {
        //
        $idiomas=Idiomas::findOrdFail($request->id);
        $idiomas->delete();
    }
}
