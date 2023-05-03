<?php

namespace App\Http\Controllers\baigiang;

use App\Http\Controllers\Controller;
use App\Models\baigiang\baihoc;
use App\Models\baigiang\baihocchinh;
use App\Models\baigiang\baitap;
use App\Models\baigiang\giaotrinh;
use App\Models\baigiang\hinhanh;
use App\Models\baigiang\tracnghiem;
use App\Models\baigiang\tuvung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class giaotrinhController extends Controller
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
        if (!chkPhanQuyen('giaotrinh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }
        $model=giaotrinh::all();

        return view('baigiang.giaotrinh.index')
                    ->with('model',$model)
                    ->with('pageTitle','Giáo trình');
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
        if (!chkPhanQuyen('giaotrinh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }
        $inputs=$request->all();
        $inputs['magiaotrinh']=getdate()[0];
        giaotrinh::create($inputs);

        return redirect('/GiaoTrinh/ThongTin')
                ->with('success','Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if (!chkPhanQuyen('giaotrinh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }
        $inputs=$request->all();

        $model=giaotrinh::where('magiaotrinh',$inputs['magiaotrinh'])->first();

        $a_giaotrinh=array_column(giaotrinh::all()->toarray(),'tengiaotrinh','magiaotrinh');
        $m_baihoc=baihoc::where('magiaotrinh',$model->magiaotrinh)->get();
        $a_baihoc=array_column(baihoc::where('magiaotrinh','!=',$inputs['magiaotrinh'])->orwherenull('magiaotrinh')->get()->toarray(),'tenbaihoc','mabaihoc');
        $inputs['magiaotrinh']=$inputs['magiaotrinh']??'';
        $inputs['url']='/GiaoTrinh/chitiet';
        return view('baigiang.giaotrinh.chitiet')
                ->with('m_baihoc',$m_baihoc)
                ->with('a_baihoc',$a_baihoc)
                ->with('a_giaotrinh',$a_giaotrinh)
                ->with('inputs',$inputs)
                ->with('model',$model)
                ->with('pageTitle','Giáo trình');
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
        if (!chkPhanQuyen('giaotrinh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }

        $inputs=$request->all();
        $model=giaotrinh::findOrFail($id);
        if(isset($model)){
            $model->update($inputs);
        }

        return redirect('/GiaoTrinh/ThongTin')
                ->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('giaotrinh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }

        $model=giaotrinh::findOrFail($id);
        if(isset($model)){
            $model->delete();
        }

        return redirect('/GiaoTrinh/ThongTin')
                ->with('success','Xóa thành công');
    }

    public function thembaihoc(Request $request)
    {
        if (!chkPhanQuyen('giaotrinh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }
        $inputs=$request->all();
        $model=giaotrinh::where('magiaotrinh',$inputs['magiaotrinh'])->first();
        foreach($inputs['mabaihoc'] as $ct){
            $baihoc=baihoc::where('mabaihoc',$ct)->first();
            if(isset($baihoc)){
                $baihoc->update(['magiaotrinh'=>$inputs['magiaotrinh']]);
               
            }
        }
        $model->update(['soluongbai'=>$model->soluongbai + count($inputs['mabaihoc'])]);
        return redirect('/GiaoTrinh/chitiet?magiaotrinh='.$model->magiaotrinh)
                ->with('success','Thêm thành công');
    }

    public function xoabaihoc(Request $request,$id)
    {
        if (!chkPhanQuyen('giaotrinh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }

        $baihoc=baihoc::findOrFail($id);
        $giaotrinh=giaotrinh::where('magiaotrinh',$baihoc->magiaotrinh)->first();
        if(isset($baihoc)){
            $baihoc->update(['magiaotrinh'=>'']);
        }

        return redirect('/GiaoTrinh/chitiet?magiaotrinh='.$giaotrinh->magiaotrinh)
                ->with('success','Xóa thành công');
    }

    public function DanhSach(){
        if (!chkPhanQuyen('giaotrinh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }

        $model=baihoc::where('magiaotrinh',1681271756)->get();

        return view('baigiang.giaotrinh.60baieps.index')
                ->with('model',$model)
                ->with('pageTitle','60 bài eps-topik');

    }

    public function noidungbaihoc(Request $request)
    {
        if (!chkPhanQuyen('giaotrinh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }
        $inputs=$request->all();

        //Bài học chính
        $model=baihoc::where('mabaihoc',$inputs['mabaihoc'])->first();
        $m_baihocchinh=baihocchinh::where('mabaihoc',$inputs['mabaihoc'])->get();
        $trang=$m_baihocchinh->max('stt');

        //Từ vựng
        $m_tuvung=tuvung::where('mabaihoc',$inputs['mabaihoc'])->get();
        $a_cumtuvung=array_column($m_tuvung->unique('cumtuvung')->toarray(),'cumtuvung');

        //Trắc nghiệm
        $m_tracnghiem=tracnghiem::where('mabaihoc',$inputs['mabaihoc'])->get();

        //Hình ảnh
        $m_hinhanh=hinhanh::where('mabaihoc',$inputs['mabaihoc'])->get();

        //Bài tập
        $m_baitap=baitap::where('mabaihoc',$inputs['mabaihoc'])->get();
        return view('baigiang.giaotrinh.60baieps.chitiet')
                    ->with('m_baihocchinh',$m_baihocchinh)
                    ->with('m_tuvung',$m_tuvung)
                    ->with('a_cumtuvung',$a_cumtuvung)
                    ->with('m_tracnghiem',$m_tracnghiem)
                    ->with('m_hinhanh',$m_hinhanh)
                    ->with('m_baitap',$m_baitap)
                    ->with('model',$model)
                    ->with('trang',$trang)
                    ->with('pageTitle',$model->tenbaihoc);
    }
}
