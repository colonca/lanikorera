<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMedioPagoToDeudas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deudas', function (Blueprint $table) {
            $table->enum('medio_pago',['efectivo','datafono','transferencia']);
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
            $table->dropColumn('medio_pago');
        });
    }
}
