<?php

namespace App\Http\Controllers;

use App\Models\RowMaterial;
use Illuminate\Http\Request;

class RowMaterialController extends Controller
{
    public function index()
    {
    $response = ObjectResponse::DefaultResponse();
        try {
            $list = RowMaterial::where('row_materials.rm_active', true)
            ->select('row_materials.rm_name', 
            'row_materials.rm_name', 'row_materials.rm_measure unity',
            'row_materials.rm_unity_quantity','row_materials.rm_stock', 'row_materials.rm_unit_price')
            ->orderBy('recipes.rec_name', 'ASC')
            ->get();
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message', 'peticion satisfactoria | lista de materias primas:');
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
                'rm_name' => $request->rm_name,
                'rm_measure_unity' => $request->rm_measure_unity,
                'rm_unity_quantity' => $request->rm_unity_quantity,
                'rm_prov_id'=>$request->rm_prov_id,
                'rm_stock' => $request->rm_stock,
                'rm_unit_price' => $request->rm_unit_price,
                'rm_active' => $request->rm_active,
            ]);

            $response = ObjectResponse::CorrectResponse();
            data_set($response, 'message', 'peticion satisfactoria | materia prima registrada');
            data_set($response, 'alert_text', 'receta registrada');
        }
        catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response["status_code"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RowMaterial  $row_material
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            $recipe = RowMaterial::where('row_materials.rm_id', $id)
            ->select('row_materials.rm_name', 'row_materials.rm_measure_unity',
             'row_materials.rm_unity_quantity','row_materials.rm_stock','row_materials.rm_unit_price')
             ->get();
             
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | materia prima encontrada.');
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
     * @param  \App\Models\RowMaterial  $row_material
     * @return \Illuminate\Http\Response
     */
   /* public function edit(RowMaterial $row_material)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RowMaterial  $row_material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $response = $this->DefaultResponse();
        $status = 200;
        try{
            $recipe = RowMaterial::where('rm_id', $id)
            ->update([
                'rm_name' => $request->rm_name,
                'rm_measure_unity' => $request->rm_measure_unity,
                'rm_unity_quantity' => $request->rm_unity_quantity,
                'rm_prov_id'=> $request->rm_prov_id,
                'rm_stock' => $request->rm_stock,
                'rm_unit_price' => $request->rm_unit_price,
                'rm_active' => $request->rm_active,
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | materia prima actualizada.');
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
     * @param  \App\Models\RowMaterial $row_material
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            RowMaterial::where('rm_id', $id)
            ->update([
                'rm_active'=>false,
                'deleted_at'=> date('Y-m-d H:i:s'),
            ]);
        }
        catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse();
        }
        return response()->json($response,$response["status_code"]);
    }
}
