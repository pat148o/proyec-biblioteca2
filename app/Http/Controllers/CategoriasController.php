<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias; 

class CategoriasController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $categorias=Categorias::orderBy('nombre','asc')->paginate(4);
            // todo...
        }else {
            $categorias=Categorias::where($criterio,'like','%'.$buscar.'%')->orderBy('nombre','asc')->paginate(4);
        }

        
        
        return [ 'pagination'=>[
                  'total'=>$categorias->total(),
                   'current_page'=>$categorias->currentPage(),
                   'per_page'=>$categorias->perPage(),
                   'last_page'=>$categorias->lastPage(),
                   'from'=>$categorias->firstItem(),
                   'to'=>$categorias->lastItem(),

                
        
                ],'categorias'=>$categorias
            
            ];
    }
   //guarda datos
    public function store(Request $request)
    {
        
        $categorias=new Categorias();
        $categorias->nombre=$request->nombre;
        $categorias->save();
    }
   //actualiza datos
    public function update(Request $request)
    {
        
        $categorias=Categorias::findOrFail($request->id);
        $categorias->nombre=$request->nombre;
        $categorias->save();
    }
   //elimina datos 
    public function destroy(Request $request)
    {
        
        $categorias=Categorias::findOrFail($request->id);
        $categorias->delete();

    }
    public function getCategorias(Request $request){
        $categorias=Categorias::orderBy('nombre','asc')->get();
        return[
            'categorias'=>$categorias
        ];
    }
    
}
