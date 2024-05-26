<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();

            $table->integer('codigo');
            $table->string('nombre', 60);
            $table->text('imagen');
            $table->string('tipo', 30);
            $table->integer('precio_unitario');
            $table->integer('precio_mayor');
            $table->decimal('precio_promedio', 10, 2);
            $table->integer('stock');
            $table->string('descripcion', 60)->nullable();

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
        Schema::dropIfExists('articulos');
    }
}
