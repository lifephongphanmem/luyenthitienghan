<?php

namespace App\Http\Controllers\quanly;

use App\Http\Controllers\Controller;
use App\Models\quanly\hocvien;
use App\Models\quanly\lophoc;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class hocvienController extends Controller
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
        if (!chkPhanQuyen('hocvien', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'hocvien');
        }
        $model=hocvien::all();

        return view('quanly.hocvien.index')
                    ->with('model',$model)
                    ->with('pageTitle','Quản lý học viên');
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
        if (!chkPhanQuyen('hocvien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'hocvien');
        }
        $inputs=$request->all();
        //check cccd
        $cccd=hocvien::where('cccd',$inputs['cccd'])->first();
        if(isset($cccd)){
            return view('errors.tontaidulieu')
                        ->with('furl','/HocVien/ThongTin')
                        ->with('message','CCCD đã được sử dụng');
        };

        $inputs['mahocvien']=getdate()[0];
        hocvien::create($inputs);
        //Tạo tài khoản
        $data=[
            'tentaikhoan'=>$inputs['tenhocvien'],
            'cccd'=>$inputs['cccd'],
            'password'=>Hash::make('123456abc'),
            'hocvien'=>1,
            'sdt'=>$inputs['sdt'],
            'mataikhoan'=>date('YmdHis'),
            'manhomchucnang'=>1680748012
        ];
        User::create($data);

        return redirect('/HocVien/ThongTin')
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
    public function edit(string $id)
    {
        if (!chkPhanQuyen('hocvien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'hocvien');
        }

        $model=hocvien::findOrFail($id);
        return response()->json($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!chkPhanQuyen('hocvien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'hocvien');
        }

        $inputs=$request->all();
        $model=hocvien::findOrFail($id);
        if(isset($model)){
            $model->update($inputs);
        }

        return redirect('/HocVien/ThongTin')
                    ->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('hocvien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'hocvien');
        }
        $model=hocvien::findOrFail($id);
        if(isset($model)){
            $taikhoan=User::where('cccd',$model->cccd)->delete();
            $lophoc=lophoc::where('malop',$model->malop)->delete();
            $model->delete();
            
        }

        return redirect('/HocVien/ThongTin')
                ->with('success','Xóa thành công');
    }
}
