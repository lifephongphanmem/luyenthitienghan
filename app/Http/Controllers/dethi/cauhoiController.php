<?php

namespace App\Http\Controllers\dethi;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\dmnguoncauhoi;
use App\Models\danhmuc\loaicauhoi;
use App\Models\danhmuc\loaicauhoict;
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
    public function index(Request $request)
    {
        if (!chkPhanQuyen('cauhoi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'cauhoi');
        }
        $inputs = $request->all();
        $nguoncauhoi = dmnguoncauhoi::all();
        $loaicauhoi = loaicauhoi::all();
        $madm = loaicauhoi::select('madm')->first()->madm;
        $inputs['madm'] = isset($inputs['madm']) ? $inputs['madm'] : $madm;
        $inputs['dangcau'] = isset($inputs['dangcau']) ? $inputs['dangcau'] : 1;
        $model = cauhoi::where('loaicauhoi', $inputs['madm'])->where('dangcau', $inputs['dangcau'])->orderBy('id', 'desc')->get();
        $a_ghep = array_column($model->toarray(), 'macaughep');
        $luottrung = [];
        if ($inputs['dangcau'] == 2) {
            $luottrung = array_count_values($a_ghep);
        }


        $inputs['url'] = '/CauHoi/ThongTin';
        return view('dethi.cauhoi.index')
            ->with('model', $model)
            ->with('inputs', $inputs)
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
        if (!chkPhanQuyen('cauhoi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'cauhoi');
        }

        $inputs = $request->all();
        $inputs['macauhoi'] = getdate()[0];

        if ($inputs['dangcau'] == 2) {
            if (!isset($inputs['macaughep'])) {
                $inputs['macaughep'] = $inputs['macauhoi'];
            }
        }

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

        if ($inputs['loaidapan'] == 2) {
            $arr = ['A', 'B', 'C', 'D'];
            foreach ($arr as $ct) {
                if (isset($inputs[$ct])) {
                    $file = $inputs[$ct];
                    $name = time() . $file->getClientOriginalName();
                    $file->move('uploads/cauhoi/dapan/anh/', $name);
                    $inputs[$ct] = 'uploads/cauhoi/dapan/anh/' . $name;
                }
            }
        }
        cauhoi::create($inputs);

        return redirect('/CauHoi/ThongTin?madm=' . $inputs['loaicauhoi'] . '&dangcau=' . $inputs['dangcau'])
            ->with('success', 'Thêm câu hỏi thành công');
    }


    public function loaidapan(Request $request)
    {
        $inputs = $request->all();
        if ($inputs['loaidapan'] == 1) {
            $html = '<div class="col-md-3 mt-2" id="A">';
            $html .= '<label class="control-label ml-3">Đáp án 1<span class="require">*</span></label>';
            $html .= '<input type="text" name="A" class="form-control ml-3">';
            $html .= '</div>';
            $html .= '<div class="col-md-3 mt-2" id="B">';
            $html .= '<label class="control-label ml-3">Đáp án 2<span class="require">*</span></label>';
            $html .= '<input type="text" name="B" class="form-control ml-3">';
            $html .= '</div>';
            $html .= '<div class="col-md-3 mt-2" id="C">';
            $html .= '<label class="control-label ml-3">Đáp án 3<span class="require">*</span></label>';
            $html .= '<input type="text" name="C" class="form-control ml-3">';
            $html .= '</div>';
            $html .= '<div class="col-md-3 mt-2" id="D">';
            $html .= '<label class="control-label ml-3">Đáp án 4<span class="require">*</span></label>';
            $html .= '<input type="text" name="D" class="form-control ml-3">';
            $html .= '</div>';
            $html .= '<div class="col-md-3 mt-2" id="Atiengviet">';
            $html .= '<label class="control-label ml-3">Đáp án 1 tiếng việt<span class="require">*</span></label>';
            $html .= '<input type="text" name="Atiengviet" class="form-control ml-3">';
            $html .= '</div>';
            $html .= '<div class="col-md-3 mt-2" id="Btiengviet">';
            $html .= '<label class="control-label ml-3">Đáp án 2 tiếng việt<span class="require">*</span></label>';
            $html .= '<input type="text" name="Btiengviet" class="form-control ml-3">';
            $html .= '</div>';
            $html .= '<div class="col-md-3 mt-2" id="Ctiengviet">';
            $html .= '<label class="control-label ml-3">Đáp án 3 tiếng việt<span class="require">*</span></label>';
            $html .= '<input type="text" name="Ctiengviet" class="form-control ml-3">';
            $html .= '</div>';
            $html .= '<div class="col-md-3 mt-2" id="Dtiengviet">';
            $html .= '<label class="control-label ml-3">Đáp án 4 tiếng việt<span class="require">*</span></label>';
            $html .= '<input type="text" name="Dtiengviet" class="form-control ml-3">';
            $html .= '</div>';
        } else {

            $html = '<div class="col-md-3 mt-2" id="A">';
            $html .= '<label class="control-label ml-3">Đáp án 1<span class="require">*</span></label>';
            $html .= '<input type="file" name="A" class="form-control ml-3">';
            $html .= '</div>';
            $html .= '<div class="col-md-3 mt-2" id="B">';
            $html .= '<label class="control-label ml-3">Đáp án 2<span class="require">*</span></label>';
            $html .= '<input type="file" name="B" class="form-control ml-3">';
            $html .= '</div>';
            $html .= '<div class="col-md-3 mt-2" id="C">';
            $html .= '<label class="control-label ml-3">Đáp án 3<span class="require">*</span></label>';
            $html .= '<input type="file" name="C" class="form-control ml-3">';
            $html .= '</div>';
            $html .= '<div class="col-md-3 mt-2" id="D">';
            $html .= '<label class="control-label ml-3">Đáp án 4<span class="require">*</span></label>';
            $html .= '<input type="file" name="D" class="form-control ml-3">';
            $html .= '</div>';
        }

        return response()->json($html);
    }

    public function loaicauhoi(Request $request)
    {
        $inputs = $request->all();
        $caudoc = loaicauhoict::where('madm', 1683685323)->orderBy('id', 'desc')->get();
        if ($inputs['loaicauhoi'] == 1683685323) {
            $html = '<div class="col-md-12 mt-2" id="xoadangcaudoc">';
            $html .= '<label class="control-label">Dạng câu đọc<span class="require">*</span></label>';
            $html .= '<select name="dangcaudochieu" class="form-control" id="dangcaudoc" onchange="xemtranh(this)">';
            foreach ($caudoc as $ct) {
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
                ->with('pageTitle', '960 câu đọc hiểu');
        }
        $model = cauhoi::where('loaicauhoi', 1683685323)->where('nguoncauhoi', 1684121327)->get();
        if ($inputs['socau']==1){
            $title='Câu 01 đến câu 40';
        }else{
            $title='Câu '.(($inputs['socau']-1)*40)+1 .' đến câu '.$inputs['socau']*40;
        }

        
        // dd($model);
        return view('960cau.dochieu.960caudochieu')
            ->with('model', $model)
            ->with('title', $title)
            ->with('pageTitle', '960 câu đọc hiểu');
    }
}
