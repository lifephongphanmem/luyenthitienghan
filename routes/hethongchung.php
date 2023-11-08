<?php

use App\Http\Controllers\Hethong\ChucnangController;
use App\Http\Controllers\Hethong\dsnhomtaikhoanController;
use App\Http\Controllers\Hethong\dstaikhoanController;
use App\Http\Controllers\Hethong\generalConfigController;
use App\Http\Controllers\Hethong\HethongchungController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HeThongChungController::class,'index']);
// Route::get('/',[HethongchungController::class,'login']);

Route::get('/DangNhap',[HethongchungController::class,'login']);
Route::post('/DangNhap',[HethongchungController::class,'DangNhap']);
Route::post('/DangKy',[HethongchungController::class,'DangKy']);
Route::get('/DangXuat',[HethongchungController::class,'logout']);

//danh mục chức năng
Route::prefix('Chuc_nang')->group(function () {
    Route::get('/ThongTin', [ChucnangController::class, 'index']);
    Route::get('/create', [ChucnangController::class, 'create']);
    Route::post('/store', [ChucnangController::class, 'store']);
    Route::get('/edit/{id}', [ChucnangController::class, 'edit']);
    Route::post('/update/{id}', [ChucnangController::class, 'update']);
    Route::get('/destroy/{id}', [ChucnangController::class, 'destroy']);
});

//Tài khoản
Route::prefix('TaiKhoan')->group(function () {
    Route::get('/ThongTin', [dstaikhoanController::class, 'ThongTin']);
    // Route::get('/ThemMoi', [dstaikhoanController::class, 'create']);
    Route::post('/store', [dstaikhoanController::class, 'store']);
    Route::post('/delete/{id}', [dstaikhoanController::class, 'destroy']);
    // Route::get('/edit_tk/{id}', [dstaikhoanController::class, 'edit_tk']);
    Route::post('/update/{id}', [dstaikhoanController::class, 'update']);

    Route::get('/PhanQuyen',[dstaikhoanController::class,'phanquyen']);
    Route::post('/PhanQuyen',[dstaikhoanController::class,'luuphanquyen']);

    Route::post('/NhomChucNang',[dstaikhoanController::class,'NhomChucNang']);
    // Route::get('/DoiMatKhau',[dstaikhoanController::class,'DoiMatKhau']);
    // Route::post('/DoiMatKhau',[dstaikhoanController::class,'capnhatdoimatkhau']);

    Route::get('/QuanLyTaiKhoan',[dstaikhoanController::class,'quanlytaikhoan']);
    Route::get('/LuuThongTin',[dstaikhoanController::class,'luuthongtin']);

    Route::post('/DoiMatKhau',[dstaikhoanController::class,'doimatkhau']);
    Route::post('/CapNhatThongTin',[dstaikhoanController::class,'capnhatthongtincanhan']);

    //Phân quyền chức năng luyện thi riêng
    Route::post('/phanquyenluyenthi',[dstaikhoanController::class,'phanquyenluyenthi']);
    Route::post('/phanquyenkhoahoc',[dstaikhoanController::class,'phanquyenkhoahoc']);
    // Route::post('/phanquyenbaigiang',[dstaikhoanController::class,'phanquyenbaigiang']);
    // Route::post('/phanquyen960cau',[dstaikhoanController::class,'phanquyen960cau']);

    //Khóa nhiều tài khoản (chủ yếu khóa tài khoản học viên theo lớp)
    Route::post('/khoataikhoan',[dstaikhoanController::class,'khoataikhoan']);
});

//Nhóm chức năng
Route::prefix('nhomchucnang')->group(function(){
    Route::get('/ThongTin',[dsnhomtaikhoanController::class,'index']);
    Route::post('/store',[dsnhomtaikhoanController::class,'store']);
    Route::get('/delete/{id}',[dsnhomtaikhoanController::class,'destroy']);

    Route::get('/PhanQuyen',[dsnhomtaikhoanController::class,'PhanQuyen']);
    Route::post('/PhanQuyen',[dsnhomtaikhoanController::class,'LuuPhanQuyen']);

    Route::get('/danhsach_donvi',[dsnhomtaikhoanController::class,'DanhSachDonVi']);
    Route::post('/ThietLapLai', [dsnhomtaikhoanController::class, 'ThietLapLai']);
});

//thiết lập hệ thống
Route::prefix('generalconfig')->group(function(){
    Route::get('/ThongTin',[generalConfigController::class,'index']);
    Route::post('/update',[generalConfigController::class,'update']);
});