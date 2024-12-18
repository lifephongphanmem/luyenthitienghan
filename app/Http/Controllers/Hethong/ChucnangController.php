<?php

namespace App\Http\Controllers\Hethong;

use App\Http\Controllers\Controller;
use App\Models\Hethong\Chucnang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChucnangController extends Controller
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
    public function index()
    {
        // if (!chkPhanQuyen('chucnang', 'danhsach')) {
        //     return view('errors.noperm')->with('machucnang', 'chucnang');
        // }
        $model=Chucnang::orderBy('id','DESC')->get();
        // foreach($model as $value){
        //     $m_cn=$model->where('parent',1);
        //     dd($m_cn);
        // }
        return view('Hethong.chucnang.index')
        // ->with('baocao', getdulieubaocao())
                ->with('model',$model)
                ->with('baocao',getdulieubaocao())
                ->with('pageTitle','Quản lý chức năng tài khoản');
    }

    public function store(Request $request)
    {
        if (!chkPhanQuyen('chucnang', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'chucnang');
        }
        $inputs=$request->all();
        $inputs['parent'] = isset($inputs['parent'])?$inputs['parent']:0;
        if($inputs['edit'] == null){
            Chucnang::create($inputs);
            loghethong(getIP(),session('admin'),'them','chucnang');
        }else{
            $id=$inputs['edit'];
            $model=Chucnang::findOrFail($id);
                $model_cd2=Chucnang::where('parent',$model->id)->get();
                if(isset($model_cd2)){
                    foreach($model_cd2 as $value){
                        $value->update(['trangthai'=>$inputs['trangthai']]);
                    }
                }
                $a_id_cd2=array_column($model_cd2->toarray(),'id');
                $model_cd3=Chucnang::wherein('parent',$a_id_cd2)->get();
                if(isset($model_cd3)){
                    foreach($model_cd3 as $value){   
                        $value->update(['trangthai'=>$inputs['trangthai']]);
                    }
                }

            $model->update($inputs);
            loghethong(getIP(),session('admin'),'capnhat','chucnang');
        }

        return redirect('/Chuc_nang/ThongTin');
    }

    public function edit($id)
    {
        // if (!chkPhanQuyen('chucnang', 'thaydoi')) {
        //     return view('errors.noperm')->with('machucnang', 'chucnang');
        // }
        $model=Chucnang::findOrFail($id);
        return response()->json($model);
    }

    public function destroy($id)
    {
        // if (!chkPhanQuyen('chucnang', 'thaydoi')) {
        //     return view('errors.noperm')->with('machucnang', 'chucnang');
        // }
        $model=Chucnang::findOrFail($id);
        $m_model=Chucnang::where('parent',$model->id)->get();
        if(isset($m_model)){
            foreach ($m_model as $value){
                $value->delete();
            }
            loghethong(getIP(),session('admin'),'xoa','chucnang');
        }
        $model->delete();
        return redirect('/Chuc_nang/ThongTin');
    }
}
