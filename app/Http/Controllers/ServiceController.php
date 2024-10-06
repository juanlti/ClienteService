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
        $servicies = Service::all();
        return response()->json(['data' => $servicies, 'message' => 'Servicios listados correctamente'], 200);
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
        // Crear una nueva instancia del modelo Service
        $service = new Service();

        // Asignar los valores del request a los atributos del modelo
        $service->price = $request->price;
        $service->name = $request->name;
        $service->description = $request->description;

        // Guardar el nuevo servicio en la base de datos
        $service->save();

        // Devolver una respuesta JSON con los datos del servicio creado y un mensaje de éxito
        return response()->json(['data' => $service, 'message' => 'Servicio creado correctamente'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $servicio = Service::find($id);
        return response()->json(['data' => $servicio, 'message' => 'Servicio listado correctamente'], 200);
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
    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        $service->price = $request->price;
        $service->save();
        return response()->json(['data' => $service, 'message' => 'Servicio actualizado correctamente'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        return response()->json(['message' => 'Servicio eliminado correctamente'], 200);
    }

    public function clients()
    {
        $servicios = Service::all();
        $serviciosConClientes = [];
        foreach ($servicios as $servicio) {
            $serviciosConClientes[] = [
                'servicio' => $servicio,
                'clientes' => $servicio->clients
            ];
        }

        return response()->json(['data' => $serviciosConClientes, 'message' => 'Servicios con clientes listados correctamente'], 200);
    }
}
