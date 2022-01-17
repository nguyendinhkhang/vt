<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StorageRemoveFactory extends Factory
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
            'storage_seri' => '0352062266',
            'storage_ten_san_pham' => 'test',
            'storage_nha_cung_cap' => 'test',
            'storage_gia_nhap' => 'test',
            'storage_ly_do_tra_hang' => 'test',
        ];
    }
}