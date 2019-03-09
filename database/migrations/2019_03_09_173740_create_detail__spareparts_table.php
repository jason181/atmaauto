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
        Schema::create('detail__spareparts', function (Blueprint $table) {
            $table->increments('Id_Detail_Sparepart');
            $table->integer('Id_Transaksi');
            $table->integer('Id_Jasa_Montir');
            $table->string('Kode_Sparepart',10);
            $table->double('Harga_Satuan');
            $table->integer('Jumlah');
            $table->double('Subtotal_Detail_Sparepart');
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
        Schema::dropIfExists('detail__spareparts');
    }
}
