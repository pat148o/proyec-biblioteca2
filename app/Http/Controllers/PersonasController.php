<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personas;

class PersonasController extends Controller
{
    //mostrar datos de la tabla
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $personas= Personas::orderBy('nombres','asc')->paginate(4);
        }else {
            $personas= Personas::where($criterio, 'like', '%'.$buscar. '%')->orderBy('nombres','asc')->paginate(4);
        }

        // GET para obtener
        // POST guardar en la bd
        // PUT actualizar o eliminar
                
        return [

            'pagination'=>[
                'total'=> $personas -> total(),
                'current_page'=> $personas -> currentPage(),
                'per_page'=> $personas -> perPage(),
                'last_page'=> $personas -> lastPage(),
                'from'=> $personas -> firstItem(),
                'to'=> $personas -> lastItem(),
            ],
            'personas'=>$personas
        ];
    }
    
    //guardar datos en la bd
    public function store(Request $request)
    {
        $personas= new Personas();
        $personas->nombres = $request->nombres;
        $personas->apellidos = $request->apellidos;
        $personas->dir = $request->dir;
        $personas->tel = $request->tel;
        $personas->email = $request->email;
        $personas->save();
    }
    
    //actualizar datos
    public function update(Request $request)
    {
        $personas= Personas::findOrFail($request->id);
        $personas->nombres = $request->nombres;
        $personas->apellidos = $request->apellidos;
        $personas->dir = $request->dir;
        $personas->tel = $request->tel;
        $personas->email = $request->email;
        $personas->save();
    }

    //eliminar datos
    public function destroy(Request $request)
    {
        $personas= Personas::findOrFail($request->id);
        $personas->delete();
    }

    public function getPersona(Request $request)
    {
        $personas = Personas::orderBy('nombres', 'asc')->get();
        return [
            'personas'=>$personas];
    }
}
