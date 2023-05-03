<?php

namespace App\Http\Controllers\thithu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class thithuController extends Controller
{
    public function thithu(Request $request){

        return view('dethi.thithu.index');

    }

    public function lambai(){

        $model=dethi::all();
        $a_madethi=array_column($model->toarray(),'made');
        $made=$a_madethi[array_rand($a_madethi)];
        $m_cauhoi=cauhoi::join('cauhoi_dethi','cauhoi_dethi.macauhoi','cauhoi.macauhoi')
                            ->where('cauhoi_dethi.made',$made)
                            ->get();
                            dd($m_cauhoi);
        return view('dethi.thithu.thithu')
                ->with('m_cauhoi',$m_cauhoi)
                ->with('made',$made)
                ->with('pageTitle','Thi thử EPS-TOPIK');
    }

    public function nopbai(Request $request){
        $inputs=$request->all();
        $m_cauhoi=cauhoi::join('cauhoi_dethi','cauhoi_dethi.macauhoi','cauhoi.macauhoi')
                            ->where('cauhoi_dethi.made',$inputs['made'])
                            ->get();
    }
}
