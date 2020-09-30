<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Editorials;

class EditorialsController extends Controller
{
    
    public function index()
    {
        //
        $editorials=Editorials::orderBy('nombre','asc')->get();
        return ['editorials' =>$editorials];
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
}
