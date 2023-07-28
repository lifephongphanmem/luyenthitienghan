<?php

namespace App\Http\Controllers\danhmuc;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\nganhhoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class dmnganhhocController extends Controller
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
        if (!chkPhanQuyen('nganhhoc', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'nganhhoc');
        }
        $model=nganhhoc::all();
        return view('danhmuc.nganhhoc.index')
                ->with('model',$model)
                ->with('pageTitle','Danh mục ngành học');
    }
    public function store_update(Request $request)
	{		
		if (!chkPhanQuyen('nganhhoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'nganhhoc');
        }
		$input = $request->all();
		if ($input['id'] != null) {
			nganhhoc::FindOrFail($input['id'])->update($input);
		}
		else{

			$input["manganh"] = getdate()[0];
			nganhhoc::create($input);
		}
		return redirect('/NganhHoc/ThongTin')
                ->with('success','Thành công');
	}




    public function delete($id){
		if (!chkPhanQuyen('nganhhoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'nganhhoc');
        }	
		$id_delete = nganhhoc::findOrFail($id);
        $id_delete->delete();
		return redirect('/NganhHoc/ThongTin')
                ->with('success','Xóa thành công');
    }



	public function edit($id)
	{		
		if (!chkPhanQuyen('nganhhoc', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'nganhhoc');
        }	
        $model = nganhhoc::FindOrFail($id);	
		die($model);
	}
}
