<?php

use App\Http\Controllers\Thivong2\thivong2EPSController;
use App\Http\Controllers\Thivong2\vandapController;
use Illuminate\Support\Facades\Route;




Route::prefix('epstopik-test')->group(function(){
    Route::get('/ThongTin',[thivong2EPSController::class,'thivong2']);
    Route::get('vandap',[thivong2EPSController::class,'VanDap']);
    Route::get('hieulenh',[thivong2EPSController::class,'HieuLenh']);
    Route::get('gioithieubanthan',[thivong2EPSController::class,'GTBanThan']);
});

Route::prefix('ThiVong2')->group(function(){
    Route::prefix('VanDap')->group(function(){
        Route::get('ThongTin',[vandapController::class,'ThongTin']);
        Route::post('LuuCauHoi',[vandapController::class,'LuuCauHoi']);
        Route::post('XoaCauHoi/{id}',[vandapController::class,'XoaCauHoi']);
    });
});