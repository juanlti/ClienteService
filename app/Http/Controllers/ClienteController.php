<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //todos los clientes
        $clients = Cliente::all();
        $clientesWithData = [];
        //defino un arreglo vacio, que voy llenando con un objeto personalidado $clientesWithData

        //$clients->makeHidden('services');
        foreach ($clients as $client) {
            $clientesWithData[] = [
                'cliente' => $client,
                'servicios' => $client->services
            ];
        }

        return response()->json(['data' => $clientesWithData, 'message' => 'Clientes listados correctamente'], 200);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // no se utiliza en api, porque create es una vista
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // se utiliza para guardar

        // creo cliente vacio
        $nuevoCliente = new Cliente();
        // asigno los valores ingresados al cliente
        $nuevoCliente->name = $request->name;
        $nuevoCliente->email = $request->email;
        $nuevoCliente->phone = $request->phone;
        $nuevoCliente->address = $request->address;
        // guardo el nuevo cliente cargado
        $nuevoCliente->save();

        $data = [
            'message' => 'Cliente creado correctamente',
            'cliente' => $nuevoCliente
        ];
        return response()->json($data, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        //obtengo los servicios del cliente
        $servicios = $cliente->services;
        //oculto los servicios del cliente Pero se muestran por fuera del objeto cliente
        //$cliente->makeHidden('services');
        //RECORDATORIO: automaticamente el cliente obtiene los servicios asociados a el, por la relacion definida en el modelo
        // al convertir el objeto Cliente a json, se obtiene los servicios, y estos se incluyen dentro del objeto.

        $data = [
            'message' => 'Detalles cliente',
            'cliente' => $cliente,
            'servicios' => $servicios
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        // es una vista, no se utiliza en api
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        // $request valores ingresados por el usuario
        //actualizo los valors utilizando eloquent
        $cliente->phone = $request->phone;
        $cliente->address = $request->address;
        //guardo el cliente actualizado
        $cliente->save();

        $data = [
            'message' => 'Cliente actualizado correctamente',
            'cliente' => $cliente
        ];
        return response()->json(data: $data, status: 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //elimino el cliente
        $cliente=$request->client_id;
        $cliente = Cliente::find($cliente);
        $cliente->delete();

        $data = [
            'message' => 'Cliente eliminado correctamente',
            'cliente' => $cliente
        ];
        return response()->json(data: $data, status: 200);
    }

    public function attachService(Request $request)
    {
        //attachService, a un cliente le agrega un servicio,
        // id_cliente y id_servicios vienen en el Request.
        $idCliente = $request->client_id;
        $idServicio = $request->service_id;
        //dd($idCliente, $idServicio);
        $cliente = Cliente::find($idCliente);
        $cliente->services()->attach($idServicio);
        $data = [
            'message' => 'Servicio asignado correctamente',
            'cliente' => $cliente,
            'servicie' => $idServicio
        ];
        return response()->json(data: $data, status: 200);
    }

    public function detachhService(Request $request)
    {
        //attachService, a un cliente le quito  un servicio,
        // id_cliente y id_servicios vienen en el Request.
        $idCliente = $request->client_id;
        $idServicio = $request->service_id;
        //dd($idCliente, $idServicio);
        $cliente = Cliente::find($idCliente);
        $cliente->services()->detach($idServicio);
        $data = [
            'message' => 'Servicio eliminado correctamente',
            'cliente' => $cliente,
            'servicie' => $idServicio
        ];
        return response()->json(data: $data, status: 200);
    }



}
