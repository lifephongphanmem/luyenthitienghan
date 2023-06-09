<?php

namespace App\Http\Controllers\quanly;

use App\Http\Controllers\Controller;
use App\Models\dethi\dethi;
use App\Models\ketqua\ketquathithu;
use App\Models\quanly\giaovien;
use App\Models\quanly\hocvien;
use App\Models\quanly\lophoc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class lophocController extends Controller
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
    public function index(Request $request)
    {
        if (!chkPhanQuyen('lophoc', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }
        $inputs=$request->all();
        $khoahoc=lophoc::select('khoahoc')->orderBy('id','desc')->first();
        $inputs['khoahoc'] = $inputs['khoahoc'] ?? (isset($khoahoc) ? $khoahoc->khoahoc : '');
        $model=lophoc::where(function($q) use($inputs){
            if(isset($inputs['khoahoc'])){
                $q->where('khoahoc',$inputs['khoahoc']);
            }
        })->get();
        $a_giaovien=array_column(giaovien::where('trangthai','!=',3)->get()->toarray(),'tengiaovien','magiaovien');
        $a_khoahoc=array_column(lophoc::select('khoahoc')->get()->unique('khoahoc')->toarray(),'khoahoc','khoahoc');

        $inputs['url']='/LopHoc/ThongTin';
        return view('quanly.lophoc.index')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('a_khoahoc',$a_khoahoc)
                ->with('a_giaovien',$a_giaovien)
                ->with('pageTitle','Quản lý lớp học');

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
        if (!chkPhanQuyen('lophoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }

        $inputs=$request->all();
        $inputs['malop']=getdate()[0];
        $inputs['soluonghocvien']=0;

        lophoc::create($inputs);
        return redirect('/LopHoc/ThongTin?khoahoc='.$inputs['khoahoc'])
                ->with('success','Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if (!chkPhanQuyen('lophoc', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }
            $inputs=$request->all();
            $model=lophoc::where('malop',$inputs['lophoc'])->first();

        $inputs['khoahoc']=isset($inputs['khoahoc'])?$inputs['khoahoc']:$model->khoahoc;
 
        $hocvien=lophoc::join('hocvien','hocvien.malop','lophoc.malop')
                            ->where('hocvien.malop',$inputs['lophoc'])
                            ->where('khoahoc',$inputs['khoahoc'])
                            ->get();
        // $giaovien=giaovien::where('trangthai','!=',3)->get();
        $a_giaovien=array_column(giaovien::where('trangthai','!=',3)->get()->toarray(),'tengiaovien','magiaovien');
        $a_khoahoc=array_column(lophoc::select('khoahoc')->get()->unique('khoahoc')->toarray(),'khoahoc','khoahoc');
        $a_lophoc=array_column(lophoc::select('malop','tenlop')->get()->toarray(),'tenlop','malop');

        $inputs['url']='/LopHoc/chitiet';
        $m_hocvien=hocvien::wherenull('malop')->get();
        $ketquathi=ketquathithu::where('malop',$inputs['lophoc'])->get();
        $ketquathi->unique('created_at');
        
        return view('quanly.lophoc.chitiet')
                ->with('model',$model)
                ->with('inputs',$inputs)
                ->with('hocvien',$hocvien)
                ->with('m_hocvien',$m_hocvien)
                ->with('a_khoahoc',$a_khoahoc)
                ->with('a_lophoc',$a_lophoc)
                ->with('a_giaovien',$a_giaovien)
                ->with('ketquathi',$ketquathi)
                ->with('pageTitle','Chi tiết lớp học');
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
        if (!chkPhanQuyen('lophoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }

        $inputs=$request->all();
        $model=lophoc::findOrFail($id);
        if(isset($model)){
            $model->update($inputs);
        }

        return redirect('/LopHoc/ThongTin?khoahoc='.$inputs['khoahoc'])
                ->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('lophoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }

        $model=lophoc::findOrFail($id);
        if(isset($model)){
            $model->delete();
        }

        return redirect('/LopHoc/ThongTin')
                ->with('success','Xóa thành công');
    }

    public function themhocvien(Request $request)
    {
        if (!chkPhanQuyen('lophoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }
        $inputs=$request->all();
        $lophoc=lophoc::where('malop',$inputs['malop'])->first();
        foreach($inputs['mahocvien'] as $ct){
            $hocvien=hocvien::where('mahocvien',$ct)->first();
            $hocvien->update(['malop'=>$inputs['malop']]);
        }

        return redirect('/LopHoc/chitiet?lophoc='.$inputs['malop'].'&khoahoc='.$lophoc->khoahoc);
    }
    public function chuyenlop(Request $request,$id){
        if (!chkPhanQuyen('lophoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }
        $inputs=$request->all();
        $hocvien=hocvien::findOrFail($id);
        if(isset($hocvien)){
            $hocvien->update(['malop'=>$inputs['malop']]);
        }
        $lophoc=lophoc::where('malop',$inputs['malop'])->first();

        return redirect('/LopHoc/chitiet?lophoc='.$lophoc->malop.'&khoahoc='.$lophoc->khoahoc)
                    ->with('success','Chuyển lớp thành công');
    }

    public function ketquathi(Request $request){
        $inputs=$request->all();
        $a_giaovien=array_column(giaovien::where('trangthai','!=',3)->get()->toarray(),'tengiaovien','magiaovien');
        $a_khoahoc=array_column(lophoc::select('khoahoc')->get()->unique('khoahoc')->toarray(),'khoahoc','khoahoc');
        $a_lophoc=array_column(lophoc::select('malop','tenlop')->get()->toarray(),'tenlop','malop');
        $ketqua=ketquathithu::where('malop',$inputs['malop'])->where('ngaythi',$inputs['ngaythi'])->where('giothi',$inputs['giothi'])->get();
        $thongtin_thithu=$ketqua->unique('made')->first();
        $a_dethi=array_column(dethi::all()->toarray(),'tende','made');
        $mahocvien=array_column($ketqua->toarray(),'mahocvien');
        $hocvien=hocvien::wherein('mahocvien',$mahocvien)->get();
        foreach($hocvien as $ct){
            $ketqua_hv=$ketqua->where('mahocvien',$ct->mahocvien)->first();
            $ct->diemthi=$ketqua_hv->diemthi;
            $ct->ngaythi=$ketqua_hv->ngaythi;
            $ct->giothi=$ketqua_hv->giothi;
            $ct->thoigianlambai=$ketqua_hv->thoigianlambai;
        }
        $inputs['url']='/LopHoc/KetQuaThiThu';
        return view('export.ketquathi.index')
                ->with('a_khoahoc',$a_khoahoc)
                ->with('a_lophoc',$a_lophoc)
                ->with('a_giaovien',$a_giaovien)
                ->with('a_dethi',$a_dethi)
                ->with('thongtin_thithu',$thongtin_thithu)
                ->with('inputs',$inputs)
                ->with('hocvien',$hocvien)
                ->with('ketqua',$ketqua)
                ->with('pageTitle','Kết quả thi thử');
    }
}
