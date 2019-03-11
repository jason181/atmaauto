<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('Id_Supplier');
            $table->string('Nama_Supplier',50)->nullable(true)->change();
            $table->string('Alamat_Supplier',255)->nullable(true)->change();
            $table->string('Nama_Sales',50)->nullable(true)->change();
            $table->string('Telepon_Sales',15)->nullable(true)->change();
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
        Schema::dropIfExists('suppliers');
    }
}
