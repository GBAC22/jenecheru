<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');            
            // $table->foreign('user_id')->references('id')->on('users');
            $table->dateTime('fecha')->unique(); 
            $table->string('descripcion'); 
            $table->enum('status',['Valido','Cancelado'])->defaul('Valido');
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
        Schema::dropIfExists('salidas');
    }
}
