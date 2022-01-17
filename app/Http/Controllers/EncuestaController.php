<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Encuesta;
use App\Resultado;
use App\Participacion;

class EncuestaController extends Controller
{
    public function index(Request $request){
        //if (!$request->ajax()) return redirect('/');

        $encuestas= Encuesta::select(
            'id',
            'encuestas.descripcion',
            'encuestas.fecha',
        )
        ->where('encuestas.id','=','3')
        ->orderBy('encuestas.id', 'asc')->paginate(500);

        return ['encuestas'=>$encuestas];

    }
    public function getEncuestas(Request $request){

        $encuestas= Encuesta::select(
            'id',
            'encuestas.descripcion',
            'encuestas.fecha'
        )
        ->where('encuestas.id','=','3')
        ->orderBy('encuestas.id', 'asc')->paginate(500);

        return ['encuestas'=>$encuestas];

    }

    public function store(Request $request)
    {


        try {
            DB::beginTransaction();

            $resultado = new Resultado();
            $resultado->idrespuesta = $request->idrespuesta;
            $resultado->idencuesta = $request->idencuesta;
            $resultado->idregion = $request->idregion;
            $resultado->idpregunta = $request->idpregunta;
            $resultado->fecha = now();
            $resultado->save();

            $participacion = new Participacion();

            $participacion->idencuesta = $request->idencuesta;
            $participacion->iduser = $request->idusers;
            $participacion->fecha = now();
            $participacion->save();




            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
