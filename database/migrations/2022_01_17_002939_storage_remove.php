<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StorageRemove extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_removes', function (Blueprint $table) {
            $table->increments('id_storage');
            $table->integer('id_quan_ly_giao');
            $table->string('storage_seri')->nullable();
            $table->string('storage_ten_san_pham')->nullable();
            $table->string('storage_nha_cung_cap')->nullable();
            $table->string('storage_gia_nhap')->nullable();
            $table->string('storage_ly_do_tra_hang')->nullable();
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
        Schema::dropIfExists('storage_removes');
    }
}
