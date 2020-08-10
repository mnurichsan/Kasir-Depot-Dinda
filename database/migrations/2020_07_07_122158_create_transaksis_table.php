<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('alamat');
            $table->unsignedBigInteger('id_setoran');
            $table->unsignedBigInteger('id_barang');
            $table->string('nama_barang');
            $table->integer('harga_barang');
            $table->integer('total_harga');
            $table->integer('total_bayar');
            $table->integer('kembalian');
            $table->timestamps();

             $table->foreign('id_setoran')->references('id')->on('setorans')->onDelete('restrict');
             $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('restrict');
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
        Schema::dropIfExists('transaksis');
    }
}
