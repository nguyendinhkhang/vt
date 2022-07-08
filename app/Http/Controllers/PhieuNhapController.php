<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TlsPhieuNhap;

class PhieuNhapController extends Controller
{
    public function getDataAllPhieuNhap(Request $request)
    {
        try {
            $data = TlsPhieuNhap::getListAllPhieuNhap();

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

    public function insertDataAllPhieuNhap(Request $request)
    {
        try {
            $name_phieu_nhap = $request->input('name_phieu_nhap');
            $data = TlsPhieuNhap::insertDataAllPhieuNhap($name_phieu_nhap);

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

    public function getWhenIDPhieuNhap(Request $request, $id)
    {
        try {
            $data = TlsPhieuNhap::getWhenIDPhieuNhap($id);

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

    public function getNamePhieuNhap(Request $request, $name)
    {
        try {
            $data = TlsPhieuNhap::getNamePhieuNhap($name);

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

    public function getDataBySupplier(Request $request, $id)
    {
        try {
            $data = TlsPhieuNhap::getDataBySupplier($id);

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

    public function getDataBySupplierDate(Request $request, $id, $date)
    {
        try {
            $data = TlsPhieuNhap::getDataBySupplierDate($id,$date);

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

    public function updateDataTuoiCongNo(Request $request)
    {
        try {
            $tuoi_cong_no = $request->input('tuoi_cong_no');
            $id_kho_hang = $request->input('id_kho_hang');
            $data = TlsPhieuNhap::updateDataTuoiCongNo($id_kho_hang, $tuoi_cong_no);

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

    public function getDataWareHouse(Request $request, $id)
    {
        try {
            $data = TlsPhieuNhap::getDataWareHouse($id);

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

    public function updateDataPhieuNhap(Request $request)
    {
        try {
            $name_phieu_nhap = $request->input('name_phieu_nhap');
            $id_supplier = $request->input('id_supplier');
            $tls_id_kho = $request->input('tls_id_kho');

            $data = TlsPhieuNhap::updateDataPhieuNhap($name_phieu_nhap, $id_supplier, $tls_id_kho);

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
