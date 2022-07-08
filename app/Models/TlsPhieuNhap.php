<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TlsPhieuNhap extends Model
{
    use HasFactory;

    // Get-All-tls_phieu_nhap
    public static function getListAllPhieuNhap(){
        $result = DB::table('tls_phieu_nhap')
                    ->select('id_phieu_nhap as id', 'name_phieu_nhap as name')->get();
        return $result;
    }

    // insert-tls_phieu_nhap
    public static function insertDataAllPhieuNhap($name_phieu_nhap){
        DB::table('tls_phieu_nhap')->insert(
                                            array(
                                                'name_phieu_nhap' => $name_phieu_nhap,
                                                'updated_at' => date('Y-m-d G:i:s'),
                                                'created_at' => date('Y-m-d G:i:s'),
                                            )
                                            );
    }

    // Get-When-ID-tls_phieu_nhap
    public static function getWhenIDPhieuNhap($id){
        $result = DB::table('tls_phieu_nhap')->select('id_phieu_nhap')
                    ->where('tls_phieu_nhap.name_phieu_nhap', '=', $id)
                    ->get();

        return $result;
    }

        // Get-When-ID-tls_phieu_nhap
        public static function getNamePhieuNhap($name){
            $result = DB::table('tls_quan_ly_kho_hangs')->select('tls_quan_ly_kho_hangs.ten_san_pham', 'tls_quan_ly_kho_hangs.trang_thai_nhap_kho','tls_quan_ly_kho_hangs.created_at','tls_quan_ly_kho_hangs.tuoi_cong_no')
                        ->join('tls_phieu_nhap', 'tls_quan_ly_kho_hangs.id_phieu_nhap', '=', 'tls_phieu_nhap.id_phieu_nhap')
                        ->where('tls_phieu_nhap.name_phieu_nhap', '=', $name)
                        ->get();
    
            return $result;
        }

    // Get-Data-By-Supplier
    public static function getDataBySupplier($id){
        $result = DB::table('tls_quan_ly_kho_hangs')
                    ->select('tls_phieu_nhap.name_phieu_nhap', 'tls_quan_ly_kho_hangs.nha_cung_cap', 'tls_quan_ly_kho_hangs.kho_hang', 'tls_quan_ly_kho_hangs.updated_at')
                    ->join('tls_phieu_nhap', 'tls_quan_ly_kho_hangs.id_phieu_nhap', '=', 'tls_phieu_nhap.id_phieu_nhap')
                    ->groupByRaw('tls_quan_ly_kho_hangs.kho_hang, tls_phieu_nhap.name_phieu_nhap')
                    ->where('tls_quan_ly_kho_hangs.nha_cung_cap', '=', $id)
                    ->paginate(11);
        return $result;
    }
        // Get-Data-By-Supplier-Date
        public static function getDataBySupplierDate($id, $date){
            $result = DB::table('tls_quan_ly_kho_hangs')
                        ->select('tls_phieu_nhap.name_phieu_nhap', 'tls_quan_ly_kho_hangs.nha_cung_cap', 'tls_quan_ly_kho_hangs.kho_hang', 'tls_quan_ly_kho_hangs.updated_at', 'tls_quan_ly_kho_hangs.tuoi_cong_no', 'tls_quan_ly_kho_hangs.id_kho_hang')
                        ->join('tls_phieu_nhap', 'tls_quan_ly_kho_hangs.id_phieu_nhap', '=', 'tls_phieu_nhap.id_phieu_nhap')
                        ->groupByRaw('tls_quan_ly_kho_hangs.kho_hang, tls_phieu_nhap.name_phieu_nhap')
                        ->where('tls_quan_ly_kho_hangs.nha_cung_cap', '=', $id)
                        ->where('tls_quan_ly_kho_hangs.month_phieu_nhap', '=', $date)
                        ->paginate(11);
            return $result;
        }

        // Get-Data-By-WareHouse
        public static function getDataWareHouse($id){
            $result = DB::table('tls_quan_ly_kho_hangs')
                    ->select('tls_phieu_nhap.name_phieu_nhap', 'tls_quan_ly_kho_hangs.nha_cung_cap', 'tls_quan_ly_kho_hangs.kho_hang')
                    ->join('tls_phieu_nhap', 'tls_quan_ly_kho_hangs.id_phieu_nhap', '=', 'tls_phieu_nhap.id_phieu_nhap')
                    ->groupByRaw('tls_quan_ly_kho_hangs.kho_hang, tls_phieu_nhap.name_phieu_nhap')
                    ->where('tls_quan_ly_kho_hangs.kho_hang', '=', $id)->paginate(11);
            return $result;
        }

    // Update-Data-WareHouse
    public static function updateDataPhieuNhap($name, $id_supplier, $tls_id_kho){
        DB::table('tls_phieu_nhap')->where('name_phieu_nhap', $name)
                          ->update([
                              'id_supplier' => $id_supplier,
                              'tls_id_kho' => $tls_id_kho,
                              'updated_at' => date('Y-m-d G:i:s'),
                            ]);
    }

    // updateDataTuoiCongNo
    public static function updateDataTuoiCongNo($id_kho_hang, $tuoi_cong_no){
        DB::table('tls_quan_ly_kho_hangs')->where('id_kho_hang', $id_kho_hang)
                          ->update([
                              'tuoi_cong_no' => $tuoi_cong_no
                            ]);
    }
    
}
