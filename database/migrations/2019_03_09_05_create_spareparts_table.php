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
            $table->string('Kode_Sparepart',10)->index();
            $table->string('Tipe_Barang',10)->nullable(true)->change();
            $table->string('Nama_Sparepart',50)->nullable(true)->change();
            $table->string('Merk_Sparepart',50)->nullable(true)->change();
            $table->string('Rak_Sparepart',15)->nullable(true)->change();
            $table->integer('Jumlah_Sparepart')->nullable(true)->change();
            $table->integer('Stok_Minimum_Sparepart')->nullable(true)->change();
            $table->double('Harga_Beli')->nullable(true)->change();
            $table->double('Harga_Jual')->nullable(true)->change();
            $table->string('Gambar',255)->nullable(true)->change();
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
