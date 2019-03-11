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
        Schema::create('transaksi_penjualans', function (Blueprint $table) {
            $table->increments('Id_Transaksi');
            $table->unsignedInteger('Id_Konsumen');
            $table->date('Tanggal_Transaksi')->nullable(true)->change();
            $table->string('Jenis_Transaksi',10)->nullable(true)->change();
            $table->double('Subtotal')->nullable(true)->change();
            $table->double('Diskon')->nullable(true)->change();
            $table->double('Total')->nullable(true)->change();
            $table->integer('Status')->nullable(true)->change();
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
        Schema::dropIfExists('transaksi_penjualans');
    }
}
