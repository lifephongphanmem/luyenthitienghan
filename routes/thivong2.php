<?php

use App\Http\Controllers\Thivong2\thivong2EPSController;
use Illuminate\Support\Facades\Route;




Route::prefix('epstopik-test')->group(function(){
    Route::get('/ThongTin',[thivong2EPSController::class,'thivong2']);
    Route::get('vandap',[thivong2EPSController::class,'VanDap']);
    Route::get('hieulenh',[thivong2EPSController::class,'HieuLenh']);
    Route::get('gioithieubanthan',[thivong2EPSController::class,'GTBanThan']);
});