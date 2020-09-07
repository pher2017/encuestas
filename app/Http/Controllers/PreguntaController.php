<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pregunta;
class PreguntaController extends Controller
{
    public function index(){
        if (!$request->ajax()) return redirect('/');
        $preguntas = Pregunta::all();


        return ['preguntas' => $preguntas];

    }
}
