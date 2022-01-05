<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TlsQuanLyKhoHangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ma_so_seri' => Str::random(5),
            'ten_san_pham' => Str::random(10),
            'nha_cung_cap' => Str::random(5),
            'gia_nhap' => rand(1000, 5000),
            'gia_ban' => rand(5000, 9000),
            'gia_ban' => rand(1, 5),
            'kho_hang' => Str::random(3),
            'so_luong_trong_kho' => 15,
        ];
    }
}
