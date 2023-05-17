<?php

use App\Http\Controllers\danhmuc\chitietloaicauhoictController;
use App\Http\Controllers\danhmuc\dmhanhchinhController;
use App\Http\Controllers\danhmuc\dmlophocController;
use App\Http\Controllers\danhmuc\dmnganhhocController;
use App\Http\Controllers\danhmuc\dmnguoncauhoiController;
use App\Http\Controllers\danhmuc\dmtrinhdocmktController;
use App\Http\Controllers\danhmuc\dmtrinhdogdptController;
use App\Http\Controllers\danhmuc\doituonguutienController;
use App\Http\Controllers\danhmuc\loaicauhoiController;
use App\Http\Controllers\danhmuc\loaicauhoictController;
use Illuminate\Support\Facades\Route;

Route::prefix('LoaiCauHoi')->group(function(){
    Route::get('/ThongTin',[loaicauhoiController::class,'index']);
    Route::post('/store',[loaicauhoiController::class,'store']);
    Route::post('/update/{madm}',[loaicauhoiController::class,'update']);
    Route::post('/delete/{madm}',[loaicauhoiController::class,'destroy']);
    Route::get('/chitiet/{madm}',[loaicauhoictController::class,'index']);
});

Route::prefix('LoaiCauHoiCt')->group(function(){
    Route::post('/store',[loaicauhoictController::class,'store']);
    Route::post('/update/{madmct}',[loaicauhoictController::class,'update']);
    Route::post('/delete/{madmct}',[loaicauhoictController::class,'destroy']);
    Route::get('/chitiet/{madmct}',[chitietloaicauhoictController::class,'index']);
});

Route::prefix('ChiTietLoaiCauHoiCt')->group(function(){
    Route::post('/store',[chitietloaicauhoictController::class,'store']);
    Route::post('/update/{madmct2}',[chitietloaicauhoictController::class,'update']);
    Route::post('/delete/{madmct2}',[chitietloaicauhoictController::class,'destroy']);
});

Route::prefix('DiaBan')->group(function(){
    Route::get('/ThongTin',[dmhanhchinhController::class,'index']);
    Route::post('/store',[dmhanhchinhController::class,'store']);
    Route::post('/update/{id}',[dmhanhchinhController::class,'update']);
    Route::get('/delete/{id}',[dmhanhchinhController::class,'destroy']);
});

Route::prefix('TrinhDoGDPT')->group(function(){
    Route::get('/ThongTin', [dmtrinhdogdptController::class, 'index']);
    Route::post('/store_update', [dmtrinhdogdptController::class, 'store_update']);
    Route::get('/delete/{id}', [dmtrinhdogdptController::class, 'delete']);
    Route::get('/edit/{id}', [dmtrinhdogdptController::class, 'edit']);
});

Route::prefix('/TrinhDoCMKT')->group(function () {
    Route::get('/ThongTin', [dmtrinhdocmktController::class, 'index']);
    Route::post('/store_update', [dmtrinhdocmktController::class, 'store_update']);
    Route::get('/delete/{id}', [dmtrinhdocmktController::class, 'delete']);
    Route::get('/edit/{id}', [dmtrinhdocmktController::class, 'edit']);
});

Route::prefix('DoiTuongUuTien')->group(function(){
    Route::get('/ThongTin', [doituonguutienController::class, 'index']);
    Route::post('/store_update', [doituonguutienController::class, 'store_update']);
    Route::get('/delete/{id}', [doituonguutienController::class, 'delete']);
    Route::get('/edit/{id}', [doituonguutienController::class, 'edit']);
});

Route::prefix('NganhHoc')->group(function(){
    Route::get('/ThongTin', [dmnganhhocController::class, 'index']);
    Route::post('/store_update', [dmnganhhocController::class, 'store_update']);
    Route::get('/delete/{id}', [dmnganhhocController::class, 'delete']);
    Route::get('/edit/{id}', [dmnganhhocController::class, 'edit']);
});
Route::prefix('dmLopHoc')->group(function(){
    Route::get('/ThongTin', [dmlophocController::class, 'index']);
    Route::post('/store_update', [dmlophocController::class, 'store_update']);
    Route::get('/delete/{id}', [dmlophocController::class, 'delete']);
    Route::get('/edit/{id}', [dmlophocController::class, 'edit']);
});
Route::prefix('NguonCauHoi')->group(function(){
    Route::get('/ThongTin', [dmnguoncauhoiController::class, 'index']);
    Route::post('/store_update', [dmnguoncauhoiController::class, 'store_update']);
    Route::get('/delete/{id}', [dmnguoncauhoiController::class, 'delete']);
    Route::get('/edit/{id}', [dmnguoncauhoiController::class, 'edit']);
});

