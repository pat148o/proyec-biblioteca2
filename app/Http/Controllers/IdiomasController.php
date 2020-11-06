<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idiomas;

class IdiomasController extends Controller
{
  
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        
        if ($buscar=='') {
            $idiomas=Idiomas::orderBy('nombre','asc')->paginate(4);
        }else {
            $idiomas=Idiomas::where($criterio,'like','%'.$buscar.'%')->orderBy('nombre','asc')->paginate(4);   
        }


        return ['pagination'=>[
            'total'=>$idiomas->total(),
            'current_page'=>$idiomas->currentPage(),
            'per_page'=>$idiomas->perPage(),
            'last_page'=>$idiomas->lastPage(),
            'from'=>$idiomas->firstItem(),
            'to'=>$idiomas->lastItem(),

              ],'idiomas'=>$idiomas 
        

        ];
    }
    public function store(Request $request)
    {
        
        $idiomas=new Idiomas();
        $idiomas->nombre=$request->nombre;
        $idiomas->save();
    }

    public function update(Request $request) 
    {
        //
        $idiomas=Idiomas::findOrFail($request->id);
        $idiomas->nombre=$request->nombre;
        $idiomas->save();
    }
    public function destroy(Request $request)
    {
        //
        $idiomas=Idiomas::findOrFail($request->id);
        $idiomas->delete();
    }
    public function getIdiomas(Request $request){
        $idiomas=Idiomas::orderBy('nombre','asc')->get();
        return[
            'idiomas'=>$idiomas
        ];
    }
}
