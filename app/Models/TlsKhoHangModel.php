<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TlsKhoHangModel extends Model
{
    use HasFactory;

    public static function getDataKho(){
        $result = DB::table('tls_kho_hang')
                    ->select('tls_id_kho', 'tls_ten_kho')
                    ->orderBy('tls_id_kho', 'DESC')->paginate(11);
        return $result;
    }

    public static function getDataAllKho(){
        $result = DB::table('tls_kho_hang')
                    ->select('tls_id_kho as id', 'tls_ten_kho as name')->get();
  
        return $result;
    }

    public static function createDataKhoHang($ten_kho){
        DB::table('tls_kho_hang')->insert(
                                            array(
                                                'tls_ten_kho' => $ten_kho,
                                            )
                                            );
    }

    public static function GetDataKhoWithID($id){
        $result = DB::table('tls_kho_hang')->select('tls_id_kho', 'tls_ten_kho')
                    ->where('tls_kho_hang.tls_id_kho', '=', $id)
                    ->get();

        return $result;
    }

    public static function updateDataKhoHang($tls_id_kho, $tls_ten_kho){
        DB::table('tls_kho_hang')->where('tls_id_kho', $tls_id_kho)
                          ->update([
                              'tls_ten_kho' => $tls_ten_kho,
                            ]);
    }

    public static function getListAllWareHosue(){
        $result = DB::table('tls_kho_hang')
                    ->select('tls_id_kho as id', 'tls_ten_kho as name')->get();
        return $result;
    }
}
