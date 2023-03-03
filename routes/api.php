<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\RiwayatLaporanController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can`t find me register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::resource('/status', StatusController::class);
//     Route::resource('/jabatan', JabatanController::class);
//     Route::resource('/karyawan', KaryawanController::class);
// });

Route::resource('/status', StatusController::class);
Route::resource('/jabatan', JabatanController::class);
Route::resource('/karyawan', KaryawanController::class);
Route::resource('/riwayat-laporan', RiwayatLaporanController::class);

Route::get('/users', [UsersController::class, 'index']);
Route::get('/employee-flutter', [KaryawanController::class, 'getFlutter']);
Route::get('/laporan-flutter', [RiwayatLaporanController::class, 'getFlutter']);



Route::delete('/karyawan', [KaryawanController::class, 'destroyAll']);
Route::put('/karyawan/{karyawan}/update-gaji', [KaryawanController::class, 'updateGaji']);

// Route::put('/karyawan/{karyawan}/update-status', [KaryawanController::class, 'updateStatus']);
// Route::put('/karyawan/{karyawan}/update-jabatan', [KaryawanController::class, 'updateJabatan']);
Route::post('/karyawan/{karyawan}/update-bank', [KaryawanController::class, 'updateBank']);
Route::post('/karyawan/{karyawan}/update-foto', [KaryawanController::class, 'updateFoto']);
Route::post('/karyawan/{karyawan}/update-statuses', [KaryawanController::class, 'updateStatuses']);


