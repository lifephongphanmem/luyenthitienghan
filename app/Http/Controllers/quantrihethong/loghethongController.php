<?php

namespace App\Http\Controllers\quantrihethong;

use App\Http\Controllers\Controller;
use App\Models\Hethong\Chucnang;
use App\Models\quantrihethong\cauhinhhethong;
use App\Models\quantrihethong\loghethong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class loghethongController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!chkPhanQuyen('loghethong', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'loghethong');
        }
        $inputs=$request->all();
        $model=loghethong::where(function ($q) use ($inputs){
            if(isset($inputs['thaotac'])){
                $q->where('thaotac',$inputs['thaotac']);
            }
            if(isset($inputs['ngay'])){
                $q->wheredate('thoigian',$inputs['ngay']);
            }
        })->where('taikhoantruycap','<>','SSA')
        ->orderBy('id','desc')
        ->get();
        $inputs['thaotac']=isset($inputs['thaotac'])?$inputs['thaotac']:'';
        $inputs['ngay']=isset($inputs['ngay'])?$inputs['ngay']:'';
        $inputs['url']='/LogHeThong/ThongTin';
        return view('quantrihethong.loghethong.index')
                    ->with('model',$model)
                    ->with('inputs',$inputs)
                    ->with('baocao',getdulieubaocao())
                    ->with('pageTitle','Log Hệ thống');
    }

public function innhatky(Request $request){
    if (!chkPhanQuyen('loghethong', 'hoanthanh')) {
        return view('errors.noperm')->with('machucnang', 'loghethong');
    } 
    $inputs=$request->all();
    $model=loghethong::where(function ($q) use ($inputs){
        if(isset($inputs['thaotac'])){
            $q->where('thaotac',$inputs['thaotac']);
        }
    })->where('taikhoantruycap','<>','SSA')->get();

    return view('quantrihethong.loghethong.nhatky')
            ->with('model',$model)
            ->with('baocao',getdulieubaocao())
            ->with('pageTitle','Nhật ký hệ thống');
}
}
