<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToMFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_facturas', function (Blueprint $table) {
            $table->string('serie');
            $table->bigInteger('n_venta');
            $table->date('fecha');
            $table->enum('modalidad_pago',['contado','credito']);
            $table->enum('medio_pago',['efectivo','datafono']);
            $table->double('total');
            $table->foreignId('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_facturas', function (Blueprint $table) {
            //
        });
    }
}
