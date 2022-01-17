<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageRemove extends Model
{
    use HasFactory;

    public static function getDataStorage(){
        $result = DB::table('storage_removes')
                    ->orderBy('id_storage', 'DESC')->paginate(11);
        return $result;
    }
    
    public static function insertDataStorage($id_quan_ly_giao,$storage_seri ,$storage_ten_san_pham,$storage_nha_cung_cap,$storage_gia_nhap,$storage_ly_do_tra_hang ){
        DB::table('storage_removes')->insert(
            array(
                'id_quan_ly_giao' => $id_quan_ly_giao,
                'storage_seri' => $storage_seri,
                'storage_ten_san_pham' => $storage_ten_san_pham,
                'storage_nha_cung_cap' => $storage_nha_cung_cap,
                'storage_gia_nhap' => $storage_gia_nhap,
                'storage_ly_do_tra_hang' => $storage_ly_do_tra_hang,
                'updated_at' => date('Y-m-d G:i:s'),
                'created_at' => date('Y-m-d G:i:s'),
            )
            );
    }
}
