<?php

use App\Http\Controllers\tintuc\tintucController;
use Illuminate\Support\Facades\Route;

Route::prefix('TinTuc')->group(function(){
    Route::get('/TrangChu', [tintucController::class, 'index'])->name('trangchutintuc');
    Route::get('/TaoBai', [tintucController::class, 'create']);
    Route::post('/TaoBai/create', [tintucController::class, 'store']);
    Route::get('/{slug}', [tintucController::class, 'show']);
});