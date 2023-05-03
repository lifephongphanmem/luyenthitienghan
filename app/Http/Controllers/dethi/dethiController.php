<?php

namespace App\Http\Controllers\dethi;

use App\Http\Controllers\Controller;
use App\Models\dethi\cauhoi;
use App\Models\dethi\cauhoi_dethi;
use App\Models\dethi\dethi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class dethiController extends Controller
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
        if (!chkPhanQuyen('dethi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }
        $model=dethi::all();
        foreach($model as $ct){
        $ct->socauhoi=cauhoi::join('cauhoi_dethi','cauhoi_dethi.macauhoi','cauhoi.macauhoi')
                                ->where('cauhoi_dethi.made',$ct->made)
                                ->count();
        }
        return  view('dethi.dethi.index')
                    ->with('model',$model)
                    ->with('pageTitle','Quản lý đề thi');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('dethi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }
        $inputs=$request->all();
        $inputs['made']=getdate()[0];
        $model=dethi::where('tende','like','%'.$inputs['tende'].'%')->first();
        if(isset($model)){
            return redirect('/DeThi/ThongTin')
                    ->with('error','Đề thi đã tồn tại');
        }else{
            dethi::create($inputs);
            return redirect('/DeThi/ThongTin')
                        ->with('success','Thêm mới thành công');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if (!chkPhanQuyen('dethi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }
        $inputs=$request->all();
        $model=dethi::where('made',$id)->first();
        $m_cauhoi=cauhoi::join('cauhoi_dethi','cauhoi_dethi.macauhoi','cauhoi.macauhoi')
                            ->where('cauhoi_dethi.made',$model->made)
                            ->get();
        $a_dethi=array_column(dethi::all()->toarray(),'tende','made');

        $a_cauhoi=array_column($m_cauhoi->toarray(),'macauhoi');
        $m_cauhoi_khac=cauhoi::wherenotin('macauhoi',$a_cauhoi)->get();               
        if(isset($inputs['made'])){
            $inputs['url']='/DeThi/ChiTiet/'.$inputs['made'];
        }else{
            $inputs['url']='/DeThi/ChiTiet/'.$id;
        }
        $inputs['made']=$inputs['made']??$id;
        return view('dethi.dethi.chitiet')
                    ->with('model',$model)
                    ->with('m_cauhoi',$m_cauhoi)
                    ->with('a_dethi',$a_dethi)
                    ->with('a_cauhoi',$a_cauhoi)
                    ->with('m_cauhoi_khac',$m_cauhoi_khac)
                    ->with('inputs',$inputs)
                    ->with('pageTitle','Chi tiết đề thi');
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
        if (!chkPhanQuyen('dethi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }

        $inputs=$request->all();
        $model=dethi::where('made',$id)->first();
        if(isset($model)){
            $model->update($inputs);
        }

        return redirect('/DeThi/ThongTin')
                        ->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('dethi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }

        $model=dethi::where('made',$id)->first();
        if(isset($model)){
            $model->delete();
        }
        return redirect('/DeThi/ThongTin')
                        ->with('success','Xóa thành công');
    }

    public function themcauhoi(Request $request){
        if (!chkPhanQuyen('dethi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }

        $inputs=$request->all();
        foreach($inputs['macauhoi'] as $ct){
            $data=[
                'made'=>$inputs['made'],
                'macauhoi'=>$ct
            ];

            cauhoi_dethi::create($data);
        }
        $mes='Thêm thành công'.count($inputs['macauhoi']).'câu hỏi';
        return redirect('/DeThi/ChiTiet/'.$inputs['made'])
                ->with('success',$mes);

    }


}
