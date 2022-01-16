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
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
            $gia_ban = $request->input('gia_ban');
            

            $data = TlsQuanLyGiaoHang::createDonHang($dia_chi_giao_hang, $so_luong, $user_dam_nhiem, $ten_khach_hang, $so_dien_thoai, $id_kho_hang, $latitude, $longitude, $gia_ban );

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

    public function dataThongKe(Request $request, $trang_thai, $from, $to)
    {
        try {
            $data = TlsQuanLyGiaoHang::dataThongKe($trang_thai, $from, $to);

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

    public function dataThongKeDoanhThu(Request $request, $trang_thai, $from, $to)
    {
        try {

            $data = TlsQuanLyGiaoHang::dataThongKeDoanhThu($trang_thai, $from, $to);

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

    public function dataTongDoanhThu(Request $request, $trang_thai, $from, $to)
    {
        try {
            $data = TlsQuanLyGiaoHang::dataTongDoanhThu($trang_thai, $from, $to);

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

    public function getDataWhenUserID(Request $request, $user_id)
    {
        try {
            $data = TlsQuanLyGiaoHang::getDataWhenUserID($user_id);

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

    public function getDataWhenUserIDAdmin(Request $request, $user_id)
    {
        try {
            $data = TlsQuanLyGiaoHang::getDataWhenUserIDAdmin($user_id);
            
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

    public function updateDataShip(Request $request)
    {
        try {
            $id_quan_ly_giao = $request->input('id_quan_ly_giao');
            $trang_thai = $request->input('trang_thai');
            
            $data = TlsQuanLyGiaoHang::updateDataShip($id_quan_ly_giao, $trang_thai);
            
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

    public function updateDataRedfundShip(Request $request)
    {
        try {
            $id_quan_ly_giao = $request->input('id_quan_ly_giao');
            $trang_thai = $request->input('trang_thai');
            $ghi_chu = $request->input('ghi_chu');
            
            $data = TlsQuanLyGiaoHang::updateDataRedfundShip($id_quan_ly_giao, $trang_thai, $ghi_chu);
            
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

    public function getDataWhenUserShipped(Request $request, $user_id)
    {
        try {
            $date = getdate();
            $to = $date['year']."-".$date['mon']."-".($date['mday']-1) . " 00:00:00";
            $from = $date['year']."-".$date['mon']."-".($date['mday']+1) . " 00:00:00";

            $data = TlsQuanLyGiaoHang::getDataWhenUserShipped($user_id, $to, $from);
            
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
