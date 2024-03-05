<?php

namespace App\Http\Controllers\quanly;

use App\Http\Controllers\Controller;
use App\Models\dethi\dethi;
use App\Models\Hethong\dstaikhoan_phanquyen;
use App\Models\ketqua\ketquathithu;
use App\Models\quanly\giaovien;
use App\Models\quanly\hocvien;
use App\Models\quanly\lophoc;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class lophocController extends Controller
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
    public function index(Request $request)
    {
        if (!chkPhanQuyen('lophoc', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }
        $inputs = $request->all();
        if (in_array(session('admin')->sadmin, ['SSA', 'ADMIN'])) {
            $khoahoc = lophoc::select('khoahoc')->orderBy('id', 'desc')->first();

            $inputs['khoahoc'] = $inputs['khoahoc'] ?? (isset($khoahoc) ? $khoahoc->khoahoc : '');
            $model = lophoc::where(function ($q) use ($inputs) {
                if (isset($inputs['khoahoc'])) {
                    $q->where('khoahoc', $inputs['khoahoc']);
                }
            })->get();
        } else if (session('admin')->giaovien == 1) {
            $khoahoc = lophoc::select('khoahoc')->where('giaovienchunhiem', session('admin')->mataikhoan)->orderBy('id', 'desc')->first();
            $inputs['khoahoc'] = $inputs['khoahoc'] ?? (isset($khoahoc) ? $khoahoc->khoahoc : '');
            // dd($inputs['khoahoc']);
            $model = lophoc::where(function ($q) use ($inputs) {
                if (isset($inputs['khoahoc'])) {
                    $q->where('khoahoc', $inputs['khoahoc']);
                }
                if(!chkPhanQuyen('taikhoan', 'thaydoi')){
                    $q->where('giaovienchunhiem', session('admin')->mataikhoan);
                }
            })
                // ->where('giaovienchunhiem', session('admin')->mataikhoan)
                ->get();
        }

        // foreach($model as $ct){
        //     if($ct->giaotrinhhoc != null){
        //         $ct->giaotrinh=explode(';',$ct->giaotrinhhoc);
        //     }else{
        //         $ct->giaotrinh='';
        //     }
        // }
        // dd($model);
        $a_giaovien = array_column(User::where('giaovien',1)->where('trangthai', '!=', 3)->get()->toarray(), 'tentaikhoan', 'mataikhoan');
        $a_khoahoc = array_column(lophoc::select('khoahoc')->get()->unique('khoahoc')->toarray(), 'khoahoc', 'khoahoc');

        $inputs['url'] = '/LopHoc/ThongTin';
        return view('quanly.lophoc.index')
            ->with('model', $model)
            ->with('baocao', getdulieubaocao())
            ->with('inputs', $inputs)
            ->with('a_khoahoc', $a_khoahoc)
            ->with('a_giaovien', $a_giaovien)
            ->with('pageTitle', 'Quản lý lớp học');
    }

    public function indanhsach(Request $request)
    {
        if (!chkPhanQuyen('lophoc', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }

        $inputs = $request->all();

        if (in_array(session('admin')->sadmin, ['SSA', 'admin'])) {
            $khoahoc = lophoc::select('khoahoc')->orderBy('id', 'desc')->first();

            $inputs['khoahoc'] = $inputs['khoahoc'] ?? (isset($khoahoc) ? $khoahoc->khoahoc : '');
            $model = lophoc::where(function ($q) use ($inputs) {
                if (isset($inputs['khoahoc'])) {
                    $q->where('khoahoc', $inputs['khoahoc']);
                }
            })->get();
        } else if (session('admin')->giaovien == 1) {
            $khoahoc = lophoc::select('khoahoc')->where('giaovienchunhiem', session('admin')->manguoidung)->orderBy('id', 'desc')->first();
            $inputs['khoahoc'] = $inputs['khoahoc'] ?? (isset($khoahoc) ? $khoahoc->khoahoc : '');
            $model = lophoc::where(function ($q) use ($inputs) {
                if (isset($inputs['khoahoc'])) {
                    $q->where('khoahoc', $inputs['khoahoc']);
                }
            })
                ->where('giaovienchunhiem', session('admin')->manguoidung)
                ->get();
        }

        $danhsachkhoahoc = $model->unique('khoahoc');

        $a_giaovien = array_column(giaovien::where('trangthai', '!=', 3)->get()->toarray(), 'tengiaovien', 'magiaovien');

        return view('quanly.lophoc.indanhsach')
            ->with('model', $model)
            ->with('a_giaovien', $a_giaovien)
            ->with('khoahoc', $danhsachkhoahoc)
            ->with('pageTitle', 'Danh sách lớp học');
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

        $inputs = $request->all();
        $inputs['malop'] = getdate()[0];
        $inputs['soluonghocvien'] = 0;

        lophoc::create($inputs);
        return redirect('/LopHoc/ThongTin?khoahoc=' . $inputs['khoahoc'])
            ->with('success', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if (!chkPhanQuyen('lophoc', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }
        $inputs = $request->all();
        $model = lophoc::where('malop', $inputs['lophoc'])->first();

        $inputs['khoahoc'] = isset($inputs['khoahoc']) ? $inputs['khoahoc'] : $model->khoahoc;

        $hocvien = lophoc::join('users', 'users.malop', 'lophoc.malop')
            ->where('users.malop', $inputs['lophoc'])
            ->where('khoahoc', $inputs['khoahoc'])
            ->get();
            foreach($hocvien as $ct){
                $phanquyen=dstaikhoan_phanquyen::where('tendangnhap',$ct->cccd)->wherein('machucnang',['luyenthi','60baieps','960caudoc','960caunghe'])->get();
                $a_phanquyen=array_column($phanquyen->toarray(),'phanquyen','machucnang');
                $a_macngiaotrinh=array_column($phanquyen->toarray(),'machucnang','machucnang');
                if(isset($a_phanquyen['luyenthi'])){
                    $ct->phanquyenluyenthi=$a_phanquyen['luyenthi'];
                    unset($a_phanquyen['luyenthi']);
                    unset($a_macngiaotrinh['luyenthi']);
                }else{
                    $ct->phanquyenluyenthi=0;
                }
                if(count($a_phanquyen)> 0){
                    $giaotrinh=implode(';',$a_macngiaotrinh);
                    $ct->giaotrinhhoc=$giaotrinh;
                    foreach($a_phanquyen as $val){
                        $ct->phanquyengiaotrinhhoc=$val;
                        break;
                    }
                }else{
                    $ct->giaotrinhhoc='60baieps;960caudoc;960caunghe';
                    $ct->phanquyengiaotrinhhoc=0;
                }

                $khoataikhoan=User::where('cccd',$ct->cccd)->first();
                if(isset($khoataikhoan)){
                    $ct->khoataikhoan=$khoataikhoan->trangthai;
                }else{
                    $ct->khoataikhoan=2;
                }

            }
        // $giaovien=giaovien::where('trangthai','!=',3)->get();
        $a_giaovien = array_column(User::where('giaovien',1)->where('trangthai', '!=', 3)->get()->toarray(), 'tentaikhoan', 'mataikhoan');
        $a_khoahoc = array_column(lophoc::select('khoahoc')->get()->unique('khoahoc')->toarray(), 'khoahoc', 'khoahoc');
        $a_lophoc = array_column(lophoc::select('malop', 'tenlop')->get()->toarray(), 'tenlop', 'malop');

        $inputs['url'] = '/LopHoc/chitiet';
        $m_hocvien = User::where('hocvien',1)->wherenull('malop')->get();
        $ketquathi = ketquathithu::where('malop', $inputs['lophoc'])->get();
        $ketquathi->unique('created_at');
// dd($hocvien);
        return view('quanly.lophoc.chitiet')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('hocvien', $hocvien)
            ->with('m_hocvien', $m_hocvien)
            ->with('a_khoahoc', $a_khoahoc)
            ->with('a_lophoc', $a_lophoc)
            ->with('a_giaovien', $a_giaovien)
            ->with('ketquathi', $ketquathi)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Chi tiết lớp học');
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

        $inputs = $request->all();
        $model = lophoc::findOrFail($id);
        if (isset($model)) {
            $model->update($inputs);
        }

        return redirect('/LopHoc/ThongTin?khoahoc=' . $inputs['khoahoc'])
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('lophoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }

        $model = lophoc::findOrFail($id);
        if (isset($model)) {
            $model->delete();
        }

        return redirect('/LopHoc/ThongTin')
            ->with('success', 'Xóa thành công');
    }

    public function themhocvien(Request $request)
    {
        if (!chkPhanQuyen('lophoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }
        $inputs = $request->all();
        $lophoc = lophoc::where('malop', $inputs['malop'])->first();
        foreach ($inputs['mahocvien'] as $ct) {
            $hocvien = User::where('mataikhoan', $ct)->first();
            $hocvien->update(['malop' => $inputs['malop']]);
        }
        $lophoc->update(['soluonghocvien' => $lophoc->soluonghocvien + count($inputs['mahocvien'])]);
        return redirect('/LopHoc/chitiet?lophoc=' . $inputs['malop'] . '&khoahoc=' . $lophoc->khoahoc);
    }
    public function chuyenlop(Request $request, $id)
    {
        if (!chkPhanQuyen('lophoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'lophoc');
        }
        $inputs = $request->all();
        $hocvien = User::findOrFail($id);
        $lophoc = lophoc::where('malop', $hocvien->malop)->first();
        if (isset($hocvien)) {
            $hocvien->update(['malop' => $inputs['malop']]);
        }
        $lophoc->update(['soluonghocvien' => $lophoc->soluonghocvien - 1]);
        // $lophoc=lophoc::where('malop',$inputs['malop'])->first();

        return redirect('/LopHoc/chitiet?lophoc=' . $lophoc->malop . '&khoahoc=' . $lophoc->khoahoc)
            ->with('success', 'Chuyển lớp thành công');
    }

    public function ketquathi(Request $request)
    {
        $inputs = $request->all();
        $a_giaovien = array_column(User::where('giaovien',1)->where('trangthai', '!=', 3)->get()->toarray(), 'tentaikhoan', 'mataikhoan');
        $a_khoahoc = array_column(lophoc::select('khoahoc')->get()->unique('khoahoc')->toarray(), 'khoahoc', 'khoahoc');
        $a_lophoc = array_column(lophoc::select('malop', 'tenlop')->get()->toarray(), 'tenlop', 'malop');
        $ketqua = ketquathithu::where('malop', $inputs['malop'])
            ->where(function ($q) use ($inputs) {
                if (isset($inputs['ngaythi'])) {
                    $q->where('ngaythi', $inputs['ngaythi']);
                }
            })->get();
        // dd($ketqua);
        // $thongtin_thithu=$ketqua->unique('madethi')->first();
        $thongtin_thithu = $ketqua->unique('madethi');
        $a_madeketqua = array_column($thongtin_thithu->toarray(), 'madethi');
        $dethi = dethi::all();
        $a_dethi = array_column($dethi->toarray(), 'tende', 'made');
        $a_dethi_sosanh = array_column($dethi->toarray(), 'made');
        if (count(array_intersect($a_madeketqua, $a_dethi_sosanh)) <= 0) {
            $ketqua = new ketquathithu();
        }
        $mahocvien = array_column($ketqua->toarray(), 'mahocvien');

        $hocvien = User::where('hocvien',1)->wherein('mahocvien', $mahocvien)->get();
        foreach ($hocvien as $ct) {
            $ketqua_hv = $ketqua->where('mahocvien', $ct->mahocvien)->first();
            $ct->diemthi = $ketqua_hv->diemthi;
            $ct->ngaythi = $ketqua_hv->ngaythi;
            // $ct->giothi=$ketqua_hv->giothi;
            $ct->madethi = $ketqua_hv->madethi;
            $ct->thoigianlambai = $ketqua_hv->thoigianlambai;
        }

        $inputs['url'] = '/LopHoc/KetQuaThiThu';
        return view('export.ketquathi.index')
            ->with('a_khoahoc', $a_khoahoc)
            ->with('a_lophoc', $a_lophoc)
            ->with('a_giaovien', $a_giaovien)
            ->with('a_dethi', $a_dethi)
            ->with('a_madeketqua', $a_madeketqua)
            ->with('thongtin_thithu', $thongtin_thithu)
            ->with('inputs', $inputs)
            ->with('hocvien', $hocvien)
            ->with('ketqua', $ketqua)
            ->with('pageTitle', 'Kết quả thi thử');
    }

}