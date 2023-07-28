<?php

namespace App\Http\Controllers\danhmuc;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\dmlophoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class dmlophocController extends Controller
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
    public function index(){
        if (!chkPhanQuyen('dmlophoc', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'dmlophoc');
        }
        $model=dmlophoc::all();
        return view('danhmuc.lophoc.index')
                ->with('model',$model)
                ->with('pageTitle','Danh mục lớp học');
    }
    public function store_update(Request $request)
	{		
		if (!chkPhanQuyen('dmlophoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dmlophoc');
        }
		$input = $request->all();
		if ($input['id'] != null) {
			dmlophoc::FindOrFail($input['id'])->update($input);
		}
		else{

			$input["malop"] = getdate()[0];
			dmlophoc::create($input);
		}
		return redirect('/dmLopHoc/ThongTin')
                ->with('success','Thành công');
	}




    public function delete($id){
		if (!chkPhanQuyen('dmlophoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dmlophoc');
        }	
		$id_delete = dmlophoc::findOrFail($id);
        $id_delete->delete();
		return redirect('/dmLopHoc/ThongTin')
                ->with('success','Xóa thành công');
    }



	public function edit($id)
	{		
		if (!chkPhanQuyen('dmlophoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dmlophoc');
        }	
        $model = dmlophoc::FindOrFail($id);	
		die($model);
	}
}
