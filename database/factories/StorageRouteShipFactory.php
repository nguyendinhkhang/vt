<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StorageRouteShipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_quan_ly_giao' => 1,
            'dia_chi_giao_hang' => 'test',
            'user_giao_hang' => '2',
            'doan_duong_di_chuyen' => '45km',
            'ma_so_seri' => 'Test 1',
        ];
    }
}