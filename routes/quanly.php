<?php 

use App\Http\Controllers\quanly\giaovienController;
use App\Http\Controllers\quanly\hocvienController;
use App\Http\Controllers\quanly\lophocController;
use App\Http\Controllers\quanly\thongtinController;
use Illuminate\Support\Facades\Route;


//Lớp học
Route::prefix('LopHoc')->group(function(){
    Route::get('/ThongTin',[lophocController::class,'index']);
    Route::post('/store',[lophocController::class,'store']);
    Route::post('/update/{id}',[lophocController::class,'update']);
    Route::post('/delete/{id}',[lophocController::class,'destroy']);
    Route::get('/chitiet',[lophocController::class,'show']);
    Route::post('/themhocvien',[lophocController::class,'themhocvien']);
    Route::post('/chuyenlop/{id}',[lophocController::class,'chuyenlop']);
    Route::post('/KetQuaThiThu',[lophocController::class,'ketquathi']);
});

//giáo viên

Route::prefix('GiaoVien')->group(function(){
    Route::get('/ThongTin',[giaovienController::class,'index']);
    Route::get('/CapNhat/{id}',[giaovienController::class,'edit']);
    Route::post('/store',[giaovienController::class,'store']);
    Route::post('/update/{id}',[giaovienController::class,'update']);
    Route::post('/delete/{id}',[giaovienController::class,'destroy']);
});

//Học viên
Route::prefix('HocVien')->group(function(){
    Route::get('/ThongTin',[hocvienController::class,'index']);
    Route::get('/ThongTin/ChiTiet/{mahocvien}', [hocvienController::class, 'show']);
    Route::post('/store',[hocvienController::class,'store']);
    Route::get('/CapNhat/{id}',[hocvienController::class,'edit']);
    Route::post('/update/{id}',[hocvienController::class,'update']);
    Route::post('/delete/{id}',[hocvienController::class,'destroy']);

});

Route::get('/QuanLyThongTin', [thongtinController::class,'index']);