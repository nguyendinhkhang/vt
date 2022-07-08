<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhieuNhapNameModel extends Model
{
    use HasFactory;

        // insert-tls-name-phieu_nhap
        public static function insertDataPhieuNhap($name_phieu_nhap, $doanhsoap, $month){
            DB::table('tls_name_supplier')->insert(
                                                array(
                                                    'name' => $name_phieu_nhap,
                                                    'doanh_so_ap' => $doanhsoap,
                                                    'cong_no_nha_cung_cap' => 0,
                                                    'doanh_dat_duoc' => 0,
                                                    'month' => $month
                                                )
                                                );
        }

        // Get-All-name-phieu_nhap
        public static function getDataAllNamePhieuNhap($date){
            $result = DB::table('tls_name_supplier')
                        ->select('id_name_supplier as id', 'name as name', 'doanh_so_ap', 'cong_no_nha_cung_cap', 'doanh_dat_duoc', 'month', 'tuoi_cong_no')
                        ->orWhere('month', 'like', '%' . $date . '%')
                        ->get();
            return $result;
        }

        // Get-All-month-phieu_nhap
        public static function getDataAllMonthPhieuNhap(){
            $result = DB::table('tls_name_supplier')
                        ->select('month')
                        ->get();
            return $result;
        }

        // update-Data-name-phieu_nhap
        public static function updateDataNamePhieuNhap($id, $name, $tuoiCongNo){
            if($tuoiCongNo == "0"){
                DB::table('tls_name_supplier')->where('id_name_supplier', $id)
                ->update([
                    'name' => $name,
                  ]);
            }else{
                DB::table('tls_name_supplier')->where('id_name_supplier', $id)
                ->update([
                    'name' => $name,
                    'tuoi_cong_no' => $tuoiCongNo
                  ]);
            }
        }

        public static function updateDataCongNo($name, $cong_no_nha_cung_cap){
            for($i=0; $i< count($name); $i++){
                DB::table('tls_name_supplier')->where('name', $name[$i])
                              ->update([
                                  'cong_no_nha_cung_cap' => $cong_no_nha_cung_cap[$i],
                                ]);
            }
        }

        // Delete-Data-name-phieu_nhap
        public static function deleteDataSupplier($id){
            DB::table('tls_name_supplier')->where('id_name_supplier', $id)->delete();
        }

    // Get-All-name-phieu_nhap
    public static function getDataSupplierDebts($name){
            $result = DB::table('tls_name_supplier')
                            ->select('id_name_supplier as id', 'cong_no_nha_cung_cap')
                            ->where('tls_name_supplier.name', '=', $name)->get();
                return $result;
        }
            
}
