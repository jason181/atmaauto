<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaiOnDutiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai_on_duties', function (Blueprint $table) {
            $table->increments('Id_Duty');
            $table->unsignedInteger('Id_Pegawai');
            $table->unsignedInteger('Id_Transaksi');
            $table->timestamps();

            $table->foreign('Id_Pegawai')->references('Id_Pegawai')->on('pegawais');
            $table->foreign('Id_Transaksi')->references('Id_Transaksi')->on('transaksi_penjualans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai_on_duties');
    }
}
