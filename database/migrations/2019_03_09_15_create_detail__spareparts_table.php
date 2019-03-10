<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSparepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_spareparts', function (Blueprint $table) {
            $table->increments('Id_Detail_Sparepart');
            $table->unsignedInteger('Id_Transaksi');
            $table->unsignedInteger('Id_Jasa_Montir');
            $table->string('Kode_Sparepart',10);
            $table->double('Harga_Satuan');
            $table->integer('Jumlah');
            $table->double('Subtotal_Detail_Sparepart');
            $table->timestamps();

            $table->foreign('Id_Transaksi')->references('Id_Transaksi')->on('transaksi_penjualans');
            $table->foreign('Id_Jasa_Montir')->references('Id_Jasa_Montir')->on('montirs');
            $table->foreign('Kode_Sparepart')->references('Kode_Sparepart')->on('spareparts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_spareparts');
    }
}
