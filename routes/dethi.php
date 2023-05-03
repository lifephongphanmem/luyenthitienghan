<?php

use App\Http\Controllers\dethi\cauhoiController;
use App\Http\Controllers\dethi\dethiController;
use App\Http\Controllers\thithu\thithuController;
use Illuminate\Support\Facades\Route;




//Đề thi
Route::prefix('DeThi')->group(function(){
    Route::get('/ThongTin',[dethiController::class,'index']);
    Route::post('/store',[dethiController::class,'store']);
    Route::post('/update/{made}',[dethiController::class,'update']);
    Route::post('/delete/{made}',[dethiController::class,'destroy']);
    Route::get('/ChiTiet/{made}',[dethiController::class,'show']);
    Route::post('/ThemCauHoi',[dethiController::class,'themcauhoi']);
});

//Câu hỏi
Route::prefix('CauHoi')->group(function(){
    Route::get('/ThongTin',[cauhoiController::class,'index']);
    Route::post('/store',[cauhoiController::class,'store']);
    Route::post('/update/{macauhoi}',[cauhoiController::class,'update']);
    Route::post('/delete/{macauhoi}',[cauhoiController::class,'destroy']);
});

Route::prefix('ThiThu')->group(function(){
    Route::get('/EPS-TOPIK',[thithuController::class,'thithu']);
    Route::get('/LamBai',[thithuController::class,'lambai']);
});