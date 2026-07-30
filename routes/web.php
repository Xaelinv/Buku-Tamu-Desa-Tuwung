<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataBukuTamuController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\StatistikExportController;
use App\Http\Controllers\StatistikPdfController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])
    ->name('landing');

/*
|--------------------------------------------------------------------------
| Buku Tamu
|--------------------------------------------------------------------------
*/

Route::get('/buku-tamu', [BukuTamuController::class, 'create'])
    ->name('buku-tamu');

Route::post('/buku-tamu', [BukuTamuController::class, 'store'])
    ->name('buku-tamu.store');

/*
|--------------------------------------------------------------------------
| Login Admin
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthController::class, 'loginForm'])
    ->name('admin.login');

Route::post('/admin/login', [AuthController::class, 'login'])
    ->name('admin.login.process');

/*
|--------------------------------------------------------------------------
| Dashboard Admin
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');

/*
|--------------------------------------------------------------------------
| Data Buku Tamu
|--------------------------------------------------------------------------
*/

Route::get('/admin/data-buku-tamu', [DataBukuTamuController::class, 'index'])
    ->name('admin.data');

/*
|--------------------------------------------------------------------------
| Statistik
|--------------------------------------------------------------------------
*/

Route::get('/admin/statistik', [StatistikController::class, 'index'])
    ->name('admin.statistik');

/*
|--------------------------------------------------------------------------
| Export Statistik Excel
|--------------------------------------------------------------------------
*/

Route::get('/admin/statistik/export-excel', [StatistikExportController::class, 'exportExcel'])
    ->name('admin.statistik.export.excel');

Route::get('/admin/statistik/export-pdf',
    [StatistikPdfController::class,'export'])
    ->name('admin.statistik.export.pdf');
/*
|--------------------------------------------------------------------------
| Export Excel
|--------------------------------------------------------------------------
*/

Route::get('/admin/export-excel', [ExportController::class, 'exportExcel'])
    ->name('admin.export.excel');

/*
|--------------------------------------------------------------------------
| Hapus Data
|--------------------------------------------------------------------------
*/

Route::delete('/admin/hapus/{id}', [AdminController::class, 'destroy'])
    ->name('admin.hapus');

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');