<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhieuNhapNameModel;

class PhieuNhapNameController extends Controller
{
    public function insertDataPhieuNhap(Request $request)
    {
        try {
            $name_phieu_nhap = $request->input('name');
            $doanhsoap = $request->input('doanhsoap');
            $month = $request->input('month');
            $data = PhieuNhapNameModel::insertDataPhieuNhap($name_phieu_nhap, $doanhsoap, $month);

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

    public function getDataAllNamePhieuNhap(Request $request, $date)
    {
        try {
            $data = PhieuNhapNameModel::getDataAllNamePhieuNhap($date);

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

    public function getDataAllMonthPhieuNhap(Request $request)
    {
        try {
            $data = PhieuNhapNameModel::getDataAllMonthPhieuNhap();

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

    public function updateDataNamePhieuNhap(Request $request)
    {
        try {
            $id = $request->input('id'); 
            $name_phieu_nhap = $request->input('name'); 
            $tuoiCongNo = $request->input('tuoiCongNo'); 

            $data = PhieuNhapNameModel::updateDataNamePhieuNhap($id, $name_phieu_nhap, $tuoiCongNo);

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

    public function updateDataCongNo(Request $request)
    {
        try {
            $name = $request->input('name'); 
            $cong_no_nha_cung_cap = $request->input('cong_no_nha_cung_cap');    
            $data = PhieuNhapNameModel::updateDataCongNo($name, $cong_no_nha_cung_cap);

            return response()->json([
                'status_code' => 200,
                'data' => count($name),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status_code' => 500,
                'Error' => 'Error' + $th,
            ]);
        }
    }

    

    public function deleteDataSupplier(Request $request)
    {
        try {
            $id = $request->input('id');    
            $data = PhieuNhapNameModel::deleteDataSupplier($id);

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

    public function getDataSupplierDebts(Request $request, $name)
    {
        try {
            $data = PhieuNhapNameModel::getDataSupplierDebts($name);

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
