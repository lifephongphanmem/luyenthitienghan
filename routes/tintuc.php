<?php

use App\Http\Controllers\tintuc\tintucController;
use Illuminate\Support\Facades\Route;

Route::prefix('TinTuc')->group(function () {
    Route::get('/TrangChu', [tintucController::class, 'index'])->name('trangchutintuc');
    Route::get('/TaoBai', [tintucController::class, 'create']);
    Route::post('/TaoBai/create', [tintucController::class, 'store']);
    Route::get('/{slug}', [tintucController::class, 'show']);
    Route::get('/{slug}/Sua', [tintucController::class, 'edit']);
    Route::post('/{slug}/CapNhat', [tintucController::class, 'update']);
    Route::get('/{slug}/Xoa', [tintucController::class, 'destroy']);
});