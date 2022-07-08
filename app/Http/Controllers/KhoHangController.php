<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TlsKhoHangModel;

class KhoHangController extends Controller
{
    public function getDataKho(Request $request)
    {
        try {
            $data = TlsKhoHangModel::getDataKho();

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


    public function createDataKhoHang(Request $request)
    {
        try {
            $ten_kho = $request->input('ten_kho');
            
            $data = TlsKhoHangModel::createDataKhoHang($ten_kho);

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


    public function updateDataKhoHang(Request $request)
    {
        try {
            $tls_id_kho = $request->input('tls_id_kho');    
            $tls_ten_kho = $request->input('tls_ten_kho');
            
            $data = TlsKhoHangModel::updateDataKhoHang($tls_id_kho, $tls_ten_kho);

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

    public function GetDataKhoWithID(Request $request, $id)
    {
        try {
            $data = TlsKhoHangModel::GetDataKhoWithID($id);

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

    public function getDataAllKho(Request $request)
    {
        try {
            $data = TlsKhoHangModel::getDataAllKho();

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

    public function getListAllWareHosue(Request $request)
    {
        try {
            $data = TlsKhoHangModel::getListAllWareHosue();

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
    
}
