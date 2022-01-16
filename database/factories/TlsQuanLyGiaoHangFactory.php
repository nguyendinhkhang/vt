<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TlsQuanLyGiaoHangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dia_chi_giao_hang' => Str::random(20),
            'so_luong' => 1,
            'ngay_giao' => '',
            'trang_thai' => rand(1, 3),
            'user_dam_nhiem' => 1,
            'ten_khach_hang' => 'Le Van A',
            'so_dien_thoai' => '0352062266',
            'user_giao_hang' => rand(1, 10),
            'id_kho_hang' => rand(1, 10),
            'latitude' => '12.67608',
            'longitude' => '108.04084',
            'ghi_chu' => '',
            'gia_ban' => 2500,
        ];
    }
}