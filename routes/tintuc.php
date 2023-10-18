<?php

use App\Http\Controllers\tintuc\tintucController;
use Illuminate\Support\Facades\Route;

Route::prefix('TinTuc')->group(function () {
    Route::get('/TrangChu', [tintucController::class, 'index'])->name('trangchutintuc');
    Route::get('/QuanLy', [tintucController::class, 'quanly'])->name('quanlytintuc');
    Route::get('/TaoBai', [tintucController::class, 'create']);
    Route::post('/TaoBai/create', [tintucController::class, 'store']);
    Route::get('/NoiDung/{slug}', [tintucController::class, 'show']);
    Route::get('/CapNhat/{slug}', [tintucController::class, 'edit']);
    Route::post('/ThayDoi/{slug}', [tintucController::class, 'update']);
    Route::get('/Xoa/{slug}', [tintucController::class, 'destroy']);
});