<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private function DefaultResponse() {
        $response = array([
            "result" => "incorrect",
            "data" => "no se logro completar la petcion"
        ]);
        return $response;
    }
    private function CatchResponse() {
        $response = array([
            "result" => "incorrect",
            "data" => "no se logro completar la petcion"
        ]);
        return $response;
    }


    /**
     * Mostrar lista de todos los roles activos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->DefaultResponse();
        try {
            // $lista = DB::select('SELECT * FROM roles where role_active = 1');
            $list = Role::where('role_active', true)
            ->select('roles.role_id','roles.role_name')
            ->orderBy('roles.role_name', 'ASC')
            ->get();

            $response = array([
                "result" => "correct",
                "data" => $list
            ]);
        } catch (\Throwable $th) {
            $response = $this->CatchResponse();
        }
        return response()->json($response);
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
        $response = $this->DefaultResponse();
        try {
            $new_role = Role::create([
                'role_name' => $request->role_name,
            ]);

            $response = array(
                'result' => 'correct',
                'message' => 'rol creado'
            );
        } catch (\Throwable $th) {
            $response = $this->CatchResponse();
        }
        return response()->json($response);
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
        $response = $this->DefaultResponse();
        try {
            $role = Role::where('role_id', $id)
            ->select('roles.role_id','roles.role_name')
            ->get();

            $response = array([
                "result" => "correct",
                "data" => $role
            ]);
        } catch (\Throwable $th) {
            $response = $this->CatchResponse();
        }
        return response()->json($response);
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
        $response = $this->DefaultResponse();
        try {
            $role = Role::where('role_id', $request->role_id)
            ->update([
                'role_name' => $request->role_name,
            ]);

            $response = array(
                'result' => 'correct',
                'message' => 'rol actualizado'
            );            
        } catch (\Throwable $th) {
            $response = $this->catchResponse();
        }
        return response()->json($response);
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
        $response = $this->DefaultResponse();
        try {
            Role::where('role_id', $id)
            ->update([
                'role_active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);

            $response = array(
                'result' => 'correct',
                'message' => 'rol eliminado'
            );            
        } catch (\Throwable $th) {
            $response = $this->CatchResponse();
        }
        return response()->json($response);
    }
}
