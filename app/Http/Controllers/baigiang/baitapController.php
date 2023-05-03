<?php

namespace App\Http\Controllers\baigiang;

use App\Http\Controllers\Controller;
use App\Models\baigiang\baihoc;
use App\Models\baigiang\baitap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class baitapController extends Controller
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
        if (!chkPhanQuyen('baitap', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'baitap');
        }
        $model = baitap::all();
        $m_baihoc = baihoc::all();
        return view('baigiang.baitap.index')
            ->with('model', $model)
            ->with('m_baihoc', $m_baihoc)
            ->with('pageTitle', 'Bài tập');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('baitap', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'baitap');
        }
        $inputs = $request->all();
        $inputs['mabaitap'] = date('YmdHis');

        //file hình ảnh
        if (isset($inputs['anh'])) {
            $file = $inputs['anh'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/baitap/anh/', $name);
            $inputs['anh'] = 'uploads/baitap/anh/' . $name;
        }

        //file audio
        if (isset($inputs['audio'])) {
            $file = $inputs['audio'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/baitap/audio/', $name);
            $inputs['audio'] = 'uploads/baitap/audio/' . $name;
        }

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
// dd($inputs);
        baitap::create($inputs);
        return redirect('/BaiTap/ThongTin')
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
