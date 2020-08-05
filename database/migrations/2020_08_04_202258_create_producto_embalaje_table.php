<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoEmbalajeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_embalaje', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('CASCADE');
            $table->foreignId('embalaje_id');
            $table->foreign('embalaje_id')->references('id')->on('embalajes')->onDelete('CASCADE');
            $table->string('codigo_de_barras')->unique()->index();
            $table->integer('unidades');
            $table->double('precio_venta');
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
        Schema::dropIfExists('producto_embalaje');
    }
}
