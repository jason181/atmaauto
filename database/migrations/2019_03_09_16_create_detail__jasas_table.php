<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailJasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_jasas', function (Blueprint $table) {
            $table->increments('Id_Detail_Jasa');
            $table->unsignedInteger('Id_Transaksi');
            $table->unsignedInteger('Id_Jasa');
            $table->unsignedInteger('Id_Jasa_Montir');
            $table->double('Subtotal_Detail_Jasa')->nullable(true)->change();
            $table->timestamps();

            $table->foreign('Id_Transaksi')->references('Id_Transaksi')->on('transaksi_penjualans');
            $table->foreign('Id_Jasa')->references('Id_Jasa')->on('jasas');
            $table->foreign('Id_Jasa_Montir')->references('Id_Jasa_Montir')->on('montirs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_jasas');
    }
}
