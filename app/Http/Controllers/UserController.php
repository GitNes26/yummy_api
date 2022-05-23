<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
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
     * Mostrar lista de todos los usuarios activos del
     * uniendo con roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->DefaultResponse();
        try {
            // $lista = DB::select('SELECT * FROM users where active = 1');
            $list = User::where('active', true)
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->select('users.id','users.name','users.last_name','users.email','users.username','users.phone','roles.role_id','roles.role_name')
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
     * Crear un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = $this->DefaultResponse();
        try {
            $token = $request->bearerToken();
        
            $new_user = User::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role_id' => $request->role_id,
            ]);
            $response = array(
                'result' => 'correct',
                'message' => 'usuario creado'
            );
        } catch (\Throwable $th) {
            $response = $this->CatchResponse();
        }
        return response()->json($response);
    }

    /**
     * Mostrar un usuario especifico.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @param   int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = $this->DefaultResponse();
        try {
            $user = User::where('id', $id)
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->select('users.id','users.name','users.last_name','users.email','users.username','users.phone','roles.role_id','roles.role_name')
            ->get();

            $response = array([
                "result" => "correct",
                "data" => $user
            ]);
        } catch (\Throwable $th) {
            $response = $this->CatchResponse();
        }
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function edit(Request $request)
    // {
    //     //
    // }

    /**
     * Actualizar un usuario especifico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $response = $this->DefaultResponse();
        try {
            $user = User::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role_id' => $request->role_id,
            ]);

            $response = array(
                'result' => 'correct',
                'message' => 'usuario actualizado'
            );
        } catch (\Throwable $th) {
            $response = $this->CatchResponse();
        }        
        return response()->json($response);
    }

    /**
     * Eliminar (cambiar estado activo=false) un usuario especidifco.
     *
     * @param  \App\Models\User  $user
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = $this->DefaultResponse();
        try {
            User::where('id', $id)
            ->update([
                'active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            $response = array(
                'result' => 'correct',
                'message' => 'usuario eliminado'
            );
        } catch (\Throwable $th) {
            $response = $this->CatchResponse();
        }
        return response()->json($response);
    }
}