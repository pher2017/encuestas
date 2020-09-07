<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Encuesta;
use App\Resultado;
use App\Participacion;

class EncuestaController extends Controller
{
    public function index(){
        if (!$request->ajax()) return redirect('/');

        $encuestas= Encuesta::all();

        return ['encuestas'=>$encuestas];

    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

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
