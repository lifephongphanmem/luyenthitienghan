<?php

namespace App\Http\Controllers\baocao;

use App\Http\Controllers\Controller;
use App\Models\quanly\hocvien;
use App\Models\quanly\lophoc;
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
            return $next($request);
        });
    }

    public function danhsachhocvien(Request $request)
    {
        $inputs = $request->all();

        $model = hocvien::join('ketquathithu', 'ketquathithu.mahocvien', 'hocvien.mahocvien')
            ->join('lophoc', 'lophoc.malop', 'hocvien.malop')
            ->select('hocvien.*', 'lophoc.khoahoc', 'ketquathithu.madethi', 'ketquathithu.diemthi')
            ->where(function ($q) use ($inputs) {

                if (isset($inputs['khoahoc'])) {
                    $q->where('khoahoc', $inputs['khoahoc']);
                }
                if (isset($inputs['ketqua'])) {
                    $q->where('diemthi', '>=', $inputs['ketqua']);
                }
            })
            ->orderBy('diemthi', 'desc')
            ->get();
            $mahocvien=array_column($model->unique('mahocvien')->toarray(),'mahocvien');
            $a_diemthi_hv=[];
            foreach($mahocvien as $hv){
                // $diemthi=array_column($model->where('mahocvien',$hv)->toarray(),'diemthi');
                $diemthi=$model->where('mahocvien',$hv)->max('diemthi');
                $a_diemthi_hv[$hv]=$diemthi;
            }
            $hocvien=$model->unique('mahocvien');
            foreach($hocvien as $ct){
                $ct->diemthi=$a_diemthi_hv[$ct->mahocvien];
            }
            // dd($hocvien);
        $khoahoc = $model->unique('khoahoc');
        return view('baocao.danhsachhocvien')
            ->with('model', $hocvien)
            ->with('khoahoc', $khoahoc)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Thống kê danh sách học viên');
    }
}
