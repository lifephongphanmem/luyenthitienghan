<?php

namespace App\Http\Controllers\thithu;

use App\Http\Controllers\Controller;
use App\Models\dethi\cauhoi;
use App\Models\dethi\dethi;
use App\Models\ketqua\ketquathithu;
use App\Models\quanly\hocvien;
use App\Models\quanly\lophoc;
use App\Models\thithu\phongthi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class thithuController extends Controller
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
    public function thithu(Request $request)
    {
        $m_phongthi = phongthi::join('phongthi_lop', 'phongthi_lop.maphongthi', 'phongthi.maphongthi')->select('phongthi_lop.malop')->where('phongthi.trangthai', 1)->get();
        $a_malop = array_column($m_phongthi->toarray(), 'malop');
        $hocvien = hocvien::where('mahocvien', session('admin')->mahocvien)->first();
        if (isset($hocvien)) {
            if (in_array($hocvien->malop, $a_malop)) {
                $phongthi = phongthi::join('phongthi_lop', 'phongthi_lop.maphongthi', 'phongthi.maphongthi')->select('phongthi.*')->where('phongthi_lop.malop', $hocvien->malop)->first();
            }
        }
        $url = '/ThiThu/LamBai';
        return view('dethi.thithu.index')
            ->with('url', $url)
            ->with('phongthi', $phongthi->tenphongthi);
    }

    public function lambai(Request $request)
    {
        // $model = dethi::all();
        // $a_madethi = array_column($model->toarray(), 'made');
        // $made = $a_madethi[array_rand($a_madethi)];
        $inputs = $request->all();
        if (isset($inputs['loai'])) {
            $cauhoi = taodethi();
            $m_cauhoi = cauhoi::wherein('macauhoi', $cauhoi)->get();
            // $hocvien = hocvien::where('mahocvien', session('admin')->mahocvien)->first();
            // $phongthi = phongthi::join('phongthi_lop', 'phongthi_lop.maphongthi', 'phongthi.maphongthi')
            //     ->select('phongthi.made')
            //     ->where('phongthi.trangthai', 1)
            //     ->where('phongthi_lop.malop', $hocvien->malop)
            //     ->first();
            // $made = $phongthi->made;
            // $m_cauhoi = cauhoi::join('cauhoi_dethi', 'cauhoi_dethi.macauhoi', 'cauhoi.macauhoi')
            //     ->where('cauhoi_dethi.made', $made)
            //     ->orderBy('loaicauhoi', 'desc')
            //     ->get();
            $made = 1;
            $malop=1;
            $maphongthi=1;
        } else {
            $hocvien = hocvien::where('mahocvien', session('admin')->mahocvien)->first();
            $phongthi = phongthi::join('phongthi_lop', 'phongthi_lop.maphongthi', 'phongthi.maphongthi')
                ->select('phongthi.made','phongthi_lop.malop','phongthi.maphongthi')
                ->where('phongthi.trangthai', 1)
                ->where('phongthi_lop.malop', $hocvien->malop)
                ->first();
            $made = $phongthi->made;
            $maphongthi=$phongthi->maphongthi;
            $malop=$phongthi->malop;
            $m_cauhoi = cauhoi::join('cauhoi_dethi', 'cauhoi_dethi.macauhoi', 'cauhoi.macauhoi')
                ->where('cauhoi_dethi.made', $made)
                ->orderBy('loaicauhoi', 'desc')
                ->get();
        }

        $thoigianbatdau = Carbon::now('Asia/Ho_Chi_Minh');
        $timestart = strtotime($thoigianbatdau->toTimeString());
        return view('dethi.thithu.thithu')
            ->with('m_cauhoi', $m_cauhoi)
            ->with('made', $made)
            ->with('maphongthi', $maphongthi)
            ->with('malop', $malop)
            ->with('timestart', $timestart)
            ->with('pageTitle', 'Thi thử EPS-TOPIK');
    }

    public function nopbai(Request $request)
    {
        $inputs = $request->all();
        unset($inputs['_token']);
        $a_cautraloi = explode("|", $inputs['queryString']);
        $dapandung = [];
        $dapansai = [];
        $kq_chon = [];
        $kq_dung = [];
        $bailam = [];
        $thoigianketthuc = Carbon::now('Asia/Ho_Chi_Minh');
        $timesend = strtotime($thoigianketthuc->toTimeString());
        $thoigianlambai = $timesend - $inputs['timestart'];
        foreach ($a_cautraloi as $key => $ct) {
            if ($ct != '') {
                $dapanchon = explode(":", $ct);
                $bailam[$dapanchon[0]] = $dapanchon[1];
                $cauhoi = cauhoi::where('macauhoi', $dapanchon[0])->first();
                $kq_dung[$key] = $dapanchon[0] . '_' . $cauhoi->dapan;
                if ($dapanchon[1] != 'F') {
                    if ($cauhoi->dapan == $dapanchon[1]) {
                        $dapandung[] = $dapanchon[0] . '_' . $cauhoi->dapan;
                        $kq_chon[$key] = 'traloidung';
                    } else {
                        $dapansai[] = $dapanchon[0] . '_' . $dapanchon[1];
                        $kq_chon[$key] = 'traloisai';
                    }
                } else {
                    $kq_chon[$key] = 'traloisai';
                }
            }
        }
        $diemthi = count($dapandung) * 5;
        $data['dapandung'] = $dapandung;
        $data['dapansai'] = $dapansai;
        $data['diemthi'] = $diemthi;
        $data['dapanchon'] = $a_cautraloi;
        $data['kq_chon'] = $kq_chon;
        $data['kq_dung'] = $kq_dung;
        $data['madethi']=$inputs['madethi'];
        // $data['thoigianlambai']=$thoigianlambai;
        if ($inputs['madethi'] != 1) {
            $luu_kq = array(
                'maketqua' => getdate()[0],
                'madethi' => $inputs['madethi'],
                'mahocvien' => session('admin')->mahocvien,
                'diemthi' => $diemthi,
                'dapanchon' => json_encode($bailam),
                'thoigianlambai' => $thoigianlambai,
                'malop'=>$inputs['malop'],
                'maphongthi'=>$inputs['maphongthi'],
                'ngaythi'=>$thoigianketthuc->toDateString(),
                'giothi'=>$thoigianketthuc->toTimeString()
            );

            ketquathithu::create($luu_kq);
        }

        return response()->json($data);
    }

    public function  checklog(Request $request)
    {
        $data = '';
        if (!Session::has('admin')) {
            $data = 'offline';
        } else {
            $data = 'online';
        }

        return response()->json($data);
    }

    public function quanlythithu()
    {
        $model = phongthi::all();

        return view('dethi.thithu.quanlythithu')
            ->with('model', $model)
            ->with('pageTitle', 'Danh sách phòng thi');
    }

    public function luyenthi()
    {
        $url = '/ThiThu/LamBai?loai=1';
        return view('dethi.thithu.index')
            ->with('url', $url)
            ->with('pageTitle', 'Luyện thi EPS-TOPIK');
    }
}
