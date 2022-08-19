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
            $list = Recipe::where('rec_active', true)
            ->select('recipes.rec_milk', 'recipes.rec_pro_id', 'recipes.rec_quantity_usage',
            'recipes.rec_measure')
            ->orderBy('recipes.rec_id', 'ASC')
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
                'rec_product_id' => $request->product_id,
                'rec_milk' => $request->rec_milk_id,
                'rec_quantity_usage' => $request->rec_quantity_usage,
                'rec_measure' => $request->rec_measure
            ]);
            $new_recipe->save();
            $recipe_id = $new_recipe->rec_id;
            
            //return redirect()->action([OrderDetailsController::class, 'store'], ['recipe_id' => $recipe_id, $request->except('rec_milk','rec_product_id','rec_quantity_usage','rec_measure')]);

            $response = ObjectResponse::CorrectResponse();
            
            data_set($response, 'message', 'peticion satisfactoria | receta registrada');
            data_set($response, 'alert_text', 'receta registrada');
        }
        catch(\Exception $ex){
            
            //$response = ObjectResponse::CatchResponse($ex->getMessage());
            return data_set($response, 'alert_text', $request);
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
            $recipe = Recipe::where('rec_id', $id)
            ->select('recipes.rec_milk', 'recipes.rec_pro_id',
             'recipes.rec_quantity_usage','recipes.rec_measure')
             ->get();
             
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | receta encontrada.');
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
            $recipe = Recipe::where('rec_id', $id)
            ->update([
                'rec_milk' => $request->rec_milk,
                'rec_pro_id' => $request->rec_pro_id,
                'rec_quantity_usage' => $request->rec_quantity_usage,
                'rec_measure' => $request->rec_measure,
                'rec_active' => $request->rec_active,
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | receta actualizada.');
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
            Recipe::where('rec_id', $id)
            ->update([
                'rec_active'=>false,
                'deleted_at'=> date('Y-m-d H:i:s'),
            ]);
        }
        catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response,$response["status_code"]);
    }
}
