<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Autors;

class AutorsController extends Controller
{
  
    
    public function index(Request $request)
    {  
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {

            $autors=Autors::join('pais','autors.id_pais','=','pais.id')
            ->select('autors.id','autors.nombre','pais.nombre as nomPais')
            ->orderBy('autors.nombre','asc')->paginate(4);
        }else {
            $autors=Autors::join('pais','autors.id_pais', '=','pais.id') 
    ->select('autors.id','autors.nombre','pais.nombre as nomPais')
    ->where('autors.nombre',$buscar)
    ->orwhere('autors.nombre','like','%'.$buscar.'%')
    ->orderBy('autors.nombre','asc')->paginate(4);
        }

        
        return ['pagination'=>[

                'total'=>$autors->total(),
                'current_page'=>$autors->currentPage(),
                'per_page'=>$autors->perPage(),
                'last_page'=>$autors->lastPage(),
                'from'=>$autors->firstItem(),
                'to'=>$autors->lastItem(),

            ],'autors' =>$autors
     
        
        ];
    
    
    }

    public function store(Request $request)
    {
        //
        $autors=new Autors();
        $autors->nombre=$request->nombre;
        
        $autors->id_pais= $request->idPais;
        $autors->save();
    }
    
    public function update(Request $request)
    {
    
        $autors=Autors::findOrFail($request->id);
        $autors->nombre=$request->nombre;
        
        $autors->id_pais= $request->idPais;
        $autors->save();
    }
    
    public function destroy(Request $request)
    {
    
        $autors=Autors::findOrFail($request->id);
        $autors->delete();
    }
    
    public function getAutor(Request $request){

       
        
    $autors=Autors::
    select('autors.id','autors.nombre')->get();
    
        return[
            'autors'=>$autors
        ];
    }
    
}

