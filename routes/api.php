<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WareHouseController;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/get-name-usr/{role}', [UsersController::class, 'getUser'])->name('Get-Name-Usr');

    Route::get('/get-data-ware-house', [WareHouseController::class, 'getData'])->name('Get-Data');
    Route::get('/get-data-ware-house/{id}/{seri}', [WareHouseController::class, 'getDataWhenID'])->name('Get-Data-When-ID');
    Route::post('/update-data-ware-house', [WareHouseController::class, 'updateDataWhenID'])->name('Update-Data');
    Route::post('/delete-data-ware-house', [WareHouseController::class, 'deleteDataWhenID'])->name('Delete-Data');
    Route::post('/create-data-ware-house', [WareHouseController::class, 'createDataWhenID'])->name('Create-Data');
    Route::post('/update-so-luong-order', [WareHouseController::class, 'updateSoLuongTrongKho'])->name('Update-so-luong-order');
    Route::get('/get-details-order/{id}', [WareHouseController::class, 'getListOrderWhenHome'])->name('get-details-order');

    Route::get('/get-data-order', [OrderController::class, 'getData'])->name('Get-Order');
    Route::get('/get-data-order/{id}', [OrderController::class, 'getDataWhenID'])->name('Get-Order-When-ID');
    Route::post('/update-data-order', [OrderController::class, 'updateDataUserDeal'])->name('Update-Data-User');
    Route::post('/create-data-order', [OrderController::class, 'createDonHang'])->name('Create-Data-User');
    
    Route::get('/get-thong-ke-don-hang/{trang_thai}/{date}/{compare}', [OrderController::class, 'dataThongKe'])->name('data-thong-ke');
});
