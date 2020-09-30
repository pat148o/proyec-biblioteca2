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
        $categorias=Categorias::orderBy('nombre','asc')->get();
        return ['categorias'=>$categorias];
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
    public function update(Request $request)
    {
        //
        $categorias=Categorias::findOrFail($request->id);
        $categorias->nombre=$request->nombre;
        $categorias->save();
    }
   //elimina datos 
    public function destroy(Request $request)
    {
        //
        $categorias=Categorias::findOrFail($request->id);
        $categorias->delete();

    }
}
