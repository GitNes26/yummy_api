<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
            $list = Category::where('category_active', true)
            ->select('categories.category_name', 'categories.category_description')
            ->orderBy('categories.category_name', 'ASC')
            ->get();
            $response =[
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
        $response = $this->DefaultResponse();
        $status = 200;
        try {
            $new_recipe = Category::create([
                'category_name' => $request->category_name,
                'category_description' => $request->category_description,
                'category_active'=> $request->category_active
            ]);

            $response = [
                'result'=>"correct",
                'message' => 'categoria creada'
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = $this->DefaultResponse();
        $status = 200;
        try{
            $category = Category::where('category_id', $id)
            ->select('categories.category_name', 'categories.category_description')
             ->get();
             
             $response = [
                 "result" => "correct",
                 "data" => $category
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
        $response = $this->DefaultResponse();
        $status = 200;
        try{
            $recipe = Category::where('category_id', $id)
            ->update([
                'category_name' => $request->category_name,
                'category_description' => $request->category_description,
                'category_active' => $request->category_active
            ]);

            $response = [
                'result' =>'correct',
                'message' => 'receta actualizada'
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = $this->DefaultResponse();
        $status = 200;

        try{
            Category::where('category_id', $id)
            ->update([
                'category_active'=>false,
                'deleted_at'=> date('Y-m-d H:i:s'),
            ]);
        }
        catch(\Throwable $th){
            $status = 400;
            $response = $this->CatchResponse();
        }
        return response()->json($response, $status);
    }
}
