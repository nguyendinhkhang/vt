<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StorageRouteShip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_route_ships', function (Blueprint $table) {
            $table->increments('id_route_ships');
            $table->integer('id_quan_ly_giao');
            $table->string('dia_chi_giao_hang')->nullable();
            $table->string('user_giao_hang')->nullable();
            $table->string('ma_so_seri')->nullable();
            $table->string('doan_duong_di_chuyen')->nullable();
            $table->string('time_di_chuyen')->nullable();
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
        Schema::dropIfExists('storage_route_ships');
    }
}
