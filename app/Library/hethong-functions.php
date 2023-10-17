<?php

use App\Models\baigiang\giaotrinh;
use App\Models\danhmuc\loaicauhoict;
use App\Models\dethi\cauhoi;
use App\Models\quanly\hocvien;
use App\Models\quanly\lophoc;
use App\Models\quantrihethong\cauhinhhethong;
use App\Models\quantrihethong\loghethong;
use App\Models\thithu\phongthi;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

function chkPhanQuyen($machucnang = null, $tenphanquyen = null)
{
    //return true;
    //Kiểm tra giao diện (danhmucchucnang)
    if (!chkGiaoDien($machucnang)) {
        return false;
    }
    $capdo = session('admin')->capdo;

    if (in_array($capdo, ['SSA', 'ssa','ADMIN'])) {
        return true;
    }
    // dd(session('phanquyen'));
    return session('phanquyen')[$machucnang][$tenphanquyen] ?? 0;
}

function chkGiaoDien($machucnang, $tentruong = 'trangthai')
{
    $chk = session('chucnang')[$machucnang] ?? ['trangthai' => 0, 'tencn' => $machucnang . '()'];
    // if($machucnang == 'quantrihethong'){
    // dd($chk);
    // }
    return $chk[$tentruong];
}
function chkThiThu($mahocvien)
{
    // if (!Session::has('admin')) {
    //     return redirect('/');
    // };
    $phongthi = phongthi::join('phongthi_lop', 'phongthi_lop.maphongthi', 'phongthi.maphongthi')->select('phongthi_lop.malop')->where('phongthi.trangthai', 1)->get();
    $a_malop = array_column($phongthi->toarray(), 'malop');
    $hocvien = hocvien::where('mahocvien', $mahocvien)->first();

    if (isset($hocvien)) {
        if (in_array($hocvien->malop, $a_malop)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function taodeluyenthi()
{
    $m_cauhoi = cauhoi::all();
    $m_caunghe = $m_cauhoi->where('loaicauhoi', 1683685241);
    $caudoc = $m_cauhoi->where('loaicauhoi', 1683685323);
    $loaicaudoc = loaicauhoict::where('madm', 1683685323)->get();
    $loaicaunghe = loaicauhoict::where('madm', 1683685241)->where('madmct', '!=', 1684898896)->get();
    // dd($loaicaunghe);
    // $macaudoc=[];
    $macaudoc_khac = [];
    $macaunghekhac = [];
    $caudoc_tutao = $caudoc->where('nguoncauhoi', 1684121372);
    $caudoc_bode = $caudoc->where('nguoncauhoi', 1684121327);
    if (count($caudoc_tutao) > 2) {
        //Lấy 2 câu tự tạo
        $cauthi_tutao = $caudoc_tutao->random(2);
        // dd($cauthi_tutao);
        $a_madangcau = array_column($cauthi_tutao->toarray(), 'dangcaudochieu');
        $a_cauhoi = array_column($cauthi_tutao->toarray(), 'macauhoi');
        //Kiểm tra dạng câu và trừ đi số lượng câu
        if(in_array(1683688096,$a_madangcau)){
            $stt=$cauthi_tutao->where('dangcaudochieu',1683688096)->first()->stt;
            $cauthi_tutao=$caudoc_tutao->where('dangcaudochieu',1683688096)->where('stt',$stt);
            $a_cauhoi=array_column($cauthi_tutao->toarray(),'macauhoi');
        }
        foreach ($loaicaudoc as $val) {
            foreach($cauthi_tutao as $cttt){
                if($val->madmct == $cttt->dangcaudochieu){
                    $val->soluongcau=$val->soluongcau - 1;
                }
            }
        }
        // dd(array_column($loaicaudoc->toarray(),'soluongcau'));
        //Lấy 18 câu đọc còn lại của bộ đề

        // dd(array_column($loaicaudoc->toarray(),'soluongcau'));
        foreach ($loaicaudoc as $ct) {
            if ($ct->madmct == 1683688096) {
                $caudoc2cauhoi = $caudoc_bode->where('dangcau', 2)->whereNotIn('macauhoi', $a_cauhoi)->unique('stt')->random($ct->soluongcau / 2);
                foreach ($caudoc2cauhoi as $chitiet) {
                    $caudoc_ghep = $caudoc_bode->where('dangcau', 2)->where('stt', $chitiet->stt);
                    foreach ($caudoc_ghep as $caughep) {
                        $macaudoc_khac[] = $caughep->macauhoi;
                    }
                }
            } else {
                $m_caudoc = $caudoc_bode->where('dangcaudochieu', $ct->madmct)->whereNotIn('macauhoi', $a_cauhoi)->where('dangcau', 1);
                if (count($m_caudoc) > 0) {
                    $m_cauhoi_thi = $m_caudoc->random($ct->soluongcau);
                    foreach ($m_cauhoi_thi as $ch) {
                        $macaudoc_khac[] = $ch->macauhoi;
                    }
                }
            }
        }
        // dd($macaudoc_khac);
        // dd($a_cauhoi);
        $macaudoc = array_merge($macaudoc_khac, $a_cauhoi);
        // dd($macaudoc);
    } else {
        foreach ($loaicaudoc as $ct) {
            if ($ct->madmct == 1683688096) {
                $caudoc2cauhoi = $caudoc_bode->where('dangcau', 2)->unique('stt')->random($ct->soluongcau / 2);
                foreach ($caudoc2cauhoi as $chitiet) {
                    $caudoc_ghep = $caudoc_bode->where('dangcau', 2)->where('stt', $chitiet->stt);
                    foreach ($caudoc_ghep as $caughep) {
                        $macaudoc_khac[] = $caughep->macauhoi;
                    }
                }

                // $caudoc_ghep = $caudoc_bode->where('dangcau', 2)->where('stt', $caudoc2cauhoi->stt);
                // foreach ($caudoc_ghep as $caughep) {
                //     $macaudoc_khac[] = $caughep->macauhoi;
                // }
            } else {
                $m_caudoc = array_column($caudoc_bode->where('dangcaudochieu', $ct->madmct)->where('dangcau', 1)->toarray(), 'macauhoi');
                if ($m_caudoc != []) {
                    $index = array_rand($m_caudoc, $ct->soluongcau);
                    foreach ($index as $val) {
                        $macaudoc_khac[] = $m_caudoc[$val];
                    }
                }
            }
           
        }
        $macaudoc = $macaudoc_khac;
    }

    // dd($macaudoc);
    foreach ($loaicaunghe as $ct) {
        $caunghe = array_column($m_caunghe->where('dangcau', 1)->where('loaicaunghe', $ct->madmct)->toarray(), 'macauhoi');
        if ($caunghe != []) {
            $index = array_rand($caunghe, $ct->soluongcau);
            foreach ($index as $val) {
                $macaunghekhac[] = $caunghe[$val];
            }
        }
    }

    $caungheghep = array_column($m_caunghe->where('dangcau', 2)->unique('stt')->toarray(), 'stt');

    $macaungheghep = [];
    if ($caungheghep != []) {
        $index_caungheghep = array_rand($caungheghep);
        $macaungheghep = array_column($m_caunghe->where('stt', $caungheghep[$index_caungheghep])->toarray(), 'macauhoi');
    }
    // dd($macaunghekhac);
    $macaunghe = array_merge($macaunghekhac, $macaungheghep);

    // dd($macaunghe);
    $macauhoidethi = array_merge($macaudoc, $macaunghe);
    // dd($macauhoidethi);
    return $macauhoidethi;
}
function taodethi()
{
    $m_cauhoi = cauhoi::all();
    $m_caunghe = $m_cauhoi->where('loaicauhoi', 1683685241);
    $caudoc = $m_cauhoi->where('loaicauhoi', 1683685323);
    $loaicaudoc = loaicauhoict::where('madm', 1683685323)->get();
    $loaicaunghe = loaicauhoict::where('madm', 1683685241)->where('madmct', '!=', 1684898896)->get();
    // dd($loaicaunghe);
    // $macaudoc=[];
    $macaudoc_khac = [];
    $macaunghekhac = [];
    $caudoc_tutao = $caudoc->where('nguoncauhoi', 1684121372);

    $caudoc_bode = $caudoc->where('nguoncauhoi', 1684121327);
    if (count($caudoc_tutao) > 2) {
        //Lấy 2 câu tự tạo
        $cauthi_tutao = $caudoc_tutao->random(2);
        // dd($cauthi_tutao);
        $a_madangcau = array_column($cauthi_tutao->toarray(), 'dangcaudochieu');
        $a_cauhoi = array_column($cauthi_tutao->toarray(), 'macauhoi');
        //Kiểm tra dạng câu và trừ đi số lượng câu
        if(in_array(1683688096,$a_madangcau)){
            $stt=$cauthi_tutao->where('dangcaudochieu',1683688096)->first()->stt;
            $cauthi_tutao=$caudoc_tutao->where('dangcaudochieu',1683688096)->where('stt',$stt);
            $a_cauhoi=array_column($cauthi_tutao->toarray(),'macauhoi');
        }
        foreach ($loaicaudoc as $val) {
            foreach($cauthi_tutao as $cttt){
                if($val->madmct == $cttt->dangcaudochieu){
                    $val->soluongcau=$val->soluongcau - 1;
                }
            }
        }
        // dd(array_column($loaicaudoc->toarray(),'soluongcau'));
        //Lấy 18 câu đọc còn lại của bộ đề

        // dd(array_column($loaicaudoc->toarray(),'soluongcau'));
        foreach ($loaicaudoc as $ct) {
            if ($ct->madmct == 1683688096) {
                $caudoc2cauhoi = $caudoc_bode->where('dangcau', 2)->whereNotIn('macauhoi', $a_cauhoi)->unique('stt')->random($ct->soluongcau / 2);
                foreach ($caudoc2cauhoi as $chitiet) {
                    $caudoc_ghep = $caudoc_bode->where('dangcau', 2)->where('stt', $chitiet->stt);
                    foreach ($caudoc_ghep as $caughep) {
                        $macaudoc_khac[] = $caughep->macauhoi;
                    }
                }
            } else {
                $m_caudoc = $caudoc_bode->where('dangcaudochieu', $ct->madmct)->whereNotIn('macauhoi', $a_cauhoi)->where('dangcau', 1);
                if (count($m_caudoc) > 0) {
                    $m_cauhoi_thi = $m_caudoc->random($ct->soluongcau);
                    foreach ($m_cauhoi_thi as $ch) {
                        $macaudoc_khac[] = $ch->macauhoi;
                    }
                }
            }
        }
        // dd($macaudoc_khac);
        // dd($a_cauhoi);
        $macaudoc = array_merge($macaudoc_khac, $a_cauhoi);
        // dd($macaudoc);
    } else {
        $caughep=[];
        $caudockhac=[];
        
        foreach ($loaicaudoc as $ct) {
            if ($ct->madmct == 1683688096) {
                $caudoc2cauhoi = $caudoc_bode->where('dangcau', 2)->unique('stt')->random($ct->soluongcau / 2);
                foreach ($caudoc2cauhoi as $chitiet) {
                    $caudoc_ghep = $caudoc_bode->where('dangcau', 2)->where('stt', $chitiet->stt);
                    foreach ($caudoc_ghep as $cg) {
                        $caughep[] = $cg->macauhoi;
                    }
                }

                // $caudoc_ghep = $caudoc_bode->where('dangcau', 2)->where('stt', $caudoc2cauhoi->stt);
                // foreach ($caudoc_ghep as $caughep) {
                //     $macaudoc_khac[] = $caughep->macauhoi;
                // }
            } else {
                // $m_caudoc = array_column($caudoc_bode->where('dangcaudochieu', $ct->madmct)->where('dangcau', 1)->toarray(), 'macauhoi');
                // if ($m_caudoc != []) {
                //     $index = array_rand($m_caudoc, $ct->soluongcau);
                //     foreach ($index as $val) {
                //         $caudockhac[] = $m_caudoc[$val];
                //     }
                // }
                $m_caudoc =$caudoc_bode->where('dangcaudochieu', $ct->madmct)->where('dangcau', 1)->random($ct->soluongcau);
                $caudockhac[]=$m_caudoc;
            }
           
        }
        $colection=new Collection($caudockhac);
        $macaudoc_khac=array_column($colection->collapse()->random(14)->toarray(),'macauhoi');
        $macaudoc=array_merge($macaudoc_khac,$caughep);
    }

    foreach ($loaicaunghe as $ct) {
        $caunghe = array_column($m_caunghe->where('dangcau', 1)->where('loaicaunghe', $ct->madmct)->toarray(), 'macauhoi');
        if ($caunghe != []) {
            $index = array_rand($caunghe, $ct->soluongcau);
            foreach ($index as $val) {
                $macaunghekhac[] = $caunghe[$val];
            }
        }
    }

    $caungheghep = array_column($m_caunghe->where('dangcau', 2)->unique('stt')->toarray(), 'stt');

    $macaungheghep = [];
    if ($caungheghep != []) {
        $index_caungheghep = array_rand($caungheghep);
        $macaungheghep = array_column($m_caunghe->where('stt', $caungheghep[$index_caungheghep])->toarray(), 'macauhoi');
    }
    // dd($macaunghekhac);
    $macaunghe = array_merge($macaunghekhac, $macaungheghep);

    // dd($macaunghe);
    $macauhoidethi = array_merge($macaudoc, $macaunghe);
    // dd($macauhoidethi);
    return $macauhoidethi;
}
function getdulieubaocao(){
    $khoahoc=lophoc::select('khoahoc')->get()->unique('khoahoc');
    $giaotrinh=giaotrinh::all();
    $arr=array(
        'khoahoc'=>$khoahoc  ,
        'giaotrinh'=>$giaotrinh      
    );

    return $arr;
}

function getIP(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){  
        $ip_add = $_SERVER['HTTP_CLIENT_IP'];  
    }
    elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){  
        $ip_add = $_SERVER['HTTP_X_FORWARDED_FOR'];  
    }
    else{
        $ip_add = $_SERVER['REMOTE_ADDR'];  
    }

    return $ip_add;
}
function thaotac()
{
    return [
        'dangnhap'=>'Đăng nhập',
        'them'=>'Thêm',
        'capnhat'=>'Cập nhật',
        'xoa'=>'Xóa',
        'excel'=>'Nhận excel',
        'thembaihoc'=>'Thêm bài học vào',
        'xoabaihoc'=>'Xóa bài học khỏi',
        'themcauhoi'=>'Thêm câu hỏi vào',
        'phanquyen'=>'Phân quyền',
        'phanquyennhom'=>'Phân quyền tài khoản theo',
        'phanquyentaikhoannhom'=>'Gắn phân quyền nhóm cho'
        
    ];
}

function loghethong($ip,$taikhoan,$thaotac,$chucnang){
    $m_chucnang=cauhinhhethong::where('trangthai',1)->get();
    $a_chucnang=array_column($m_chucnang->toarray(),'thumuc','machucnang');
    // $a_thaotac=[
    //     'dangnhap'=>'Đăng nhập',
    //     'them'=>'Thêm',
    //     'capnhat'=>'Cập nhật',
    //     'xoa'=>'Xóa',
    //     'excel'=>'Nhận excel',
    //     'thembaihoc'=>'Thêm bài học vào',
    //     'xoabaihoc'=>'Xóa bài học khỏi',
    //     'themcauhoi'=>'Thêm câu hỏi vào',
    //     'phanquyen'=>'Phân quyền',
    //     'phanquyennhom'=>'Phân quyền tài khoản theo',
    //     'phanquyentaikhoannhom'=>'Gắn phân quyền nhóm cho'
        
    // ];
    $data=[
        'ip'=>$ip,
        'taikhoantruycap'=>$taikhoan->cccd,
        'tentaikhoan'=>$taikhoan->tentaikhoan,
        'thaotac'=>$thaotac,
        'chucnang'=>$chucnang,
        'noidung'=>thaotac()[$thaotac] .' '.$a_chucnang[$chucnang],
        'thoigian'=>Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString()
    ];
    if(in_array($chucnang,array_column($m_chucnang->toarray(),'machucnang'))){
        loghethong::create($data);
    }

}

function xoadulieusaoluu()
{//Xét thời gian đăng nhập hiện tại và thời gian đăng nhập gần nhất -> so sánh với thời gian cài đặt xóa
    $cauhinh=cauhinhhethong::where('trangthai',1)->get();

    foreach($cauhinh as $ct){
        // $time=Carbon::now('Asia/Ho_Chi_Minh');
        $start_time=Carbon::now('Asia/Ho_Chi_Minh')->subDays($ct->thoigianluu)->toDateTimeString();
        $end_time=Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $model=loghethong::where('chucnang',$ct->machucnang)->orderBy('thoigian','desc')->first();
        $thoigiangannhat=isset($model)?$model->thoigian:0;
        $chenhlechthoigian=Carbon::now('Asia/Ho_Chi_Minh')->diffInDays($thoigiangannhat);
        if($chenhlechthoigian < $ct->thoigianluu){
            loghethong::where('chucnang',$ct->machucnang)->whereNotBetween('thoigian',[$start_time,$end_time])->delete();
        }
       
    }

}
