<?php

use App\Http\Controllers\Thivong2\congcuController;
use App\Http\Controllers\ThiVong2\testMuMauController;
use App\Http\Controllers\Thivong2\thivong2EPSController;
use App\Http\Controllers\Thivong2\vandapController;
use Illuminate\Support\Facades\Route;




Route::prefix('epstopik-test')->group(function(){
    Route::get('/ThongTin',[thivong2EPSController::class,'thivong2']);
    Route::get('phongvan',[thivong2EPSController::class,'VanDap']);
    Route::get('hieulenh',[thivong2EPSController::class,'HieuLenh']);
    Route::get('gioithieubanthan',[thivong2EPSController::class,'GTBanThan']);
    Route::get('getCauHoi',[thivong2EPSController::class,'getCauHoi']);
    Route::get('CongCu/{phanloai}',[thivong2EPSController::class,'CongCu']);
    Route::get('test_mu_mau',[thivong2EPSController::class,'TestMuMau']);
});

Route::prefix('ThiVong2')->group(function(){
    Route::prefix('VanDap')->group(function(){
        Route::get('ThongTin',[vandapController::class,'ThongTin']);
        Route::post('LuuCauHoi',[vandapController::class,'LuuCauHoi']);
        Route::get('XoaCauHoi/{id}',[vandapController::class,'XoaCauHoi']);
        Route::get('edit',[vandapController::class,'edit']);
        Route::post('CapNhat',[vandapController::class,'CapNhat']);
    });
});
Route::prefix('CongCu')->group(function(){
    Route::get('ThongTin',[congcuController::class,'ThongTin']);
    Route::post('LuuCongCu',[congcuController::class,'LuuCongCu']);
    Route::get('XoaCongCu/{id}',[congcuController::class,'XoaCongCu']);
    Route::get('edit',[congcuController::class,'edit']);
    Route::post('CapNhat',[congcuController::class,'CapNhat']);
    Route::post('NhanExcel',[congcuController::class,'NhanExcel']);
    Route::post('ChuyenHinhAnh',[thivong2EPSController::class,'ChuyenHinhAnh']);
});
Route::prefix('TestMuMau')->group(function(){
    Route::get('ThongTin',[testMuMauController::class,'ThongTin']);
    Route::post('Luu',[testMuMauController::class,'Luu']);
    Route::get('edit',[testMuMauController::class,'edit']);
    Route::post('CapNhat',[testMuMauController::class,'CapNhat']);
    Route::get('Xoa/{id}',[testMuMauController::class,'Xoa']);
    Route::post('NhanExcel',[testMuMauController::class,'NhanExcel']);
    Route::post('ChuyenAnhTest',[thivong2EPSController::class,'ChuyenAnhTest']);
    Route::post('KiemTra',[thivong2EPSController::class,'KiemTra']);
});