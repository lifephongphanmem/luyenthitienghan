<?php

namespace App\Http\Controllers\quanly;

use App\Http\Controllers\Controller;
use App\Models\quanly\giaovien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class giaovienController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!chkPhanQuyen('giaovien', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'giaovien');
        }
        $model=giaovien::all();
                $a_trangthai=array('1'=>'Đang công tác','2'=>'Nghỉ Phép','3'=>'Đã nghỉ việc');
                $a_texttrangthai=array('1'=>'text-success','2'=>'text-warning','3'=>'text-danger');
        return view('quanly.giaovien.index')
                ->with('model',$model)
                ->with('a_texttrangthai',$a_texttrangthai)
                ->with('a_trangthai',$a_trangthai)
                ->with('pageTitle','Quản lý giáo viên');
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
        if (!chkPhanQuyen('giaovien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'giaovien');
        }
        $inputs=$request->all();
        $inputs['magiaovien']=getdate()[0];

        giaovien::create($inputs);

        return redirect('/GiaoVien/ThongTin')
                ->with('success','Thêm mới thành công');
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
    public function edit(Request $request, string $id)
    {
        if (!chkPhanQuyen('giaovien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'giaovien');
        }
        $model=giaovien::findOrFail($id);
        return response()->json($model);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!chkPhanQuyen('giaovien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'giaovien');
        }
        $inputs=$request->all();
        $model=giaovien::findOrFail($id);
        if(isset($model)){
            $model->update($inputs);
        }

        return redirect('/GiaoVien/ThongTin')
                ->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('giaovien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'giaovien');
        }
        $model=giaovien::findOrFail($id);
        if(isset($model)){
            $model->delete();
        }

        return redirect('/GiaoVien/ThongTin')
                ->with('success','Xóa thành công');
    }
}
