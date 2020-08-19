<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('CASCADE');
            $table->foreignId('bodega_id');
            $table->foreign('bodega_id')->references('id')->on('bodegas')->onDelete('CASCADE');
            $table->enum('tipo_movimiento',['ENTRADA','SALIDA','DEVOLUCION']);
            $table->unsignedInteger('cantidad');
            $table->double('costo');
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
        Schema::dropIfExists('kardexes');
    }
}
