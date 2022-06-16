<?php

namespace App\Http\Controllers;

use App\Models\ObjectResponse;
use App\Models\Order;
use App\Models\Order_status;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Actualizar el status de la orden.
     *
     * @param  \Illuminate\Http\Request  $request (id,empleado_id,order_os_id)
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function statusUpdate(Request $request)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $order = Order::where('order_id', $request->order_id)
            ->update([
                "order_employee_id" => $request->order_employee_id ,
                "order_os_id" => $request->order_os_id
            ]);

            $new_status = Order_status::where('os_id', $request->order_os_id)->select('os_name')->first();

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | status actualizado a la orden.');
            data_set($response,'alert_title','Orden actualizada');
            data_set($response,'alert_text',"status de orden: $new_status->os_name");

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }



    #region CRUD BASICO
    /**
     * Mostrar lista de ordenes activas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            $list = Order::where('order_active',true)
            ->join('users as e','order_employee_id','=','e.id')
            ->join('users as t','order_table_id','=','t.id')
            ->join('branch_offices as bo','order_bo_id','=','bo_id')
            ->join('order_status as os','order_os_id','=','os_id')
            ->select('order_id','e.id as employee_id', 'e.name as employee_name', 'e.last_name as employee_lastname','t.id as table_id','t.name as table_name','bo_id','bo_name','os_id','os_name','order_date')
            ->get();

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message', 'peticion satisfactoria | lista de ordenes.');
            data_set($response, 'data', $list);
        }
        catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response["status_code"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Crear una nueva orden.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $new_order = Order::create([
                'order_employee_id' => $request->order_employee_id,
                'order_table_id' => $request->order_table_id,
                'order_bo_id' => $request->order_bo_id,
                'order_os_id' => $request->order_os_id,
            ]);

            $new_order->save();
            $order_id = $new_order->order_id;
            // $order_detail = new OrderDetailsController($order_id);


            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message',"peticion satisfactoria | orden registrada $order_id.");
            data_set($response,'alert_text','Tu orden esta en cola.');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Mostrar una orden especifico.
     *
     * @param  \App\Models\Order  $order
     * @param  \Illuminate\Http\Request  $request
     * @param   int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $order = Order::where('order_id', $id)
            ->join('users as e','order_employee_id','=','e.id')
            ->join('users as t','order_table_id','=','t.id')
            ->join('branch_offices as bo','order_bo_id','=','bo_id')
            ->join('order_status as os','order_os_id','=','os_id')
            ->select('order_id','e.id as employee_id', 'e.name as employee_name', 'e.last_name as employee_lastname','t.id as table_id','t.name as table_name','bo_id','bo_name','os_id','os_name','order_date')
            ->get();

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | orden encontrada.');
            data_set($response,'data',$order);

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function edit(Request $request)
    // {
    //     //
    // }

    /**
     * Actualizar una orden especifico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $order = Order::where('order_id', $request->order_id)
            ->update([
                "order_employee_id" => $request->order_employee_id ,
                "order_table_id" => $request->order_table_id,
                "order_bo_id" => $request->order_bo_id,
                "order_os_id" => $request->order_os_id
            ]);

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | orden actualizada.');
            data_set($response,'alert_text','Orden actualizada');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Eliminar (cambiar estado activo=false) una orden especidifco.
     *
     * @param  \App\Models\Order  $order
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            Order::where('order_id', $id)
            ->update([
                'order_active' => false,
                'deleted_at' => date('Y-m-d H:i:s'),
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | orden eliminada.');
            data_set($response,'alert_text','Orden eliminada');

        } catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }
    #endregion
}
