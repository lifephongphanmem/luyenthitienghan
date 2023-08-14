<?php

namespace App\Http\Controllers\danhmuc;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\loaicauhoi;
use App\Models\danhmuc\loaicauhoict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class loaicauhoictController extends Controller
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
    public function index(Request $request,$madm)
    {
        if (!chkPhanQuyen('loaicauhoict', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'loaicauhoict');
        }
        $a_danhmuc=array_column(loaicauhoi::all()->toarray(),'tendm','madm');
        $model=loaicauhoict::where('madm',$madm)->get();

        return view('danhmuc.loaicauhoict.index')
                    ->with('madm',$madm)
                    ->with('model',$model)
                    ->with('baocao',getdulieubaocao())
                    ->with('a_danhmuc',$a_danhmuc)
                    ->with('pageTitle','Danh mục loại câu hỏi chi tiết');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('loaicauhoict', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'loaicauhoict');
        }
        $inputs=$request->all();
        $inputs['madmct']=getdate()[0];
        loaicauhoict::create($inputs);
        // $a_danhmuc=array_column(loaicauhoi::all(),'tendm','madm');
        return redirect('/LoaiCauHoi/chitiet/'.$inputs['madm'])
        // ->with('a_danhmuc',$a_danhmuc)
                        ->with('success','Tạo mới thành công');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!chkPhanQuyen('loaicauhoict', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'loaicauhoict');
        }

        $inputs=$request->all();
        $model=loaicauhoict::where('madmct',$id)->first();
        if(isset($model)){
            $model->update($inputs);
            return redirect('/LoaiCauHoi/chitiet/'.$model->madm)
                        ->with('success','Cập nhật thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('loaicauhoict', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'loaicauhoict');
        }
        $model=loaicauhoict::where('madmct',$id)->first();
        if(isset($model)){
            $model->delete();
            return redirect('/LoaiCauHoi/chitiet/'.$model->madm)
                        ->with('success','Xóa thành công');
        }
    }
}
