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
            $table->integer('Id_Transaksi');
            $table->integer('Id_Jasa');
            $table->integer('Id_Jasa_Montir');
            $table->double('Subtotal_Detail_Jasa');
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
        Schema::dropIfExists('detail_jasas');
    }
}
