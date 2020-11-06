<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Solicitudes;
use App\DetSolicitudes;


class SolicitudesController extends Controller
{
    //
    public function index(Request $request)
    {
        $buscar=$request->buscar;
       
        if ($buscar=='') {
            $solicitudes=Solicitudes::orderBy('id_persona','asc')->paginate(12);
   
        }else {
            $solicitudes=Solicitudes::where(nomCom,'like','%'.$buscar.'%')->orderBy('nomCom','asc')->paginate(4);
        }

        
        
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

    public function store(Request $request) {

      try {

        DB::beginTransaction();

        $solicitudes= new Solicitudes();
        $solicitudes->fec_entrega=$request->fecE;
        $solicitudes->id_persona=$request->idPerso;
        $solicitudes->save();

        $detalles=$request->data;

        foreach($detalles as $key=>$det){
          $detalle=new DetSolicitudes();
          $detalle->id_solucitudes=$solicitudes->id;
          $detalle->id_libros= $det['id'];
          $detalle->cant=$det['cant'];
          $detalle->save();

        }
      DB::commit();

      } catch (Exception $e){
        DB::rollback();
        console.log('Error', $e);

      }


    }


    public function destroy(Request $request)
  {
    //
    $solicitudes=Solicitudes::findOrFail($request->id);
    $solicitudes->delete();
  }

}   