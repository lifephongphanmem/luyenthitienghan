<?php

use App\Http\Controllers\hotro\vanphonghotroController;

Route::group(['prefix' => 'van_phong'], function () {
    Route::get('danh_sach', [vanphonghotroController::class, 'index']);
    Route::get('get_chucnang', [vanphonghotroController::class, 'edit']);
    Route::post('store', [vanphonghotroController::class, 'store']);
    Route::post('delete', [vanphonghotroController::class, 'destroy']);
});
Route::get('thongtinhotro', [vanphonghotroController::class, 'thongtinhotro']);