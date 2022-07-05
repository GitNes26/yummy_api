<?php
namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
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
            $list = Provider::where('providers.prov_active', true)
            ->select('providers.prov_name', 'providers.prov_country',
            'providers.prov_state', 'providers.prov_city', 'providers.prov.suburb',
            'providers.prov_suburb', 'providers.prov_address', 
            'providers.prov_phone_contact', 'providers.prov_contact_name')
            ->orderBy('providers.prov_name', 'ASC')->get();
            $response = ObjectResponse::CorrectResponse();
            data_set($response, 'message', 'petision satisfactoria | lista de proveedores',);
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
        try{
            $new_provider = Provider::create([
            'prov_name',
            'prov_country',
            'prov_state',
            'prov_city',
            'prov_suburb',
            'prov_address',
            'prov_phone_contact',
            'prov_contact_name',
            'prov_active',
            ]);
            $response = ObjectResponse::CorrectResponse();
            data_set($response, 'message', 'peticion satisfactoria | proveedor añadido');
            data_set($response, 'alert_text', 'proveedor guardado');
        }
        catch(\Exception $exc){
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
        return response()->json($response, $response["status_code"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $response = ObjectResponse::DefaultResponse();
        try{
            $provider = Provider::where('providers.prov_id', $id)
            ->select('providers.prov_name', 'providers.prov_country',
            'providers.prov_state', 'providers.prov_city', 
            'providers.prov_suburb', 'providers.prov_address', 
            'providers.prov_phone_contact', 'providers.prov_contact_name')
            ->get();
            $response = ObjectResponse::CorrectResponse();
            data_set($response,'message','peticion satisfactoria | proveedor encontrado.');
            data_set($response,'data',$provider);
        }
        catch(\Exception $ex){
            $response = ObjectResponse::CatchResponse($ex->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }
}
