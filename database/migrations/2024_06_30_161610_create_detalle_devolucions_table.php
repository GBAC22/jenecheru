<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleDevolucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_devolucions', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->decimal('precio',10,2);
            $table->decimal('importe',10,2);
            $table->string('estado',20);
            $table->unsignedBigInteger('articulo_id');
            $table->unsignedBigInteger('nota_devolucion_id');
            $table->foreign('articulo_id')->references('id')->on('articulos');
            $table->foreign('nota_devolucion_id')->references('id')->on('nota_devolucions');
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
        Schema::dropIfExists('detalle_devolucions');
    }
}
