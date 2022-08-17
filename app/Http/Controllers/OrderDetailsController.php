<?php

namespace App\Http\Controllers;

use App\Models\ObjectResponse;
use App\Models\Order_details;
use App\Models\Order_status;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            $list = Order_details::where('order_status.os_name','=','En cola')
            ->join('orders as O', 'O.order_id','=','order_details.od_order_id')
            ->join('recipes as R', 'R.rec_id', '=', 'order_details.od_rec_id')
            ->join('products as P', 'P.pro_id', '=', 'R.rec_pro_id')
            ->select('od_order_id','od_quantity', 'R.rec_quantity_usage', 'od_complement', 'R.rec_milk', 'od_names')
            ->get();

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message', 'peticion satisfactoria | lista de ordenes carrito general.');
            data_set($response, 'data', $list);
        }catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response["status_code"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function create()
    //{
        //
    //}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $response = ObjectResponse::DefaultResponse();
        try{
            $new_Orderdetail = Order_details::create([
                'od_order_id' => $request->order_id,
                'od_recipe_id' => $request->recipe_id,
                'od_unit_price' => $request->od_unit_price,
                'od_quantity' => $request->od_quantity,
                'od_complements' => $request->complements,
                'od_name' => $request->od_name
            ]);
            $new_Orderdetail->save();

            
        } catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response["status_code"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order_details  $order_details
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            $list = Order_details::where('order_status.os_name', 'En cola' ,'and', 'order_details.od_order_id', $id)
            ->join('orders as O', 'O.order_id','=','order_details.od_order_id')
            ->join('recipes as R', 'R.rec_id', '=', 'order_details.od_rec_id')
            ->join('products as P', 'P.pro_id', '=', 'R.rec_pro_id')
            ->select('od_quantity', 'R.rec_quantity_usage', 'od_complement', 'R.rec_milk', 'od_names')
            ->get();
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message', 'peticion satisfactoria | lista de ordenes carrito.');
            data_set($response, 'data', $list);
        }catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response["status_code"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order_details  $order_details
     * @return \Illuminate\Http\Response
     */
    //public function edit(Order_details $order_details)
    //{
        //
    //}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order_details  $order_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order_details $order_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order_details  $order_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            Order_details::where('od_order_id', $id)
            ->update([
                'od_active' => false,
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | Detalle Orden eliminada.');
            data_set($response,'alert_text','Detalle Orden eliminada');
        }catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }
}
