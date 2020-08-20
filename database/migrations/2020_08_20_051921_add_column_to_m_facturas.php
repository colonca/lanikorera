<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_facturas', function (Blueprint $table) {
            $table->enum('tipo',['VENTA','DEVOLUCION'])->default('VENTA');
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
            $table->dropColumn('tipo');
        });
    }
}
