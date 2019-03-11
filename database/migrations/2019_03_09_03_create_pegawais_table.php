<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('Id_Pegawai');
            $table->unsignedInteger('Id_Role');
            $table->unsignedInteger('Id_Cabang');
            $table->string('Nama_Pegawai',50)->nullable(true)->change();
            $table->string('Alamat',255)->nullable(true)->change();
            $table->string('Telepon_Pegawai',15)->nullable(true)->change();
            $table->double('Gaji_Pegawai')->nullable(true)->change();
            $table->string('Username',20)->nullable(true)->change();
            $table->string('Password',50)->nullable(true)->change();
            $table->timestamps();

            $table->foreign('Id_Role')->references('Id_Role')->on('roles');
            $table->foreign('Id_Cabang')->references('Id_Cabang')->on('cabangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
