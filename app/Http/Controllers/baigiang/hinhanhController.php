<?php

namespace App\Http\Controllers\baigiang;

use App\Http\Controllers\Controller;
use App\Models\baigiang\baihoc;
use App\Models\baigiang\hinhanh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class hinhanhController extends Controller
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
        if (!chkPhanQuyen('hinhanh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'hinhanh');
        }
        $model=hinhanh::all();
        $m_baihoc = baihoc::all();
        return view('baigiang.hinhanh.index')
                    ->with('model',$model)
                    ->with('m_baihoc',$m_baihoc)
                    ->with('pageTitle','Hình ảnh bài giảng');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('hinhanh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'hinhanh');
        }
        $inputs=$request->all();
        $inputs['mahinhanh']=date('YmdHis');

                //file hình ảnh
                if (isset($inputs['hinhanh'])) {
                    $file = $inputs['hinhanh'];
                    $name = time() . $file->getClientOriginalName();
                    $file->move('uploads/hinhanh/anh/', $name);
                    $inputs['hinhanh'] = 'uploads/hinhanh/anh/' . $name;
                }

                        //file audio
        if (isset($inputs['audio'])) {
            $file = $inputs['audio'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/hinhanh/audio/', $name);
            $inputs['audio'] = 'uploads/hinhanh/audio/' . $name;
        }

        $baihoc=baihoc::where('mabaihoc',$inputs['tenbaihoc'])->first();
        if(!isset($baihoc)){
            $inputs['mabaihoc']=getdate()[0];
            $data=[
                'mabaihoc'=>$inputs['mabaihoc'],
                'tenbaihoc'=>$inputs['tenbaihoc'],
            ];
            baihoc::create($data);
        }else{
            $inputs['mabaihoc']=$baihoc->mabaihoc;
        }

        hinhanh::create($inputs);

        return redirect('/HinhAnh/ThongTin')
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
