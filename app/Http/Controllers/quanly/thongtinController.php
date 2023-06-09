<?php

namespace App\Http\Controllers\quanly;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\quanly\hocvien;
use App\Models\quanly\giaovien;
use App\Models\ketqua\ketquathithu;

class thongtinController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin')) {
                return redirect('/');
            };
            return $next($request);
        });
    }

    public function index()
    {
        $user = Session::get('admin');

        if ($user->hocvien == 1) {
            $nguoidung = hocvien::where('mahocvien', $user->manguoidung)->first();

            $ketquathi = ketquathithu::join('dethi', 'ketquathithu.madethi', '=', 'dethi.made')
                ->where('mahocvien', '1681118558')
                ->orderBy('ketquathithu.created_at', 'DESC')
                ->get();
        } else if ($user->giaovien == 1) {
            $nguoidung = giaovien::where('magiaovien', $user->manguoidung)->first();
            $ketquathi = null;
        } else {
            $nguoidung = null;
            $ketquathi = null;
        }

        return view('quanly.thongtin.index', compact('nguoidung', 'ketquathi', 'user'))
            ->with('pageTitle', 'Quản lý thông tin');
    }
}