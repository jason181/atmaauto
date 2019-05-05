<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotorKonsumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motor_konsumens', function (Blueprint $table) {
            $table->increments('Id_Motor_Konsumen');
            $table->unsignedInteger('Id_Konsumen');
            $table->unsignedInteger('Id_Motor');
            $table->string('Plat_Kendaraan',15);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('Id_Konsumen')->references('Id_Konsumen')->on('konsumens');
            $table->foreign('Id_Motor')->references('Id_Motor')->on('motors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motor_konsumens');
    }
}
