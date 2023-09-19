<?php

namespace App\Http\Controllers\quantrihethong;

use App\Http\Controllers\Controller;
use App\Models\quantrihethong\cauhinhhethong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class cauhinhhethongController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin')) {
                return redirect('/DangNhap');
            };
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!chkPhanQuyen('cauhinhhethong', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'cauhinhhethong');
        }

        $model = cauhinhhethong::all();
        foreach ($model as $ct) {
            if ($ct->trangthai == 1) {
                $ct->status = 'Lưu trữ';
            } else {
                $ct->status = 'Không lưu trữ';
            }
        }
        return view('quantrihethong.cauhinhhethong.index')
            ->with('model', $model)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Quản trị hệ thống');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('cauhinhhethong', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'cauhinhhethong');
        }
        $inputs = $request->all();
        $inputs['macauhinh'] = getdate()[0];
        $model = cauhinhhethong::where('machucnang', 'like', '%' . $inputs['machucnang'] . '%')->first();
        if (isset($model)) {
            return view('errors.tontaidulieu')
                ->with('message', 'Chức năng đã tồn tại')
                ->with('furl', '/CauHinhHeThong/ThongTin');
        }
        cauhinhhethong::create($inputs);
        return redirect('/CauHinhHeThong/ThongTin')
            ->with('success', 'Thêm thư mục thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!chkPhanQuyen('cauhinhhethong', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'cauhinhhethong');
        }
        $inputs = $request->all();
        $model = cauhinhhethong::where('macauhinh', $id)->first();
        if (isset($model)) {
            $model->update($inputs);
        }

        return redirect('/CauHinhHeThong/ThongTin')
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('cauhinhhethong', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'cauhinhhethong');
        }
        $model = cauhinhhethong::where('macauhinh', $id)->first();
        if (isset($model)) {
            $model->delete();
        }

        return redirect('/CauHinhHeThong/ThongTin')
            ->with('success', 'Xóa thành công');
    }
}
