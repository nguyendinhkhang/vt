<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\TlsQuanLyKhoHang;
use App\Models\TlsQuanLyGiaoHang;
use App\Models\StorageRemove;
use App\Models\StorageRouteShip;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        TlsQuanLyKhoHang::factory(30)->create();
        TlsQuanLyGiaoHang::factory(30)->create();
        StorageRemove::factory(5)->create();
        StorageRouteShip::factory(5)->create();
    }
}
