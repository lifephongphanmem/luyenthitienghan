<?php

namespace App\Http\Controllers\danhmuc;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\loaicauhoi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class loaicauhoiController extends Controller
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
        if (!chkPhanQuyen('loaicauhoi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'loaicauhoi');
        }

        $model=loaicauhoi::all();

        return view('danhmuc.loaicauhoi.index')
                    ->with('model',$model)
                    ->with('baocao',getdulieubaocao())
                    ->with('pageTitle','Danh mục loại câu hỏi');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('loaicauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'loaicauhoi');
        }
        $inputs=$request->all();
        $inputs['madm']=getdate()[0];
        loaicauhoi::create($inputs);

        return redirect('/LoaiCauHoi/ThongTin')
                ->with('success','Tạo mới thành công');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!chkPhanQuyen('loaicauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'loaicauhoi');
        }
        $inputs=$request->all();
        $model=loaicauhoi::where('madm',$id)->first();
        if(isset($model)){
            $model->update($inputs);
            return redirect('/LoaiCauHoi/ThongTin')
                        ->with('success','Cập nhật thành công');
        }else{
            return redirect('/LoaiCauHoi/ThongTin')
                    ->with('error','Lỗi: Không xác định được danh mục');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('loaicauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'loaicauhoi');
        }
        $model=loaicauhoi::where('madm',$id)->first();

        if(isset($model)){
            $model->delete();
            return redirect('/LoaiCauHoi/ThongTin')
            ->with('success','Xóa thành công');
        }else{
            return redirect('/LoaiCauHoi/ThongTin')
                    ->with('error','Lỗi: Không xác định được danh mục');
        }
    }
}
