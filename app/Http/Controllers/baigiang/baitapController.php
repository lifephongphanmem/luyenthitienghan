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
use Illuminate\Support\Facades\File;

class baitapController extends Controller
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
        if (!chkPhanQuyen('baitap', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'baitap');
        }
        $inputs = $request->all();
        $m_baihoc = baihoc::all();
        $inputs['mabaihoc'] = $inputs['mabaihoc'] ?? $m_baihoc->first()->mabaihoc;
        $model = baitap::join('baihoc', 'baihoc.mabaihoc', 'baitap.mabaihoc')
            ->select('baitap.*')
            ->where('baihoc.mabaihoc', $inputs['mabaihoc'])
            ->get();
        $inputs['url'] = '/BaiTap/ThongTin';
        return view('baigiang.baitap.index')
            ->with('model', $model)
            ->with('baocao', getdulieubaocao())
            ->with('m_baihoc', $m_baihoc)
            ->with('inputs', $inputs)
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

        if ($inputs['loaidapan'] == 2) {
            $arr = ['A', 'B', 'C', 'D'];
            foreach ($arr as $da) {
                if (isset($item[$da])) {
                    $file = $item[$da];
                    $name = time() . $file->getClientOriginalName();
                    $file->move('uploads/baitap/dapan/anh/', $name);
                    $item[$da] = 'uploads/baitap/dapan/anh/' . $name;
                }
            }
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

        baitap::create($inputs);
        loghethong(getIP(), session('admin'), 'them', 'baitap');
        return redirect('/BaiTap/ThongTin?mabaihoc=' . $inputs['mabaihoc'])
            ->with('success', 'Thêm mới thành công');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!chkPhanQuyen('baitap', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'baitap');
        }
        $inputs = $request->all();
        // dd($inputs);
        $model = baitap::where('mabaitap', $id)->first();

        //file hình ảnh
        if (isset($inputs['anh'])) {
            if (File::exists($model->anh)) {
                File::Delete($model->anh);
            }
            $file = $inputs['anh'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/baitap/anh/', $name);
            $inputs['anh'] = 'uploads/baitap/anh/' . $name;
        };

        //file audio
        if (isset($inputs['audio'])) {
            if (File::exists($model->audio)) {
                File::Delete($model->audio);
            }
            $file = $inputs['audio'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/baitap/audio/', $name);
            $inputs['audio'] = 'uploads/baitap/audio/' . $name;
        };

        if ($inputs['loaidapan'] == 2) {
            $arr = ['A', 'B', 'C', 'D'];
            foreach ($arr as $da) {
                if (isset($inputs[$da])) {
                    if (File::exists($model->da)) {
                        File::Delete($model->da);
                    }
                    $file = $inputs[$da];
                    $name = time() . $file->getClientOriginalName();
                    $file->move('uploads/baitap/dapan/anh/', $name);
                    $inputs[$da] = 'uploads/baitap/dapan/anh/' . $name;
                }
            }
        };
        if (isset($model)) {
            $model->update($inputs);
            loghethong(getIP(), session('admin'), 'capnhat', 'baitap');
        }

        return redirect('/BaiTap/ThongTin?mabaihoc=' . $model->mabaihoc)
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('baitap', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'baitap');
        }
        $model = baitap::where('mabaitap', $id)->first();
        $mabaihoc = $model->mabaihoc;
        if (isset($model)) {
            if (File::exists($model->anh)) {
                File::Delete($model->anh);
            }
            if (File::exists($model->audio)) {
                File::Delete($model->audio);
            }
            if (File::exists($model->A)) {
                File::Delete($model->A);
            }
            if (File::exists($model->B)) {
                File::Delete($model->B);
            }
            if (File::exists($model->C)) {
                File::Delete($model->C);
            }
            if (File::exists($model->D)) {
                File::Delete($model->D);
            }
            $model->delete();
            loghethong(getIP(), session('admin'), 'xoa', 'baitap');
        }
        return redirect('/BaiTap/ThongTin?mabaihoc=' . $mabaihoc)->with('success', 'Xóa thành công');
    }
    public function import(Request $request)
    {
        if (!chkPhanQuyen('baitap', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'baitap');
        }
        $inputs = $request->all();
        $dataObj = new ColectionImport();
        $theArray = Excel::toArray($dataObj, $inputs['file']);
        $arr = $theArray[0];
        // $arr_col = array('tenbaihoc','cauhoi','noidung','hoithoai1','hoithoai2','hoithoai3','hoithoai4','anh','audio','A','B','C','D','dapan');
        $arr_col = array('tenbaihoc', 'cauhoi', 'noidung', 'hoithoai1', 'hoithoai2', 'hoithoai3', 'hoithoai4', 'anh', 'audio', 'A', 'B', 'C', 'D', 'dapan', 'dangcauhoi', 'loaidapan1', 'phanloai', 'dangcaudochieu', 'loaidapan', 'dangcau');
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
        loghethong(getIP(), session('admin'), 'excel', 'baitap');

        return redirect('/BaiTap/ThongTin')
            ->with('success', 'Thêm thành công');
    }

    public function edit($mabaitap)
    {
        if (!chkPhanQuyen('baitap', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'baitap');
        }
        $model = baitap::where('mabaitap', $mabaitap)->first();
        $m_baihoc = baihoc::all();

        $html = '';
        $html = '<div class="row" id="baitap">';
        $html .= '<div class="col-md-6 mt-2">';
        $html .= '<label class="control-label">Tên bài học<span class="require">*</span></label>';
        $html .= '<select name="tenbaihoc" id="tenbaihoc_edit_select" class="form-control">';
        foreach ($m_baihoc as $key => $ct) {
            $html .= '<option value="' . $ct->mabaihoc . '" ' . ($model->mabaihoc == $ct->mabaihoc ? "selected" : "") . '>' . $ct->tenbaihoc . '</option>';
        }
        $html .= '</select>';
        $html .= '</div>';
        $html .= '<div class="col-md-1 mt-10" style="padding-left: 0px;">';
        $html .= '<label class="control-label">&nbsp;&nbsp;&nbsp;</label>';
        $html .= '<button type="button" class="btn btn-default" data-target="#modal-tenbaihoc-edit" data-toggle="modal">
            <i class="fa fa-plus"></i></button>';
        $html .= '</div>';
        $html .= '<div class="col-md-4 mt-2">';
        $html .= '<label class="control-label">Câu hội thoại/không<span class="require">*</span></label>';
        $html .= '<select name="hoithoai" class="form-control" id="hoithoai_edit">';
        $html .= '<option value="0">Không hội thoại</option>';
        $html .= '<option value="1">Câu hội thoại</option>';
        $html .= '</select>';
        $html .= '</div>';
        $html .= '<div id="cauhoithoai_edit" style="width:100%">';
        if ($model->hoithoai1 == null) {
            $html .= '<div class="col-md-12 mt-2" id="noidung_edit">';
            $html .= '<label class="control-label">Nội dung</label>';
            $html .= '<textarea name="noidung" id="noidungcau" rows="5" class="form-control">'.$model->noidung.'</textarea>';
            $html .= '</div>';
        } else {
            $html .= '<div id="noidung_edit">';
            $html .= '<div class="row mt-2">';
            $html .= '<div class="col-md-6 mt-2">';

            $html .= '<label class="control-label">Hội thoại 1</label>';
            $html .= '<input type="text" name="hoithoai1" class="form-control">';
            $html .= '</div>';
            $html .= '<div class="col-md-6 mt-2">';
            $html .= '<label class="control-label">Hội thoại 2</label>';
            $html .= '<input type="text" name="hoithoai2" class="form-control">';
            $html .= '</div>';
            $html .= '<div class="col-md-6 mt-2">';
            $html .= '<label class="control-label">Hội thoại 3</label>';
            $html .= '<input type="text" name="hoithoai3" class="form-control">';
            $html .= '</div>';
            $html .= '<div class="col-md-6 mt-2">';
            $html .= '<label class="control-label">Hội thoại 4</label>';
            $html .= '<input type="text" name="hoithoai4" class="form-control">';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
        $html .= '</div>';
        $html .= '<div class="col-md-12 mt-2">';
        $html .= '<label class="control-label">Câu hỏi</label>';
        $html .= '<input type="text" name="cauhoi" value="' . $model->cauhoi . '" class="form-control">';
        $html .= '</div>';


        $html .= '<div class="col-md-4 mt-2">';
        $html .= '<label class="control-label">Ảnh</label>';
        $html .= '<input type="file" name="anh" class="form-control" accept=".jpg,.png">';
        $html .= '</div>';
        $html .= '<div class="col-md-4 mt-2">';
        $html .= '<label class="control-label">Audio</label>';
        $html .= '<input type="file" name="audio" class="form-control" accept=".mp3,.m4a">';
        $html .= '</div>';

        $html .= '<div class="col-md-4 mt-2">';
        $html .= '<label class="control-label">Loại đáp án</label>';
        $html .= '<select name="loaidapan" class="form-control " id="loaidapan_edit">';
        $html .= '<option value="1" ' . ($model->loaidapan == 1 ? "selected" : "") . '>Text</option>';
        $html .= '<option value="2" ' . ($model->loaidapan == 2 ? "selected" : "") . '>Hình ảnh</option>';
        $html .= '</select>';
        $html .= '</div>';
        $html .= '<div class=" row ml-1" id="dapan_edit" style="width:100%">';
        if ($model->loaidapan == 1) {
            $html .= '<div class="col-xl-3 mt-2" id="A">';
            $html .= '<label class="control-label">Đáp án 1</label>';
            $html .= '<input type="text" name="A" value="' . $model->A . '" class="form-control">';
            $html .= '</div>';
            $html .= '<div class="col-xl-3 mt-2" id="B">';
            $html .= '<label class="control-label">Đáp án 2</label>';
            $html .= '<input type="text" name="B" value="' . $model->B . '" class="form-control">';
            $html .= '</div>';
            $html .= '<div class="col-xl-3 mt-2" id="C">';
            $html .= '<label class="control-label ">Đáp án 3</label>';
            $html .= '<input type="text" name="C" value="' . $model->C . '" class="form-control">';
            $html .= '</div>';
            $html .= '<div class="col-xl-3 mt-2" id="D">';
            $html .= '<label class="control-label ">Đáp án 4</label>';
            $html .= '<input type="text" name="D" value="' . $model->D . '" class="form-control">';
            $html .= '</div>';
        } else {

            $html .= '<div class="col-xl-3 mt-2" id="A">';
            $html .= '<label class="control-label ">Đáp án 1</label>';
            $html .= '<input type="file" name="A" class="form-control" accept=".jpg,.png">';
            $html .= '</div>';
            $html .= '<div class="col-xl-3 mt-2" id="B">';
            $html .= '<label class="control-label ">Đáp án 2</label>';
            $html .= '<input type="file" name="B" class="form-control" accept=".jpg,.png">';
            $html .= '</div>';
            $html .= '<div class="col-xl-3 mt-2" id="C">';
            $html .= '<label class="control-label ">Đáp án 3</label>';
            $html .= '<input type="file" name="C" class="form-control" accept=".jpg,.png">';
            $html .= '</div>';
            $html .= '<div class="col-xl-3 mt-2" id="D">';
            $html .= '<label class="control-label ">Đáp án 4</label>';
            $html .= '<input type="file" name="D" class="form-control" accept=".jpg,.png">';
            $html .= '</div>';
        }
        $html .= '</div>';
        $html .= '<div class="col-md-12 mt-2">';
        $html .= '<label class="control-label">Đáp án đúng</label>';
        $html .= '<select name="dapan" class="form-control">';
        $html .= '<option value="A" ' . ($model->dapan == "A" ? "selected" : "") . '>1</option>';
        $html .= '<option value="B" ' . ($model->dapan == "B" ? "selected" : "") . '>2</option>';
        $html .= '<option value="C" ' . ($model->dapan == "C" ? "selected" : "") . '>3</option>';
        $html .= '<option value="D" ' . ($model->dapan == "D" ? "selected" : "") . '>4</option>';
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';

        return response()->json($html);
    }
}
