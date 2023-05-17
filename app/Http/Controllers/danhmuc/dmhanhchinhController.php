<?php

namespace App\Http\Controllers\danhmuc;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\danhmuchanhchinh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class dmhanhchinhController extends Controller
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

    public function index()
    {
        if (!chkPhanQuyen('diaban', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'chucnang');
        }
        $model=danhmuchanhchinh::where('capdo','!=','Th')->get();
        // dd(getdate()[0]);
        return view('danhmuc.danhmuchanhchinh.index')
                ->with('model',$model)
                ->with('pageTitle','Danh mục hành chính');
    }

    public function store(Request $request)
    {
        if (!chkPhanQuyen('diaban', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'chucnang');
        }
        $inputs=$request->all();
        if(in_array($inputs['level'],['Huyện','Thành phố','Thị xã']))
        {
            $inputs['capdo']='H';
        }else if(in_array($inputs['level'],['Xã','Phường','Thị trấn'])){
            $inputs['capdo']='X';
        }else{
            $inputs['capdo']='T';
        }
        $inputs['madb']=getdate()[0];
            danhmuchanhchinh::create($inputs);
            return redirect('/dia_ban');
    }

    public function update(Request $request, $id)
    {
        if (!chkPhanQuyen('diaban', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'chucnang');
        }
        $inputs=$request->all();
        $id=$inputs['edit'];
        $model=danhmuchanhchinh::findOrFail($id);
        $model->update($inputs);
        return redirect('/dia_ban');
    }

    public function destroy($id)
    {
        if (!chkPhanQuyen('diaban', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'chucnang');
        }
        $model=danhmuchanhchinh::findOrFail($id);
        $model->delete();
        return redirect('/dia_ban');
    }
}
