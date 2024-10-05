<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients_services', function (Blueprint $table) {
            $table->id();
            //creo una columna llamada client_id
            $table->unsignedBigInteger('client_id');
            // a la columna client_id creada anteriormente, le indico que va ser una clave foranea
            // y que va a hacer referencia a la columna id de la tabla clients, ejemplo client_id = 1 (clientes_services), id = 1 (clients)
            $table->foreign('client_id')->references('id')->on('clientes');
            //creo una columna llamada service_idclientes
            $table->unsignedBigInteger('service_id');
            // a la columna service_id creada anteriormente, le indico que va ser una clave foranea
            // y que va a hacer referencia a la columna id de la tabla services, ejemplo service_id = 1 (clientes_services), id = 1 (services)
            $table->foreign('service_id')->references('id')->on('services');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients_services');
    }
};
