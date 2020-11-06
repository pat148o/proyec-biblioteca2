<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Editorials;

class EditorialsController extends Controller
{
    
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $editorials=Editorials::orderBy('nombre','asc')->paginate(4);
        }else {
            $editorials=Editorials::where($criterio,'like','%'.$buscar.'%')->orderBy('nombre','asc')->paginate(4);
        }

        
        return ['pagination'=>[

                'total'=>$editorials->total(),
                'current_page'=>$editorials->currentPage(),
                'per_page'=>$editorials->perPage(),
                'last_page'=>$editorials->lastPage(),
                'from'=>$editorials->firstItem(),
                'to'=>$editorials->lastItem(),

            ],'editorials' =>$editorials
     
        
        ];
    
    
    }

    public function store(Request $request)
    {
        //
        $editorials=new Editorials();
        $editorials->nombre=$request->nombre;
        $editorials->save();
    }
    
    public function update(Request $request)
    {
        //
        $editorials=Editorials::findOrFail($request->id);
        $editorials->nombre=$request->nombre;
        $editorials->save();
    }
    
    public function destroy(Request $request)
    {
        //
        $editorials=Editorials::findOrFail($request->id);
        $editorials->delete();
    }
    public function getEditorials(Request $request){
        $editorials=Editorials::orderBy('nombre','asc')->get();
        return[
            'editorials'=>$editorials
        ];
    }
}
