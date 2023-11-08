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
    public function index(Request $request)
    {
        if (!chkPhanQuyen('tuvung', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'tuvung');
        }
        $inputs=$request->all();

        $m_baihoc = baihoc::all();
        $inputs['mabaihoc']=$inputs['mabaihoc']??$m_baihoc->first()->mabaihoc;
        $model = tuvung::join('baihoc','baihoc.mabaihoc','tuvung.mabaihoc')
        ->select('tuvung.*')
        ->where('baihoc.mabaihoc',$inputs['mabaihoc'])
        ->get();
        $a_cumtuvung = array_column($model->unique('cumtuvung')->sortBy('cumtuvung')->toarray(), 'cumtuvung');
        $inputs['url']='/TuVung/ThongTin';
        return view('baigiang.tuvung.index')
            ->with('model', $model)
            ->with('baocao',getdulieubaocao())
            ->with('m_baihoc', $m_baihoc)
            ->with('inputs',$inputs)
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
        loghethong(getIP(),session('admin'),'them','tuvung');
        return redirect('/TuVung/ThongTin?mabaihoc=' . $inputs['mabaihoc'])
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
        if (!chkPhanQuyen('tuvung', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tuvung');
        }
        $inputs=$request->all();
        $model=tuvung::findOrFail($id);
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

        if(isset($model)){
            $model->update($inputs);
            loghethong(getIP(),session('admin'),'capnhat','tuvung');
        }

        return redirect('/TuVung/ThongTin?mabaihoc=' . $inputs['mabaihoc'])->with('success','Cập nhật thành công');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = tuvung::where('id', $id)->first();
        $mabaihoc = $model->mabaihoc;
        if (isset($model)) {
            $model->delete();
            loghethong(getIP(), session('admin'), 'xoa', 'tuvung');
        }
        return redirect('/TuVung/ThongTin?mabaihoc=' . $mabaihoc)->with('success', 'Xóa thành công');
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
        loghethong(getIP(),session('admin'),'excel','tuvung');
        return redirect('/TuVung/ThongTin')
                    ->with('success','Thêm thành công');
    }
}
