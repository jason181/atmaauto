<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPengadaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pengadaans', function (Blueprint $table) {
            $table->increments('Id_Pengadaan');
            $table->unsignedInteger('Id_Supplier');
            $table->date('Tanggal_Pengadaan');
            $table->double('Total_Harga');
            $table->integer('Status_Pengadaan');
            $table->timestamps();

            $table->foreign('Id_Supplier')->references('Id_Supplier')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_pengadaans');
    }
}
