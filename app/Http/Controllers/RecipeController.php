<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\ObjectResponse;
use Illuminate\Http\Request;

class RecipeController extends Controller
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
            $list = Recipe::where('recipe_active', true)
            ->select('recipes.recipe_name', 
            'recipes.product_id', 'recipes.recipe_quantity',
            'recipes.row_material_id','recipes.measure_id')
            ->orderBy('recipes.recipe_name', 'ASC')
            ->get();
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message', 'peticion satisfactoria | lista de recetas:');
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
        try {
            $new_recipe = Recipe::create([
                'recipe_name' => $request->recipe_name,
                'product_id' => $request->product_id,
                'recipe_quantity' => $request->recipe_quantity,
                'measure_id' => $request->measure_id,
                'row_material_id' => $request->row_material_id,
                'recipe_active' => $request->recipe_active,
            ]);

            $response = ObjectResponse::CorrectResponse();
            data_set($response, 'message', 'peticion satisfactoria | receta registrada');
            data_set($response, 'alert_text', 'Rol registrado');
        }
        catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response["status_code"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            $recipe = Recipe::where('recipe_id', $id)
            ->select('recipes.recipe_name', 'recipes.product_id',
             'recipes.recipe_quantity','recipes.row_material_id','recipes.measure_id')
             ->get();
             
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | receta encontrado.');
            data_set($response,'data',$recipe);
        }
        catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
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
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | receta encontrado.');
            data_set($response,'data',$recipe);
        }
        catch (\Exception $ex) {
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            Recipe::where('recipe_id', $id)
            ->update([
                'recipe_active'=>false,
                'deleted_at'=> date('Y-m-d H:i:s'),
            ]);
        }
        catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse();
        }
        return response()->json($response,$response["status_code"]);
    }
}
