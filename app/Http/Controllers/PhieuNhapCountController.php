<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhieuNhapCountModel;

class PhieuNhapCountController extends Controller
{
    public function insertCountPhieuNhap(Request $request)
    {
        try {
            $id_kho = $request->input('id_kho');
            $name_phieu_nhap = $request->input('name_phieu_nhap');
            $tong_chua_xac_nhan = $request->input('tong_chua_xac_nhan');
            $tong_da_xac_nhan = $request->input('tong_da_xac_nhan');
            $data = PhieuNhapCountModel::insertCountPhieuNhap($id_kho, $name_phieu_nhap, $tong_chua_xac_nhan, $tong_da_xac_nhan);

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

    public function getDataAllPhieuNhap(Request $request)
    {
        try {
            $data = PhieuNhapCountModel::getListAllPhieuNhap();

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

    public function getDataKhoHangTheoPhieuNhap(Request $request)
    {
        try {
            $data = PhieuNhapCountModel::getDataKhoHangTheoPhieuNhap();

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

    public function getDataPhieuNhapWailt(Request $request)
    {
        try {
            $data = PhieuNhapCountModel::getDataPhieuNhapWailt();

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

    public function getDataWithSupplier(Request $request, $name)
    {
        try {
            $data = PhieuNhapCountModel::getDataWithSupplier($name);

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

    public function updateTrangThaiNhap(Request $request)
    {
        try {
            $id = $request->input('id');  
            $data = PhieuNhapCountModel::updateDataNamePhieuNhap($id);

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

    public function updateDataPhieuNhapSuccess(Request $request)
    {
        try {
            $id = $request->input('id');  
            $data = PhieuNhapCountModel::updateDataPhieuNhapSuccess($id);

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
