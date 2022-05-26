<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
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
            $list = Recipe::where('recipe_active', true)
            ->select('recipes.recipe_name', 
            'recipes.product_id', 'recipes.recipe_quantity',
            'recipes.row_material_id','recipes.measure_id')
            ->orderBy('recipes.recipe_name', 'ASC')
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
        try {
            $new_recipe = Recipe::create([
                'recipe_name' => $request->recipe_name,
                'product_id' => $request->product_id,
                'recipe_quantity' => $request->recipe_quantity,
                'measure_id' => $request->measure_id,
                'row_material_id' => $request->row_material_id,
                'recipe_active' => $request->recipe_active,
            ]);

            $response = [
                'result'=>"correct",
                'message' => 'receta creada'
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
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = $this->DefaultResponse();
        $status = 200;
        try{
            $recipe = Recipe::where('recipe_id', $id)
            ->select('recipes.recipe_name', 'recipes.product_id',
             'recipes.recipe_quantity','recipes.row_material_id','recipes.measure_id')
             ->get();
             
             $response = [
                 "result" => "correct",
                 "data" => $recipe
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
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
   /* public function edit(Recipe $recipe)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $response = $this->DefaultResponse();
        $status = 200;
        try{
            $recipe = Recipe::where('recipe_id', $id)
            ->update([
                'recipe_name' => $request->recipe_name,
                'product_id' => $request->product_id,
                'recipe_quantity' => $request->recipe_quantity,
                'measure_id' => $request->measure_id,
                'row_material_id' => $request->row_material_id,
                'recipe_active' => $request->recipe_active,
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
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = $this->DefaultResponse();
        $status = 200;

        try{
            Recipe::where('recipe_id', $id)
            ->update([
                'recipe_active'=>false,
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
