<?php

use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsLogin;
use Maatwebsite\Excel\Row;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// route yg hanya dapat diakses setalah login dan role nya admin
Route::middleware('IsLogin', 'CekRole:admin')->group(function() {
    Route::get('/dashboard', [PengaduanController::class,'dashboard'])->name('dashboard_admin');
    Route::delete('/hapus/{id}',[PengaduanController::class,'destroy'])->name('delete');
    Route::get('/export/pdf/{id}', [PengaduanController::class, 'createPDF'])->name('export.pdf');
    Route::get('/export/pdf', [PengaduanController::class, 'print'])->name('export.all');
    Route::get('/export/excel', [PengaduanController::class,  'createExcel'])->name('export.excel');

    
});
// route yg hanya dapat diakses setelah login dan role nya petugas
Route::middleware('IsLogin', 'CekRole:petugas')->group(function() {
 Route::get('/data/petugas', [PengaduanController::class,'dataPetugas'])->name('data.petugas');
//  menampilkan form tambah atau response
 Route::get('/response/edit/{pengaduan_id}', [ResponseController::class,'edit'])->name('response.edit');
//  kirim data response, menggunakan patch, karena dia bisa berupa tambah data dan kirim data
 Route::patch('/response/update/{pengaduan_id}', [ResponseController::class,'updateResponse'])->name('response.update');
});

// route untuk admin dan petugas setelah login
Route::middleware('IsLogin', 'CekRole:admin,petugas')->group(function()
{
    Route::get('/logout',[PengaduanController::class,'logout'])->name('logout');
});

Route::post('/kirim-data',[PengaduanController::class,'store'])->name('kirim_data');
Route::get('/',[PengaduanController::class,'index'])->name('home');
Route::get('/login',[PengaduanController::class,'login'])->name('login');
Route::post('/auth',[PengaduanController::class,'auth'])->name('auth');



