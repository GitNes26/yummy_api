<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private function DefaultResponse(){
        $response =[
            "status" => false,
            "message" => "No se ha completado la petición.",
            "data" => [],
        ];
        return $response;
    }
    private function CatchResponse(){
        $response =[
            "status"=>false,
            "message"=>"Ocurrio un error, verifica tus datos",
            "data"=>[],
        ];
        return $response;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = $this->DefaultResponse();
        $status = 200;
        try {
            $list = Product::where('product_active', true)
            ->select('products.product_name','products.category_id',
            'products.product_price')
            ->orderBy('products.product_name', 'DESC')
            ->get();
            $response = [
                "result" => "correct",
                "data" => $list
            ];
        }
        catch(\Throwable $th){
            $status = 400;
            $response = $this->CatchResponse();
        }
        return response()->json($response, $status);
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
        $response = $this->DefaultResponse();
        $status = 200;
        try{
            $new_product = Product::create([
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'product_price' => $request->product_price,
                'product_active' => $request->product_active
            ]);
            $response = [
                'result' => 'correct',
                'message' => 'producto creado',
            ];
        }
        catch(\Throwable $th){
            $status = 400;
            $response = $this->CatchResponse();
        }
        return response()->json($response, $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = $this->DefaultResponse();
        $status = 200;
        try{
            $product = Product::where('product_id', $id)
            ->select('products.product_name, products.category_id',
            'products.product_active', 'products.product_price')
            ->get();

            $response = [
                "result" => "correct",
                "data" => $product
            ];
        }
        catch(\Throwable $th){
            $status = 400;
            $response = $this->CatchResponse();
        }
        return response()->json($response, $status);
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
        $response = $this->DefaultResponse();
        $status = 200;
        try{
            $product = Product::where('product_id', $request->product_id)
            ->update([
                'product_name'=>$request->product_name,
                'category_id'=>$request->category_id,
                'product_price'=>$request->product_price,
                'product_active'=>$request->product_active
            ]);

            $response = [
                'result' => 'correct',
                'message' => 'producto actualizado'
            ];
        }
        catch(\Throwable $th) {
            $status = 400;
            $response = $this->CatchResponse();
        }
        return response()->json($response, $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = $this->DefaultResponse();
        $status = 200;

        try{
            Product::where('product_id', $id)
            ->update([
                'product_active' => false,
                'deleted_at'=> date('Y-m-d H:i:s')
            ]);
            $response = [
                'result' => 'correct',
                'message' => 'producto eliminado'
            ];        
        }
        catch(\Throwable $th){
            $status = 400;
            $response = $this->CatchResponse();
        }
        return response()->json($response, $status);
    }
}
