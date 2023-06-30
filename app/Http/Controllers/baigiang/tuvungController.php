<?php

namespace App\Http\Controllers\baigiang;

use App\Http\Controllers\Controller;
use App\Models\baigiang\baihoc;
use App\Models\baigiang\tuvung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Imports\ColectionImport;
use Maatwebsite\Excel\Facades\Excel;

class tuvungController extends Controller
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
        if (!chkPhanQuyen('tuvung', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tuvung');
        }
        $model = tuvung::all();
        $m_baihoc = baihoc::all();
        $a_cumtuvung = array_column($model->unique('cumtuvung')->toarray(), 'cumtuvung');
        return view('baigiang.tuvung.index')
            ->with('model', $model)
            ->with('m_baihoc', $m_baihoc)
            ->with('a_cumtuvung', $a_cumtuvung)
            ->with('pageTitle', 'Từ vựng');
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
        if (!chkPhanQuyen('tuvung', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tuvung');
        }
        $inputs = $request->all();
        $inputs['matuvung'] = date('YmdHis');

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

        //file hình ảnh
        // if (isset($inputs['hinhanh'])) {
        //     $file = $inputs['hinhanh'];
        //     $name = time() . $file->getClientOriginalName();
        //     $file->move('uploads/anh/tuvung/', $name);
        //     $inputs['hinhanh'] = 'uploads/anh/tuvung/' . $name;
        // }
        //file audio
        // if (isset($inputs['audio'])) {
        //     $file = $inputs['audio'];
        //     $name = time() . $file->getClientOriginalName();
        //     $file->move('uploads/audio/tuvung/', $name);
        //     $inputs['audio'] = 'uploads/audio/tuvung/' . $name;
        // }

        tuvung::create($inputs);

        return redirect('/TuVung/ThongTin')
                ->with('success','Thêm thành công');
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
    public function import(Request $request){
        if (!chkPhanQuyen('tuvung', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tuvung');
        }
        $inputs = $request->all();
        $dataObj = new ColectionImport();
        $theArray = Excel::toArray($dataObj, $inputs['file']);
        $arr = $theArray[0];
        $arr_col = array('tenbaihoc','cumtuvung','tutienghan', 'tiengviet');
        $nfield = sizeof($arr_col);
        // dd($arr);
        $baihoc = baihoc::where('mabaihoc', $inputs['tenbaihoc'])->first();
        if (!isset($baihoc)) {
            $inputs['mabaihoc'] = getdate()[0];
            $databaihoc = [
                'mabaihoc' => $inputs['mabaihoc'],
                'tenbaihoc' => $inputs['tenbaihoc']
            ];
            baihoc::create($databaihoc);
            $mabaihoc=$inputs['mabaihoc'];
        } else {
            $mabaihoc = $baihoc->mabaihoc;
        }
        for ($i = 1; $i < count($arr); $i++) {
            $data = array();
            $data['matuvung'] = date('YmdHis') . $i;

            for ($j = 0; $j < $nfield; $j++) {
                $data[$arr_col[$j]] = $arr[$i][$j];
            }
            $data['mabaihoc']=$mabaihoc;
            unset($data['tenbaihoc']);
            tuvung::create($data);
        }

        return redirect('/TuVung/ThongTin')
                    ->with('success','Thêm thành công');
    }
}
