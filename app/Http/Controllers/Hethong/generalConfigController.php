<?php

namespace App\Http\Controllers\Hethong;

use App\Http\Controllers\Controller;
use App\Models\Hethong\generalCOnfig;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class generalConfigController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin') && !chksession()) {
                return redirect('/DangNhap');
            };
            if (!chksession()) {
                return redirect('/DangNhap');
            };
            chkaction();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!chkPhanQuyen('generalconfig', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'generalconfig');
        }
        $model=generalCOnfig::first();

        return view('Hethong.general_config.index')
                    ->with('model',$model)
                    ->with('baocao',getdulieubaocao())
                    ->with('pageTitle', 'Thiết lập');
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
        //
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
    public function update(Request $request)
    {
        if (!chkPhanQuyen('generalconfig', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'generalconfig');
        }
        $inputs=$request->all();
        $model=generalCOnfig::first();
        if(isset($model)){
            $model->update($inputs);
        }
        return redirect('/generalconfig/ThongTin')
                    ->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
