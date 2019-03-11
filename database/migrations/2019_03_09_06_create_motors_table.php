<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('motors', function (Blueprint $table) {
            $table->increments('Id_Motor');
            $table->string('Kode_Sparepart',10);
            $table->string('Merk',50)->nullable(true)->change();
            $table->string('Tipe',50)->nullable(true)->change();
            $table->timestamps();

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
        Schema::dropIfExists('motors');
    }
}
