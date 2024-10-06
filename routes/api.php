<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//listar clientes
Route::get('/clientes',[ClienteController::class,'index']);
// crear cliente
Route::post('/clientes',[ClienteController::class,'store']);
//mostrar cliente
Route::get('/clientes/{id}',[ClienteController::class,'show']);
//actualizar cliente
Route::put('/clientes/{id}',[ClienteController::class,'update']);
//eliminar cliente
Route::delete('/clientes',[ClienteController::class,'destroy']);
// agregar servicio a cliente
Route::post('/clientes/agregarServicio',[ClienteController::class,'attachService']);
// quitar servicio a cliente
Route::post('/clientes/quitarServicio',[ClienteController::class,'detachhService']);


// Listar todos los servicios en el sistema
Route::get('/servicios',[ServiceController::class,'index']);
//listar servicios con clientes
Route::get('/servicios/clientes',[ServiceController::class,'clients']);
Route::get('/servicios/{id}',[ServiceController::class,'show']);
Route::delete('/servicios',[ServiceController::class,'destroy']);
Route::put('/servicios/{id}',[ServiceController::class,'update']);
Route::post('/servicios',[ServiceController::class,'store']);


