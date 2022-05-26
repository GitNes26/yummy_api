<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\ObjectResponse;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    /**
     * Mostrar lista de todos los roles activos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            // $lista = DB::select('SELECT * FROM roles where role_active = 1');
            $list = Role::where('role_active', true) #where('role_active','=',1)
            ->select('roles.role_id','roles.role_name')
            ->orderBy('roles.role_name', 'ASC')
            ->get();

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | lista roles.');
            data_set($response,'data',$list);

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $request)
    // {
        
    // }

    /**
     * Crear un nuevo rol.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $new_role = Role::create([
                'role_name' => $request->role_name,
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | rol registrado.');
            data_set($response,'alert_text','Rol registrado');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Mostrar un rol especifico.
     *
     * @param  \App\Models\Role  $role
     * @param  \Illuminate\Http\Request  $request
     * @param   int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $role = Role::where('role_id', $id)
            ->select('roles.role_id','roles.role_name')
            ->get();

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | rol encontrado.');
            data_set($response,'data',$role);

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function edit(Request $request)
    // {
    //     //
    // }

    /**
     * Actualizar un rol especifico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $role = Role::where('role_id', $request->role_id)
            ->update([
                'role_name' => $request->role_name,
            ]);

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | rol actualizado.');
            data_set($response,'alert_text','Rol actualizado');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Eliminar (cambiar estado activo=false) un rol especidifco.
     *
     * @param  \App\Models\Role  $role
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            Role::where('role_id', $id)
            ->update([
                'role_active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | rol eliminado.');
            data_set($response,'alert_text','Rol eliminado');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }
}
