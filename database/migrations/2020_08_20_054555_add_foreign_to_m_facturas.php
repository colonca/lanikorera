<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToMFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_facturas', function (Blueprint $table) {
            $table->foreignId('bodega_id');
            $table->foreign('bodega_id')->references('id')->on('bodegas')->onDelete('CASCADE');
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
