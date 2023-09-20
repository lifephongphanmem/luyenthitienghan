<?php

use App\Http\Controllers\tracuu\tracuuController;
use Illuminate\Support\Facades\Route;

Route::prefix('TraCuu')->group(function () {
    Route::get('/', [tracuuController::class, 'index']);
    Route::post('/KetQua', [tracuuController::class, 'ketqua']);
});