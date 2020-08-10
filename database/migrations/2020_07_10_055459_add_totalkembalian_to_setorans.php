<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalkembalianToSetorans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setorans', function (Blueprint $table) {
            $table->integer('total_setoran')->after('id_pegawai');
            $table->integer('total_bayar')->after('id_pegawai');
            $table->integer('kembalian')->after('id_pegawai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setorans', function (Blueprint $table) {
            //
        });
    }
}
