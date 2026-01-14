<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JabatanKaryawanController;

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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin','middleware' => ['auth']], function () {
    Route::resource('pengguna', UserController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::resource('jabatan-karyawan', JabatanKaryawanController::class);
    Route::get('print-pdf', [JabatanController::class, 'printPdf'])->name('print.jabatan');
//kita tambahkan juga untuk memanggil method grafik dan export excel
Route::get('grafik-jabatan', [JabatanController::class, 'grafikJabatan'])->name('grafik.jabatan');
Route::get('get-grafik', [JabatanController::class, 'getGrafik'])->name('get.grafik.jabatan');
Route::get('export-excel', [JabatanController::class, 'exportExcel'])->name('export.excel');

});
