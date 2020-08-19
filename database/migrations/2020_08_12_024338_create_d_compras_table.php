<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Dcompras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_embalaje_id');
            $table->foreign('producto_embalaje_id')->references('id')->on('producto_embalaje')->onDelete('CASCADE');
            $table->unsignedInteger('cantidad');
            $table->double('costo')->comment('costo del embalaje unitario');
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
        Schema::dropIfExists('d_compras');
    }
}
