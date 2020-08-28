<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFechaToKardexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kardexes', function (Blueprint $table) {
            $table->date('fecha')->default(date('y-m-d'));
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('kardexes', function (Blueprint $table) {
            $table->dropColumn('fecha');
        });
    }
}
