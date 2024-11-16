<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatuspengaduanController;
use App\Http\Controllers\PeranpenggunaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IsuController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\AktivitasController;

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


Route::middleware('auth:admin-api')->get('/admin',[AuthController::class, 'currentAdmin']);

Route::middleware('auth:user-api')->get('/user',[AuthController::class, 'currentUser']);

// Route::middleware('auth:admin-api')->get('/admin', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:user-api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('dinas/login', [AuthController::class, 'userlogin'])->name('userLogin');
Route::post('admin/register', [AuthController::class, 'registerAdmin']);
Route::post('admin/login',[AuthController::class, 'adminLogin'])->name('adminLogin');

// ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin-api','scopes:admin']], function () {

    // ADMIN
    Route::get('dashboardadmin',[AuthController::class, 'adminDashboard']);
    Route::delete('hapusadmin/{id}', [AuthController::class, 'destroyAdmin']);
    Route::post('editadmin/{id}', [AuthController::class, 'editAdmin']);
    Route::get('/detailadmin/{id}', [AuthController::class, 'showAdmin']);
    Route::get('/searchadmin', [AuthController::class, 'searchAdmin']);

    // DINAS
    Route::post('registerdinas', [AuthController::class, 'registerUser']);
    Route::get('dashboarddinas',[AuthController::class, 'userDashboard']);
    Route::delete('hapusdinas/{id}', [AuthController::class, 'destroyUser']);
    Route::post('editdinas/{id}', [AuthController::class, 'editUser']);
    Route::get('/detaildinas/{id}', [AuthController::class, 'showUser']);
    Route::get('/searchdinas', [AuthController::class, 'searchUser']);

    // PERAN PENGGUNA
    Route::get('/peranpengguna', [PeranpenggunaController::class, 'index']);
    Route::get('/peranpengguna/{id}', [PeranpenggunaController::class, 'show']);
    Route::post('/peranpengguna', [PeranpenggunaController::class, 'store']);
    Route::post('/peranpengguna/{id}', [PeranpenggunaController::class, 'update']);
    Route::delete('/peranpengguna/{id}', [PeranpenggunaController::class, 'destroy']);

    // STATUS PENGADUAN
    Route::get('/statuspengaduan', [StatuspengaduanController::class, 'index']);
    Route::get('/statuspengaduan/{id}', [StatuspengaduanController::class, 'show']);
    Route::post('/statuspengaduan', [StatuspengaduanController::class, 'store']);
    Route::post('/statuspengaduan/{id}', [StatuspengaduanController::class, 'update']);
    Route::delete('/statuspengaduan/{id}', [StatuspengaduanController::class, 'destroy']);
    Route::get('/searchstatus', [StatuspengaduanController::class, 'search']);

    // TOTAL ISU PENGADUAN
    Route::get('/hitungisu', [IsuController::class, 'countData']);
    Route::get('/hitungisuselesai', [AktivitasController::class, 'countData']);
    Route::get('/hitungisuproses', [PengaduanController::class, 'countData']);
  
});

// DINAS
Route::group(['prefix' => 'dinas', 'middleware' => ['auth:user-api','scopes:user']], function () {

    // PROFILE CURRENT LOGIN
    Route::get('/editprofile/{id}',[AuthController::class, 'getUserbyid']);
    Route::post('/editprofile/{id}',[AuthController::class, 'updateProfile']);

    // ISU PENGADUAN MASUK
    Route::get('/isumasuk', [IsuController::class, 'index']);
    Route::get('/isumasuk/{id}', [IsuController::class, 'show']);
    Route::delete('/isumasuk/{id}', [IsuController::class, 'destroy']);
    Route::post('/isumasuk/{id}', [IsuController::class, 'update']);
    Route::get('/searchisu', [IsuController::class, 'search']);

    // BAN
    Route::post('/banisu/{id}', [IsuController::class, 'updateBan']);
    // VERIFIKASI
    Route::post('/pengaduan', [PengaduanController::class, 'store']);

    // PENGADUAN VERIFIKASI
    Route::get('/pengaduan', [PengaduanController::class, 'index']);
    Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy']);
    Route::get('/pengaduan/{id}', [PengaduanController::class, 'show']);
    Route::post('/pengaduan/{id}', [PengaduanController::class, 'update']);
    Route::get('/searchpengaduan', [PengaduanController::class, 'search']);
    // Route::post('/pengaduan/export', [PengaduanController::class, 'export']);
    // Route::get('/pengaduan/export', [PengaduanController::class, 'exportExcel']);

    // PENGADUAN BAN
    Route::get('/isuban', [IsuController::class, 'indexBan']);

    // AKTIVITAS
    Route::get('/aktivitas', [AktivitasController::class, 'index']);
    Route::post('/aktivitas', [AktivitasController::class, 'store']);
    Route::get('/aktivitas/{id}', [AktivitasController::class, 'show']);

    // TOTAL PENGADUAN
    Route::get('/hitungisuselesai', [AktivitasController::class, 'countData']);
    Route::get('/hitungisu', [IsuController::class, 'countData']);
    Route::get('/hitungisuproses', [PengaduanController::class, 'countData']);
    
    Route::get('/statuspengaduan', [StatuspengaduanController::class, 'indexDinas']);

});

// USER
Route::post('/user/isumasuk', [IsuController::class, 'store']);
Route::get('/aktivitas/search', [AktivitasController::class, 'search']);
Route::get('/pengaduan/search', [PengaduanController::class, 'search']);




// EXPORT VERIFIKASI
Route::get('/pengaduan/export', [PengaduanController::class, 'export']);

Route::get('/pengaduanmasuk/export', [IsuController::class, 'export']);
Route::get('/pengaduanban/export', [IsuController::class, 'exportBan']);


Route::get('/aktivitas/export', [AktivitasController::class, 'export']);