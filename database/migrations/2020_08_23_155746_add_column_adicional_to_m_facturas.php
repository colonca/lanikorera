<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAdicionalToMFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_facturas', function (Blueprint $table) {
            $table->longText('adicionales')->default('[]');
        });

        Schema::dropIfExists('adicionals');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_facturas', function (Blueprint $table) {
            $table->dropColumn('adicionales');
        });
        Schema::create('adicionals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->double('precio_compra');
            $table->double('precio_venta');
            $table->string('descripcion')->nullable();
            $table->integer('cantidad');
            $table->foreignId('factura_id');
            $table->foreign('factura_id')->references('id')->on('m_facturas')->onDelete('CASCADE');
            $table->timestamps();
        });
    }
}
