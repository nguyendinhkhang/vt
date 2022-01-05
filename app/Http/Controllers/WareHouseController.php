<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TlsQuanLyKhoHang;

class WareHouseController extends Controller
{
    public function getData(Request $request)
    {
        try {
            $data = TlsQuanLyKhoHang::getListWareHouse();

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

    public function getDataWhenID(Request $request, $id, $seri)
    {
        try {
            $data = TlsQuanLyKhoHang::getListWhenID($id, $seri);

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

    public function updateDataWhenID(Request $request)
    {
        try {
            $id = $request->input('id');
            $ma_so_seri = $request->input('ma_so_seri');
            $ten_san_pham = $request->input('ten_san_pham');
            $nha_cung_cap = $request->input('nha_cung_cap');
            $gia_nhap = $request->input('gia_nhap');
            $gia_ban = $request->input('gia_ban');
            $kho_hang = $request->input('kho_hang');
            $so_luong_trong_kho = $request->input('so_luong_trong_kho');

            $data = TlsQuanLyKhoHang::updateKhoHang($id, $ma_so_seri, $ten_san_pham, $nha_cung_cap, $gia_nhap, $gia_ban, $kho_hang, $so_luong_trong_kho);

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

    public function deleteDataWhenID(Request $request)
    {
        try {
            $id = $request->input('id');
            $data = TlsQuanLyKhoHang::deleteKhoHang($id);
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

    public function createDataWhenID(Request $request)
    {
        try {
            $ma_so_seri = $request->input('ma_so_seri');
            $ten_san_pham = $request->input('ten_san_pham');
            $nha_cung_cap = $request->input('nha_cung_cap');
            $gia_nhap = $request->input('gia_nhap');
            $gia_ban = $request->input('gia_ban');
            $kho_hang = $request->input('kho_hang');
            $so_luong_trong_kho = $request->input('so_luong_trong_kho');

            $data = TlsQuanLyKhoHang::createKhoHang($ma_so_seri, $ten_san_pham, $nha_cung_cap, $gia_nhap, $gia_ban, $kho_hang, $so_luong_trong_kho);

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

    public function updateSoLuongTrongKho(Request $request)
    {
        try {
            $id_kho_hang = $request->input('id_kho_hang');
            $so_luong_trong_kho = $request->input('so_luong_trong_kho');
            $so_luong_da_xuat = $request->input('so_luong_da_xuat');

            $data = TlsQuanLyKhoHang::updateSoLuongTrongKho($id_kho_hang, $so_luong_trong_kho, $so_luong_da_xuat);

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

    public function getListOrderWhenHome(Request $request, $id)
    {
        try {
            $data = TlsQuanLyKhoHang::getListOrderWhenHome($id);

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
