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
        //
        $clients = Cliente::all();


        return response()->json(data: $clients, status: 200);
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

        //creo cliente vacio
        $nuevoCliente = new Cliente();
        //asigno los valores ingresados al cliente
        $nuevoCliente->name = $request->name;
        $nuevoCliente->email = $request->email;
        $nuevoCliente->phone = $request->phone;
        $nuevoCliente->address = $request->address;
        //guardo el nuevo cliente cargado
        $nuevoCliente->save();

        $data = [
            'message' => 'Cliente creado correctamente',
            'cliente' => $nuevoCliente
        ];
        return response()->json(data: $data, status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        if(!$cliente){
            return response()->json(data: ['message' => 'Cliente no encontrado'], status: 404);

        }
        return response()->json(data: $cliente, status: 200);

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
    public function update(Request $request, Cliente $cliente)
    {
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
    public function destroy(Cliente $cliente)
    {
        //elimino el cliente
        $clienteTemp = $cliente;
        $cliente->delete();

        $data = [
            'message' => 'Cliente eliminado correctamente',
            'cliente' => $clienteTemp
        ];
        return response()->json(data: $data, status: 200);
    }
}
