<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Encuesta;

class EncuestaController extends Controller
{
    public function index(){

        $encuestas= Encuesta::all();

        return ['encuestas'=>$encuestas];

    }
}
