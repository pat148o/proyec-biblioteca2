<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias; 

class CategoriasController extends Controller
{
    //mostrar datos de la tabla
    public function index()
    {
        //
        $categorias=Categorias::all();
        return $categorias;
    }


   //guarda datos
    public function store(Request $request)
    {
        //
        $categorias=new Categorias();
        $categorias->nombre=$request->nombre;
        $categorias->save();
    }

   //actualiza datos
    public function update(Request $request, $id)
    {
        //
        $categorias=Categorias::findOrdFail($request->id);
        $categorias->nombre=$request->nombre;
        $categorias->save();
    }

   //elimina datos
    public function destroy(Request $request)
    {
        //
        $categorias=Categorias::findOrdFail($request->id);
        $categorias->delete();

    }
}
