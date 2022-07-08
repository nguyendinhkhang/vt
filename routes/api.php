<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WareHouseController;
use App\Http\Controllers\StorageRemoveController;
use App\Http\Controllers\StorageRouteShip;
use App\Http\Controllers\SupplierComponent;
use App\Http\Controllers\KhoHangController;
use App\Http\Controllers\PhieuNhapController;
use App\Http\Controllers\PhieuNhapNameController;
use App\Http\Controllers\PhieuNhapCountController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login_system', [AuthController::class, 'login'])->name('Login-System');
Route::post('/login_system_ship', [AuthController::class, 'loginShip'])->name('Login-System');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/get-name-usr/{role}', [UsersController::class, 'getUser'])->name('Get-Name-Usr');
    Route::get('/get-all-user', [UsersController::class, 'getInfoUser'])->name('Get-All-Data');
    Route::get('/get-user/{id}', [UsersController::class, 'getInfoUserWhenID'])->name('Get-User-Data');
    Route::post('/update-data-user', [UsersController::class, 'updateDataUserWhenID'])->name('Update-Data-User');
    Route::post('/delete-data-user', [UsersController::class, 'deleteDataUserWhenID'])->name('Delete-Data-User');
    Route::post('/create-data-user', [UsersController::class, 'createDataUser'])->name('Create-Data-User');
    
    Route::get('/get-data-ware-house/{id}', [WareHouseController::class, 'getData'])->name('Get-Data');
    Route::get('/get-sum-ware-house/{id}/{month}', [WareHouseController::class, 'getSum'])->name('Get-Sum');
    Route::get('/get-data-ware-house/{id}/{seri}', [WareHouseController::class, 'getDataWhenID'])->name('Get-Data-When-ID');
    Route::post('/search-data-ware-house', [WareHouseController::class, 'searchData'])->name('Search-Data');
    Route::get('/get-data-count-ware-house/{id}/{month}', [WareHouseController::class, 'getDataCount'])->name('Get-Data-Count');
    Route::post('/update-data-ware-house', [WareHouseController::class, 'updateDataWhenID'])->name('Update-Data');
    Route::post('/delete-data-ware-house', [WareHouseController::class, 'deleteDataWhenID'])->name('Delete-Data');
    Route::post('/create-data-ware-house', [WareHouseController::class, 'createDataWhenID'])->name('Create-Data');
    Route::post('/update-so-luong-order', [WareHouseController::class, 'updateSoLuongTrongKho'])->name('Update-so-luong-order');
    Route::get('/get-details-order/{id}', [WareHouseController::class, 'getListOrderWhenHome'])->name('get-details-order');
    Route::get('/get-phieu-nhap-when-id-phieu-nhap/{name}/{kho}', [WareHouseController::class, 'getDataWhenIDPhieuNhap'])->name('get-phieu-nhap-when-id-phieu-nhap');
    Route::post('/delete-data-ware-house-seri', [WareHouseController::class, 'deleteDataWhenSeri'])->name('Delete-Data-Seri');
    Route::get('/get-name-phieu-nhap/{id}', [WareHouseController::class, 'getDataPhieuByWareHouse'])->name('Get-Data-By-Ware-House');
    Route::get('/get-name-phieu-nhap-wailt/{id}', [WareHouseController::class, 'getDataPhieuByWareHouseWailt'])->name('Get-Data-By-Ware-House');
    Route::post('/update-status-paid', [WareHouseController::class, 'updateStatusPaid'])->name('Update-status-paid');
    Route::post('/update-seri', [WareHouseController::class, 'updateSeri'])->name('Update-seri');

    Route::get('/get-data-order', [OrderController::class, 'getData'])->name('Get-Order');
    Route::get('/get-data-order/{id}', [OrderController::class, 'getDataWhenID'])->name('Get-Order-When-ID');
    Route::post('/update-data-order', [OrderController::class, 'updateDataUserDeal'])->name('Update-Data-User');
    Route::post('/update-data-order-bh', [OrderController::class, 'updateDataUserDealBH'])->name('Update-Data-User-BH');
    Route::post('/create-data-order', [OrderController::class, 'createDonHang'])->name('Create-Data-User');
    Route::get('/get-thong-ke-don-hang/{trang_thai}/{from}/{to}', [OrderController::class, 'dataThongKe'])->name('data-thong-ke');
    Route::get('/get-thong-ke-doanh-thu/{trang_thai}/{from}/{to}', [OrderController::class, 'dataThongKeDoanhThu'])->name('data-thong-ke-doanh-thu');
    Route::get('/get-tong-doanh-thu/{trang_thai}/{from}/{to}', [OrderController::class, 'dataTongDoanhThu'])->name('data-tong-doanh-thu');

    //Thu Hoi
    Route::post('/delete-data-order', [OrderController::class, 'deleteDonHang'])->name('Delete-Data-User');
    //Shiping
    Route::get('/get-data-order-user/{user_id}', [OrderController::class, 'getDataWhenUserID'])->name('Get-Order-When-User-Ship-ID');
    Route::get('/get-data-order-role/{user_id}', [OrderController::class, 'getDataWhenUserIDAdmin'])->name('Get-Order-When-User-Admin-ID');
    Route::post('/update-data-ship', [OrderController::class, 'updateDataShip'])->name('update-Data-Ship');
    Route::post('/update-data-refund-ship', [OrderController::class, 'updateDataRedfundShip'])->name('update-Data-Refund-Ship');
    Route::get('/get-data-user-shipped/{user_id}', [OrderController::class, 'getDataWhenUserShipped'])->name('Get-Data-When-User-Shiped');

    // Storage Remove
    Route::get('/get-data-storage-remove', [StorageRemoveController::class, 'getDataStorage'])->name('Get-Data-Storage');
    Route::post('/insert-data-storage-remove', [StorageRemoveController::class, 'insertDataStorage'])->name('Insert-Data-Storage');

    // Storage Insert
    Route::post('/insert-data-storage-route-ship', [StorageRouteShip::class, 'insertDataStorageRoute'])->name('Insert-Data-Storage-Route');
    Route::get('/get-data-storage-route-ship/{from}/{to}', [StorageRouteShip::class, 'getDataStorageRouteShip'])->name('Get-Data-Storage-route-Ship');

    // Nha cung cap
    Route::get('/get-nha-cung-cap/{name}', [SupplierComponent::class, 'getDataSupplier'])->name('Get-Data-getDataSupplier');
    Route::get('/get-nha-cung-cap-voi-id/{id}', [SupplierComponent::class, 'GetDataSupplierWithID'])->name('Get-Data-getDataSupplier-ID');
    Route::post('/create-nha-cung-cap', [SupplierComponent::class, 'createDataSupplier'])->name('Create-Data-getDataSupplier');
    Route::post('/update-nha-cung-cap', [SupplierComponent::class, 'updateDataSupplier'])->name('Update-Data-getDataSupplier');
    Route::post('/delete-data-nha-cung-cap', [SupplierComponent::class, 'deleteDataSupplier'])->name('Delete-Data-Supplier');
    Route::get('/get-data-nha-cung-cap/{from}/{to}', [SupplierComponent::class, 'getDataSupplierFrom'])->name('Get-Data-Supplier-From');
    Route::get('/get-detail-data-from-to/{name}', [SupplierComponent::class, 'getDataDetailSupplierFrom'])->name('Get-Data-Detail-Supplier-From');
    Route::post('/create-san-pham-nha-cung-cap', [SupplierComponent::class, 'createDataSupplierNew'])->name('Create-Data-getDataSupplier');
    Route::post('/update-san-pham-cung-cap', [SupplierComponent::class, 'updateDataProductSupplier'])->name('Update-Data-product');

    //Kho Hang
    Route::get('/get-kho-hang', [KhoHangController::class, 'getDataKho'])->name('Get-Data-Kho');
    Route::get('/get-ten-kho-hang', [KhoHangController::class, 'getListAllWareHosue'])->name('Get-Data-Name-Kho');
    Route::get('/get-kho-hang-id/{id}', [KhoHangController::class, 'GetDataKhoWithID'])->name('Get-Data-kho-ID');
    Route::post('/create-kho-hang', [KhoHangController::class, 'createDataKhoHang'])->name('Create-Data-kho-Hang');
    Route::post('/update-kho-hang', [KhoHangController::class, 'updateDataKhoHang'])->name('Update-Data-Kho-Hang');

    // API DropDown
    Route::get('/get-all-hang', [KhoHangController::class, 'getDataAllKho'])->name('Get-Data-Kho');
    Route::get('/get-all-nha-cung-cap', [SupplierComponent::class, 'getDataAllNhaCungCap'])->name('Get-Data-Nha-Cung-Cap');
    Route::get('/get-all-nha-cung-cap-date/{date}', [SupplierComponent::class, 'getDataAllNhaCungCapDate'])->name('Get-Data-Nha-Cung-Cap');
    Route::get('/get-san-pham-cung-cap', [SupplierComponent::class, 'getDataSanPhamNhaCungCap'])->name('Get-Data-Nha-Cung-Cap');

    // API Nhập kho 
    Route::get('/get-all-phieu-nhap', [PhieuNhapController::class, 'getDataAllPhieuNhap'])->name('Get-All-tls_phieu_nhap');
    Route::post('/insert-phieu-nhap', [PhieuNhapController::class, 'insertDataAllPhieuNhap'])->name('insert-tls_phieu_nhap');
    Route::get('/get-phieu-nhap-when-id/{id}', [PhieuNhapController::class, 'getWhenIDPhieuNhap'])->name('Get-When-ID-tls_phieu_nhap');
    Route::post('/update-phieu-nhap', [PhieuNhapController::class, 'updateDataPhieuNhap'])->name('update-phieu-nhap');
    Route::get('/get-phieu-nhap-when-name/{name}', [PhieuNhapController::class, 'getNamePhieuNhap'])->name('get-phieu-nhap-Name');

    Route::get('/get-data-by-supplier/{id}', [PhieuNhapController::class, 'getDataBySupplier'])->name('Get-Data-By-Supplier');
    Route::get('/get-data-by-supplier/{id}/{date}', [PhieuNhapController::class, 'getDataBySupplierDate'])->name('Get-Data-By-Supplier-Date');
    Route::get('/get-data-by-ware-house/{id}', [PhieuNhapController::class, 'getDataWareHouse'])->name('Get-Data-By-WareHouse');
    Route::get('/get-san-pham-theo-phieu-nhap/{name}', [PhieuNhapCountController::class, 'getDataWithSupplier'])->name('Get-data-theo-phieu-nhap');
    Route::post('/update-cong-no', [PhieuNhapController::class, 'updateDataTuoiCongNo'])->name('update-tuoi-cong-no');
    
    
    // API supplier
    Route::post('/insert-name-phieu-nhap', [PhieuNhapNameController::class, 'insertDataPhieuNhap'])->name('insert-tls-name-phieu_nhap');
    Route::get('/get-all-name-phieu-nhap/{date}', [PhieuNhapNameController::class, 'getDataAllNamePhieuNhap'])->name('Get-All-name-phieu_nhap');
    Route::get('/get-all-month-phieu-nhap', [PhieuNhapNameController::class, 'getDataAllMonthPhieuNhap'])->name('Get-All-month-phieu_nhap');
    Route::post('/update-data-name-phieu-nhap', [PhieuNhapNameController::class, 'updateDataNamePhieuNhap'])->name('update-Data-name-phieu_nhap');
    Route::post('/update-data-cong-no', [PhieuNhapNameController::class, 'updateDataCongNo'])->name('update-Data-Cong-No');
    Route::post('/delete-data-name-phieu-nhap', [PhieuNhapNameController::class, 'deleteDataNamePhieuNhap'])->name('Delete-Data-name-phieu_nhap');

    // GetData And Add Supplier
    Route::get('/get-supplier-debts/{name}', [PhieuNhapNameController::class, 'getDataSupplierDebts'])->name('Get-supplier-debts');

    Route::post('/insert-count-phieu-nhap', [PhieuNhapCountController::class, 'insertCountPhieuNhap'])->name('insert-tls-dem-data-phieu-nhap');
    Route::get('/data-status-off', [PhieuNhapCountController::class, 'getDataKhoHangTheoPhieuNhap'])->name('Lay-Data-Trang-Thai-Chua-Nhap');
    Route::post('/update-trang-thai-nhap-kho', [PhieuNhapCountController::class, 'updateTrangThaiNhap'])->name('update-trang-thai-nhap');
    Route::get('/get-phieu-nhap-trang-thai-cho', [PhieuNhapCountController::class, 'getDataPhieuNhapWailt'])->name('Get-data-phieu-nhap-wait');
    Route::post('/success-trang-thai-nhap-kho', [PhieuNhapCountController::class, 'updateDataPhieuNhapSuccess'])->name('update-trang-thai-nhap');
});
