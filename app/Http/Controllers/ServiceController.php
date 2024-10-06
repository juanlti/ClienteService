<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $servicies = Service::all();
        return response()->json(['data' => $servicies, 'message' => 'Servicios listados correctamente'], status: 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }

    public function clients(){

        $servicios=Service::all();
        $serviciosConClientes=[];
        foreach($servicios as $servicio){
            $serviciosConClientes[]=[
                'servicio'=>$servicio,
                'clientes'=>$servicio->clients
            ];
        }

        return response()->json(['data'=>$serviciosConClientes,'message'=>'Servicios con clientes listados correctamente'],200);


    }
}
