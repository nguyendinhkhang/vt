<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorageRemove;

class StorageRemoveController extends Controller
{
    public function getDataStorage(Request $request)
    {
        try {
            $data = StorageRemove::getDataStorage();
            
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

    public function insertDataStorage(Request $request)
    {
        try {
            $id_quan_ly_giao = $request->input('id_quan_ly_giao');
            $storage_seri = $request->input('torage_seri');
            $storage_ten_san_pham = $request->input('storage_ten_san_pham');
            $storage_nha_cung_cap = $request->input('storage_nha_cung_cap');
            $storage_gia_nhap = $request->input('storage_gia_nhap');
            $storage_ly_do_tra_hang = $request->input('storage_ly_do_tra_hang');

            $data = StorageRemove::insertDataStorage($id_quan_ly_giao,$storage_seri ,$storage_ten_san_pham,$storage_nha_cung_cap,$storage_gia_nhap,$storage_ly_do_tra_hang );
            
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
    // 
}
