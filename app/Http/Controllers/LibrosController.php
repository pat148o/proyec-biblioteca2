<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libros;

class LibrosController extends Controller
{
    public function index(Request $request)
    {
        $buscar=$request->buscar;
       
        if ($buscar=='') {
            $libro=Libros::join('editorials','libros.id_editorial','=','editorials.id')
            ->join('categorias','libros.id_categoria','=','categorias.id')
            ->join('autors','libros.id_autor','=','autors.id')
            ->join('idiomas','libros.id_idioma','=','idiomas.id')
            ->select('libros.id','libros.nombre','libros.codigo','libros.cant','libros.ano_publi','libros.num_pag','libros.ubicacion','libros.edicion',
            'editorials.nombre as nomEdit','categorias.nombre as nomCat','autors.nombre as nomAut','idiomas.nombre as nomIdi')
            ->orderBy('libros.nombre','asc')->paginate(4);
   
        }else { 
            $libro=Libros::join('editorials','libros.id_editorial','=','editorials.id')
            ->join('categorias','libros.id_categoria','=','categorias.id')
            ->join('autors','libros.id_autor','=','autors.id')
            ->join('idiomas','libros.id_idioma','=','idiomas.id')
            ->select('libros.id','libros.nombre','libros.codigo','libros.cant','libros.ano_publi','libros.num_pag','libros.ubicacion','libros.edicion',
            'editorials.nombre as nomEdit','categorias.nombre as nomCat','autors.nombre as nomAut','idiomas.nombre as nomIdi')
            ->where('libros.nombre','like','%'.$buscar.'%')
            ->orwhere('libros.codigo','like','%'.$buscar.'%')
            ->orderBy('libros.nombre','asc')->paginate(4);
        }

        
        
        return [ 'pagination'=>[
                  'total'=>$libro->total(),
                   'current_page'=>$libro->currentPage(),
                   'per_page'=>$libro->perPage(),
                   'last_page'=>$libro->lastPage(),
                   'from'=>$libro->firstItem(),
                   'to'=>$libro->lastItem(),

                
        
                ],'libro'=>$libro
            
            ];
    }
    
    
    

    public function store(Request $request)
    {
        //
        $libro=new Libros();
        $libro->nombre=$request->nombre;
        $libro->codigo=$request->codigo;
        $libro->cant=$request->cant;
        $libro->ano_publi=$request->ano_publi;
        $libro->num_pag=$request->num_pag;
        $libro->ubicacion=$request->ubicacion;
        $libro->edicion=$request->edicion;
    
        $libro->id_editorial = $request->idEdit;
        $libro->id_categoria = $request->idCat;
        $libro->id_autor= $request->idAut;
        $libro->id_idioma= $request->idIdi;
        $libro->save();
    }
    
    public function update(Request $request)
    {
        //
        $libro=Libros::findOrFail($request->id);
        $libro->nombre=$request->nombre;
        $libro->codigo=$request->codigo;
        $libro->cant=$request->cant;
        $libro->ano_publi=$request->ano_publi;
        $libro->num_pag=$request->num_pag;
        $libro->ubicacion=$request->ubicacion;
        $libro->edicion=$request->edicion;
    
        $libro->id_editorial = $request->idEdit;
        $libro->id_categoria = $request->idCat;
        $libro->id_autor= $request->idAut;
        $libro->id_idioma= $request->idIdi;
        $libro->save();
    } 
    
    public function destroy(Request $request)
    {
        //
        $libro=Libros::findOrFail($request->id);
        $libro->delete();
    }
    
    public function getLibro(Request $request){
    
       
       
   
            $libro=Libros::join('editorials','libros.id_editorial','=','editorials.id')
            ->join('autors','libros.id_autor','=','autors.id')
            ->select('libros.id','libros.codigo','libros.nombre','autors.nombre as nomAut','editorials.nombre as nomEdit')            
            ->where('libros.codigo',$buscar)
           ->orwhere('libros.nombre','like','%'.$buscar.'%')
            ->orderBy('libros.nombre','asc')->take(1)->get();
        
        return[
            'libro'=>$libro   
        ];
    }
    
}

