<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Region;


class UserController extends Controller
{
    public function index(Request $request){
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        if($buscar ==''){
            return [];

        }
        else{
        $users = User::join('regions','users.idregion','=','regions.id')
        ->select(
            'users.numero',
            'users.dv',
            'users.nombre',
            'regions.descripcion',
            'users.cargo',
            'users.centro',
            'users.correo',
            'users.telefono'

        )
        ->where('users.numero', '=', $buscar)
     
        ->orderBy('users.id')->paginate(10);
        }

        return ['users'=> $users];

    }
    public function selectUsers(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $user = User::where('numero', 'like', '%' . $filtro . '%')
            ->select("*", DB::RAW("CONCAT(users.numero,'-',users.dv,' ',users.nombre) as full "))->orderBy('id', 'asc')->get();
        return ['users' => $user];
    }

    public function selectReporte(Request $request){
        $buscar = $request->buscar;
       


        if ($buscar == '') {
            $reportes = User::join('regions', 'users.idregion', '=', 'regions.id')   
                ->select(
                    'users.numero',
                    'users.dv',
                    'users.nombre',
                    'regions.descripcion',
                    'users.cargo',
                    'users.centro',
                    'users.correo',
                    'users.telefono'
                    
                )
                ->where('users.condicion', '=', 1)

                ->orderBy('users.id', 'asc')->paginate(50);
        } else{
            $reportes = User::join('regions', 'users.idregion', '=', 'regions.id')   
            ->select(
                'users.numero',
                'users.dv',
                'users.nombre',
                'regions.descripcion',
                'users.cargo',
                'users.centro',
                'users.correo',
                'users.telefono'
                
            )
                ->where('users.nombre', 'like', '%' . $buscar . '%')
                ->orWhere('users.numero', 'like', '%' . $buscar . '%')
                ->orderBy('users.id', 'asc')->paginate(50);
        }


        return [
            
            'reportes' => $reportes
        ];
    }


}

