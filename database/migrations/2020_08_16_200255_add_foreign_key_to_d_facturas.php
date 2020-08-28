<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToDFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('d_facturas', function (Blueprint $table) {
            $table->foreignId('factura_id');
            $table->foreign('factura_id')->references('id')->on('m_facturas')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('d_facturas', function (Blueprint $table) {
        });
    }
}
