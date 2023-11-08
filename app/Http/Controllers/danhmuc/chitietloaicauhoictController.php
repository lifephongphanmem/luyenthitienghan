<?php

namespace App\Http\Controllers\danhmuc;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\chitietloaicauhoict;
use App\Models\danhmuc\loaicauhoict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class chitietloaicauhoictController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,$madmct)
    {
        if (!chkPhanQuyen('chitietloaicauhoict', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'chitietloaicauhoict');
        }

        $model=chitietloaicauhoict::where('madmct',$madmct)->get();
        $a_dmct=array_column(loaicauhoict::all()->toarray(),'tendmct','madmct');

        return view('danhmuc.chitietloaicauhoict.index')
                    ->with('model',$model)
                    ->with('baocao',getdulieubaocao())
                    ->with('a_dmct',$a_dmct)
                    ->with('madmct',$madmct)
                    ->with('pageTitle','Chi tiết loại câu hỏi chi tiết');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('chitietloaicauhoict', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'chitietloaicauhoict');
        }
        $inputs=$request->all();
        $inputs['madmct2']=getdate()[0];
        chitietloaicauhoict::create($inputs);

        return redirect('/LoaiCauHoiCt/chitiet/'.$inputs['madmct'])
                    ->with('success','Tạo mới thành công');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!chkPhanQuyen('chitietloaicauhoict', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'chitietloaicauhoict');
        }
        $inputs=$request->all();
        $model=chitietloaicauhoict::where('madmct2',$id)->first();
        if(isset($model)){
            $model->update($inputs);
            return redirect('/LoaiCauHoiCt/chitiet/'.$model->madmct)
                    ->with('success','Cập nhật thành công');
        }else{
            return redirect('/LoaiCauHoiCt/chitiet/'.$id)
            ->with('error','Lỗi: không xác định được loại câu hỏi ct');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('chitietloaicauhoict', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'chitietloaicauhoict');
        }
        $model=chitietloaicauhoict::where('madmct2',$id)->first();
        if(isset($model)){
            $model->delete();
            return redirect('/LoaiCauHoiCt/chitiet/'.$model->madmct)
                    ->with('success','Xóa thành công');
        }else{
            return redirect('/LoaiCauHoiCt/chitiet/'.$id)
            ->with('error','Lỗi: không xác định được loại câu hỏi ct');
        }
    }
}
