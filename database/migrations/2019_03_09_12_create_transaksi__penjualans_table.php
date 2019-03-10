<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi__penjualans', function (Blueprint $table) {
            $table->increments('Id_Transaksi');
            $table->unsignedInteger('Id_Konsumen');
            $table->date('Tanggal_Transaksi');
            $table->string('Jenis_Transaksi',10);
            $table->double('Subtotal');
            $table->double('Diskon');
            $table->double('Total');
            $table->integer('Status');
            $table->timestamps();

            $table->foreign('Id_Konsumen')->references('Id_Konsumen')->on('konsumens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi__penjualans');
    }
}
