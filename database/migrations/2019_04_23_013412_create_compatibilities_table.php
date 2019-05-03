<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompatibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compatibilities', function (Blueprint $table) {
            $table->increments('Id_Compatibility');
            $table->unsignedInteger('Id_Motor');
            $table->string('Kode_Sparepart',15);
            $table->timestamps();

            $table->foreign('Kode_Sparepart')->references('Kode_Sparepart')->on('spareparts');
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
        Schema::dropIfExists('compatibilities');
    }
}
