<?php

namespace App\Http\Controllers;

use App\Models\Branch_office;
use App\Models\ObjectResponse;
use Illuminate\Http\Request;

class BranchOfficeController extends Controller
{
    /**
     * Mostrar lista de todas las sucursales activas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $list = Branch_office::where('bo_active', true)
            ->select('bo_id','bo_name','bo_country','bo_state','bo_city','bo_address')
            ->get();

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | lista sucursales.');
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
    public function create()
    {
        //
    }

    /**
     * Crear una nueva sucursal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $new_branch_office = Branch_office::create([
                'bo_name' => $request->bo_name,
                'bo_country' => $request->bo_country,
                'bo_state' => $request->bo_state,
                'bo_city' => $request->bo_city,
                'bo_address' => $request->bo_address,
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | sucursal registrada.');
            data_set($response,'alert_text','Sucursal registrado');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Mostrar una sucursal especifica.
     *
     * @param  \App\Models\Branch_office  $branch_office
     * @param  \Illuminate\Http\Request  $request
     * @param   int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $user = Branch_office::where('bo_id', $id)
            ->select('bo_id','bo_name','bo_country','bo_state','bo_city','bo_address')
            ->get();

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | sucursal encontrada.');
            data_set($response,'data',$user);

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch_office  $branch_office
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch_office $branch_office)
    {
        //
    }

    /**
     * Actualizar una sucursal especifica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch_office  $branch_office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $user = Branch_office::where('bo_id', $request->bo_id)
            ->update([
                'bo_name' => $request->bo_name,
                'bo_country' => $request->bo_country,
                'bo_state' => $request->bo_state,
                'bo_city' => $request->bo_city,
                'bo_address' => $request->bo_address,
            ]);

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | sucursal actualizado.');
            data_set($response,'alert_text','Sucursal actualizado');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }        
        return response()->json($response,$response["status_code"]);
    }

    /**
     * "Eliminar" (cambiar estado activo=false) una sucursal especidifca.
     *
     * @param  \App\Models\Branch_office  $branch_office
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            Branch_office::where('bo_id', $id)
            ->update([
                'bo_active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | sucursal eliminada.');
            data_set($response,'alert_text','Sucursal eliminada');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }
}
