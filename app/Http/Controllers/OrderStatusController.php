<?php

namespace App\Http\Controllers;

use App\Models\ObjectResponse;
use App\Models\Order_status;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    /**
     * Mostrar lista de todos los status orden activos.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $list = Order_status::where('os_active',true)->select('os_id','os_name')->get();

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | lista estados de order.');
            data_set($response,'data', $list);

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * 
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Crear un nuevo status orden.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $new_order_status = Order_status::create([
                'os_name' => $request->os_name
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response, 'message', 'peticion satisfactoria | usuario registrado');
            data_set($response, 'alert_text', 'Status orden registrado');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Mostrar un status orden especifico.
     * @param  \App\Models\Order_status  $order_status
     * @param  \Illuminate\Http\Request  $request
     * @param   int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order_status $order_status, int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $order_status = Order_status::where('os_id',$id)
            ->select('os_id','os_name')->get();

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | status orden encontrado.');
            data_set($response,'data',$order_status);

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order_status  $order_status
     * @return \Illuminate\Http\Response
     */
    // public function edit(Order_status $order_status)
    // {
    //     //
    // }

    /**
     * Actualizar un status orden especifico.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order_status  $order_status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order_status $order_status)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $order_staus = Order_status::where('os_id',$request->os_id)
            ->update([
                'os_name' => $request->os_name
            ]);

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | status orden actualizado.');
            data_set($response,'data','Status orden actualizado.');
        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }        
        return response()->json($response,$response["status_code"]);
    }

    /**
     * "Eliminar" (cambiar estado activo=false) un status orden especidifco.
     * @param  \App\Models\Order_status  $order_status
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            Order_status::where('os_id',$id)
            ->update([
                'os_active' => false,
                'deleted_at' => date('Y-m-d H:i:s')
            ]);

            $response = Order_status::CorrectResponse();
            data_set($response,'message','petición satisfactoria | status orden eliminado.');
            data_set($response,'alert_text','Status orden eliminado');
            
        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }
}
