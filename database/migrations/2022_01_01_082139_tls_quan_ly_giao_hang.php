<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TlsQuanLyGiaoHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tls_quan_ly_giao_hangs', function (Blueprint $table) {
            $table->increments('id_quan_ly_giao');
            $table->string('dia_chi_giao_hang')->nullable();
            $table->integer('so_luong')->nullable()->default(0);
            $table->string('ngay_giao')->nullable();
            $table->string('trang_thai')->default(1);
            $table->integer('user_dam_nhiem')->nullable()->default(-1);
            $table->string('ten_khach_hang');
            $table->string('so_dien_thoai');
            $table->string('ghi_chu');
            $table->integer('user_giao_hang')->nullable()->default(-1);
            $table->integer('id_kho_hang');
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
        Schema::dropIfExists('tls_quan_ly_giao_hangs');
    }
}
