<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSparepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spareparts', function (Blueprint $table) {
            $table->string('Kode_Sparepart',10);
            $table->string('Tipe_Barang',10);
            $table->string('Nama_Sparepart',50);
            $table->string('Merk_Sparepart',50);
            $table->string('Rak_Sparepart',15);
            $table->integer('Jumlah_Sparepart');
            $table->integer('Stok_Minimum_Sparepart');
            $table->double('Harga_Beli');
            $table->double('Harga_Jual');
            $table->string('Gambar',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spareparts');
    }
}
