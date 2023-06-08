<?php

use App\Http\Controllers\quanly\lophocController;
use Illuminate\Support\Facades\Route;

Route::prefix('Export')->group(function(){
    Route::post('/KetQuaThi',[lophocController::class,'ketquathi']);
});