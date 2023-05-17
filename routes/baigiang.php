<?php

use App\Http\Controllers\baigiang\baihocchinhController;
use App\Http\Controllers\baigiang\baitapController;
use App\Http\Controllers\baigiang\giaotrinhController;
use App\Http\Controllers\baigiang\hinhanhController;
use App\Http\Controllers\baigiang\tracnghiemController;
use App\Http\Controllers\baigiang\tuvungController;
use Illuminate\Support\Facades\Route;


//giáo trình
Route::prefix('GiaoTrinh')->group(function(){
    Route::get('/ThongTin',[giaotrinhController::class,'index']);
    Route::post('/store',[giaotrinhController::class,'store']);
    Route::post('/update/{id}',[giaotrinhController::class,'update']);
    Route::post('/delete/{id}',[giaotrinhController::class,'destroy']);
    Route::get('/chitiet',[giaotrinhController::class,'show']);
    Route::post('/thembaihoc',[giaotrinhController::class,'thembaihoc']);
    Route::post('/XoaBaiHoc/{id}',[giaotrinhController::class,'xoabaihoc']);


    Route::prefix('60-bai-eps-topik')->group(function(){
        Route::get('',[giaotrinhController::class,'DanhSach']);
        Route::get('/baihoc',[giaotrinhController::class,'noidungbaihoc']);
    });
});

//Bài học chính
Route::prefix('BaiHocChinh')->group(function(){
    Route::get('/ThongTin',[baihocchinhController::class,'index']);
    Route::post('/store',[baihocchinhController::class,'store']);
    Route::post('/update/{id}',[baihocchinhController::class,'update']);
    Route::post('/delete/{id}',[baihocchinhController::class,'destroy']);
});

//Từ vựng
Route::prefix('/TuVung')->group(function(){
    Route::get('/ThongTin',[tuvungController::class,'index']);
    Route::post('/store',[tuvungController::class,'store']);
    Route::post('/update/{id}',[tuvungController::class,'update']);
    Route::post('/delete/{id}',[tuvungController::class,'destroy']);
});

//Trắc nghiệm
Route::prefix('/TracNghiem')->group(function(){
    Route::get('/ThongTin',[tracnghiemController::class,'index']);
    Route::post('/store',[tracnghiemController::class,'store']);
    Route::post('/update/{matracnghiem}',[tracnghiemController::class,'update']);
    Route::post('/delete/{matracnghiem}',[tracnghiemController::class,'destroy']);
});

//Hình ảnh
Route::prefix('HinhAnh')->group(function(){
    Route::get('/ThongTin',[hinhanhController::class,'index']);
    Route::post('/store',[hinhanhController::class,'store']);
    Route::post('/update/{mahinhanh}',[hinhanhController::class,'update']);
    Route::post('/delete/{mahinhanh}',[hinhanhController::class,'destroy']);
});

//Bài tập
Route::prefix('BaiTap')->group(function(){
    Route::get('/ThongTin',[baitapController::class,'index']);
    Route::post('/store',[baitapController::class,'store']);
    Route::post('/update/{mabaitap}',[baitapController::class,'update']);
    Route::post('/delete/{mabiatap}',[baitapController::class,'destroy']);
});