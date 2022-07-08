<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TlsSupplierModel extends Model
{
    use HasFactory;

    public static function getListSupplier($name){
        $result = DB::table('tls_supplier')
                    ->select('id_supplier', 'ten_nha_cung_cap', 'san_pham_cung_cap', 'doanh_so_ap', 'cong_no_nha_cung_cap', 
                                'id_kho_hang')
                    ->where('tls_supplier.ten_nha_cung_cap', '=', $name)
                    ->orderBy('id_supplier', 'DESC')->paginate(11);
        return $result;
    }

    public static function getListAllSupplier(){
        $result = DB::table('tls_name_supplier')
                    ->select('id_name_supplier as id', 'name as name')->get();
        return $result;
    }

    public static function getDataAllNhaCungCapDate($date){
        $result = DB::table('tls_name_supplier')
                    ->select('id_name_supplier as id', 'name as name')->orWhere('month', 'like', '%' . $date . '%')->get();
        return $result;
    }

    public static function getDataSanPhamNhaCungCap(){
        $result = DB::table('tls_supplier')
                    ->select('id_supplier as id', 'san_pham_cung_cap as name')->get();
        return $result;
    }

    public static function getListSupplierWithID($id_supplier){
        $result = DB::table('tls_supplier')->select('ten_nha_cung_cap', 'san_pham_cung_cap', 'doanh_so_ap', 'cong_no_nha_cung_cap', 'id_kho_hang')
                    ->where('tls_supplier.id_supplier', '=', $id_supplier)
                    ->get();

        return $result;
    }

    public static function updateSupplier($id_supplier, $ten_nha_cung_cap, $san_pham_cung_cap, $doanh_so_ap, $cong_no_nha_cung_cap, $id_kho_hang){
        DB::table('tls_supplier')->where('id_supplier', $id_supplier)
                          ->update([
                              'ten_nha_cung_cap' => $ten_nha_cung_cap,
                              'san_pham_cung_cap' => $san_pham_cung_cap,
                              'doanh_so_ap' => $doanh_so_ap,
                              'cong_no_nha_cung_cap' => $cong_no_nha_cung_cap,
                              'id_kho_hang' => $id_kho_hang,
                            ]);
    }


    public static function updateDataProductSupplier($id_supplier, $ten_nha_cung_cap, $san_pham_cung_cap){
        DB::table('tls_supplier')->where('id_supplier', $id_supplier)
                          ->update([
                              'ten_nha_cung_cap' => $ten_nha_cung_cap,
                              'san_pham_cung_cap' => $san_pham_cung_cap,
                            ]);
    }

    public static function createSupplier($ten_nha_cung_cap, $san_pham_cung_cap, $doanh_so_ap, $cong_no_nha_cung_cap, $id_kho_hang){
        DB::table('tls_supplier')->insert(
                                            array(
                                                'ten_nha_cung_cap' => $ten_nha_cung_cap,
                                                'san_pham_cung_cap' => $san_pham_cung_cap,
                                                'doanh_so_ap' => $doanh_so_ap,
                                                'cong_no_nha_cung_cap' => $cong_no_nha_cung_cap,
                                                'id_kho_hang' => $id_kho_hang,
                                            )
                                            );
    }

    public static function createSupplierNew($ten_nha_cung_cap, $san_pham_cung_cap){
        DB::table('tls_supplier')->insert(
                                            array(
                                                'ten_nha_cung_cap' => $ten_nha_cung_cap,
                                                'san_pham_cung_cap' => $san_pham_cung_cap,
                                                'doanh_so_ap' => 0,
                                                'cong_no_nha_cung_cap' => 0,
                                                'id_kho_hang' => 0,
                                                'id_name_supplier' => 0,
                                                'month' => '3'
                                            )
                                            );
    }


    

    public static function deleteSupplier($id_supplier){
        DB::table('tls_supplier')->where('id_supplier', $id_supplier)->delete();
    }


    public static function getDataSupplierFrom($from, $to){
        $result = DB::table('tls_phieu_nhap')
                    ->select('tls_phieu_nhap.name_phieu_nhap')
                    // ->join('tls_supplier', 'tls_phieu_nhap.id_supplier', '=', 'tls_supplier.id_supplier')
                    // ->join('tls_kho_hang', 'tls_phieu_nhap.tls_id_kho', '=', 'tls_kho_hang.tls_id_kho')
                    ->whereBetween('tls_phieu_nhap.updated_at', [$from, $to])
                    // ->toSql();
                    // dd($result);
                    ->orderBy('tls_phieu_nhap.id_phieu_nhap', 'DESC')->paginate(11);
        return $result;
    }
    // 
    public static function getDataDetailSupplierFrom($name){
        $result = DB::table('tls_quan_ly_kho_hangs')
                    ->select('tls_quan_ly_kho_hangs.id_kho_hang', 'tls_quan_ly_kho_hangs.ten_san_pham','tls_quan_ly_kho_hangs.kho_hang','tls_quan_ly_kho_hangs.nha_cung_cap','tls_quan_ly_kho_hangs.trang_thai_nhap_kho')
                    ->join('tls_phieu_nhap', 'tls_quan_ly_kho_hangs.id_phieu_nhap', '=', 'tls_phieu_nhap.id_phieu_nhap')
                    ->where('tls_phieu_nhap.name_phieu_nhap', $name)->get();
                    // ->orderBy('tls_phieu_nhap.id_phieu_nhap', 'DESC')->paginate(11);
        return $result;
    }
}
