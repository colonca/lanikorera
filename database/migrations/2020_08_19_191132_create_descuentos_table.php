<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descuentos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedInteger('cantidad_destinada');
            $table->unsignedInteger('cantidad_vendida');
            $table->double('valor');
            $table->foreignId('producto_embalaje_id');
            $table->foreign('producto_embalaje_id')->references('id')->on('producto_embalaje')->onDelete('CASCADE');
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
        Schema::dropIfExists('descuentos');
    }
}
