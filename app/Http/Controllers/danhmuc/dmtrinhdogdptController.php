<?php

namespace App\Http\Controllers\danhmuc;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\trinhdogdpt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class dmtrinhdogdptController extends Controller
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
		if (!chkPhanQuyen('trinhdogdpt', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'trinhdogdpt');
        }	
        $model = trinhdogdpt::all()->sortBy('stt');	
		$count = Count($model);		
		return view('danhmuc.trinhdogdpt.index',compact('model','count'))
        ->with('baocao',getdulieubaocao())
        ->with('pageTitle','Danh mục trình độ DGPT');
	}
    public function store_update(Request $request)
	{		
		if (!chkPhanQuyen('trinhdogdpt', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'trinhdogdpt');
        }	
		$input = $request->all();

		if ($input['id'] != null) {
			trinhdogdpt::FindOrFail($input['id'])->update($input);
		}
		else{

			$input["madm"] = getdate()[0];
			trinhdogdpt::create($input);
		}
		return redirect('/TrinhDoGDPT/ThongTin')
                ->with('success','Thành công');
	}

    public function edit($id)
	{		
		if (!chkPhanQuyen('trinhdogdpt', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'trinhdogdpt');
        }
        $model = trinhdogdpt::Find($id);	
		die($model);
	}

    public function delete($id){
		if (!chkPhanQuyen('trinhdogdpt', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'trinhdogdpt');
        }	
		$id_delete = trinhdogdpt::findOrFail($id);
        $model = trinhdogdpt::where('stt', '>=', $id_delete->stt)->get();
        if ($model != null) {
            foreach ($model as $item) {
                trinhdogdpt::Find($item->id)->update(['stt' => $item->stt - 1]);
            }
        }
        $id_delete->delete();
		return redirect('/TrinhDoGDPT/ThongTin')
        ->with('success','Xóa thành công');
    }
}
