<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participacion;

class ParticipacionController extends Controller
{
    public function index(Request $request){
        if (!$request->ajax()) return redirect('/');
        $participacion = Participacion::join('encuestas','participacion.idencuesta','=','encuestas.id')
        ->join('users','participacion.iduser','=','users.id')
        ->select(
            'participacion.id',
            'users.numero',
            'users.id as iduser',
            'users.nombre',
            'encuestas.descripcion'
        )
        ->orderBy('participacion.id', 'asc')->paginate(500);

    


        return ['participacion' => $participacion];


    }

    public function getUser(Request $request){
        if (!$request->ajax()) return redirect('/');
        $users=Participacion::join('encuestas','participacion.idencuesta','=','encuestas.id')
        ->join('users','participacion.iduser','=','users.id')
        ->select(
            'participacion.id',
            'participacion.iduser',
            'users.numero',
            'users.nombre',
            'encuestas.descripcion'
        )
      ->where('participacion.iduser','=',$request->j)
      ->first();

        
    return ['users' => $users];


    }
}
