<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToAdicionals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adicionals', function (Blueprint $table) {
            $table->integer('cantidad');
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
        Schema::table('adicionals', function (Blueprint $table) {
            //
        });
    }
}
