<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetSolicitudes;

class DetSolicitudesController extends Controller
{
    //
    public function index(Request $request)
    {
        $buscar=$request->buscar;
    
        
            $solicitudes=DetSolicitudes::join('solicitudes','det_solicitudes.id_solicitud','=','solicitudes.id')
            ->join('libros','det_solicitudes.id_libro','=','libros.id')
            ->join('autors','libros.id_autor','=','autors.id')
            ->join('editorials','libros.id_editorial','=','editorials.id')
            ->select('det_solicitudes.id_solicitud','libros.id as idLibro','libros.codigo as codLibro', 'libros.nombre as nomLibro','det_solicitudes.cant','autors.nombre as nomAut','editorials.nombre as nomEdit')
            ->where('det_solicitudes.id_solicitud','=', $buscar) 
           ->orderBy('det_solicitudes.id_libro','asc')->paginate(12);
   
        
        
        return [ 'pagination'=>[
                  'total'=>$solicitudes->total(),
                   'current_page'=>$solicitudes->currentPage(),
                   'per_page'=>$solicitudes->perPage(),
                   'last_page'=>$solicitudes->lastPage(),
                   'from'=>$solicitudes->firstItem(),
                   'to'=>$solicitudes->lastItem(),

                
        
                ],'solicitudes'=>$solicitudes
            
            ];

        
    }

}
