<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnEstadoToMFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_facturas', function (Blueprint $table) {
            $table->enum('estado',['EN DEUDA','PAGADA'])->default('PAGADA');
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
            $table->dropColumn('estado');
        });
    }
}
