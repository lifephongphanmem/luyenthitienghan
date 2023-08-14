<?php

use App\Http\Controllers\baocao\baocaoController;
use Illuminate\Support\Facades\Route;

Route::prefix('ThongKe')->group(function(){
    Route::post('/DanhSachHocVien',[baocaoController::class,'danhsachhocvien']);
});