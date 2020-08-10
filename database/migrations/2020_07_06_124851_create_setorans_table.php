<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetoransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setorans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_setoran');
            $table->date('tanggal_setoran');
            $table->string('nama_setoran');
            $table->unsignedBigInteger('id_pegawai');
            $table->timestamps();

            $table->foreign('id_pegawai')->references('id')->on('pegawais')->onDelete('restrict');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setorans');
    }
}
