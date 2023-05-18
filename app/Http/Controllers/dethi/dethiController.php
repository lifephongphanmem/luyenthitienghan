<?php

namespace App\Http\Controllers\dethi;

use App\Http\Controllers\Controller;
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
        $m_cauhoi=cauhoi::all();
        $m_caunghe=$m_cauhoi->where('loaicauhoi',1683685241);
        $caudoc=$m_cauhoi->where('loaicauhoi',1683685323);
        $loaicaudoc=loaicauhoict::where('madm',1683685323)->get();
        foreach($loaicaudoc as $ct){
            switch($ct->madmct){
                case 1683687307:
                    $xemtranh=array_column($caudoc->where('dangcaudochieu',1683687307)->toarray(),'macauhoi');
                    $madexemtranh=[];
                    if($xemtranh != []){
                        $index_xemtranh=array_rand($xemtranh,2);
                      
                        foreach($index_xemtranh as $ct){
                            $madexemtranh[]=$xemtranh[$ct];
                        };
                        }
                break;
                case 1683687864:
                    $timtulienquan=array_column($caudoc->where('dangcaudochieu',1683687864)->toarray(),'macauhoi');
                    $madetimtulienquan=[];
                    if($timtulienquan != []){
                        $index_timtulienquan=array_rand($timtulienquan,2);

                        foreach($index_timtulienquan as $ct){
                            $madetimtulienquan[]=$timtulienquan[$ct];
                        };
                        }
                    break;
                case 1683687948:
                    $luachondapan=array_column($caudoc->where('dangcaudochieu',1683687948)->toarray(),'macauhoi');
                    $madeluachondapan=[];
                    if($luachondapan != []){
                        $index_luachondapan=array_rand($luachondapan,4);

                        foreach($index_luachondapan as $ct){
                            $madeluachondapan[]=$luachondapan[$ct];
                        };
                        }
                break;
                case 1683687978:
                    $traloicauhoi=array_column($caudoc->where('dangcaudochieu',1683687978)->toarray(),'macauhoi');
                    $madetraloicauhoi=[];
                    if($traloicauhoi != []){
                        $index_traloicauhoi=array_rand($traloicauhoi,4);

                        foreach($index_traloicauhoi as $ct){
                            $madetraloicauhoi[]=$traloicauhoi[$ct];
                        };
                        }
                break;
                case 1683688026:
                    $dapan2tinhtu=array_column($caudoc->where('dangcaudochieu',1683688026)->toarray(),'macauhoi');
                    $madedapan2tinhtu=[];
                    if($dapan2tinhtu != []){
                        $index_dapan2tinhtu=array_rand($dapan2tinhtu,2);

                        foreach($index_dapan2tinhtu as $ct){
                            $madedapan2tinhtu[]=$dapan2tinhtu[$ct];
                        };
                        }
                break;
                case 1683688050:
                    $doanvannoivedieugi=array_column($caudoc->where('dangcaudochieu',1683688050)->toarray(),'macauhoi');
                    $madedoanvannoivedieugi=[];
                    if($doanvannoivedieugi != []){
                        $index_doanvannoivedieugi=array_rand($doanvannoivedieugi,2);

                        foreach($index_doanvannoivedieugi as $ct){
                            $madedoanvannoivedieugi[]=$doanvannoivedieugi[$ct];
                        };
                        }
                break;
                case 1683688096:
                    $caughep=array_column($caudoc->where('dangcaudochieu',1683688096)->unique('macaughep')->toarray(),'macaughep');
                    // $caughepdoanvan=array_column($caudoc->where('dangcaudochieu',1683688096)->toarray(),'macauhoi');
                    $madecaughepdoanvan=[];
                    if($caughep != []){
                        $index_caughepdoanvan=array_rand($caughep);
                        $madecaughepdoanvan=array_column($caudoc->where('macaughep',$caughep[$index_caughepdoanvan])->toarray(),'macauhoi');
                        }
                break;
                case 1683688124:
                    $luachontuvung=array_column($caudoc->where('dangcaudochieu',1683688124)->toarray(),'macauhoi');
                    $madeluachontuvung=[];
                    if($luachontuvung != []){
                        $index_luachontuvung=array_rand($luachontuvung,2);

                        foreach($index_luachontuvung as $ct){
                            $madeluachontuvung[]=$luachontuvung[$ct];
                        };
                        }
                break;
            }
        }


        $macaudoc=array_merge($madexemtranh,$madetimtulienquan,$luachondapan,$madetraloicauhoi,$madedapan2tinhtu,$madedoanvannoivedieugi,$madeluachontuvung,$madecaughepdoanvan);

        // $caungheghep=array_column($m_caunghe->unique('macaughep')->toarray(),'macaughep');
        $caungheghep=array_column($m_caunghe->where('dangcau',2)->unique('macaughep')->toarray(),'macaughep');
        $macaungheghep=[];
        if($caungheghep != []){
            $index_caungheghep=array_rand($caungheghep);
            $macaungheghep=array_column($m_caunghe->where('macaughep',$caungheghep[$index_caungheghep])->toarray(),'macauhoi');
        }

        $caunghekhac=array_column($m_caunghe->where('dangcau',1)->toarray(),'macauhoi');
        $macaunghekhac=[];
        if($caunghekhac != []){
            $index_caungheghepkhac=array_rand($caunghekhac,18);
            foreach($index_caungheghepkhac as $ct){
                $macaunghekhac[]=$caunghekhac[$ct];
            }
        }
        $macaunghe=array_merge($macaunghekhac,$macaungheghep);
        $macauhoidethi=array_merge($macaudoc,$macaunghe);
        if(isset($model)){
            return redirect('/DeThi/ThongTin')
                    ->with('error','Đề thi đã tồn tại');
        }else{
            dethi::create($inputs);
            foreach($macauhoidethi as $ct){
                $data=[
                    'made'=>$inputs['made'],
                    'macauhoi'=>$ct
                ];
                cauhoi_dethi::create($data);
            }
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
