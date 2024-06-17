<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    public function up()
    {
        // Tabla 'ventas'
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->date('fecha');
            $table->decimal('total', 10, 2);
            $table->timestamps();

            // Clave foránea para 'cliente_id'
            $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
