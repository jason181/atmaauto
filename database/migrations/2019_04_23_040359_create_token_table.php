<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token', function (Blueprint $table) {
            $table->increments('Id_Token');
            $table->string('Token_Username',255);
            $table->string('Token_Password',255);
            $table->unsignedInteger('Id_Pegawai');
            $table->timestamps();

            $table->foreign('Id_Pegawai')->references('Id_Pegawai')->on('pegawais');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token');
    }
}
