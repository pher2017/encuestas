<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pregunta;
class PreguntaController extends Controller
{
    public function index(){

        $preguntas = Pregunta::all();


        return ['preguntas' => $preguntas];

    }
}
