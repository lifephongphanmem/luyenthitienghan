<?php

use App\Http\Controllers\quantrihethong\cauhinhhethongController;
use App\Http\Controllers\quantrihethong\loghethongController;
use Illuminate\Support\Facades\Route;


//Cấu hình hệ thống
Route::prefix('CauHinhHeThong')->group(function(){
    Route::get('/ThongTin',[cauhinhhethongController::class,'index']);
    Route::post('/store',[cauhinhhethongController::class,'store']);
    Route::post('/update/{mathumuc}',[cauhinhhethongController::class,'update']);
    Route::post('/delete/{mathumuc}',[cauhinhhethongController::class,'destroy']);
});

//Log hệ thống
Route::prefix('LogHeThong')->group(function(){
    Route::get('/ThongTin',[loghethongController::class,'index']);
    Route::post('/InNhatKy',[loghethongController::class,'innhatky']);
});