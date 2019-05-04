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
            $table->string('Nama_Pegawai',50);
            $table->string('Alamat_Pegawai',255);
            $table->string('Telepon_Pegawai',15);
            $table->double('Gaji_Pegawai');
            $table->string('Username',20)->unique();
            $table->string('Password');
            $table->softDeletes();
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
