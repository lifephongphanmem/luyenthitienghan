<?php

namespace App\Http\Controllers\baigiang;

use App\Http\Controllers\Controller;
use App\Models\baigiang\baihoc;
use App\Models\baigiang\baihocchinh;
use App\Models\baigiang\baitap;
use App\Models\baigiang\giaotrinh;
use App\Models\baigiang\giaotrinh_baihoc;
use App\Models\baigiang\hinhanh;
use App\Models\baigiang\tracnghiem;
use App\Models\baigiang\tuvung;
use App\Models\dethi\cauhoi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class giaotrinhController extends Controller
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
    public function index()
    {

        if (!chkPhanQuyen('giaotrinh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }
        $model=giaotrinh::all();
        foreach($model as $ct){
            $baihoc=giaotrinh_baihoc::where('magiaotrinh',$ct->magiaotrinh)->get();
            $ct->soluongbai=count($baihoc);
        }
        return view('baigiang.giaotrinh.index')
                    ->with('model',$model)
                    ->with('baocao',getdulieubaocao())
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
        loghethong(getIP(),session('admin'),'them','giaotrinh');
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
        $a_baihoc_giaotrinh=array_column(giaotrinh_baihoc::where('magiaotrinh',$model->magiaotrinh)->get()->toarray(),'mabaihoc');
        $m_baihoc=baihoc::wherein('mabaihoc',$a_baihoc_giaotrinh)->get();
        $a_baihoc=array_column(baihoc::wherenotin('mabaihoc',$a_baihoc_giaotrinh)->get()->toarray(),'tenbaihoc','mabaihoc');
        $inputs['magiaotrinh']=$inputs['magiaotrinh']??'';
        $inputs['url']='/GiaoTrinh/chitiet';
        return view('baigiang.giaotrinh.chitiet')
                ->with('m_baihoc',$m_baihoc)
                ->with('baocao',getdulieubaocao())
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
        loghethong(getIP(),session('admin'),'capnhat','giaotrinh');
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
            loghethong(getIP(),session('admin'),'xoa','giaotrinh');
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
        if(isset($inputs['mabaihoc'])){
            $sobai=0;
            foreach($inputs['mabaihoc'] as $ct){
                $baihoc=baihoc::where('mabaihoc',$ct)->first();
                if(isset($baihoc)){
                    $data=[
                        'magiaotrinh'=>$model->magiaotrinh,
                        'mabaihoc'=>$baihoc->mabaihoc
                    ];
                    giaotrinh_baihoc::create($data);
                   $sobai++;
                }
            }
            loghethong(getIP(),session('admin'),'thembaihoc','giaotrinh');
            return redirect('/GiaoTrinh/chitiet?magiaotrinh='.$model->magiaotrinh)
            ->with('success','Thêm thành công');
        }else{
            return redirect('/GiaoTrinh/chitiet?magiaotrinh='.$model->magiaotrinh)
            ->with('error','Chưa chọn bài học nào');
        }


    }

    public function xoabaihoc(Request $request,$id)
    {
        if (!chkPhanQuyen('giaotrinh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }
        $inputs=$request->all();
        $model=giaotrinh_baihoc::where('magiaotrinh',$inputs['magiaotrinh'])->where('mabaihoc',$id)->first();
        if(isset($model)){
            $model->delete();
            loghethong(getIP(),session('admin'),'xoabaihoc','giaotrinh');
        }

        return redirect('/GiaoTrinh/chitiet?magiaotrinh='.$inputs['magiaotrinh'])
                ->with('success','Xóa thành công');
    }

    public function DanhSach(Request $request){
        if (!chkPhanQuyen('noidungbaihoc', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }
        $inputs=$request->all();
        $model=giaotrinh_baihoc::where('magiaotrinh',$inputs['magiaotrinh'])->get();
        $m_baihoc=baihoc::select('mabaihoc','tenbaihoc')->get();
        $a_baihoc=array_column($m_baihoc->toarray(),'tenbaihoc','mabaihoc');
        $giaotrinh=giaotrinh::select('tengiaotrinh')->where('magiaotrinh',$inputs['magiaotrinh'])->first();
        // dd($a_baihoc);
// dd($model);
        return view('baigiang.giaotrinh.60baieps.index')
        ->with('baocao',getdulieubaocao())
                ->with('model',$model)
                ->with('a_baihoc',$a_baihoc)
                ->with('giaotrinh',$giaotrinh)
                ->with('pageTitle','60 bài eps-topik');

    }

    public function noidungbaihoc(Request $request)
    {
        if (!chkPhanQuyen('noidungbaihoc', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'giaotrinh');
        }
        $inputs=$request->all();
        // dd($inputs);
        //Bài học chính
        $model=baihoc::where('mabaihoc',$inputs['mabaihoc'])->first();
        // dd($model);
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
                    ->with('baocao',getdulieubaocao())
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
