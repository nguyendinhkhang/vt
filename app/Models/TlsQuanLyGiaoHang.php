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

    public static function createDonHang($dia_chi_giao_hang, $so_luong, $user_dam_nhiem, $ten_khach_hang, $so_dien_thoai, $id_kho_hang, $latitude, $longitude, $gia_ban){
        DB::table('tls_quan_ly_giao_hangs')->insert(
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
                'latitude' => (float)$latitude,
                'longitude' => (float)$longitude,
                'gia_ban' => $gia_ban,
                'updated_at' => date('Y-m-d G:i:s'),
                'created_at' => date('Y-m-d G:i:s'),
            )
            );
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

    public static function getDataWhenUserID($user_id){
            $result = DB::table('tls_quan_ly_giao_hangs')
                    ->select('tls_quan_ly_giao_hangs.id_quan_ly_giao', 'tls_quan_ly_kho_hangs.ma_so_seri', 'tls_quan_ly_giao_hangs.dia_chi_giao_hang', 
                    'tls_quan_ly_giao_hangs.so_luong', 'tls_quan_ly_kho_hangs.gia_ban' ,'tls_quan_ly_giao_hangs.ngay_giao', 'tls_quan_ly_giao_hangs.trang_thai',
                    'tls_quan_ly_giao_hangs.user_giao_hang', 'tls_quan_ly_kho_hangs.kho_hang', 'tls_quan_ly_giao_hangs.ten_khach_hang', 'tls_quan_ly_giao_hangs.so_dien_thoai',
                    'tls_quan_ly_giao_hangs.ghi_chu', 'users.name', 'tls_quan_ly_giao_hangs.latitude', 'tls_quan_ly_giao_hangs.longitude')
                    ->join('tls_quan_ly_kho_hangs', 'tls_quan_ly_kho_hangs.id_kho_hang', '=', 'tls_quan_ly_giao_hangs.id_kho_hang')
                    ->leftJoin('users', 'users.id', '=', 'tls_quan_ly_giao_hangs.user_giao_hang')
                    ->where(function ($query) {
                        $query->where('tls_quan_ly_giao_hangs.trang_thai', '=', 1)
                        ->orWhere('tls_quan_ly_giao_hangs.trang_thai', '=', 2)
                        ->orWhere('tls_quan_ly_giao_hangs.trang_thai', '=', 4);
                    })
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
                ->where('tls_quan_ly_giao_hangs.user_dam_nhiem', '=', $user_id)
                ->orderBy('id_quan_ly_giao', 'DESC')->paginate(8);
    return $result;
    }

    public static function updateDataShip($id_quan_ly_giao, $trang_thai){
        DB::table('tls_quan_ly_giao_hangs')->where('id_quan_ly_giao', $id_quan_ly_giao)
                          ->update([
                              'trang_thai' => $trang_thai,
                              'updated_at' => date('Y-m-d G:i:s'),
                            ]);
    }

    public static function updateDataRedfundShip($id_quan_ly_giao, $trang_thai,$ghi_chu){
        DB::table('tls_quan_ly_giao_hangs')->where('id_quan_ly_giao', $id_quan_ly_giao)
                          ->update([
                              'trang_thai' => $trang_thai,
                              'ghi_chu' => $ghi_chu,
                              'updated_at' => date('Y-m-d G:i:s'),
                            ]);
    }

    public static function getDataWhenUserShipped($user_id, $from, $to){
        $result = DB::table('tls_quan_ly_giao_hangs')
                ->select('tls_quan_ly_giao_hangs.id_quan_ly_giao', 'tls_quan_ly_giao_hangs.ten_khach_hang', 'tls_quan_ly_giao_hangs.so_dien_thoai')
                ->join('tls_quan_ly_kho_hangs', 'tls_quan_ly_kho_hangs.id_kho_hang', '=', 'tls_quan_ly_giao_hangs.id_kho_hang')
                ->leftJoin('users', 'users.id', '=', 'tls_quan_ly_giao_hangs.user_giao_hang')
                ->where('tls_quan_ly_giao_hangs.trang_thai', '=', 3)
                ->whereBetween('tls_quan_ly_giao_hangs.updated_at', [$from, $to])
                ->where('tls_quan_ly_giao_hangs.user_giao_hang', '=', $user_id)
                ->orderBy('id_quan_ly_giao', 'DESC')->get();

            return $result;
        }

// public static function dataTongDoanhThu($trang_thai, $from, $to){
//     $result = DB::table('tls_quan_ly_giao_hangs')
//             ->select(DB::raw('SUM(tls_quan_ly_giao_hangs.gia_ban) as gia_ban'))
//             ->join('tls_quan_ly_kho_hangs', 'tls_quan_ly_kho_hangs.id_kho_hang', '=', 'tls_quan_ly_giao_hangs.id_kho_hang')   
//             ->whereBetween('tls_quan_ly_giao_hangs.updated_at', [$from, $to])
//             ->where('tls_quan_ly_giao_hangs.trang_thai', '=', $trang_thai)->get();

//     return $result;
// }
}
