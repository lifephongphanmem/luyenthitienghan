<?php

namespace App\Http\Controllers\baigiang;

use App\Http\Controllers\Controller;
use App\Models\baigiang\baihoc;
use App\Models\baigiang\baitap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Imports\ColectionImport;
use App\Models\danhmuc\loaicauhoi;
use Maatwebsite\Excel\Facades\Excel;

class baitapController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!chkPhanQuyen('baitap', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'baitap');
        }
        $inputs=$request->all();
        $m_baihoc = baihoc::all();
        $inputs['mabaihoc']=$inputs['mabaihoc']??$m_baihoc->first()->mabaihoc;
        $model=baitap::join('baihoc','baihoc.mabaihoc','baitap.mabaihoc')
                        ->select('baitap.*')
                        ->where('baihoc.mabaihoc',$inputs['mabaihoc'])
                        ->get();
                        $inputs['url']='/BaiTap/ThongTin';
        return view('baigiang.baitap.index')
            ->with('model', $model)
            ->with('baocao',getdulieubaocao())
            ->with('m_baihoc', $m_baihoc)
            ->with('inputs',$inputs)
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
    public function import(Request $request){
        if (!chkPhanQuyen('baitap', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tuvung');
        }
        $inputs = $request->all();
        $dataObj = new ColectionImport();
        $theArray = Excel::toArray($dataObj, $inputs['file']);
        $arr = $theArray[0];
        // $arr_col = array('tenbaihoc','cauhoi','noidung','hoithoai1','hoithoai2','hoithoai3','hoithoai4','anh','audio','A','B','C','D','dapan');
        $arr_col = array('tenbaihoc', 'cauhoi', 'noidung','hoithoai1','hoithoai2','hoithoai3','hoithoai4','anh','audio','A','B','C','D','dapan','dangcauhoi','loaidapan1','phanloai','dangcaudochieu','loaidapan','dangcau');
        $nfield = sizeof($arr_col);
        // dd($arr);
        for ($i = 1; $i < count($arr); $i++) {
            $data = array();
            $data['mabaitap'] = date('YmdHis') . $i;

            for ($j = 0; $j < $nfield; $j++) {
                $data[$arr_col[$j]] = $arr[$i][$j];
            }
            $baihoc = baihoc::where('mabaihoc', $inputs['tenbaihoc'])->first();
            // dd($data);
            if (!isset($baihoc)) {
                $inputs['mabaihoc'] = getdate()[0];
                $databaihoc = [
                    'mabaihoc' => $inputs['mabaihoc'],
                    'tenbaihoc' => $inputs['tenbaihoc'],
                ];
                baihoc::create($databaihoc);
            } else {
                $data['mabaihoc'] = $baihoc->mabaihoc;
            }
            unset($data['tenbaihoc']);
            baitap::create($data);
        }

        return redirect('/BaiTap/ThongTin')
                    ->with('success','Thêm thành công');
    }
}
