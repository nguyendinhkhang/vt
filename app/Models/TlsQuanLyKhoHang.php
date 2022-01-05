<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TlsQuanLyKhoHang extends Model
{
    use HasFactory;

    public static function getListWareHouse(){
        $result = DB::table('tls_quan_ly_kho_hangs')
                    ->select('ma_so_seri', 'id_kho_hang', 'ten_san_pham', 'nha_cung_cap', 'gia_nhap', 
                                'gia_ban','kho_hang','tls_quan_ly_kho_hangs.created_at',
                                'so_luong_trong_kho', 'so_luong_da_xuat')
                    ->orderBy('id_kho_hang', 'DESC')->paginate(11);
        return $result;
    }

    public static function getListWhenID($id, $seri){
        $result = DB::table('tls_quan_ly_kho_hangs')->select('ma_so_seri', 'id_kho_hang', 'ten_san_pham', 'nha_cung_cap', 'gia_nhap', 'gia_ban','kho_hang','tls_quan_ly_kho_hangs.created_at', 'so_luong_trong_kho')
                    ->where('tls_quan_ly_kho_hangs.id_kho_hang', '=', $id)
                    ->where('tls_quan_ly_kho_hangs.ma_so_seri', '=', $seri)
                    ->get();

        return $result;
    }

    public static function updateKhoHang($id, $ma_so_seri, $ten_san_pham, $nha_cung_cap, $gia_nhap, $gia_ban, $kho_hang, $so_luong_trong_kho){
        DB::table('tls_quan_ly_kho_hangs')->where('id_kho_hang', $id)
                          ->update([
                              'ma_so_seri' => $ma_so_seri,
                              'ten_san_pham' => $ten_san_pham,
                              'nha_cung_cap' => $nha_cung_cap,
                              'gia_nhap' => $gia_nhap,
                              'gia_ban' => $gia_ban,
                              'kho_hang' => $kho_hang,
                              'so_luong_trong_kho' => $so_luong_trong_kho,
                            ]);
    }

    public static function deleteKhoHang($id){
        DB::table('tls_quan_ly_kho_hangs')->where('id_kho_hang', $id)->delete();
    }

    public static function createKhoHang($ma_so_seri, $ten_san_pham, $nha_cung_cap, $gia_nhap, $gia_ban, $kho_hang, $so_luong_trong_kho){
        DB::table('tls_quan_ly_kho_hangs')->insert(
                                            array(
                                                'ma_so_seri' => $ma_so_seri,
                                                'ten_san_pham' => $ten_san_pham,
                                                'nha_cung_cap' => $nha_cung_cap,
                                                'gia_nhap' => $gia_nhap,
                                                'gia_ban' => $gia_ban,
                                                'kho_hang' => $kho_hang,
                                                'so_luong_trong_kho' => $so_luong_trong_kho,
                                                'so_luong_da_xuat' => 0,
                                            )
                                            );
    }

    public static function updateSoLuongTrongKho($id_kho_hang, $so_luong_trong_kho, $so_luong_da_xuat){
        DB::table('tls_quan_ly_kho_hangs')->where('id_kho_hang', $id_kho_hang)
                          ->update([
                              'so_luong_trong_kho' => $so_luong_trong_kho,
                              'so_luong_da_xuat' => $so_luong_da_xuat
                            ]);
    }

    public static function getListOrderWhenHome($id){
        $result = DB::table('tls_quan_ly_giao_hangs')
                    ->select('tls_quan_ly_giao_hangs.id_quan_ly_giao', 'tls_quan_ly_kho_hangs.ma_so_seri', 'tls_quan_ly_giao_hangs.dia_chi_giao_hang', 
                    'tls_quan_ly_giao_hangs.so_luong', 'tls_quan_ly_kho_hangs.gia_ban' ,'tls_quan_ly_giao_hangs.ngay_giao', 'tls_quan_ly_giao_hangs.trang_thai',
                    'tls_quan_ly_giao_hangs.user_giao_hang', 'tls_quan_ly_kho_hangs.kho_hang', 'tls_quan_ly_giao_hangs.ten_khach_hang', 'tls_quan_ly_giao_hangs.so_dien_thoai',
                    'tls_quan_ly_giao_hangs.ghi_chu', 'users.name')
                    ->join('tls_quan_ly_kho_hangs', 'tls_quan_ly_kho_hangs.id_kho_hang', '=', 'tls_quan_ly_giao_hangs.id_kho_hang')
                    ->leftJoin('users', 'users.id', '=', 'tls_quan_ly_giao_hangs.user_giao_hang')
                    ->where('tls_quan_ly_giao_hangs.id_kho_hang', $id)
                    ->orderBy('id_quan_ly_giao', 'DESC')->paginate(8);

        // dd($result);
        return $result;
    }
}
