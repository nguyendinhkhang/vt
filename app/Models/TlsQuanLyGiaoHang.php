<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TlsQuanLyGiaoHang extends Model
{
    use HasFactory;

    public static function getListOrder(){
        $result = DB::table('tls_quan_ly_giao_hangs')
                    ->select('tls_quan_ly_giao_hangs.id_quan_ly_giao', 'tls_quan_ly_kho_hangs.ma_so_seri', 'tls_quan_ly_giao_hangs.dia_chi_giao_hang', 
                    'tls_quan_ly_giao_hangs.so_luong', 'tls_quan_ly_kho_hangs.gia_ban' ,'tls_quan_ly_giao_hangs.ngay_giao', 'tls_quan_ly_giao_hangs.trang_thai',
                    'tls_quan_ly_giao_hangs.user_giao_hang', 'tls_quan_ly_kho_hangs.kho_hang', 'tls_quan_ly_giao_hangs.ten_khach_hang', 'tls_quan_ly_giao_hangs.so_dien_thoai',
                    'tls_quan_ly_giao_hangs.ghi_chu', 'users.name')
                    ->join('tls_quan_ly_kho_hangs', 'tls_quan_ly_kho_hangs.id_kho_hang', '=', 'tls_quan_ly_giao_hangs.id_kho_hang')
                    ->leftJoin('users', 'users.id', '=', 'tls_quan_ly_giao_hangs.user_giao_hang')
                    ->orderBy('id_quan_ly_giao', 'DESC')->paginate(8);
        return $result;
    }

    public static function getOrderWhenID($id){
        $result = DB::table('tls_quan_ly_giao_hangs')
                    ->select('tls_quan_ly_kho_hangs.ma_so_seri', 'tls_quan_ly_giao_hangs.dia_chi_giao_hang', 
                    'tls_quan_ly_giao_hangs.so_luong', 'tls_quan_ly_kho_hangs.gia_ban', 'tls_quan_ly_giao_hangs.ten_khach_hang', 'tls_quan_ly_giao_hangs.so_dien_thoai')
                    ->join('tls_quan_ly_kho_hangs', 'tls_quan_ly_kho_hangs.id_kho_hang', '=', 'tls_quan_ly_giao_hangs.id_kho_hang')
                    ->where('tls_quan_ly_giao_hangs.id_quan_ly_giao', '=', $id)->first();
        return $result;
    }

    public static function updateUserDeal($id, $user_giao_hang, $ngay_giao){
        DB::table('tls_quan_ly_giao_hangs')->where('id_quan_ly_giao', $id)
                          ->update([
                              'user_giao_hang' => $user_giao_hang,
                              'ngay_giao' => $ngay_giao,
                            ]);
    }

    public static function createDonHang($dia_chi_giao_hang, $so_luong, $user_dam_nhiem, $ten_khach_hang, $so_dien_thoai, $id_kho_hang, $latitude, $longitude){
        $s = DB::table('tls_quan_ly_giao_hangs')->insert(
            array(
                'dia_chi_giao_hang' => (string) $dia_chi_giao_hang,
                'so_luong' => (int)$so_luong,
                'ngay_giao' => '',
                'trang_thai' => '1',
                'user_dam_nhiem' => (int)$user_dam_nhiem,
                'ten_khach_hang' => (string)$ten_khach_hang,
                'so_dien_thoai' => (string)$so_dien_thoai,
                'ghi_chu' => '',
                'user_giao_hang' => -1,
                'id_kho_hang' => (int)$id_kho_hang,
                'latitude' => (string)$latitude,
                'longitude' => (string)$longitude,
                'updated_at' => date('Y-m-d G:i:s'),
                'created_at' => date('Y-m-d G:i:s'),
            )
            )->toSql();
            dd($s);
    }

    public static function dataThongKe($trang_thai, $from, $to){
        $result = DB::table('tls_quan_ly_giao_hangs')
                    ->whereBetween('updated_at', [$from, $to])
                    ->where('trang_thai', '=', $trang_thai)
                    ->orderBy('id_quan_ly_giao', 'DESC')->paginate(8);

        return $result;
    }

    public static function dataThongKeDoanhThu($trang_thai, $from, $to){
        $result = DB::table('tls_quan_ly_giao_hangs')
                    ->select('tls_quan_ly_kho_hangs.ma_so_seri','tls_quan_ly_giao_hangs.gia_ban', 'tls_quan_ly_kho_hangs.kho_hang', 'tls_quan_ly_kho_hangs.ten_san_pham')
                    ->join('tls_quan_ly_kho_hangs', 'tls_quan_ly_kho_hangs.id_kho_hang', '=', 'tls_quan_ly_giao_hangs.id_kho_hang')            
                    ->whereBetween('tls_quan_ly_giao_hangs.updated_at', [$from, $to])
                    ->where('tls_quan_ly_giao_hangs.trang_thai', '=', $trang_thai)->paginate(8);

        return $result;
    }

    public static function dataTongDoanhThu($trang_thai, $from, $to){
        $result = DB::table('tls_quan_ly_giao_hangs')
                ->select(DB::raw('SUM(tls_quan_ly_giao_hangs.gia_ban) as gia_ban'))
                ->join('tls_quan_ly_kho_hangs', 'tls_quan_ly_kho_hangs.id_kho_hang', '=', 'tls_quan_ly_giao_hangs.id_kho_hang')   
                ->whereBetween('tls_quan_ly_giao_hangs.updated_at', [$from, $to])
                ->where('tls_quan_ly_giao_hangs.trang_thai', '=', $trang_thai)->get();

        return $result;
    }

    public static function deleteDonHang($id_quan_ly_giao){
        DB::table('tls_quan_ly_giao_hangs')->where('id_quan_ly_giao', $id_quan_ly_giao)->delete();
    }
    
    // "id_quan_ly_giao": 30,
    // "ma_so_seri": "FXCYv",
    // "dia_chi_giao_hang": "FIKyrZeg9wFCivcRTX7J",
    // "so_luong": 1,
    // "gia_ban": 3,
    // "ngay_giao": "",
    // "trang_thai": "3",
    // "user_giao_hang": 2,
    // "kho_hang": "8nW",
    // "ten_khach_hang": "Le Van A",
    // "so_dien_thoai": "0352062266",
    // "ghi_chu": "",
    // "name": "Christa Greenfelder"

    public static function getDataWhenUserID($user_id){
            $result = DB::table('tls_quan_ly_giao_hangs')
                    ->select('tls_quan_ly_giao_hangs.id_quan_ly_giao', 'tls_quan_ly_kho_hangs.ma_so_seri', 'tls_quan_ly_giao_hangs.dia_chi_giao_hang', 
                    'tls_quan_ly_giao_hangs.so_luong', 'tls_quan_ly_kho_hangs.gia_ban' ,'tls_quan_ly_giao_hangs.ngay_giao', 'tls_quan_ly_giao_hangs.trang_thai',
                    'tls_quan_ly_giao_hangs.user_giao_hang', 'tls_quan_ly_kho_hangs.kho_hang', 'tls_quan_ly_giao_hangs.ten_khach_hang', 'tls_quan_ly_giao_hangs.so_dien_thoai',
                    'tls_quan_ly_giao_hangs.ghi_chu', 'users.name')
                    ->join('tls_quan_ly_kho_hangs', 'tls_quan_ly_kho_hangs.id_kho_hang', '=', 'tls_quan_ly_giao_hangs.id_kho_hang')
                    ->leftJoin('users', 'users.id', '=', 'tls_quan_ly_giao_hangs.user_giao_hang')
                    ->where('tls_quan_ly_giao_hangs.user_giao_hang', '=', $user_id)
                    ->orderBy('id_quan_ly_giao', 'DESC')->get();
        return $result;
    }

    public static function getDataWhenUserIDAdmin($user_id){
        $result = DB::table('tls_quan_ly_giao_hangs')
                ->select('tls_quan_ly_giao_hangs.id_quan_ly_giao', 'tls_quan_ly_kho_hangs.ma_so_seri', 'tls_quan_ly_giao_hangs.dia_chi_giao_hang', 
                'tls_quan_ly_giao_hangs.so_luong', 'tls_quan_ly_kho_hangs.gia_ban' ,'tls_quan_ly_giao_hangs.ngay_giao', 'tls_quan_ly_giao_hangs.trang_thai',
                'tls_quan_ly_giao_hangs.user_giao_hang', 'tls_quan_ly_kho_hangs.kho_hang', 'tls_quan_ly_giao_hangs.ten_khach_hang', 'tls_quan_ly_giao_hangs.so_dien_thoai',
                'tls_quan_ly_giao_hangs.ghi_chu', 'users.name')
                ->join('tls_quan_ly_kho_hangs', 'tls_quan_ly_kho_hangs.id_kho_hang', '=', 'tls_quan_ly_giao_hangs.id_kho_hang')
                ->leftJoin('users', 'users.id', '=', 'tls_quan_ly_giao_hangs.user_giao_hang')
                ->where('tls_quan_ly_giao_hangs.user_giao_hang', '=', $user_id)
                ->orderBy('id_quan_ly_giao', 'DESC')->paginate(8);
    return $result;
}
}
