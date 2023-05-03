<?php

namespace App\Http\Controllers\dethi;

use App\Http\Controllers\Controller;
use App\Models\dethi\cauhoi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class cauhoiController extends Controller
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
        if (!chkPhanQuyen('cauhoi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'cauhoi');
        }
        $model = cauhoi::all();
        return view('dethi.cauhoi.index')
            ->with('model', $model)
            ->with('pageTitle', 'Quản lý câu hỏi');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('cauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'cauhoi');
        }

        $inputs = $request->all();
        $inputs['macauhoi']=getdate()[0];

        //file hình ảnh
        if (isset($inputs['anh'])) {
            $file = $inputs['anh'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/cauhoi/anh/', $name);
            $inputs['anh'] = 'uploads/cauhoi/anh/' . $name;
        }

        //file audio
        if (isset($inputs['audio'])) {
            $file = $inputs['audio'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/cauhoi/audio/', $name);
            $inputs['audio'] = 'uploads/cauhoi/audio/' . $name;
        }

        //Đáp án

        if($inputs['loaidapan'] == 2){
            $arr=['A','B','C','D'];
            foreach($arr as $ct){
            if (isset($inputs[$ct])) {
                $file = $inputs[$ct];
                $name = time() . $file->getClientOriginalName();
                $file->move('uploads/cauhoi/dapan/anh/', $name);
                $inputs[$ct] = 'uploads/cauhoi/dapan/anh/' . $name;
            }
        }
        }
        cauhoi::create($inputs);

        return redirect('/CauHoi/ThongTin')
                    ->with('success','Thêm câu hỏi thành công');
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
