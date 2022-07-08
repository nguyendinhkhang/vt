<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PhieuNhapCountModel extends Model
{
    use HasFactory;

    public static function insertCountPhieuNhap($id_kho, $name_phieu_nhap, $tong_chua_xac_nhan, $tong_da_xac_nhan){
        foreach ( $id_kho as $id) {
            DB::table('tls_dem_data_phieu_nhap')->insert(
                array(
                    'id_kho' => $id,
                    'name_phieu_nhap' => $name_phieu_nhap,
                    'tong_chua_xac_nhan' => $tong_chua_xac_nhan,
                    'tong_da_xac_nhan' => $tong_da_xac_nhan,
                    'trang_thai_nhap_kho' => 1
                )
                );
        }
    }

    public static function getDataKhoHangTheoPhieuNhap(){
        $result = DB::table('tls_dem_data_phieu_nhap')
                    ->select('id_kho', DB::raw('count(*) as total'), 'id_data_phieu_nhap')
                    ->where('tls_dem_data_phieu_nhap.trang_thai_nhap_kho', '=', '1')
                    ->groupBy('id_kho')
                    ->get();
                    
        return $result;
    }

    public static function getDataPhieuNhapWailt(){
        $result = DB::table('tls_dem_data_phieu_nhap')
                    ->select('id_kho', DB::raw('count(*) as total'), 'id_data_phieu_nhap')
                    ->where('tls_dem_data_phieu_nhap.trang_thai_nhap_kho', '=', '2')
                    ->groupBy('id_kho')
                    ->get();
                    
        return $result;
    }

    public static function updateDataNamePhieuNhap($id){
        DB::table('tls_dem_data_phieu_nhap')->where('id_data_phieu_nhap', $id)
                          ->update([
                              'trang_thai_nhap_kho' => 2,
                            ]);
    }
    
    public static function updateDataPhieuNhapSuccess($id){
        DB::table('tls_dem_data_phieu_nhap')->where('id_data_phieu_nhap', $id)
                          ->update([
                              'trang_thai_nhap_kho' => 3,
                            ]);
    }

    public static function getDataWithSupplier($name){
        $result = DB::table('tls_quan_ly_kho_hangs')
                    ->select('tls_quan_ly_kho_hangs.ma_so_seri', 'tls_quan_ly_kho_hangs.id_kho_hang', 'tls_quan_ly_kho_hangs.ten_san_pham', 'tls_quan_ly_kho_hangs.nha_cung_cap', 'tls_quan_ly_kho_hangs.gia_nhap', 'tls_quan_ly_kho_hangs.gia_ban','tls_quan_ly_kho_hangs.kho_hang', 'tls_quan_ly_kho_hangs.so_luong_trong_kho', 'tls_quan_ly_kho_hangs.don_vi', 'tls_quan_ly_kho_hangs.trang_thai_nhap_kho', 'tls_quan_ly_kho_hangs.trang_thai_thanh_toan', 'tls_quan_ly_kho_hangs.trang_thai_hang_tang')
                    ->join('tls_phieu_nhap', 'tls_quan_ly_kho_hangs.id_phieu_nhap', '=', 'tls_phieu_nhap.id_phieu_nhap')
                    ->where('tls_phieu_nhap.name_phieu_nhap', '=', $name)
                    ->paginate(11);
                    
        return $result;
    }


    
}
