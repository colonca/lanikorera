<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnEstadoToDeudas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deudas', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deudas', function (Blueprint $table) {
            $table->enum('estado',['EN DEUDA','PAGADA']);
        });
    }
}
