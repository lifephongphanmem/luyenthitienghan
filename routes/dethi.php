<?php

use App\Http\Controllers\dethi\cauhoiController;
use App\Http\Controllers\dethi\dethiController;
use App\Http\Controllers\thithu\phongthiController;
use App\Http\Controllers\thithu\thithuController;
use Illuminate\Support\Facades\Route;




//Đề thi
Route::prefix('DeThi')->group(function(){
    Route::get('/ThongTin',[dethiController::class,'index']);
    Route::post('/store',[dethiController::class,'store']);
    Route::post('/update/{made}',[dethiController::class,'update']);
    Route::post('/delete/{made}',[dethiController::class,'destroy']);
    Route::get('/ChiTiet/{made}',[dethiController::class,'show']);
    Route::post('/ChiTiet/{made}/DanhSachCauHoi',[dethiController::class, 'danhsachcauhoi']);
    Route::post('/ThemCauHoi',[dethiController::class,'themcauhoi']);
    Route::post('/ChiTiet/{made}/XoaCauHoi/{macauhoi}',[dethiController::class, 'xoacauhoi']);
});

//Câu hỏi
Route::prefix('CauHoi')->group(function(){
    Route::get('/ThongTin',[cauhoiController::class,'index']);
    Route::get('/ThemCauHoi',[cauhoiController::class,'create']);
    Route::post('/store',[cauhoiController::class,'store']);
    Route::get('/CapNhat/{macauhoi}',[cauhoiController::class,'edit']);
    Route::post('/update/{macauhoi}',[cauhoiController::class,'update']);
    Route::post('/delete/{macauhoi}',[cauhoiController::class,'destroy']);
    Route::post('/LoaiCauHoi',[cauhoiController::class,'loaicauhoi']);
    Route::post('/LoaiDapAn',[cauhoiController::class,'loaidapan']);
    Route::post('import',[cauhoiController::class,'import']);
    Route::get('/edit/{macauhoi}',[cauhoiController::class,'edit']);
});

Route::prefix('ThiThu')->group(function(){
    Route::get('/ThongTin',[thithuController::class,'quanlythithu']);
    Route::get('/EPS-TOPIK',[thithuController::class,'thithu']);
    Route::get('/LamBai',[thithuController::class,'lambai']);
    Route::post('/NopBai',[thithuController::class,'nopbai']);
    Route::post('/checklog',[thithuController::class,'checklog']);
});

Route::prefix('PhongThi')->group(function(){
    Route::get('/ThongTin',[phongthiController::class,'index']);
    Route::get('/ChiTiet/{maphongthi}',[phongthiController::class,'show']);
    Route::post('/store',[phongthiController::class,'store']);
    Route::post('/update/{maphongthi}',[phongthiController::class,'update']);
    Route::post('/delete/{maphongthi}',[phongthiController::class,'destroy']);
    Route::post('/ThemLop',[phongthiController::class,'themlop']);
    Route::post('/XoaLop/{malop}',[phongthiController::class,'xoalop']);
    Route::post('/DongPhongThi',[phongthiController::class,'dongphongthi']);
});
Route::get('/LuyenThi_EPS',[thithuController::class,'luyenthi']);

Route::get('/960CauDocHieu',[cauhoiController::class,'caudochieu']);
Route::get('/960CauNgheHieu',[cauhoiController::class,'caunghehieu']);