<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMontirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('montirs', function (Blueprint $table) {
            $table->increments('Id_Jasa_Montir');
            $table->unsignedInteger('Id_Pegawai');
            $table->unsignedInteger('Id_Motor_Konsumen');
            $table->timestamps();

            $table->foreign('Id_Pegawai')->references('Id_Pegawai')->on('pegawais');
            $table->foreign('Id_Motor_Konsumen')->references('Id_Motor_Konsumen')->on('motor_konsumens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('montirs');
    }
}
