<?php

namespace App\Http\Controllers\danhmuc;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\dmnguoncauhoi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class dmnguoncauhoiController extends Controller
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
    public function index(){
        if (!chkPhanQuyen('dmnguoncauhoi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'nganhhoc');
        }
        $model=dmnguoncauhoi::all();
        return view('danhmuc.nguoncauhoi.index')
                ->with('model',$model)
                ->with('pageTitle','Danh mục nguồn câu hỏi');
    }
    public function store_update(Request $request)
	{		
		if (!chkPhanQuyen('dmnguoncauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dmnguoncauhoi');
        }
		$input = $request->all();
		if ($input['id'] != null) {
			dmnguoncauhoi::FindOrFail($input['id'])->update($input);
		}
		else{

			$input["madm"] = getdate()[0];
			dmnguoncauhoi::create($input);
		}
		return redirect('/NguonCauHoi/ThongTin')
                ->with('success','Thành công');
	}




    public function delete($id){
		if (!chkPhanQuyen('dmnguoncauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dmnguoncauhoi');
        }	
		$id_delete = dmnguoncauhoi::findOrFail($id);
        $id_delete->delete();
		return redirect('/NguonCauHoi/ThongTin')
                ->with('success','Xóa thành công');
    }



	public function edit($id)
	{		
		if (!chkPhanQuyen('dmnguoncauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dmnguoncauhoi');
        }	
        $model = dmnguoncauhoi::FindOrFail($id);	
		die($model);
	}
}
