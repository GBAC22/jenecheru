<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_salidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salida_id');            
            $table->foreign('salida_id')->references('id')->on('salidas');

            $table->unsignedBigInteger('articulo_id'); 
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->integer('Cantidad');
            $table->string('descripcion'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_salidas');
    }
}
