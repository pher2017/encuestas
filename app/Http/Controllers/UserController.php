<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Region;


class UserController extends Controller
{
    public function index(Request $request){
      // if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;

        $users = User::join('regions','users.idregion','=','regions.id')
        ->select(
            'users.id',
            'users.numero',
            'users.dv',
            'users.nombre',
            'regions.id as idregion',
            'regions.descripcion',
            'users.cargo',
            'users.centro',
            'users.correo',
            'users.telefono'

        )
        ->where('users.numero', '=', $buscar)

        ->orderBy('users.id')->paginate(10);


        return ['users'=> $users];

    }
    public function selectUsers(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $user = User::where('numero', 'like', '%' . $filtro . '%')
            ->select("*", DB::RAW("CONCAT(users.numero,'-',users.dv,' ',users.nombre) as full "))

            ->orderBy('id', 'asc')->get();
        return ['users' => $user];
    }

    public function selectReporte(Request $request){
        if (!$request->ajax()) return redirect('/');
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
    public function update(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->correo = $request->correo;
        $user->telefono = $request->telefono;
        $user->save();
    }

    public function usersAll(Request $request)
    {
        $users = User::join('regions', 'users.idregion', '=', 'regions.id')
                ->select(
                    'users.id',
                    'users.numero',
                    'users.dv',
                    'users.nombre',
                    'regions.descripcion',
                    'users.cargo',
                    'users.centro',
                    'users.correo',
                    'users.telefono',
                    'users.updated_at as date'

                )
                ->where('users.condicion', '=', 1)
                ->orderBy('users.id', 'asc')->paginate(5000);

        return ['users'=>$users];
    }
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
            DB::beginTransaction();

            $resultado = new User();
            $resultado->numero = $request->numero;
            $resultado->dv = $request->dv;
            $resultado->nombre = $request->nombre;
            $resultado->descripcion = $request->descripcion;
            $resultado->cargo = $request->cargo;
            $resultado->correo = $request->correo;
            $resultado->telefono = $request->telefono;
            $resultado->updated_at = now();
            $resultado->save();






            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }


}

