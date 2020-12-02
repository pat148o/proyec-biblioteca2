<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class UsersController extends Controller
{
    
    public function index(Request $request)
    {
        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if ($buscar=='') {
            $users=Users::orderBy('name','asc')->paginate(4);
        }else {
            $users=Users::where($criterio,'like','%'.$buscar.'%')->orderBy('name','asc')->paginate(4);
        }

        
        return ['pagination'=>[

                'total'=>$users->total(),
                'current_page'=>$users->currentPage(),
                'per_page'=>$users->perPage(),
                'last_page'=>$users->lastPage(),
                'from'=>$users->firstItem(),
                'to'=>$users->lastItem(),

            ],'users' =>$users
     
        
        ];
    
    
    }

    public function store(Request $request)
    {
        //
        $users=new Users();
        $users->name=$request->name;
        $users->email=$request->email;
        $users->password=bcrypt($request->password);
        $users->save();
    }
    
    public function update(Request $request)
    {
        //
        $users=Users::findOrFail($request->id);
        $users->name=$request->name;
        $users->email=$request->email;
        $users->password=bcrypt($request->password);
        $users->save();
    }
    
    public function destroy(Request $request)
    {
        //
        $users=Users::findOrFail($request->id);
        $users->delete();
    }
    public function getUsers(Request $request)
    {
        $users= Users::orderBy('name', 'asc')->get();
        return [
            'users'=> $users];
    }
}
