<?php

namespace App\Http\Controllers\ThiVong2;

use App\Http\Controllers\Controller;
use App\Imports\ColectionImport;
use App\Models\ThiVong2\testmumau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class testMuMauController extends Controller
{
    public function ThongTin()
    {
        $model= testmumau::orderBy('stt')->get();
        $stt = $model->max('stt') ?? 0;
        return view('thivong2.testmumau.index',compact('model'))
        ->with('stt', $stt)
        ->with('baocao', getdulieubaocao())
        ->with('pageTitle', 'Quản lý test mù màu');

    }
    public function Luu(Request $request)
    {
        $inputs = $request->all();
        $inputs['matest'] = getdate()[0];
        //file anh
        if (isset($inputs['hinhanh'])) {
            $file = $inputs['hinhanh'];
            $name = time() . $file->getClientOriginalName();
            $file->move('data/testmumau/', $name);
            $inputs['hinhanh'] = '/data/testmumau/'. $name;
        }

        testmumau::create($inputs);
        return redirect('/TestMuMau/ThongTin')
                ->with('success','Thêm thành công');
    }
    public function Xoa(Request $request, $id)
    {
        $model = testmumau::findOrFail($id);
        if (isset($model)) {
            $url=ltrim($model->hinhanh,'/');
            if (File::exists($url)) {
                File::Delete($url);
            }
            $model->delete();
        }
        return redirect('TestMuMau/ThongTin')
            ->with('success', 'Xóa thành công');
    }
    public function edit(Request $request)
    {
        $inputs = $request->all();
        $model = testmumau::findOrFail($inputs['id']);

        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );

        $result['message'] = '<div class="form-group row" id="edit_cauhoi">';
        $result['message'] .= '<input type="hidden" name="matest" value="' . $model->matest . '">';

        $result['message'] .= '<div class="col-md-6 mt-2 mb-2">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Số thứ tự<span class="require">*</span></label>';
        $result['message'] .= '<input type="number" name="stt" value="' . $model->stt . '" class="form-control">';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="col-md-12 mt-2 mb-2">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Đáp án<span class="require">*</span></label>';
        $result['message'] .= '<input type="text" name="dapan" value="' . $model->dapan . '" class="form-control">';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="col-md-12 mt-2 mb-2">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Hình ảnh</label>';
        $result['message'] .= '<input type="file" name="hinhanh" accept=".jpg,.png,.webp" class="form-control">';
        $result['message'] .= '</div>';


        $result['status'] = 'success';

        return response()->json($result);
    }
    public function CapNhat(Request $request)
    {
        $inputs = $request->all();
        // dd($inputs);
        $model = testmumau::where('matest', $inputs['matest'])->first();
        if (isset($model)) {

            $model->dapan = $inputs['dapan'];
            $model->stt = $inputs['stt'];
            if (isset($inputs['hinhanh'])) {
                $url=ltrim($model->hinhanh,'/');
                if (File::exists($url)) {
                    File::Delete($url);
                }
                $file = $inputs['hinhanh'];
                $name = time() . $file->getClientOriginalName();
                $file->move('data/testmumau/', $name);
                $inputs['hinhanh'] = '/data/testmumau/'. $name;
                $model->hinhanh = $inputs['hinhanh'];
            }
            $model->save();
        }
        return redirect('TestMuMau/ThongTin')
            ->with('success', 'Cập nhật thành công');
    }
    public function NhanExcel(Request $request)
    {
        $inputs=$request->all();
        $dataObj = new ColectionImport();
        $theArray = Excel::toArray($dataObj, $inputs['fexcel']);
        $data = $theArray[0];

        $phanloai=testmumau::all();
            $stt=count($phanloai) > 0?$phanloai->max('stt'):'1';

        $a_data=array();
        for ($i = ($inputs['tudong']-1); $i <= $inputs['dendong']; $i++) {

            if (!isset($data[$i][ColumnName()[$inputs['dapan']]])) {
                continue;
            }
            $hinhanh='/data/testmumau/'.$data[$i][ColumnName()[$inputs['hinhanh']]].'.webp';
            // $inputs['hinhanh'] = '/data/testmumau/'.$hinhanh;
            $a_data[]=array(
                'matest'=>getdate()[0].'_'.$i,
                'dapan'=>$data[$i][ColumnName()[$inputs['dapan']]],
                'hinhanh'=>$hinhanh,
                'stt'=>$stt++
            );
        }
        foreach (array_chunk($a_data, 100) as $data) {
            testmumau::insert($data);
        }

        return redirect('/TestMuMau/ThongTin')
                        ->with('success','Nhận Excel thành công');
    }
}
