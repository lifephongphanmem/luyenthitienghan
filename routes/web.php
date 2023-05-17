<?php

use App\Http\Controllers\Hethong\HethongchungController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/dashboard',[HethongchungController::class,'index']);
include('hethongchung.php');
include('quanly.php');
include('baigiang.php');
include('dethi.php');
include('danhmuc.php');