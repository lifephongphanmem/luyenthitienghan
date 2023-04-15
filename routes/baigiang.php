<?php

use App\Http\Controllers\baigiang\baihocchinhController;
use App\Http\Controllers\baigiang\giaotrinhController;
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
    Route::post('/delete/{id}',[baihocchinhController::class,'destroy']);
    Route::post('/update/{id}',[baihocchinhController::class,'update']);
    Route::post('/delete/{id}',[baihocchinhController::class,'destroy']);
});