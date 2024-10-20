<?php

namespace App\Http\Controllers\Thivong2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class thivong2EPSController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin')) {
                return redirect('/DangNhap');
            };
            if (!chksession()) {
                return redirect('/DangNhap');
            };
            chkaction();
            return $next($request);
        });
    }
    public function thivong2()
    {
        return redirect('/epstopik-test/vandap');
    }
    public function VanDap()
    {
        return  view('thivong2.vandap')
        ->with('baocao',getdulieubaocao())
        ->with('pageTitle', 'Ôn thi vòng 2 EPS');
    }
    public function HieuLenh(){
        return  view('thivong2.hieulenh')
        ->with('baocao',getdulieubaocao())
        ->with('pageTitle', 'Ôn thi vòng 2 EPS');
    }
    public function GTBanThan(){
        return  view('thivong2.gtbanthan')
        ->with('baocao',getdulieubaocao())
        ->with('pageTitle', 'Ôn thi vòng 2 EPS');
    }
}
