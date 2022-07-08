<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TlsQuanLyKhoHang;

class WareHouseController extends Controller
{
    public function getData(Request $request, $id)
    {
        try {
            $data = TlsQuanLyKhoHang::getListWareHouse($id);

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

    public function getSum(Request $request, $id, $month)
    {
        try {
            $data = TlsQuanLyKhoHang::getSumAnalyst($id, $month);

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

    public function getDataCount(Request $request, $id, $month)
    {
        try {
            $data = TlsQuanLyKhoHang::getDataCount($id, $month);

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

    public function searchData(Request $request)
    {
        try {
            // $id, $column, $dataSearch, $month
            $id = $request->input('id');
            $column = $request->input('column');
            $dataSearch = $request->input('dataSearch');
            $month = $request->input('month');

            $data = TlsQuanLyKhoHang::searchData($id, $column, $dataSearch, $month);

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

    public function getDataWhenIDPhieuNhap(Request $request, $name, $kho)
    {
        try {
            $data = TlsQuanLyKhoHang::getDataWhenIDPhieuNhap($name, $kho);

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

    public function getDataKhoHangTheoPhieuNhap(Request $request)
    {
        try {
            $data = TlsQuanLyKhoHang::getDataKhoHangTheoPhieuNhap();

            return response()->json([
                'status_code' => 200,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => $th,
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

    public function updateStatusPaid(Request $request)
    {
        try {
            $id = $request->input('id');
            $trang_thai_thanh_toan = $request->input('trang_thai_thanh_toan');
            $trang_thai_nhap_kho = $request->input('trang_thai_nhap_kho');

            $data = TlsQuanLyKhoHang::updateStatusPaid($id, $trang_thai_thanh_toan, $trang_thai_nhap_kho);

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

    public function deleteDataWhenSeri(Request $request)
    {
        try {
            $seri = $request->input('seri');
            $data = TlsQuanLyKhoHang::deleteDataWhenSeri($seri);
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
            $don_vi = $request->input('don_vi');
            $kho_hang = $request->input('kho_hang');
            $so_luong_trong_kho = $request->input('so_luong_trong_kho');
            $ngay_hoa_don = $request->input('ngay_hoa_don');
            $tong_gia_tri = $request->input('tong_gia_tri');
            $tong_gia_von = $request->input('tong_gia_von');
            $gia_von = $request->input('gia_von');
            $noi_dung_ghi_chu = $request->input('noi_dung_ghi_chu');
            $tls_id_kho = $request->input('tls_id_kho');
            $id_phieu_nhap = $request->input('id_phieu_nhap');
            $trang_thai_nhap_kho = $request->input('trang_thai_nhap_kho');
            $trang_thai_thanh_toan = $request->input('trang_thai_thanh_toan');
            $trang_thai_hang_tang = $request->input('trang_thai_hang_tang');
            $san_pham_nha_cung_cap = $request->input('san_pham_nha_cung_cap');
            $monthPhieuNhap = $request->input('monthPhieuNhap');

            $data = TlsQuanLyKhoHang::createKhoHang($ma_so_seri, $ten_san_pham, $nha_cung_cap, $gia_nhap, $gia_ban,$don_vi , $kho_hang, $so_luong_trong_kho, $ngay_hoa_don, $tong_gia_tri, $tong_gia_von, $gia_von, $noi_dung_ghi_chu, $tls_id_kho, $id_phieu_nhap, $trang_thai_nhap_kho, $trang_thai_thanh_toan, $trang_thai_hang_tang, $san_pham_nha_cung_cap, $monthPhieuNhap);

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

    public function updateSeri(Request $request)
    {
        try {
            $id_kho_hang = $request->input('id_kho_hang');
            $seri = $request->input('seri');

            $data = TlsQuanLyKhoHang::updateSeri($id_kho_hang, $seri);

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

    public function getDataPhieuByWareHouse(Request $request, $id)
    {
        try {
            $data = TlsQuanLyKhoHang::getDataPhieuByWareHouse($id);

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

    public function getDataPhieuByWareHouseWailt(Request $request, $id)
    {
        try {
            $data = TlsQuanLyKhoHang::getDataPhieuByWareHouseWailt($id);

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
