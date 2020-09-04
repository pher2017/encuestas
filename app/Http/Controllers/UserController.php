<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;


class UserController extends Controller
{
    public function index(){

        $users = User::select("*", DB::RAW("CONCAT(users.rut,' ',users.nombre) as full "))
        ->get();

        return ['users'=> $users];

    }
    public function selectUsers(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $users = User::where('nombre', 'like', '%' . $filtro . '%')
            ->select('id', 'rut', 'nombre', 'correo')->orderBy('id', 'asc')->get();
        return ['users' => $users];
    }
}
