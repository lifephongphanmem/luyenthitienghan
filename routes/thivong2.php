<?php

use App\Http\Controllers\Thivong2\thivong2EPSController;
use App\Http\Controllers\Thivong2\vandapController;
use Illuminate\Support\Facades\Route;




Route::prefix('epstopik-test')->group(function(){
    Route::get('/ThongTin',[thivong2EPSController::class,'thivong2']);
    Route::get('phongvan',[thivong2EPSController::class,'VanDap']);
    Route::get('hieulenh',[thivong2EPSController::class,'HieuLenh']);
    Route::get('gioithieubanthan',[thivong2EPSController::class,'GTBanThan']);
    Route::get('getCauHoi',[thivong2EPSController::class,'getCauHoi']);
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