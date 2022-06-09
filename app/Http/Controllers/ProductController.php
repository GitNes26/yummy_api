<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ObjectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $list = Product::where('products.pro_active', true)
            ->select('products.pro_name','products.pro_cat_id',
            'products.pro_price')
            ->orderBy('products.pro_name', 'DESC')
            ->get();
             $response = ObjectResponse::CorrectResponse();
            data_set($response,'message', 'peticion satisfactoria | lista de productos:');
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
    /*public function create()
    {
        //
    }*/

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
            $new_product = Product::create([
                'pro_name' => $request->pro_name,
                'pro_cat_id' => $request->pro_cat_id,
                'pro_price' => $request->pro_price,
                'pro_active' => $request->pro_active
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response, 'message', 'peticion satisfactoria | producto registrado');
            data_set($response, 'alert_text', 'producto registrado');
        }
        catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response["status_code"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            $product = Product::where('pro_id', $id)
            ->select('products.pro_name, products.pro_cat_id',
            'products.pro_active', 'products.pro_price')
            ->get();

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | producto encontrado.');
            data_set($response,'data',$product);
        }
        catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    /*public function edit(Product $product)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            $product = Product::where('pro_id', $request->pro_id)
            ->update([
                'pro_name'=>$request->pro_name,
                'pro_cat_id'=>$request->pro_cat_id,
                'pro_price'=>$request->pro_price,
                'pro_active'=>$request->pro_active
            ]);

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | producto encontrado.');
            data_set($response,'data',$product);
        }
        catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            Product::where('pro_id', $id)
            ->update([
                'pro_active' => false,
                'deleted_at'=> date('Y-m-d H:i:s')
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response, 'message', 'petición satisfactoria.');
            data_set($response, 'alert_text', 'Producto eliminado.');        
        }
        catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse();
        }
        return response()->json($response,$response["status_code"]);
    }
}
