<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TlsKhoHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tls_quan_ly_kho_hangs', function (Blueprint $table) {
            $table->increments('id_kho_hang');
            $table->string('ma_so_seri');
            $table->string('ten_san_pham');
            $table->string('nha_cung_cap');
            $table->integer('gia_nhap');
            $table->integer('gia_ban');
            $table->string('kho_hang');
            $table->integer('so_luong_trong_kho');
            $table->integer('so_luong_da_xuat')->default(0)->nullable();
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
        Schema::dropIfExists('tls_quan_ly_kho_hangs');
    }
}
