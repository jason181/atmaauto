<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPengadaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pengadaans', function (Blueprint $table) {
            $table->increments('Id_Detail_Pengadaan');
            $table->unsignedInteger('Id_Pengadaan');
            $table->string('Kode_Sparepart',10)->nullable(true)->change();
            $table->double('Harga_Satuan')->nullable(true)->change();
            $table->integer('Jumlah')->nullable(true)->change();
            $table->double('Subtotal_Pengadaan')->nullable(true)->change();
            $table->timestamps();
            
            $table->foreign('Id_Pengadaan')->references('Id_Pengadaan')->on('transaksi_pengadaans');
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
        Schema::dropIfExists('detail_pengadaans');
    }
}
