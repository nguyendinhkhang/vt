<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TlsQuanLyKhoHang extends Model
{
    use HasFactory;

    public static function getListWareHouse($id){
        $result = DB::table('tls_quan_ly_kho_hangs')
                    ->select('ma_so_seri', 'id_kho_hang', 'ten_san_pham', 'nha_cung_cap', 'gia_nhap', 
                                'gia_ban','kho_hang','tls_quan_ly_kho_hangs.created_at', 'tls_quan_ly_kho_hangs.updated_at',
                                'so_luong_trong_kho', 'so_luong_da_xuat', 'ma_san_pham')
                    ->where('tls_quan_ly_kho_hangs.tls_id_kho', $id)
                    ->orderBy('id_kho_hang', 'DESC')->paginate(8);
        return $result;
    }

    public static function getSumAnalyst($id, $month){
        $b = DB::table('tls_quan_ly_kho_hangs')->select(DB::raw('SUM(so_luong_trong_kho) AS total'))
        ->where('tls_quan_ly_kho_hangs.tls_id_kho', $id)
        ->where('tls_quan_ly_kho_hangs.updated_at', 'LIKE', '%'.$month.'%');

        $result = DB::table('tls_quan_ly_kho_hangs')
                    ->select(DB::raw('SUM(so_luong_trong_kho) AS total'))
                    ->where('tls_quan_ly_kho_hangs.tls_id_kho', $id)->union($b)
                    ->get();
        return $result;
    }

    public static function getDataCount($id, $month){
        $result = DB::table('tls_quan_ly_kho_hangs')
                    ->select('ma_so_seri', 'id_kho_hang', 'ten_san_pham', 'nha_cung_cap', 'gia_nhap', 
                                'gia_ban','kho_hang','tls_quan_ly_kho_hangs.created_at', 'tls_quan_ly_kho_hangs.updated_at',
                                'so_luong_trong_kho', 'so_luong_da_xuat', 'ma_san_pham')
                    ->where('tls_quan_ly_kho_hangs.tls_id_kho', $id)
                    ->where('tls_quan_ly_kho_hangs.updated_at', 'LIKE', '%'.$month.'%')
                    ->orderBy('id_kho_hang', 'DESC')->paginate(8);
        return $result;
    }

    public static function searchData($id, $column, $dataSearch, $month){
        $result = DB::table('tls_quan_ly_kho_hangs')
                    ->select('ma_so_seri', 'id_kho_hang', 'ten_san_pham', 'nha_cung_cap', 'gia_nhap', 
                                'gia_ban','kho_hang','tls_quan_ly_kho_hangs.created_at', 'tls_quan_ly_kho_hangs.updated_at',
                                'so_luong_trong_kho', 'so_luong_da_xuat', 'ma_san_pham')
                    ->where('tls_quan_ly_kho_hangs.'.$column.'', 'LIKE', '%'.$dataSearch.'%')
                    ->where('tls_quan_ly_kho_hangs.updated_at', 'LIKE', '%'.$month.'%')
                    ->where('tls_quan_ly_kho_hangs.tls_id_kho', $id)
                    ->orderBy('id_kho_hang', 'DESC')->paginate(8);
        return $result;
    }

    public static function getListWhenID($id, $seri){
        $result = DB::table('tls_quan_ly_kho_hangs')->select('ma_so_seri', 'id_kho_hang', 'ten_san_pham', 'nha_cung_cap', 'gia_nhap', 'gia_ban','kho_hang','tls_quan_ly_kho_hangs.created_at', 'so_luong_trong_kho')
                    ->where('tls_quan_ly_kho_hangs.id_kho_hang', '=', $id)
                    ->where('tls_quan_ly_kho_hangs.ma_so_seri', '=', $seri)
                    ->get();

        return $result;
    }

    public static function getDataWhenIDPhieuNhap($name, $kho){
        $result = DB::table('tls_quan_ly_kho_hangs')->select('tls_quan_ly_kho_hangs.id_kho_hang', 'tls_quan_ly_kho_hangs.ma_so_seri', 'tls_quan_ly_kho_hangs.id_kho_hang', 'tls_quan_ly_kho_hangs.ten_san_pham', 'tls_quan_ly_kho_hangs.nha_cung_cap', 'tls_quan_ly_kho_hangs.gia_nhap', 'tls_quan_ly_kho_hangs.gia_ban','tls_quan_ly_kho_hangs.kho_hang', 'tls_quan_ly_kho_hangs.so_luong_trong_kho', 'tls_quan_ly_kho_hangs.don_vi', 'tls_quan_ly_kho_hangs.trang_thai_nhap_kho', 'tls_quan_ly_kho_hangs.trang_thai_thanh_toan', 'tls_quan_ly_kho_hangs.trang_thai_hang_tang')
                    ->join('tls_phieu_nhap', 'tls_quan_ly_kho_hangs.id_phieu_nhap', '=', 'tls_phieu_nhap.id_phieu_nhap')
                    ->where('tls_phieu_nhap.name_phieu_nhap', '=', $name)
                    ->where('tls_quan_ly_kho_hangs.tls_id_kho', '=', $kho)
                    ->get();
        return $result;
    }


    public static function getDataKhoHangTheoPhieuNhap(){
        $result = DB::table('tls_quan_ly_kho_hangs')
                    ->select('tls_id_kho', DB::raw('count(*) as total'))
                    ->where('tls_quan_ly_kho_hangs.trang_thai_nhap_kho', '=', '1')
                    ->groupBy('tls_id_kho')
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

    public static function updateStatusPaid($id, $trang_thai_thanh_toan, $trang_thai_nhap_kho){
        DB::table('tls_quan_ly_kho_hangs')->where('id_kho_hang', $id)
                          ->update([
                              'trang_thai_thanh_toan' => $trang_thai_thanh_toan,
                              'trang_thai_nhap_kho' => $trang_thai_nhap_kho,
                              'updated_at' => date('Y-m-d G:i:s'),
                            ]);
    }

    public static function deleteKhoHang($id){
        DB::table('tls_quan_ly_kho_hangs')->where('id_kho_hang', $id)->delete();
    }

    public static function deleteDataWhenSeri($seri){
        DB::table('tls_quan_ly_kho_hangs')->where('ma_so_seri', $seri)->delete();
    }
                                      
    public static function createKhoHang($ma_so_seri, $ten_san_pham, $nha_cung_cap, $gia_nhap, $gia_ban,$don_vi, $kho_hang, $so_luong_trong_kho, $ngay_hoa_don, $tong_gia_tri, $tong_gia_von, $gia_von, $noi_dung_ghi_chu, $tls_id_kho, $id_phieu_nhap, $trang_thai_nhap_kho, $trang_thai_thanh_toan, $trang_thai_hang_tang, $san_pham_nha_cung_cap, $monthPhieuNhap){
        DB::table('tls_quan_ly_kho_hangs')->insert(
                                            array(
                                                'ma_so_seri' => $ma_so_seri,
                                                'ten_san_pham' => $ten_san_pham,
                                                'nha_cung_cap' => $nha_cung_cap,
                                                'gia_nhap' => $gia_nhap,
                                                'gia_ban' => $gia_ban,
                                                'don_vi' => $don_vi,
                                                'kho_hang' => $kho_hang,
                                                'so_luong_trong_kho' => $so_luong_trong_kho,
                                                'ngay_hoa_don' => $ngay_hoa_don,
                                                'tong_gia_tri' => $tong_gia_tri,
                                                'tong_gia_von' => $tong_gia_von,
                                                'gia_von' => $gia_von,
                                                'noi_dung_ghi_chu' => $noi_dung_ghi_chu,
                                                'so_luong_da_xuat' => 0,
                                                'tls_id_kho' => $tls_id_kho,
                                                'id_phieu_nhap' => $id_phieu_nhap,
                                                'trang_thai_nhap_kho' => $trang_thai_nhap_kho,
                                                'trang_thai_thanh_toan' => $trang_thai_thanh_toan,
                                                'trang_thai_hang_tang' => $trang_thai_hang_tang,
                                                'id_supplier' => $san_pham_nha_cung_cap,
                                                'ma_san_pham' => $san_pham_nha_cung_cap,
                                                'month_phieu_nhap' => $monthPhieuNhap,
                                                'created_at' => date('Y-m-d G:i:s'),
                                                'updated_at' => date('Y-m-d G:i:s'),
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

    public static function updateSeri($id_kho_hang, $seri){
        DB::table('tls_quan_ly_kho_hangs')->where('id_kho_hang', $id_kho_hang)
                          ->update([
                              'ma_so_seri' => $seri,
                            ]);
    }

    public static function getListOrderWhenHome($id){
        $result = DB::table('tls_quan_ly_giao_hangs')
                    ->select('tls_quan_ly_giao_hangs.id_quan_ly_giao', 'tls_quan_ly_kho_hangs.ma_so_seri', 'tls_quan_ly_giao_hangs.dia_chi_giao_hang', 
                    'tls_quan_ly_giao_hangs.so_luong', 'tls_quan_ly_kho_hangs.gia_ban' ,'tls_quan_ly_giao_hangs.ngay_giao', 'tls_quan_ly_giao_hangs.trang_thai',
                    'tls_quan_ly_giao_hangs.user_giao_hang', 'tls_quan_ly_kho_hangs.kho_hang', 'tls_quan_ly_giao_hangs.ten_khach_hang', 'tls_quan_ly_giao_hangs.so_dien_thoai', 'tls_quan_ly_kho_hangs.so_luong_trong_kho', 'tls_quan_ly_kho_hangs.so_luong_da_xuat',
                    'tls_quan_ly_giao_hangs.ghi_chu', 'users.name')
                    ->join('tls_quan_ly_kho_hangs', 'tls_quan_ly_kho_hangs.id_kho_hang', '=', 'tls_quan_ly_giao_hangs.id_kho_hang')
                    ->leftJoin('users', 'users.id', '=', 'tls_quan_ly_giao_hangs.user_giao_hang')
                    ->where('tls_quan_ly_giao_hangs.id_kho_hang', $id)
                    ->orderBy('id_quan_ly_giao', 'DESC')->paginate(8);
        return $result;
    }

    public static function wareHouseRefund($id_don_hang, $so_luong_da_xuat, $so_luong_trong_kho){
        DB::table('tls_quan_ly_kho_hangs')->where('id_kho_hang', $id_kho_hang)
                          ->update([
                              'so_luong_trong_kho' => $so_luong_trong_kho,
                              'so_luong_da_xuat' => $so_luong_da_xuat
                            ]);
    }

    // Get-Data-By-Ware-House
    public static function getDataPhieuByWareHouse($id){
        // $result = DB::table('tls_quan_ly_kho_hangs')
        //             ->select('tls_quan_ly_kho_hangs.id_phieu_nhap as id', 'tls_phieu_nhap.name_phieu_nhap as name')
        //             ->join('tls_phieu_nhap', 'tls_quan_ly_kho_hangs.id_phieu_nhap', '=', 'tls_phieu_nhap.id_phieu_nhap')
        //             ->join('tls_dem_data_phieu_nhap', 'tls_quan_ly_kho_hangs.tls_id_kho', '=', 'tls_dem_data_phieu_nhap.id_kho')
        //             ->where('tls_dem_data_phieu_nhap.trang_thai_nhap_kho', '=', '1')
        //             ->where('tls_quan_ly_kho_hangs.tls_id_kho', '=', $id)
        //             ->orderBy('tls_quan_ly_kho_hangs.id_phieu_nhap', 'DESC')->get();
        $result = DB::table('tls_dem_data_phieu_nhap')
                    ->select('tls_dem_data_phieu_nhap.id_data_phieu_nhap as id', 'tls_dem_data_phieu_nhap.name_phieu_nhap as name', 'id_kho')
                    ->where('tls_dem_data_phieu_nhap.trang_thai_nhap_kho', '=', '1')
                    ->where('tls_dem_data_phieu_nhap.id_kho', '=', $id)
                    ->orderBy('tls_dem_data_phieu_nhap.id_data_phieu_nhap', 'DESC')->get();
        return $result;
    }

    public static function getDataPhieuByWareHouseWailt($id){
        $result = DB::table('tls_dem_data_phieu_nhap')
                    ->select('tls_dem_data_phieu_nhap.id_data_phieu_nhap as id', 'tls_dem_data_phieu_nhap.name_phieu_nhap as name', 'id_kho')
                    ->where('tls_dem_data_phieu_nhap.trang_thai_nhap_kho', '=', '2')
                    ->where('tls_dem_data_phieu_nhap.id_kho', '=', $id)
                    ->orderBy('tls_dem_data_phieu_nhap.id_data_phieu_nhap', 'DESC')->get();
        return $result;
    }
}
