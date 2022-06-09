<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ObjectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
            $list = Category::where('category_active', true)
            ->select('categories.category_name', 'categories.category_description')
            ->orderBy('categories.category_name', 'ASC')
            ->get();
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message', 'peticion satisfactoria | lista de categorias:');
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = ObjectResponse::DefaultResponse();
        try {
            $new_recipe = Category::create([
                'category_name' => $request->category_name,
                'category_description' => $request->category_description,
                'category_active'=> $request->category_active
            ]);

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | categoria registrada.');
            data_set($response,'alert_text','Categoria registrada');
        }
        catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response["status_code"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            $category = Category::where('category_id', $id)
            ->select('categories.category_name', 'categories.category_description')
             ->get();
             
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | categoria encontrada.');
            data_set($response,'data',$category);
        }
         catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    /*public function edit(Category $category)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            $recipe = Category::where('category_id', $id)
            ->update([
                'category_name' => $request->category_name,
                'category_description' => $request->category_description,
                'category_active' => $request->category_active
            ]);

            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | rol actualizado.');
            data_set($response,'alert_text','Categoria actualizado');
        }
        catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            Category::where('category_id', $id)
            ->update([
                'category_active'=>false,
                'deleted_at'=> date('Y-m-d H:i:s'),
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response, 'message', 'petición satisfactoria.');
            data_set($response, 'alert_text', 'Categoria eliminada.');
        }
        catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }
}
