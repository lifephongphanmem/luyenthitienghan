<?php

namespace App\Http\Controllers\baigiang;

use App\Http\Controllers\Controller;
use App\Models\baigiang\baihoc;
use App\Models\baigiang\hinhanh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Imports\ColectionImport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;


class hinhanhController extends Controller
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
        if (!chkPhanQuyen('hinhanh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'hinhanh');
        }
        // dd(session('admin'));
        $inputs=$request->all();
        $m_baihoc = baihoc::all();
        $inputs['mabaihoc']=$inputs['mabaihoc']??$m_baihoc->first()->mabaihoc;
        $model=hinhanh::join('baihoc','baihoc.mabaihoc','hinhanh.mabaihoc')
                        ->select('hinhanh.*')
                        ->where('baihoc.mabaihoc',$inputs['mabaihoc'])
                        ->get();
        $inputs['url']='/HinhAnh/ThongTin';
        return view('baigiang.hinhanh.index')
                    ->with('model',$model)
                    ->with('baocao',getdulieubaocao())
                    ->with('m_baihoc',$m_baihoc)
                    ->with('inputs',$inputs)
                    ->with('pageTitle','Hình ảnh bài giảng');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!chkPhanQuyen('hinhanh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'hinhanh');
        }
        $inputs=$request->all();
        $inputs['mahinhanh']=date('YmdHis');

                //file hình ảnh
                if (isset($inputs['hinhanh'])) {
                    $file = $inputs['hinhanh'];
                    $name = time() . $file->getClientOriginalName();
                    $file->move('uploads/hinhanh/anh/', $name);
                    $inputs['hinhanh'] = 'uploads/hinhanh/anh/' . $name;
                }

                        //file audio
        if (isset($inputs['audio'])) {
            $file = $inputs['audio'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/hinhanh/audio/', $name);
            $inputs['audio'] = 'uploads/hinhanh/audio/' . $name;
        }

        $baihoc=baihoc::where('mabaihoc',$inputs['tenbaihoc'])->first();
        if(!isset($baihoc)){
            $inputs['mabaihoc']=getdate()[0];
            $data=[
                'mabaihoc'=>$inputs['mabaihoc'],
                'tenbaihoc'=>$inputs['tenbaihoc'],
            ];
            baihoc::create($data);
        }else{
            $inputs['mabaihoc']=$baihoc->mabaihoc;
        }

        hinhanh::create($inputs);
        loghethong(getIP(),session('admin'),'them','hinhanh');
        return redirect('/HinhAnh/ThongTin')
                ->with('success','Thêm mới thành công');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!chkPhanQuyen('hinhanh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'hinhanh');
        }

        $inputs=$request->all();
        $model=hinhanh::where('mahinhanh',$id)->first();
        if(isset($inputs['hinhanh'])){
            if(File::exists($model->hinhanh)){
                File::Delete($model->hinhanh);
            }
       
            $file = $inputs['hinhanh'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/hinhanh/anh/', $name);
            $inputs['hinhanh'] = 'uploads/hinhanh/anh/' . $name;
        }

        if(isset($inputs['audio'])){
            if(File::exists($model->audio)){
                File::Delete($model->audio);
            }
            $file = $inputs['audio'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/hinhanh/audio/', $name);
            $inputs['audio'] = 'uploads/hinhanh/audio/' . $name;
        }

        if(isset($model)){
            $model->update($inputs);
            loghethong(getIP(),session('admin'),'capnhat','hinhanh');
        }
        
        return redirect('/HinhAnh/ThongTin?mabaihoc='.$model->mabaihoc)->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!chkPhanQuyen('hinhanh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'hinhanh');
        }
        $model=hinhanh::where('mahinhanh',$id)->first();
        $mabaihoc=$model->mabaihoc;
        if(isset($model)){
            if(File::exists($model->hinhanh)){
                File::Delete($model->hinhanh);
            }
            if(File::exists($model->audio)){
                File::Delete($model->audio);
            }
            $model->delete();
            loghethong(getIP(),session('admin'),'xoa','hinhanh');
        }

        return redirect('/HinhAnh/ThongTin?mabaihoc='.$mabaihoc)->with('success','Xóa thành công');
    }
    public function import(Request $request){
        if (!chkPhanQuyen('hinhanh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'tuvung');
        }
        $inputs = $request->all();
        // dd($inputs);
        $dataObj = new ColectionImport();
        $theArray = Excel::toArray($dataObj, $inputs['file']);
        $arr = $theArray[0];
        $arr_col = array('tenbaihoc','hinhanh','audio', 'tienghan','A','B','C','D','dapan');
        $nfield = sizeof($arr_col);
        // dd($arr);
        for ($i = 1; $i < count($arr); $i++) {
            $data = array();
            $data['mahinhanh'] = date('YmdHis') . $i;

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
            } else {
                $data['mabaihoc'] = $baihoc->mabaihoc;
            }
            unset($data['tenbaihoc']);
            hinhanh::create($data);
        }
        loghethong(getIP(),session('admin'),'excel','hinhanh');
        return redirect('/HinhAnh/ThongTin')
                    ->with('success','Thêm thành công');
    }
}
