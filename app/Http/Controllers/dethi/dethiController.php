<?php

namespace App\Http\Controllers\dethi;

use App\Http\Controllers\Controller;
use App\Models\danhmuc\chitietloaicauhoict;
use App\Models\danhmuc\dmnguoncauhoi;
use App\Models\danhmuc\loaicauhoi;
use App\Models\danhmuc\loaicauhoict;
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
        if (!chkPhanQuyen('dethi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }
        $model = dethi::all();
        foreach ($model as $ct) {
            $ct->socauhoi = cauhoi::join('cauhoi_dethi', 'cauhoi_dethi.macauhoi', 'cauhoi.macauhoi')
                ->where('cauhoi_dethi.made', $ct->made)
                ->count();
        }
        return view('dethi.dethi.index')
            ->with('model', $model)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Quản lý đề thi');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store_cu(Request $request)
    {
        if (!chkPhanQuyen('dethi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }
        $inputs = $request->all();

        $inputs['made'] = getdate()[0];
        $model = dethi::where('tende', 'like', '%' . $inputs['tende'] . '%')->first();
        if (isset($model)) {
            return redirect('/DeThi/ThongTin')
                ->with('error', 'Đề thi đã tồn tại');
        }
        $m_cauhoi = cauhoi::all();
        $m_caunghe = $m_cauhoi->where('loaicauhoi', 1683685241);
        $caudoc = $m_cauhoi->where('loaicauhoi', 1683685323);
        $loaicaudoc = loaicauhoict::where('madm', 1683685323)->get();
        $loaicaunghe = loaicauhoict::where('madm', 1683685241)->where('madmct', '!=', 1684898896)->get();
        $macaudoc = [];
        $macaunghekhac = [];
        foreach ($loaicaudoc as $ct) {
            $m_caudoc = array_column($caudoc->where('dangcaudochieu', $ct->madmct)->toarray(), 'macauhoi');
            if ($m_caudoc != []) {
                $index = array_rand($m_caudoc, $ct->soluongcau);
                foreach ($index as $val) {
                    $macaudoc[] = $m_caudoc[$val];
                }

            }
        }

        foreach ($loaicaunghe as $ct) {
            $m_caunghe = array_column($m_caunghe->where('loaicaunghe', $ct->madmct)->toarray(), 'macauhoi');
            if ($m_caudoc != []) {
                $index = array_rand($m_caunghe, $ct->soluongcau);
                foreach ($index as $val) {
                    $macaunghekhac[] = $m_caunghe[$val];
                }

            }
        }


        $caungheghep = array_column($m_caunghe->where('dangcau', 2)->unique('macaughep')->toarray(), 'macaughep');
        $macaungheghep = [];
        if ($caungheghep != []) {
            $index_caungheghep = array_rand($caungheghep);
            $macaungheghep = array_column($m_caunghe->where('macaughep', $caungheghep[$index_caungheghep])->toarray(), 'macauhoi');
        }

        // $caunghekhac=array_column($m_caunghe->where('dangcau',1)->toarray(),'macauhoi');
        // $macaunghekhac=[];
        // if($caunghekhac != []){
        //     $index_caungheghepkhac=array_rand($caunghekhac,18);
        //     // $index_caungheghepkhac=array_rand($caunghekhac,20);
        //     foreach($index_caungheghepkhac as $ct){
        //         $macaunghekhac[]=$caunghekhac[$ct];
        //     }
        // }
        $macaunghe = array_merge($macaunghekhac, $macaungheghep);
        $macauhoidethi = array_merge($macaudoc, $macaunghe);

        dethi::create($inputs);
        foreach ($macauhoidethi as $ct) {
            $data = [
                'made' => $inputs['made'],
                'macauhoi' => $ct
            ];
            cauhoi_dethi::create($data);
        }
        return redirect('/DeThi/ThongTin')
            ->with('success', 'Thêm mới thành công');

    }
    public function store(Request $request)
    {
        if (!chkPhanQuyen('dethi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }
        $inputs = $request->all();
        $inputs['made'] = getdate()[0];
        $model = dethi::where('tende', 'like', '%' . $inputs['tende'] . '%')->first();
        if (isset($model)) {
            return redirect('/DeThi/ThongTin')
                ->with('error', 'Đề thi đã tồn tại');
        }
        // dd(taodethi());

        foreach (taodethi() as $ct) {
            // dd($ct);
            $data = [
                'made' => $inputs['made'],
                'macauhoi' => $ct
            ];
            // dd($data);
            cauhoi_dethi::create($data);
        }
        dethi::create($inputs);
        loghethong(getIP(), session('admin'), 'them', 'dethi');
        return redirect('/DeThi/ThongTin')
            ->with('success', 'Thêm mới thành công');

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if (!chkPhanQuyen('dethi', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }
        $inputs = $request->all();
        $model = dethi::where('made', $id)->first();
        $m_cauhoi = cauhoi::join('cauhoi_dethi', 'cauhoi_dethi.macauhoi', 'cauhoi.macauhoi')
            ->where('cauhoi_dethi.made', $model->made)
            ->get();
        $a_dethi = array_column(dethi::all()->toarray(), 'tende', 'made');


        // $a_cauhoi=array_column($m_cauhoi->toarray(),'macauhoi');
        // $m_cauhoi_khac=cauhoi::wherenotin('macauhoi',$a_cauhoi)->where('nguoncauhoi',1684121372)->get();
        // $a_loaicauhoi=array_column(loaicauhoi::all()->toarray(),'tendm','madm');           
        // if(isset($inputs['made'])){
        //     $inputs['url']='/DeThi/ChiTiet/';
        // }else{
        //     $inputs['url']='/DeThi/ChiTiet/';

        $a_cauhoi = array_column($m_cauhoi->toarray(), 'macauhoi');
        $m_cauhoi_khac = cauhoi::wherenotin('macauhoi', $a_cauhoi)
        ->where('nguoncauhoi', '1684121372')
        ->where('loaicauhoi', '1683685323')
        ->where('dangcaudochieu', '1683687307')->get();
        $a_loaicauhoi = array_column(loaicauhoi::all()->toarray(), 'tendm', 'madm');
        if (isset($inputs['made'])) {
            $inputs['url'] = '/DeThi/ChiTiet/';
        } else {
            $inputs['url'] = '/DeThi/ChiTiet/';
        }
        $inputs['made'] = $inputs['made'] ?? $id;
        $nguoncauhoi = dmnguoncauhoi::all()->sortBy('tendm');
        $loaicauhoi = loaicauhoi::all();
        $loaicauhoict = loaicauhoict::all();
        return view('dethi.dethi.chitiet')
            ->with('model', $model)
            ->with('m_cauhoi', $m_cauhoi)
            ->with('a_dethi', $a_dethi)
            ->with('a_cauhoi', $a_cauhoi)
            ->with('m_cauhoi_khac', $m_cauhoi_khac)
            ->with('inputs', $inputs)
            ->with('a_loaicauhoi', $a_loaicauhoi)
            ->with('nguoncauhoi', $nguoncauhoi)
            ->with('loaicauhoi', $loaicauhoi)
            ->with('loaicauhoict', $loaicauhoict)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Chi tiết đề thi');
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

        $inputs = $request->all();
        $model = dethi::where('made', $id)->first();
        if (isset($model)) {
            $model->update($inputs);
        }
        loghethong(getIP(), session('admin'), 'capnhat', 'dethi');
        return redirect('/DeThi/ThongTin')
            ->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('dethi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }

        $model = dethi::where('made', $id)->first();
        if (isset($model)) {
            cauhoi_dethi::where('made',$model->made)->delete();
            $model->delete();
        }
        loghethong(getIP(), session('admin'), 'xoa', 'dethi');
        return redirect('/DeThi/ThongTin')
            ->with('success', 'Xóa thành công');
    }

    public function danhsachcauhoi(Request $request, string $id)
    {
        $inputs = $request->all();
        $nguoncauhoi = $inputs['nguoncauhoi'];
        $loaicauhoi = $inputs['loaicauhoi'];
        $loaicauhoict = $inputs['loaicauhoict'];

        $model = dethi::where('made', $id)->first();
        $m_cauhoi = cauhoi::join('cauhoi_dethi', 'cauhoi_dethi.macauhoi', 'cauhoi.macauhoi')
            ->where('cauhoi_dethi.made', $model->made)
            ->get();

        $a_cauhoi = array_column($m_cauhoi->toarray(), 'macauhoi');

        $m_cauhoi_khac = cauhoi::wherenotin('macauhoi', $a_cauhoi)
            ->where('nguoncauhoi', $nguoncauhoi)
            ->where('loaicauhoi', $loaicauhoi)
            ->when($loaicauhoi == '1683685241', function ($q) use ($loaicauhoict) {
                return $q->where('loaicaunghe', $loaicauhoict);
            })
            ->when($loaicauhoi == '1683685323', function ($q) use ($loaicauhoict) {
                return $q->where('dangcaudochieu', $loaicauhoict);
            })
            ->get();

        return response()->json($m_cauhoi_khac);
    }

    public function themcauhoi(Request $request)
    {
        if (!chkPhanQuyen('dethi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }

        $inputs = $request->all();
        foreach ($inputs['macauhoi'] as $ct) {
            $data = [
                'made' => $inputs['made'],
                'macauhoi' => $ct
            ];

            cauhoi_dethi::create($data);
        }
        $mes = 'Thêm thành công' . count($inputs['macauhoi']) . 'câu hỏi';
        loghethong(getIP(), session('admin'), 'themcauhoi', 'dethi');
        return redirect('/DeThi/ChiTiet/' . $inputs['made'])
            ->with('success', $mes);

    }

    public function xoacauhoi(string $made, string $macauhoi)
    {
        if (!chkPhanQuyen('dethi', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'dethi');
        }

        $model = cauhoi_dethi::where('made', $made)
            ->where('macauhoi', $macauhoi)->first();

        if (isset($model)) {
            $model->delete();
        }

        return redirect('DeThi/ChiTiet/' . $made)
            ->with('success', 'Xóa thành công');
    }
}