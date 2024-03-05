<?php

namespace App\Http\Controllers\baocao;

use App\Http\Controllers\Controller;
use App\Models\quanly\hocvien;
use App\Models\quanly\lophoc;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class baocaoController extends Controller
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

    public function danhsachhocvien(Request $request)
    {
        if (!chkPhanQuyen('thongke', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'thongke');
        }
        $inputs = $request->all();

        // $model = hocvien::join('ketquathithu', 'ketquathithu.mahocvien', 'hocvien.mahocvien')
        $model = User::join('ketquathithu', 'ketquathithu.mahocvien', 'users.mataikhoan')
            ->join('lophoc', 'lophoc.malop', 'users.malop')
            ->select('users.*', 'lophoc.khoahoc','lophoc.malop','lophoc.tenlop', 'ketquathithu.madethi', 'ketquathithu.diemthi')
            ->where(function ($q) use ($inputs) {
                if (isset($inputs['khoahoc'])) {
                    $q->where('khoahoc', $inputs['khoahoc']);
                }
                // if (isset($inputs['ketqua'])) {
                //     $q->where('diemthi', '>=', $inputs['ketqua']);
                // }
            })
            ->whereBetween('diemthi',[$inputs['ketquatu'],$inputs['ketquaden']])
            ->orderBy('diemthi', 'desc')
            ->get();
            $mahocvien=array_column($model->unique('mataikhoan')->toarray(),'mataikhoan');
            $a_diemthi_hv=[];
            foreach($mahocvien as $hv){
                // $diemthi=array_column($model->where('mahocvien',$hv)->toarray(),'diemthi');
                $diemthi=$model->where('mataikhoan',$hv)->max('diemthi');
                $a_diemthi_hv[$hv]=$diemthi;
            }
            $hocvien=$model->unique('mataikhoan');
            foreach($hocvien as $ct){
                $ct->diemthi=$a_diemthi_hv[$ct->mataikhoan];
            }
            // dd($hocvien);
        $khoahoc = $model->unique('khoahoc');
        $lophoc=$model->unique('malop');
        return view('baocao.danhsachhocvien')
            ->with('model', $hocvien)
            ->with('khoahoc', $khoahoc)
            ->with('lophoc', $lophoc)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Thống kê danh sách học viên');
    }
}
