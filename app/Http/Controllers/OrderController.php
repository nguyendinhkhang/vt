<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\TlsQuanLyGiaoHang;

class OrderController extends Controller
{
    public function getData(Request $request)
    {
        try {
            $data = TlsQuanLyGiaoHang::getListOrder();

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

    public function getDataWhenID(Request $request, $id)
    {
        try {
            $data = TlsQuanLyGiaoHang::getOrderWhenID($id);

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

    public function updateDataUserDeal(Request $request)
    {
        try {
            $id = $request->input('id');
            $user_giao_hang = $request->input('user_giao_hang');
            $dt = new DateTime();
            
            $data = TlsQuanLyGiaoHang::updateUserDeal($id, $user_giao_hang, (string)$dt->format('d/m/Y'));

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

    public function createDonHang(Request $request)
    {
        try {
            $dia_chi_giao_hang = $request->input('dia_chi_giao_hang');
            $so_luong = $request->input('so_luong');
            $ten_khach_hang = $request->input('ten_khach_hang');
            $user_dam_nhiem = $request->input('user_dam_nhiem');
            $so_dien_thoai = $request->input('so_dien_thoai');
            $id_kho_hang = $request->input('id_kho_hang');
   
            $data = TlsQuanLyGiaoHang::createDonHang($dia_chi_giao_hang, $so_luong, $user_dam_nhiem, $ten_khach_hang, $so_dien_thoai, $id_kho_hang);

            return response()->json([
                'status_code' => 200,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => 'Error' + $th,
            ]);
        }
    }

    public function dataThongKe(Request $request, $trang_thai, $date, $compare)
    {
        try {
            $data = TlsQuanLyGiaoHang::dataThongKe($trang_thai, $date, $compare);

            return response()->json([
                'status_code' => 200,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => 'Error' + $th,
            ]);
        }
    }

    public function deleteDonHang(Request $request)
    {
        try {
            $id_quan_ly_giao = $request->input('id_quan_ly_giao');

            $data = TlsQuanLyGiaoHang::deleteDonHang($id_quan_ly_giao);

            return response()->json([
                'status_code' => 200,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => 'Error' + $th,
            ]);
        }
    }

    
    
}
