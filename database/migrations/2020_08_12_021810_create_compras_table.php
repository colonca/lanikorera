<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('CASCADE');
            $table->foreignId('bodega_id');
            $table->foreign('bodega_id')->references('id')->on('bodegas')->onDelete('CASCADE');
            $table->double('total');
            $table->timestamp('fecha');
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('compras');
    }
}
