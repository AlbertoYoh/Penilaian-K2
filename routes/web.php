<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\KaryaController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\TaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\User\NilaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('loginPros', [LoginController::class, 'loginPros'])->name('loginPros');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('raport')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Route Untuk Mapel
    Route::resource('mapel', MapelController::class);

    // Route Untuk TA
    Route::resource('ta', TaController::class);

    // Route Untuk Karya
    Route::resource('karya', KaryaController::class);

    // Route Untuk Siswa
    Route::post('siswaImportExcel', [SiswaController::class, 'siswaImportExcel'])->name('siswaImportExcel');
    Route::resource('siswa', SiswaController::class);

    // Route Untuk Guru
    Route::resource('guru', GuruController::class);

    // Route Nilai Untuk Guru dan User
    Route::get('nilai', [NilaiController::class, 'index'])->name('nilai');
    Route::get('tambahNilai/{id}', [NilaiController::class, 'tambahNilai'])->name('tambahNilai');
});
