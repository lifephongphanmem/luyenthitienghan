<?php

namespace App\Http\Controllers\danhmuc;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\dmtrinhdocmkt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class dmtrinhdocmktController extends Controller
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
		if (!chkPhanQuyen('trinhdocmkt', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'trinhdocmkt');
        }
        $model = dmtrinhdocmkt::all()->sortBy('stt');	
		$count = Count($model);		
		return view('danhmuc.trinhdocmkt.index',compact('model','count'))
        ->with('pageTitle', 'Danh mục trình độ chuyên môn kỹ thuật');
	}

    public function store_update(Request $request)
	{		
		if (!chkPhanQuyen('trinhdocmkt', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'trinhdocmkt');
        }
		$input = $request->all();

		if ($input['id'] != null) {
			dmtrinhdocmkt::FindOrFail($input['id'])->update($input);
		}
		else{
			$input['madm'] = getdate()[0];
			dmtrinhdocmkt::create($input);
		}
		return redirect('/TrinhDoCMKT/ThongTin')
                ->with('success','Thành công');
	}


    public function delete($id){	
		if (!chkPhanQuyen('trinhdocmkt', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'trinhdocmkt');
        }
		$id_delete = dmtrinhdocmkt::findOrFail($id);
        $model = dmtrinhdocmkt::where('stt', '>=', $id_delete->stt)->get();
        if ($model != null) {
            foreach ($model as $item) {
                dmtrinhdocmkt::Find($item->id)->update(['stt' => $item->stt - 1]);
            }
        }
        $id_delete->delete();
		return redirect('/TrinhDoCMKT/ThongTin')
                    ->with('success','Xóa thành công');
    }


	public function edit($id)
	{		
		if (!chkPhanQuyen('trinhdocmkt', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'trinhdocmkt');
        }
        $model = dmtrinhdocmkt::Find($id);	
		die($model);
	}
}
