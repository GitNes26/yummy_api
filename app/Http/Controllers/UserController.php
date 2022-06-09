<?php

namespace App\Http\Controllers;

use App\Models\ObjectResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Metodo para validar credenciales e
     * inicar sesión
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        $user = User::where('username', $request->username)
        ->first();

        if(!$user || !Hash::check($request->password, $user->password)) {

            throw ValidationException::withMessages([
                'message'=>['Credenciales incorrectas'],
                'alert_title.'=>['Credenciales incorrectas'],
                'alert_text'=>['Credenciales incorrectas'],
            ]);
        }
        $token = $user->createToken($request->username, ['user'])->plainTextToken;
        $response = ObjectResponse::CorrectResponse();
        data_set($response,'message','peticion satisfactoria | usuario logeado.');
        data_set($response,'token',$token);
        data_set($response,'data',$user);
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Metodo para cerrar sesión.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function logout(int $id)
    {
        try {
            DB::table('personal_access_tokens')->where('tokenable_id', $id)->delete();
            
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | sesión cerrada.');
            data_set($response,'alert_title','Bye!');
            
        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }


    /**
     * Mostrar lista de todos los usuarios activos del
     * uniendo con roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            // $lista = DB::select('SELECT * FROM users where active = 1');
            $list = User::where('active', true)
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->select('users.id','users.name','users.last_name','users.email','users.username','users.phone','roles.role_id','roles.role_name')
            ->get();
            
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | lista de usuarios.');
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
     * Crear un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = ObjectResponse::DefaultResponse();
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
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | usuario registrado.');
            data_set($response,'alert_text','Usuario registrado');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
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
        $response = ObjectResponse::DefaultResponse();
        try {
            $user = User::where('id', $id)
            ->join('roles', 'users.role_id', '=', 'roles.role_id')
            ->select('users.id','users.name','users.last_name','users.email','users.username','users.phone','roles.role_id','roles.role_name')
            ->get();

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | usuario encontrado.');
            data_set($response,'data',$user);

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
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
        $response = ObjectResponse::DefaultResponse();
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

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | usuario actualizado.');
            data_set($response,'alert_text','Usuario actualizado');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }        
        return response()->json($response,$response["status_code"]);
    }

    /**
     * "Eliminar" (cambiar estado activo=false) un usuario especidifco.
     *
     * @param  \App\Models\User  $user
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            User::where('id', $id)
            ->update([
                'active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | usuario eliminado.');
            data_set($response,'alert_text','Usuario eliminado');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }
}