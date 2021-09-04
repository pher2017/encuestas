<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pregunta;
class PreguntaController extends Controller
{
    public function index(Request $request){
       // if (!$request->ajax()) return redirect('/');
        $preguntas = Pregunta::join('encuestas','preguntas.idencuensta','=','encuestas.id')
        ->select(
        'preguntas.id as idpregunta',
        'encuestas.id as idencuestas',
        'encuestas.descripcion',
        'preguntas.pregunta'
        )
        ->where('preguntas.id','=','2')
        ->orderBy('preguntas.id', 'asc')->paginate(500);


        return ['preguntas' => $preguntas];

    }
}
