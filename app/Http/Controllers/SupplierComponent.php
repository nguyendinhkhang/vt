<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TlsSupplierModel;

class SupplierComponent extends Controller
{
    public function getDataSupplier(Request $request, $name)
    {
        try {
            $data = TlsSupplierModel::getListSupplier($name);

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

    public function getDataAllNhaCungCap(Request $request)
    {
        try {
            $data = TlsSupplierModel::getListAllSupplier();

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

    public function getDataAllNhaCungCapDate(Request $request,$date)
    {
        try {
            $data = TlsSupplierModel::getDataAllNhaCungCapDate($date);

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

    public function getDataSanPhamNhaCungCap(Request $request)
    {
        try {
            $data = TlsSupplierModel::getDataSanPhamNhaCungCap();

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


    public function createDataSupplier(Request $request)
    {
        try {
            $ten_nha_cung_cap = $request->input('ten_nha_cung_cap');
            $san_pham_cung_cap = $request->input('san_pham_cung_cap');
            $doanh_so_ap = $request->input('doanh_so_ap');
            $cong_no_nha_cung_cap = $request->input('cong_no_nha_cung_cap');
            $id_kho_hang = $request->input('id_kho_hang');

            $data = TlsSupplierModel::createSupplier($ten_nha_cung_cap, $san_pham_cung_cap, $doanh_so_ap, $cong_no_nha_cung_cap, $id_kho_hang);

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

    public function createDataSupplierNew(Request $request)
    {
        try {
            $ten_nha_cung_cap = $request->input('ten_nha_cung_cap');
            $san_pham_cung_cap = $request->input('san_pham_cung_cap');

            $data = TlsSupplierModel::createSupplierNew($ten_nha_cung_cap, $san_pham_cung_cap);

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


    public function updateDataSupplier(Request $request)
    {
        try {
            $id_supplier = $request->input('id_supplier');    
            $ten_nha_cung_cap = $request->input('ten_nha_cung_cap');
            $san_pham_cung_cap = $request->input('san_pham_cung_cap');
            $doanh_so_ap = $request->input('doanh_so_ap');
            $cong_no_nha_cung_cap = $request->input('cong_no_nha_cung_cap');
            $id_kho_hang = $request->input('id_kho_hang');
            
            $data = TlsSupplierModel::updateSupplier($id_supplier, $ten_nha_cung_cap, $san_pham_cung_cap, $doanh_so_ap, $cong_no_nha_cung_cap, $id_kho_hang);

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

    public function updateDataProductSupplier(Request $request)
    {
        try {
            $id_supplier = $request->input('id_supplier');    
            $ten_nha_cung_cap = $request->input('ten_nha_cung_cap');
            $san_pham_cung_cap = $request->input('nha_cung_cap');
            
            $data = TlsSupplierModel::updateDataProductSupplier($id_supplier, $ten_nha_cung_cap, $san_pham_cung_cap);

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
    

    public function GetDataSupplierWithID(Request $request, $id)
    {
        try {
            $data = TlsSupplierModel::getListSupplierWithID($id);

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
    
    public function deleteDataSupplier(Request $request)
    {
        try {
            $id_supplier = $request->input('id_supplier');    
            $data = TlsSupplierModel::deleteSupplier($id_supplier);

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

    public function getDataSupplierFrom(Request $request,$from, $to)
    {
        try {
            $data = TlsSupplierModel::getDataSupplierFrom($from, $to);
            
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

    public function getDataDetailSupplierFrom(Request $request,$name)
    {
        try {
            $data = TlsSupplierModel::getDataDetailSupplierFrom($name);
            
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
