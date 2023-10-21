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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class thithuController extends Controller
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
    public function thithu(Request $request)
    {
        $m_phongthi = phongthi::join('phongthi_lop', 'phongthi_lop.maphongthi', 'phongthi.maphongthi')->select('phongthi_lop.malop')->where('phongthi.trangthai', 1)->get();
        $a_malop = array_column($m_phongthi->toarray(), 'malop');
        $hocvien = hocvien::where('mahocvien', session('admin')->manguoidung)->first();
        if (isset($hocvien)) {
            if (in_array($hocvien->malop, $a_malop)) {
                $phongthi = phongthi::join('phongthi_lop', 'phongthi_lop.maphongthi', 'phongthi.maphongthi')->select('phongthi.*')->where('phongthi_lop.malop', $hocvien->malop)->first();
            }
        }
        $url = '/ThiThu/LamBai';
        return view('dethi.thithu.index')
        ->with('baocao',getdulieubaocao())
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
            $cauhoi = taodeluyenthi();
            // dd($cauhoi);
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
            $title='Luyện thi EPS-TOPIK';
        } else {
            $hocvien = hocvien::where('mahocvien', session('admin')->manguoidung)->first();
            $phongthi = phongthi::join('phongthi_lop', 'phongthi_lop.maphongthi', 'phongthi.maphongthi')
                ->select('phongthi_lop.made','phongthi_lop.malop','phongthi.maphongthi')
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
                $title='Thi thử EPS-TOPIK';
        }

        $caudoc=$m_cauhoi->where('loaicauhoi',1683685323);
        // dd(count($caudoc));
        if(count($caudoc)<20){
            return view('errors.tontaidulieu')->with('message','Đề thi chưa đủ số lượng câu')->with('furl','/');
        }
        if(count($caudoc) > 0){
            $i=1;
            foreach($caudoc as $val){
                $val->cau=$i++;
            }
        }
        $caunghe=$m_cauhoi->where('loaicauhoi',1683685241);
        if(count($caunghe) > 0){
            $j=21;
            foreach($caunghe as $val){
                $val->cau=$j++;
            }
        }
        $colection=new Collection([$caudoc,$caunghe]);
        $cauhoi_dethi=$colection->collapse();
        // dd($cauhoi_dethi);
        $thoigianbatdau = Carbon::now('Asia/Ho_Chi_Minh');

        $timestart = strtotime($thoigianbatdau->toTimeString());
        return view('dethi.thithu.thithu')
            ->with('m_cauhoi', $cauhoi_dethi)
            ->with('baocao',getdulieubaocao())
            ->with('made', $made)
            ->with('maphongthi', $maphongthi)
            ->with('malop', $malop)
            ->with('timestart', $timestart)
            ->with('pageTitle', $title);
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
             //kiểm tra số lần thi thử trong ngày để tính toán đóng phòng thi và khóa chức năng thi thử
             $ketqua=ketquathithu::where('mahocvien',session('admin')->manguoidung)->where('malop',$inputs['malop'])->where('maphongthi',$inputs['maphongthi'])->where('madethi',$inputs['madethi'])->where('ngaythi',$thoigianketthuc->toDateString())->max('lanthithu');
             $lanthithu=$ketqua == ''?1:($ketqua+1);
            $luu_kq = array(
                'maketqua' => getdate()[0],
                'madethi' => $inputs['madethi'],
                'mahocvien' => session('admin')->manguoidung,
                'diemthi' => $diemthi,
                'dapanchon' => json_encode($bailam),
                'thoigianlambai' => $thoigianlambai,
                'malop'=>$inputs['malop'],
                'maphongthi'=>$inputs['maphongthi'],
                'ngaythi'=>$thoigianketthuc->toDateString(),
                'giothi'=>$thoigianketthuc->toTimeString(),
                'lanthithu'=>$lanthithu
            );

            ketquathithu::create($luu_kq);
            hocvien::where('mahocvien',session('admin')->manguoidung)->update(['trangthaithithu'=>0]);
            //kiểm tra nếu học viên nộp bải hết thì xóa lớp đó khỏi phòng thi, nếu phòng thi không còn lớp nào thì đóng phòng thi.
            chksoluonghocsinhtrongphongthi($inputs['malop'],$inputs['maphongthi'],$lanthithu,$inputs['madethi']);
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
            ->with('baocao',getdulieubaocao())
            ->with('pageTitle', 'Danh sách phòng thi');
    }

    public function luyenthi()
    {
        $url = '/ThiThu/LamBai?loai=1';
        return view('dethi.thithu.index')
        ->with('baocao',getdulieubaocao())
            ->with('url', $url)
            ->with('pageTitle', 'Luyện thi EPS-TOPIK');
    }
}
