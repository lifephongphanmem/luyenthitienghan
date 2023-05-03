<?php

namespace App\Http\Controllers\baigiang;

use App\Http\Controllers\Controller;
use App\Models\baigiang\baihoc;
use App\Models\baigiang\tracnghiem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class tracnghiemController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!chkPhanQuyen('tracnghiem', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tracnghiem');
        }
        $model=tracnghiem::all();
        $m_baihoc = baihoc::all();
        return view('baigiang.tracnghiem.index')
                    ->with('model',$model)
                    ->with('m_baihoc',$m_baihoc)
                    ->with('pageTitle','Quản lý câu trắc nghiệm');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('tracnghiem', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tracnghiem');
        }
        $inputs=$request->all();
        $inputs['matracnghiem'] = date('YmdHis');

        $baihoc = baihoc::where('mabaihoc', $inputs['tenbaihoc'])->first();
        if (!isset($baihoc)) {
            $inputs['mabaihoc'] = getdate()[0];
            $data = [
                'mabaihoc' => $inputs['mabaihoc'],
                'tenbaihoc' => $inputs['tenbaihoc'],
            ];
            baihoc::create($data);
        } else {
            $inputs['mabaihoc'] = $baihoc->mabaihoc;
        }

        tracnghiem::create($inputs);

        return redirect('/TracNghiem/ThongTin')
                ->with('success','Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!chkPhanQuyen('tracnghiem', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tracnghiem');
        }
        $inputs=$request->all();

        $model=tracnghiem::where('matracnghiem',$id)->first();
        if(isset($model)){
            $model->update($inputs);
        }

        return redirect('/TracNghiem/ThongTin')
                    ->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('tracnghiem', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tracnghiem');
        }
        $model=tracnghiem::where('matracnghiem',$id)->first();
        if(isset($model)){
            $model->delete();
        }

        return redirect('/TracNghiem/ThongTin')
                    ->with('success','Xóa thành công');
    }
}
