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
        if (!chkPhanQuyen('baihocchinh', 'danhsach')) {
            return view('errors.noperm')->with('machucnang', 'baihocchinh');
        }
        $inputs=$request->all();
        $m_baihoc = baihoc::all();
        $inputs['mabaihoc']=$inputs['mabaihoc']??$m_baihoc->first()->mabaihoc;
        // dd($inputs);
        $model = baihocchinh::join('baihoc', 'baihoc.mabaihoc', 'baihocchinh.mabaihoc')
            ->select('baihoc.tenbaihoc', 'baihocchinh.*')
            ->where('baihoc.mabaihoc',$inputs['mabaihoc'])
            ->orderBy('id','desc')
            ->get();
        // dd($model);

        $stt = baihocchinh::max('stt');

        $inputs['url']='/BaiHocChinh/ThongTin';
        return view('baigiang.baihocchinh.index')
            ->with('model', $model)
            ->with('baocao',getdulieubaocao())
            ->with('stt', $stt ?? 0)
            ->with('m_baihoc', $m_baihoc)
            ->with('inputs',$inputs)
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
        loghethong(getIP(),session('admin'),'them','baihocchinh');
        return redirect('/BaiHocChinh/ThongTin')
            ->with('success', 'Thêm mới thành công');
    }

    public function update(Request $request,$id)
    {
        if (!chkPhanQuyen('baihocchinh', 'thaydoi')) {
            return view('errors.noperm')->with('machucnang', 'baihocchinh');
        }
        $inputs=$request->all();
        $model=baihocchinh::findOrFail($id);
        if(isset($inputs['anh'])){
            if(File::exists($model->anh)){
                File::Delete($model->anh);
            }
            $file = $inputs['anh'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/anh/', $name);
            $inputs['anh'] = 'uploads/anh/' . $name;
        }
        if(isset($inputs['anh2'])){
            if(File::exists($model->anh2)){
                File::Delete($model->anh2);
            }
            $file = $inputs['anh2'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/anh2/', $name);
            $inputs['anh2'] = 'uploads/anh2/' . $name;
        }
        if (isset($inputs['audio'])) {
            if(File::exists($model->audio)){
                File::Delete($model->audio);
            }
            $file = $inputs['audio'];
            $name = time() . $file->getClientOriginalName();
            $file->move('uploads/audio/', $name);
            $inputs['audio'] = 'uploads/audio/' . $name;
        }

        //trường hợp lúc đầu có dữ liệu nhưng sau muốn bỏ dữ liệu
        if(isset($model->anh) && !isset($inputs['remove_anh'])){
            $inputs['anh']= null;
        }
        if(isset($model->anh2) && !isset($inputs['remove_anh2'])){
            $inputs['anh2']= null;
        }
        if(isset($model->audio) && !isset($inputs['audio'])){
            $inputs['audio']= null;
        }



        $model->update($inputs);
        loghethong(getIP(),session('admin'),'capnhat','baihocchinh');
        return redirect('/BaiHocChinh/ThongTin?mabaihoc='.$model->mabaihoc)->with('success','Cập nhật thành công');
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
            loghethong(getIP(),session('admin'),'xoa','baihocchinh');
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
        $baihoc = baihoc::where('mabaihoc', $inputs['tenbaihoc'])->first();
        if (!isset($baihoc)) {
            $inputs['mabaihoc'] = getdate()[0];
            $inputs['link1']='data/bai'.$arr[1][0].'/baihocchinh/'.$arr[1][0].'.mp4';
            $sott= baihoc::max('stt');
            $inputs['stt']=$sott??0;
            $databaihoc = [
                'mabaihoc' => $inputs['mabaihoc'],
                'tenbaihoc' => $inputs['tenbaihoc'],
                'link1'=>$inputs['link1'],
                'stt'=>++$inputs['stt']
            ];
            baihoc::create($databaihoc);
           $stt=1;
            $mabaihoc=$inputs['mabaihoc'];
        } else {
            $mabaihoc = $baihoc->mabaihoc;
            $sothutu=baihocchinh::where('mabaihoc',$inputs['tenbaihoc'])->max('stt');
            $stt=++$sothutu;
        }

        for ($i = 1; $i < count($arr); $i++) {
            $data = array();
            $data['mabaihocchinh'] = date('YmdHis') . $i;

            for ($j = 0; $j < $nfield; $j++) {
                $data[$arr_col[$j]] = $arr[$i][$j];
            }
            $data['mabaihoc']=$mabaihoc;
            $data['stt']=$stt;
            // dd($data);
            unset($data['tenbaihoc']);
            baihocchinh::create($data);
        }
        loghethong(getIP(),session('admin'),'excel','baihocchinh');

       return redirect('/BaiHocChinh/ThongTin')
                ->with('success','Thêm thành công');
    }
}
