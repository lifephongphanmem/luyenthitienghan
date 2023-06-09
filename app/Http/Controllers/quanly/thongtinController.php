<?php

namespace App\Http\Controllers\quanly;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\quanly\hocvien;
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
        $hocvien = hocvien::where('mahocvien', '1681118558')->first();

        $ketquathi = ketquathithu::join('dethi', 'ketquathithu.madethi', '=', 'dethi.made')
            ->where('mahocvien', '1681118558')
            ->orderBy('ketquathithu.created_at', 'DESC')
            ->get();

        return view('quanly.thongtin.index', compact('hocvien', 'ketquathi'))
            ->with('pageTitle', 'Quản lý thông tin');
    }
}