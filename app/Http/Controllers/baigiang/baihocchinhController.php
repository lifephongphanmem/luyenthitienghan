<?php

namespace App\Http\Controllers\baigiang;

use App\Http\Controllers\Controller;
use App\Models\baigiang\baihoc;
use App\Models\baigiang\baihocchinh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Imports\ColectionImport;
use Maatwebsite\Excel\Facades\Excel;

class baihocchinhController extends Controller
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
        if (!chkPhanQuyen('baihocchinh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'baihocchinh');
        }
        $model = baihocchinh::join('baihoc', 'baihoc.mabaihoc', 'baihocchinh.mabaihoc')
            ->select('baihoc.tenbaihoc', 'baihocchinh.*')
            ->get();
        // dd($model);
        $m_baihoc = baihoc::all();
        $stt = baihocchinh::max('stt');


        return view('baigiang.baihocchinh.index')
            ->with('model', $model)
            ->with('stt', $stt ?? 0)
            ->with('m_baihoc', $m_baihoc)
            ->with('pageTitle', 'Bài học chính');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('baihocchinh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'baihocchinh');
        }
        $inputs = $request->all();
        $inputs['mabaihocchinh'] = date('YmdHis');

        //file hình ảnh
        if (isset($inputs['anh'])) {
            $file = $inputs['anh'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/anh/', $name);
            $inputs['anh'] = 'uploads/anh/' . $name;
        }

        //file ảnh 2
        if (isset($inputs['anh2'])) {
            $file = $inputs['anh2'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/anh2/', $name);
            $inputs['anh2'] = 'uploads/anh2/' . $name;
        }

        //file audio
        if (isset($inputs['audio'])) {
            $file = $inputs['audio'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/audio/', $name);
            $inputs['audio'] = 'uploads/audio/' . $name;
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

        baihocchinh::create($inputs);

        return redirect('/BaiHocChinh/ThongTin')
            ->with('success', 'Thêm mới thành công');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('baihocchinh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'baihocchinh');
        }
        $model = baihocchinh::findOrFail($id);
        if (isset($model)) {
            if ($model->anh != null) {
                if (File::exists($model->anh)) {
                    File::Delete($model->anh);
                }
            }
            if ($model->audio != null) {
                if (File::exists($model->audio)) {
                    File::Delete($model->audio);
                }
            }
            if ($model->anh2 != null) {
                if (File::exists($model->anh2)) {
                    File::Delete($model->anh2);
                }
            }
            $model->delete();
        }
        return redirect('/BaiHocChinh/ThongTin')
            ->with('success', 'Xóa thành công');
    }

    public function import(Request $request)
    {
        if (!chkPhanQuyen('baihocchinh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'baihocchinh');
        }

        $inputs = $request->all();
        $dataObj = new ColectionImport();
        $theArray = Excel::toArray($dataObj, $inputs['file']);
        $arr = $theArray[0];
        $arr_col = array('tenbaihoc', 'audio', 'anh', 'anh2');
        $nfield = sizeof($arr_col);
        // dd($arr);
        for ($i = 1; $i < count($arr); $i++) {
            $data = array();
            $data['mabaihocchinh'] = date('YmdHis') . $i;

            for ($j = 0; $j < $nfield; $j++) {
                $data[$arr_col[$j]] = $arr[$i][$j];
            }
            $baihoc = baihoc::where('mabaihoc', $inputs['tenbaihoc'])->first();
            if (!isset($baihoc)) {
                $inputs['mabaihoc'] = getdate()[0];
                $databaihoc = [
                    'mabaihoc' => $inputs['mabaihoc'],
                    'tenbaihoc' => $inputs['tenbaihoc'],
                ];
                baihoc::create($databaihoc);
                $data['stt']=$i;
            } else {
                $data['mabaihoc'] = $baihoc->mabaihoc;
                $stt=baihocchinh::where('mabaihoc',$inputs['tenbaihoc'])->max('stt');
                $data['stt']=++$stt;
            }
            unset($data['tenbaihoc']);
            baihocchinh::create($data);
        }

       return redirect('/BaiHocChinh/ThongTin')
                ->with('success','Thêm thành công');
    }
}
