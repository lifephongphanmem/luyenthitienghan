<?php

use App\Models\danhmuc\loaicauhoict;
use App\Models\dethi\cauhoi;
use App\Models\quanly\hocvien;
use App\Models\thithu\phongthi;
use Illuminate\Support\Facades\Session;

function chkPhanQuyen($machucnang = null, $tenphanquyen = null)
{
    //return true;
    //Kiểm tra giao diện (danhmucchucnang)
    if (!chkGiaoDien($machucnang)) {
        return false;
    }
    $capdo = session('admin')->capdo;

    if (in_array($capdo, ['SSA', 'ssa',])) {
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
function chkThiThu($mahocvien){
    // if (!Session::has('admin')) {
    //     return redirect('/');
    // };
    $phongthi=phongthi::join('phongthi_lop','phongthi_lop.maphongthi','phongthi.maphongthi')->select('phongthi_lop.malop')->where('phongthi.trangthai',1)->get();
    $a_malop=array_column($phongthi->toarray(),'malop');
    $hocvien=hocvien::where('mahocvien',$mahocvien)->first();
    
    if(isset($hocvien)){
        if(in_array($hocvien->malop,$a_malop)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }

}

function taodethi(){
    $m_cauhoi=cauhoi::all();
    $m_caunghe=$m_cauhoi->where('loaicauhoi',1683685241);
    $caudoc=$m_cauhoi->where('loaicauhoi',1683685323);
    $loaicaudoc=loaicauhoict::where('madm',1683685323)->get();
    $loaicaunghe=loaicauhoict::where('madm',1683685241)->where('madmct','!=',1684898896)->get();
    $macaudoc=[];
    $macaunghekhac=[];
    foreach($loaicaudoc as $ct){
        $m_caudoc=array_column($caudoc->where('dangcaudochieu',$ct->madmct)->toarray(),'macauhoi');
        if($m_caudoc != []){
            $index=array_rand($m_caudoc,$ct->soluongcau);
            foreach($index as $val){
                $macaudoc[]=$m_caudoc[$val];
            }
           
        }
    }

    foreach($loaicaunghe as $ct){
        $caunghe=array_column($m_caunghe->where('loaicaunghe',$ct->madmct)->toarray(),'macauhoi');
        if($m_caudoc != []){
            $index=array_rand($caunghe,$ct->soluongcau);
            foreach($index as $val){
                $macaunghekhac[]=$caunghe[$val];
            }
           
        }
    }

    $caungheghep=array_column($m_caunghe->where('dangcau',2)->unique('macaughep')->toarray(),'macaughep');
    $macaungheghep=[];
    if($caungheghep != []){
        $index_caungheghep=array_rand($caungheghep);
        $macaungheghep=array_column($m_caunghe->where('macaughep',$caungheghep[$index_caungheghep])->toarray(),'macauhoi');
    }

    $macaunghe=array_merge($macaunghekhac,$macaungheghep);
    $macauhoidethi=array_merge($macaudoc,$macaunghe);
    return $macauhoidethi;
}