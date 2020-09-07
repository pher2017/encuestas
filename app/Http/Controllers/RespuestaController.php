<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Respuesta;
use App\Input;
use App\Pregunta;

class RespuestaController extends Controller
{
    public function index(){
        if (!$request->ajax()) return redirect('/');
        $respuestas = Respuesta::join('inputs','respuestas.idinput','=','inputs.id')
        ->join('preguntas','respuestas.idpregunta','=','preguntas.id')
        ->select(
            'preguntas.pregunta',
            'inputs.descripcion',
            'respuestas.valor'
        )
        ->orderBy('respuestas.id', 'asc')->paginate(10);

    


        return ['respuestas' => $respuestas];

    }

    public function all(Request $request){
     if (!$request->ajax()) return redirect('/');
        $respuestas=Respuesta::all();

        return ['respuestas'=>$respuestas];

    }

}
