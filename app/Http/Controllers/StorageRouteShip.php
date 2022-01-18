<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorageRouteShip as RouteShip;

class StorageRouteShip extends Controller
{
    public function insertDataStorageRoute(Request $request)
    {
        try {
            $id_quan_ly_giao = $request->input('id_quan_ly_giao');
            $dia_chi_giao_hang = $request->input('dia_chi_giao_hang');
            $user_giao_hang = $request->input('user_giao_hang');
            $doan_duong_di_chuyen = $request->input('doan_duong_di_chuyen');
            $ma_so_seri = $request->input('ma_so_seri');
            $time_di_chuyen = $request->input('time_di_chuyen');

            $data = RouteShip::insertDataStorageRoute($id_quan_ly_giao,$dia_chi_giao_hang ,$user_giao_hang,$doan_duong_di_chuyen,$ma_so_seri, $time_di_chuyen );
            
            return response()->json([
                'status_code' => 200,
                'data' => "success",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => 'Error',
            ]);
        }
    }

    public function getDataStorageRouteShip(Request $request)
    {
        try {
            $data = RouteShip::getDataStorageRouteShip();
            
            return response()->json([
                'status_code' => 200,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => 'Error',
            ]);
        }
    }
}
