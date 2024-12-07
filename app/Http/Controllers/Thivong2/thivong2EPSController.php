<?php

namespace App\Http\Controllers\Thivong2;

use App\Http\Controllers\Controller;
use App\Models\Thivong2\congcu;
use App\Models\ThiVong2\testmumau;
use App\Models\ThiVong2\vandap;
use App\Models\ThiVong2\vandap_cautraloi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;

class thivong2EPSController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (!Session::has('admin')) {
    //             return redirect('/DangNhap');
    //         };
    //         if (!chksession()) {
    //             return redirect('/DangNhap');
    //         };
    //         chkaction();
    //         return $next($request);
    //     });
    // }
    public function thivong2()
    {
        return redirect('/epstopik-test/phongvan?phanloai=VANDAP');
    }
    public function VanDap(Request $request)
    {
        $inputs=$request->all();
        $model=vandap::where('phanloai',$inputs['phanloai'])->orderby('stt')->get();
        $m_traloi=vandap_cautraloi::all();
        $a_phanloai = array(
            'VANDAP' => 'Vấn đáp',
            'HIEULENH' => 'Hiệu lệnh'
        );
        // dd($this->datlaicau(null));
        return  view('thivong2.vandap')
        ->with('model',$model)
        ->with('a_phanloai',$a_phanloai)
        ->with('inputs',$inputs)
        ->with('m_traloi',$m_traloi)
        ->with('baocao',getdulieubaocao())
        ->with('pageTitle', 'Ôn thi vòng 2 EPS');
    }
    public function HieuLenh(){
        return  view('thivong2.hieulenh')
        ->with('baocao',getdulieubaocao())
        ->with('pageTitle', 'Ôn thi vòng 2 EPS');
    }
    public function GTBanThan(){
        return  view('thivong2.gtbanthan')
        ->with('baocao',getdulieubaocao())
        ->with('pageTitle', 'Ôn thi vòng 2 EPS');
    }

    public function getCauHoi(Request $request)
    {
        $inputs=$request->all();
        $model=vandap::where('macau',$inputs['macau'])->first();
        $m_traloi=vandap_cautraloi::where('macau',$inputs['macau'])->get();
        $result=array(
            'model'=>$model,
            'message'=>'error'
        );
        
        $result['message']='<h5 id="text-hidden"
        class="text-center align-middle bg-gray-800 fw-bold p-3 ps-3 pe-3 m-0 text-logo-y text-warning"
        style="border-bottom-left-radius:0;border-bottom-right-radius:0;font-size:2rem">'.$model->noidung.'?<br><span
            class="text-light ps-0 pe-0 fs-5">'.$model->nghiatiengviet.'</span><br>
            <span
            class="btn text-light ps-0 pe-0 fs-5"><b class="text-warning">T.lời mẫu:</b>';
            foreach($m_traloi as $ct){
                $result['message'].= $ct->noidung;
            }
             $result['message'].='</span>
    </h5>';
        return response()->json($result);
    }

    public function setcauhoi(Request $request)
    {
        $inputs=$request->all();
        $model=vandap::all();
    }

    public function CongCu($phanloai)
    {
        $model=congcu::where('phanloai',$phanloai)->orderBy('stt')->get();
        $model_ct=$model->first();
        return view('thivong2.congcu')
        ->with('model',$model->slice(1))
        ->with('model_ct',$model_ct)
        ->with('baocao',getdulieubaocao())
        ->with('pageTitle', 'Ôn thi vòng 2 EPS');

    }

    public function ChuyenHinhAnh(Request $request)
    {
        $inputs=$request->all();
        $disable=$inputs['hiennghia'] == 0?'':'disable';
        $congcu=congcu::where('phanloai',$inputs['phanloai'])->where('macongcu',$inputs['macongcu'])->first();
        $result = array(
            'status' => 'fail',
            'hienhinhanh' => 'error',
            'hiennghia' => 'error',
            'model'=>$congcu
        );

        $result ['hienhinhanh']=    '<div class="col-lg-12 text-center mt-1 mb-1" id="hienhinhanh">';
        $result ['hienhinhanh'] .= '<img class="mt-1 mb-2" style="border-radius:5px;" id="image_congcu" src="'.$congcu->hinhanh.'" alt="">';
        $result ['hienhinhanh'] .='</div>';

        $result ['hiennghia']=    '<div class="col-lg-12 text-center mt-1 mb-1 '.$disable.'" id="hiennghia">';
        $result ['hiennghia'] .= '<p class="text-center" style="color: #517ca4;font-size:16px;font-weight:600">'.$congcu->tiengHan.'</p>';
        $result ['hiennghia'] .= '<p class="text-center text-dark" style="font-size:14px;font-weight:600">'.$congcu->tencongcu.'</p>';
        $result ['hiennghia'] .='</div>';

        $result['status']='success';
        return response()->json($result);
    }

    public function TestMuMau(Request $request)
    {
        $inputs=$request->all();
        $model=testmumau::all()->shuffle();
        $model_ct=$model->first();
        return view('thivong2.testmumau',compact('model_ct'))
        ->with('model',$model->slice(1))
        ->with('baocao',getdulieubaocao())
        ->with('pageTitle', 'Test mù màu');
    }

    public function ChuyenAnhTest(Request $request)
    {
        $inputs=$request->all();
        $model=testmumau::where('matest',$inputs['matest'])->first();
        $result = array(
            'status' => 'fail',
            'hienhinhanh' => 'error',
            'model'=>$model
        );
        $result ['hienhinhanh']=    '<div class="col-lg-12 text-center mt-1 mb-1" id="hienhinhanh_test">';
        $result ['hienhinhanh'] .= '<img class="mt-1 mb-2" style="border-radius:5px;" id="image_test" src="'.$model->hinhanh.'" alt="">';
        $result ['hienhinhanh'] .='</div>';
        $result['status']='success';
        return response()->json($result);
    }

    public function KiemTra(Request $request)
    {
        $inputs=$request->all();
        $model=testmumau::where('matest',$inputs['matest'])->first();
        $message="fail";
        if(!isset($model))
        {
            $message='Không tìm thấy hình ảnh';
        }else{
            if($model->dapan == $inputs['dapan']){
                $message='correct';
            }
        }

        return response()->json($message);
    }
}
