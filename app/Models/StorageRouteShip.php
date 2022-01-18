<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageRouteShip extends Model
{
    use HasFactory;

    public static function insertDataStorageRoute($id_quan_ly_giao,$dia_chi_giao_hang ,$user_giao_hang,$doan_duong_di_chuyen,$ma_so_seri, $time_di_chuyen ){
        DB::table('storage_route_ships')->insert(
            array(
                'id_quan_ly_giao' => $id_quan_ly_giao,
                'dia_chi_giao_hang' => $dia_chi_giao_hang,
                'user_giao_hang' => $user_giao_hang,
                'doan_duong_di_chuyen' => $doan_duong_di_chuyen,
                'ma_so_seri' => $ma_so_seri,
                'time_di_chuyen' => $time_di_chuyen,
                'updated_at' => date('Y-m-d G:i:s'),
                'created_at' => date('Y-m-d G:i:s'),
            )
            );
    }

    public static function getDataStorageRouteShip($from, $to){
        $result = DB::table('storage_route_ships')
                    ->whereBetween('updated_at', [$from, $to])
                    ->orderBy('id_route_ships', 'DESC')->paginate(11);
        return $result;
    }
}