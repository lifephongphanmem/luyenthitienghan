<?php

namespace App\Http\Controllers\dethi;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\dmnguoncauhoi;
use App\Models\danhmuc\loaicauhoi;
use App\Models\danhmuc\loaicauhoict;
use App\Models\dethi\cauhoi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Imports\ColectionImport;
use Maatwebsite\Excel\Facades\Excel;

class cauhoiController extends Controller
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
        if (!chkPhanQuyen('quanlycauhoi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'quanlycauhoi');
        }
        $inputs = $request->all();
        $nguoncauhoi = dmnguoncauhoi::all();
        $loaicauhoi = loaicauhoi::all();
        $madm = loaicauhoi::select('madm')->first()->madm;
        $inputs['madm'] = isset($inputs['madm']) ? $inputs['madm'] : $madm;
        $inputs['dangcau'] = isset($inputs['dangcau']) ? $inputs['dangcau'] : 1;
        $inputs['nguoncauhoi'] = isset($inputs['nguoncauhoi']) ? $inputs['nguoncauhoi'] : $nguoncauhoi->first()->madm;

        $model = cauhoi::where('loaicauhoi', $inputs['madm'])->where('dangcau', $inputs['dangcau'])->where('nguoncauhoi', $inputs['nguoncauhoi'])->orderBy('stt', 'asc')->get();
        // $a_ghep = array_column($model->toarray(), 'macaughep');
        $a_ghep = array_column($model->toarray(), 'stt');
        $luottrung = [];
        if ($inputs['dangcau'] == 2) {
            $luottrung = array_count_values($a_ghep);
        }
        $caunghe = loaicauhoict::where('madm', 1683685241)->get();
        // dd($model->where('stt',202));
        // dd($model);
        $inputs['url'] = '/CauHoi/ThongTin';
        return view('dethi.cauhoi.index')
            ->with('model', $model)
            ->with('baocao', getdulieubaocao())
            ->with('inputs', $inputs)
            ->with('caunghe', $caunghe)
            ->with('luottrung', $luottrung)
            ->with('nguoncauhoi', $nguoncauhoi)
            ->with('loaicauhoi', $loaicauhoi)
            ->with('pageTitle', 'Quản lý câu hỏi');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('quanlycauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'quanlycauhoi');
        }
        
        $input = $request->all();
        $inputs = $input;
        // dd($inputs);
        // foreach ($inputs as $ct){
        //     dd($ct);
        // }
        unset($input['_token'], $input['nguoncauhoi'], $input['dangcau'], $input['loaicauhoi']);
        if (isset($input['dangcaudochieu'])) {
            unset($input['dangcaudochieu']);
        };
        if (isset($input['loaicaunghe'])) {
            unset($input['loaicaunghe']);
        };
        // dd($inputs);
        $inputs['macauhoi'] = getdate()[0];

        if ($inputs['dangcau'] == 2) {
            if (!isset($inputs['macaughep'])) {
                $inputs['macaughep'] = $inputs['macauhoi'];
            }
        }
        for ($i = 0; $i < 2; $i++) {
            $item = array();
            foreach ($input as $key => $ct) {
                if (isset($ct[$i])) {
                    $item[$key] = $ct[$i];
                };
            }
            $item['macauhoi'] = getdate()[0] . $i;
            $item['loaicauhoi'] = $inputs['loaicauhoi'];
            $item['nguoncauhoi'] = $inputs['nguoncauhoi'];
            $item['dangcau'] = $inputs['dangcau'];
            if (isset($inputs['dangcaudochieu'])) {
                $item['dangcaudochieu'] = $inputs['dangcaudochieu'];
            };
            if (isset($inputs['loaicaunghe'])) {
                $item['loaicaunghe'] = $inputs['loaicaunghe'];
            };
            if ($inputs['dangcau'] == 2) {
                $stt = cauhoi::where('nguoncauhoi', $inputs['nguoncauhoi'])->where('loaicauhoi', $inputs['loaicauhoi'])->where('dangcau', 2)->max('stt');
                $cauhoi = cauhoi::where('nguoncauhoi', $inputs['nguoncauhoi'])->where('loaicauhoi', $inputs['loaicauhoi'])->where('dangcau', 2)->where('stt', $stt)->count();
                if ($cauhoi == 2) {
                    $item['stt'] = $stt + 1;
                } else {
                    $item['stt'] = $stt;
                }
            } else {
                $stt = cauhoi::where('nguoncauhoi', $inputs['nguoncauhoi'])->where('loaicauhoi', $inputs['loaicauhoi'])->where('dangcau', 1)->max('stt');
                $item['stt'] = $stt + 1;
            }

            //file hình ảnh
            if (isset($item['anh'])) {
                $file = $item['anh'];
                $name = time() . $file->getClientOriginalName();
                $file->move('uploads/cauhoi/anh/', $name);
                $item['anh'] = 'uploads/cauhoi/anh/' . $name;
            }

            //file audio
            if (isset($item['audio'])) {
                $file = $item['audio'];
                $name = time() . $file->getClientOriginalName();
                $file->move('uploads/cauhoi/audio/', $name);
                $item['audio'] = 'uploads/cauhoi/audio/' . $name;
            }

            //Đáp án

            if ($item['loaidapan'] == 2) {
                $arr = ['A', 'B', 'C', 'D'];
                foreach ($arr as $da) {
                    if (isset($item[$da])) {
                        $file = $item[$da];
                        $name = time() . $file->getClientOriginalName();
                        $file->move('uploads/cauhoi/dapan/anh/', $name);
                        $item[$da] = 'uploads/cauhoi/dapan/anh/' . $name;
                    }
                }
            }
            // cauhoi::create($item);
            if ($item['dangcau'] == 1) {
                break;
            }
        }

        loghethong(getIP(), session('admin'), 'them', 'cauhoi');
        return redirect('/CauHoi/ThongTin?madm=' . $inputs['loaicauhoi'] . '&dangcau=' . $inputs['dangcau'])
            ->with('success', 'Thêm câu hỏi thành công');
    }


    public function loaidapan(Request $request)
    {
        $inputs = $request->all();
        if (!isset($inputs['caughep'])) {
            if ($inputs['loaidapan'] == 1) {
                $html = '<div class="col-xl-3" id="A">';
                $html .= '<label class="control-label ml-3">Đáp án 1<span class="require">*</span></label>';
                $html .= '<input type="text" name="'.(isset($inputs['edit'])?"A":"A[]").'" class="form-control" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
                $html .= '<div class="col-xl-3" id="B">';
                $html .= '<label class="control-label ml-3">Đáp án 2<span class="require">*</span></label>';
                $html .= '<input type="text" name="'.(isset($inputs['edit'])?"B":"B[]").'" class="form-control" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
                $html .= '<div class="col-xl-3" id="C">';
                $html .= '<label class="control-label ml-3">Đáp án 3<span class="require">*</span></label>';
                $html .= '<input type="text" name="'.(isset($inputs['edit'])?"C":"C[]").'" class="form-control" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
                $html .= '<div class="col-xl-3" id="D">';
                $html .= '<label class="control-label ml-3">Đáp án 4<span class="require">*</span></label>';
                $html .= '<input type="text" name="'.(isset($inputs['edit'])?"D":"D[]").'" class="form-control" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
            } else {

                $html = '<div class="col-xl-3" id="A">';
                $html .= '<label class="control-label ml-3">Đáp án 1<span class="require">*</span></label>';
                $html .= '<input type="file" name="'.(isset($inputs['edit'])?"A":"A[]").'" class="form-control" accept=".jpg,.png" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
                $html .= '<div class="col-xl-3" id="B">';
                $html .= '<label class="control-label ml-3">Đáp án 2<span class="require">*</span></label>';
                $html .= '<input type="file" name="'.(isset($inputs['edit'])?"B":"B[]").'" class="form-control" accept=".jpg,.png" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
                $html .= '<div class="col-xl-3" id="C">';
                $html .= '<label class="control-label ml-3">Đáp án 3<span class="require">*</span></label>';
                $html .= '<input type="file" name="'.(isset($inputs['edit'])?"C":"C[]").'" class="form-control" accept=".jpg,.png" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
                $html .= '<div class="col-xl-3" id="D">';
                $html .= '<label class="control-label ml-3">Đáp án 4<span class="require">*</span></label>';
                $html .= '<input type="file" name="'.(isset($inputs['edit'])?"D":"D[]").'" class="form-control" accept=".jpg,.png" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
            }
        } else {
            if ($inputs['loaidapan'] == 1) {
                $html = '<div class="col-xl-3" id="A2">';
                $html .= '<label class="control-label ml-3">Đáp án 1<span class="require">*</span></label>';
                $html .= '<input type="text" name="'.(isset($inputs['edit'])?"A":"A[]").'" class="form-control" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
                $html .= '<div class="col-xl-3" id="B2">';
                $html .= '<label class="control-label ml-3">Đáp án 2<span class="require">*</span></label>';
                $html .= '<input type="text" name="'.(isset($inputs['edit'])?"B":"B[]").'" class="form-control" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
                $html .= '<div class="col-xl-3" id="C2">';
                $html .= '<label class="control-label ml-3">Đáp án 3<span class="require">*</span></label>';
                $html .= '<input type="text" name="'.(isset($inputs['edit'])?"C":"C[]").'" class="form-control" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
                $html .= '<div class="col-xl-3" id="D2">';
                $html .= '<label class="control-label ml-3">Đáp án 4<span class="require">*</span></label>';
                $html .= '<input type="text" name="'.(isset($inputs['edit'])?"D":"D[]").'" class="form-control" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
            } else {

                $html = '<div class="col-xl-3" id="A2">';
                $html .= '<label class="control-label ml-3">Đáp án 1<span class="require">*</span></label>';
                $html .= '<input type="file" name="'.(isset($inputs['edit'])?"A":"A[]").'" class="form-control" accept=".jpg,.png" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
                $html .= '<div class="col-xl-3" id="B2">';
                $html .= '<label class="control-label ml-3">Đáp án 2<span class="require">*</span></label>';
                $html .= '<input type="file" name="'.(isset($inputs['edit'])?"B":"B[]").'" class="form-control" accept=".jpg,.png" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
                $html .= '<div class="col-xl-3" id="C2">';
                $html .= '<label class="control-label ml-3">Đáp án 3<span class="require">*</span></label>';
                $html .= '<input type="file" name="'.(isset($inputs['edit'])?"C":"C[]").'" class="form-control" accept=".jpg,.png" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
                $html .= '<div class="col-xl-3" id="D2">';
                $html .= '<label class="control-label ml-3">Đáp án 4<span class="require">*</span></label>';
                $html .= '<input type="file" name="'.(isset($inputs['edit'])?"D":"D[]").'" class="form-control" accept=".jpg,.png" '.(isset($inputs['edit'])?"":"required").'>';
                $html .= '</div>';
            }
        }
        return response()->json($html);
    }

    public function loaicauhoi(Request $request)
    {
        $inputs = $request->all();
        $caudoc = loaicauhoict::where('madm', 1683685323)->orderBy('id', 'desc')->get();
        $caunghe = loaicauhoict::where('madm', 1683685241)->get();
        if ($inputs['loaicauhoi'] == 1683685323) {
            $html = '<div  id="xoadangcaudoc">';
            $html .= '<label class="control-label">Dạng câu đọc hiểu<span class="require">*</span></label>';
            $html .= '<select name="dangcaudochieu" class="form-control" id="dangcaudoc" onchange="xemtranh(this)">';
            foreach ($caudoc as $ct) {
                $html .= '<option value="' . $ct->madmct . '">' . $ct->tendmct . '</option>';
            }
            $html .= '</select>';
            $html .= '</div>';
        } else {
            $html = '<div  id="xoadangcaunghe">';
            $html .= '<label class="control-label">Dạng câu nghe hiểu<span class="require">*</span></label>';
            $html .= '<select name="loaicaunghe" class="form-control" id="loaicaunghe">';
            foreach ($caunghe as $ct) {
                $html .= '<option value="' . $ct->madmct . '">' . $ct->tendmct . '</option>';
            }
            $html .= '</select>';
            $html .= '</div>';
        }

        return response()->json($html);
    }
    public function index960caudoc()
    {
        return view('960cau.dochieu.index')
            ->with('pageTitle', '960 câu đọc hiểu');
    }
    public function caudochieu(Request $request)
    {
        $inputs = $request->all();
        // dd($inputs);
        if (!isset($inputs['socau'])) {
            return view('960cau.dochieu.index')
                ->with('baocao', getdulieubaocao())
                ->with('pageTitle', '960 câu đọc hiểu');
        }
        $m_model = cauhoi::where('loaicauhoi', 1683685323)->where('nguoncauhoi', 1684121327);
        if ($inputs['socau'] > 23) {
            $m_caughep = $m_model->where('dangcau', 2)->get();
            $a_caughep = array_column($m_caughep->unique('stt')->toarray(), 'stt');
            $model = [];
            $k = 0;
            foreach ($a_caughep as $ct) {
                $m_ghep = $m_caughep->where('stt', $ct);
                $data = [];
                foreach ($m_ghep as $val) {
                    $data['stt'] = $val->stt;
                    if (trim($val->noidung) != null) {
                        $data['noidung'] = $val->noidung;
                    }
                    // $data['macauhoi']=$val->macauhoi;
                    $data['anh'] = $val->anh;
                    $cauhoi = 'cauhoi' . ++$k;
                    $macauhoi = 'macauhoi' . $k;
                    $loaidapan = 'loaidapan' . $k;
                    $A = 'A' . $k;
                    $B = 'B' . $k;
                    $C = 'C' . $k;
                    $D = 'D' . $k;
                    $dapan = 'dapan' . $k;
                    $data[$macauhoi] = $val->macauhoi;
                    $data[$cauhoi] = $val->cauhoi;
                    $data[$loaidapan] = $val->loaidapan;
                    $data[$A] = $val->A;
                    $data[$B] = $val->B;
                    $data[$C] = $val->C;
                    $data[$D] = $val->D;
                    $data[$dapan] = $val->dapan;
                }
                $model[] = $data;
                $k = 0;
            }
            // dd($model);
            $dangcau = 2;
            $title = 'Câu ' . (($inputs['socau'] - 1) * 40) + 1 . ' đến câu ' . $inputs['socau'] * 40;
            $cau = ($inputs['socau'] - 1) * 40 + 1;
        } else {
            $model = $m_model->where('dangcau', 1)->get();
            $dangcau = 1;
            if ($inputs['socau'] == 1) {
                $title = 'Câu 01 đến câu 40';
                $model = $model->take(40);
                $cau = 1;
            } else {
                $title = 'Câu ' . (($inputs['socau'] - 1) * 40) + 1 . ' đến câu ' . $inputs['socau'] * 40;
                $cau = ($inputs['socau'] - 1) * 40 + 1;
                $model = $model->where('stt', '>=', $cau)->take(40);
            };
        }

        // if ($inputs['socau']==1){
        //     $title='Câu 01 đến câu 40';
        //     $cau=1;
        // }else{
        //     $title='Câu '.(($inputs['socau']-1)*40)+1 .' đến câu '.$inputs['socau']*40;
        //     $cau=($inputs['socau']-1)*40+1;
        // };      
        return view('960cau.dochieu.960caudochieu')
            ->with('model', $model)
            ->with('title', $title)
            ->with('cau', $cau)
            ->with('dangcau', $dangcau)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', $title);
    }
    public function index960caunghe()
    {
        return view('960cau.nghehieu.index')
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', '960 câu nghe hiểu');
    }
    public function caunghehieu(Request $request)
    {
        $inputs = $request->all();
        $m_model = cauhoi::where('loaicauhoi', 1683685241)->where('nguoncauhoi', 1684121327);
        if (!isset($inputs['socau'])) {
            $sotrang = count($m_model->get()) / 40;
            return view('960cau.nghehieu.index')
                ->with('sotrang', $sotrang)
                ->with('baocao', getdulieubaocao())
                ->with('pageTitle', '960 câu nghe hiểu');
        }

        if ($inputs['socau'] > 23) {
            $m_caughep = $m_model->where('dangcau', 2)->wherenotnull('stt')->orderBy('stt')->get();
            // dd($m_caughep);
            // $a_caughep=array_column($m_caughep->unique('macaughep')->toarray(),'macaughep');
            $a_caughep = array_column($m_caughep->unique('stt')->toarray(), 'stt');

            $model = [];
            $k = 0;
            foreach ($a_caughep as $ct) {
                $m_ghep = $m_caughep->where('stt', $ct);
                $data = [];
                foreach ($m_ghep as $val) {
                    $data['stt'] = $val->stt;
                    $data['audio'] = $val->audio;
                    $data['noidung'] = $val->noidung;
                    $data['anh'] = $val->anh;
                    $cauhoi = 'cauhoi' . ++$k;
                    $macauhoi = 'macauhoi' . $k;
                    $loaidapan = 'loaidapan' . $k;
                    $A = 'A' . $k;
                    $B = 'B' . $k;
                    $C = 'C' . $k;
                    $D = 'D' . $k;
                    $dapan = 'dapan' . $k;
                    $data[$macauhoi] = $val->macauhoi;
                    $data[$loaidapan] = $val->loaidapan;
                    $data[$cauhoi] = $val->cauhoi;
                    $data[$A] = $val->A;
                    $data[$B] = $val->B;
                    $data[$C] = $val->C;
                    $data[$D] = $val->D;
                    $data[$dapan] = $val->dapan;
                }
                $model[] = $data;
                $k = 0;
                // dd($model);
            }
            $dangcau = 2;
            $title = 'Câu ' . (($inputs['socau'] - 1) * 40) + 1 . ' đến câu ' . $inputs['socau'] * 40;
            $cau = ($inputs['socau'] - 1) * 40 + 1;
        } else {
            $model = $m_model->where('dangcau', 1)->wherenotnull('stt')->orderBy('stt')->get();
            $dangcau = 1;
            if ($inputs['socau'] == 1) {
                $title = 'Câu 01 đến câu 40';
                $model = $model->take(40);
                $cau = 1;
            } else {
                $title = 'Câu ' . (($inputs['socau'] - 1) * 40) + 1 . ' đến câu ' . $inputs['socau'] * 40;
                $cau = ($inputs['socau'] - 1) * 40 + 1;
                $model = $model->where('stt', '>=', $cau)->take(40);
            };
        }
        // dd($model->where('id',361));
        return view('960cau.nghehieu.960caunghehieu')
            ->with('model', $model)
            ->with('title', $title)
            ->with('cau', $cau)
            ->with('dangcau', $dangcau)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', $title);
    }
    public function import(Request $request)
    {

        $inputs = $request->all();
        $dataObj = new ColectionImport();
        $theArray = Excel::toArray($dataObj, $inputs['file']);
        $arr = $theArray[0];
        if ($inputs['loaicauhoi'] == 1683685241) {
            $arr_col = array('stt', 'cauhoi', 'noidung', 'audio', 'anh', 'A', 'B', 'C', 'D', 'dapan', 'dangcauhoi', 'loaidapan1', 'phanloai', 'loaicaunghe', 'loaidapan', 'dangcau');
        } else {
            $arr_col = array('stt', 'cauhoi', 'noidung', 'hoithoai1', 'hoithoai2', 'hoithoai3', 'hoithoai4', 'anh', 'A', 'B', 'C', 'D', 'dapan', 'dangcauhoi', 'loaidapan1', 'phanloai', 'dangcaudochieu', 'loaidapan', 'dangcau');
        }

        $nfield = sizeof($arr_col);
        $socauhoi = 0;
        // dd($arr);
        for ($i = 1; $i < count($arr); $i++) {
            $data = array();
            $data['macauhoi'] = date('YmdHis') . $i;
            $data['loaicauhoi'] = $inputs['loaicauhoi'];
            $data['nguoncauhoi'] = $inputs['nguoncauhoi'];
            for ($j = 0; $j < $nfield; $j++) {
                $data[$arr_col[$j]] = $arr[$i][$j];
            }
            if ($data['A'] == '' && $data['B'] == '' && $data['C'] == '' && $data['D'] == '') {
                break;
            }
            // dd($data);
            cauhoi::create($data);
            $socauhoi++;
        }
        loghethong(getIP(), session('admin'), 'excel', 'cauhoi');
        return redirect('/CauHoi/ThongTin?madm=' . $inputs['loaicauhoi'])
            ->with('success', 'Thêm thành công ' . $socauhoi . ' câu hỏi');
    }
    public function destroy($macauhoi)
    {
        if (!chkPhanQuyen('quanlycauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'quanlycauhoi');
        }

        $model = cauhoi::where('macauhoi', $macauhoi)->first();
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
            if ($model->A != null) {
                if (File::exists($model->A)) {
                    File::Delete($model->A);
                }
            }
            if ($model->B != null) {
                if (File::exists($model->B)) {
                    File::Delete($model->B);
                }
            }
            if ($model->C != null) {
                if (File::exists($model->C)) {
                    File::Delete($model->C);
                }
            }
            if ($model->D != null) {
                if (File::exists($model->D)) {
                    File::Delete($model->D);
                }
            }
            $model->delete();
            loghethong(getIP(), session('admin'), 'xoa', 'cauhoi');
        }

        return redirect('/CauHoi/ThongTin?madm=' . $model->loaicauhoi . '&dangcau=' . $model->dangcau)
            ->with('success', 'Xóa thành công');
    }

    public function edit($id)
    {
        if (!chkPhanQuyen('quanlycauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'quanlycauhoi');
        }
        $model = cauhoi::where('macauhoi', $id)->first();
        $nguoncauhoi = dmnguoncauhoi::all();
        $loaicauhoi = loaicauhoi::all();
        $caunghe = loaicauhoict::where('madm', 1683685241)->get();
        $caudoc = loaicauhoict::where('madm', 1683685323)->orderBy('id', 'desc')->get();
        return view('dethi.cauhoi.edit')
            ->with('nguoncauhoi', $nguoncauhoi)
            ->with('loaicauhoi', $loaicauhoi)
            ->with('caunghe', $caunghe)
            ->with('caudoc', $caudoc)
            ->with('model', $model)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Cập nhật câu hỏi');
    }

    public function update(Request $request, $id)
    {
        if (!chkPhanQuyen('quanlycauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'quanlycauhoi');
        }
        $inputs = $request->all();
        $model = cauhoi::where('macauhoi', $id)->first();
        if (isset($model)) {
            if (isset($inputs['anh'])) {
                if (File::exists($model->anh)) {
                    File::Delete($model->anh);
                }
                $file = $inputs['anh'];
                $name = time() . $file->getClientOriginalName();
                $file->move('uploads/cauhoi/anh/', $name);
                $inputs['anh'] = 'uploads/cauhoi/anh/' . $name;
            }

            if (isset($inputs['audio'])) {
                if (File::exists($model->audio)) {
                    File::Delete($model->audio);
                }
                $file = $inputs['audio'];
                $name = time() . $file->getClientOriginalName();
                $file->move('uploads/cauhoi/audio/', $name);
                $inputs['audio'] = 'uploads/cauhoi/audio/' . $name;
            }

            //Đáp án
            if ($inputs['loaidapan'] == 2) {
                $arr = ['A', 'B', 'C', 'D'];
                foreach ($arr as $da) {
                    if (isset($inputs[$da])) {
                        if (File::exists($model->da)) {
                            File::Delete($model->da);
                        }
                        $file = $inputs[$da];
                        $name = time() . $file->getClientOriginalName();
                        $file->move('uploads/cauhoi/dapan/anh/', $name);
                        $inputs[$da] = 'uploads/cauhoi/dapan/anh/' . $name;
                    }
                }
            }
            // dd($inputs);
            $model->update($inputs);
            loghethong(getIP(), session('admin'), 'capnhat', 'cauhoi');
        }
        return redirect('/CauHoi/ThongTin?madm=' . $model->loaicauhoi . '&dangcau=' . $model->dangcau . '&nguoncauhoi=' . $model->nguoncauhoi)
            ->with('success', 'Cập nhật thành công');
    }
    public function create()
    {
        if (!chkPhanQuyen('quanlycauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'quanlycauhoi');
        }
        $nguoncauhoi = dmnguoncauhoi::all();
        $loaicauhoi = loaicauhoi::all();
        $caunghe = loaicauhoict::where('madm', 1683685241)->get();
        return view('dethi.cauhoi.create')
            ->with('nguoncauhoi', $nguoncauhoi)
            ->with('loaicauhoi', $loaicauhoi)
            ->with('caunghe', $caunghe)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Thêm câu hỏi');
    }
}
