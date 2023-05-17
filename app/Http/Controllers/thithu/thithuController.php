<?php

namespace App\Http\Controllers\thithu;

use App\Http\Controllers\Controller;
use App\Models\dethi\cauhoi;
use App\Models\dethi\dethi;
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
    public function thithu(Request $request){

        return view('dethi.thithu.index');

    }

    public function lambai(){

        $model=dethi::all();
        $a_madethi=array_column($model->toarray(),'made');
        $made=$a_madethi[array_rand($a_madethi)];
        $m_cauhoi=cauhoi::join('cauhoi_dethi','cauhoi_dethi.macauhoi','cauhoi.macauhoi')
                            ->where('cauhoi_dethi.made',$made)
                            ->orderBy('loaicauhoi','desc')
                            ->get();
       
        return view('dethi.thithu.thithu')
                ->with('m_cauhoi',$m_cauhoi)
                ->with('made',$made)
                ->with('pageTitle','Thi thử EPS-TOPIK');
    }

    public function nopbai(Request $request){
        $inputs=$request->all();
        unset($inputs['_token']);
        // $m_cauhoi=cauhoi::join('cauhoi_dethi','cauhoi_dethi.macauhoi','cauhoi.macauhoi')
        //                     ->where('cauhoi_dethi.made',$inputs['made'])
        //                     ->get();

                            return response()->json($inputs);
    }

    public function  checklog(Request $request)
    {
        $data='';
        if (!Session::has('admin')) {
            $data='offline';
        }else{
            $data='online';
        }

        return response()->json($data);
    }
}
