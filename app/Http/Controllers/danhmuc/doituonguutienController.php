<?php

namespace App\Http\Controllers\danhmuc;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\doituonguutien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class doituonguutienController extends Controller
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
    public function index()
	{		
		if (!chkPhanQuyen('doituonguutien', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'doituonguutien');
        }
        $model = doituonguutien::all()->sortBy('stt');	
		$count = Count($model);			
		return view('danhmuc.doituonguutien.index',compact('model','count'))
        ->with('baocao',getdulieubaocao())
        ->with('pageTitle', 'Danh mục đối tượng ưu tiên');
	}


	public function store_update(Request $request)
	{		
		if (!chkPhanQuyen('doituonguutien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'doituonguutien');
        }
		$input = $request->all();
		if ($input['id'] != null) {
			doituonguutien::FindOrFail($input['id'])->update($input);
		}
		else{

			$input["madm"] = getdate()[0];
			doituonguutien::create($input);
		}
		return redirect('/DoiTuongUuTien/ThongTin')
                ->with('success','Thành công');
	}




    public function delete($id){
		if (!chkPhanQuyen('doituonguutien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'doituonguutien');
        }	
		$id_delete = doituonguutien::findOrFail($id);
        $model = doituonguutien::where('stt', '>=', $id_delete->stt)->get();
        if ($model != null) {
            foreach ($model as $item) {
                doituonguutien::Find($item->id)->update(['stt' => $item->stt - 1]);
            }
        }
        $id_delete->delete();
		return redirect('/DoiTuongUuTien/ThongTin')
                ->with('success','Xóa thành công');
    }



	public function edit($id)
	{		
		if (!chkPhanQuyen('doituonguutien', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'doituonguutien');
        }	
        $model = doituonguutien::FindOrFail($id);	
		die($model);
	}
}
