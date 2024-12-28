<?php

namespace App\Http\Controllers\Thivong2;

use App\Http\Controllers\Controller;
use App\Imports\ColectionImport;
use App\Models\Thivong2\congcu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class congcuController extends Controller
{
    public function ThongTin(Request $request)
    {
        $inputs = $request->all();
        $inputs['phanloai'] = $inputs['phanloai'] ?? '1';
        $model = congcu::where('phanloai',$inputs['phanloai'])->orderBy('stt')->get();
        $stt = $model->max('stt') ?? 0;
        return view('thivong2.congcu.index')
            ->with('model', $model)
            ->with('inputs', $inputs)
            ->with('stt', $stt)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Quản lý công cụ lao động');
    }
    public function LuuCongCu(Request $request)
    {
        $inputs = $request->all();
        $inputs['macongcu'] = getdate()[0];
        //file anh
        if (isset($inputs['hinhanh'])) {
            $file = $inputs['hinhanh'];
            $name = time() . $file->getClientOriginalName();
            $file->move('data/congcu/'.getNganhfodder()[$inputs['phanloai']], $name);
            $inputs['hinhanh'] = '/data/congcu/'.getNganhfodder()[$inputs['phanloai']] .'/'. $name;
        }

        congcu::create($inputs);
        return redirect('/CongCu/ThongTin?phanloai='.$inputs['phanloai'])
                ->with('success','Thêm thành công');
    }
    public function XoaCongCu(Request $request, $id)
    {
        $model = congcu::findOrFail($id);
        if (isset($model)) {
            $url=ltrim($model->hinhanh,'/');
            if (File::exists($url)) {
                File::Delete($url);
            }
            $model->delete();
        }
        return redirect('CongCu/ThongTin?phanloai='.$model->phanloai)
            ->with('success', 'Xóa thành công');
    }
    public function edit(Request $request)
    {
        $inputs = $request->all();
        $model = congcu::findOrFail($inputs['id']);

        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );

        $result['message'] = '<div class="form-group row" id="edit_cauhoi">';
        $result['message'] .= '<input type="hidden" name="macongcu" value="' . $model->macongcu . '">';
        $result['message'] .= '<div class="col-md-6 mt-2 mb-2">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Phân loại<span class="require">*</span></label>';
        $result['message'] .= '<select name="phanloai" class="form-control">';
        foreach (getNganhXK() as $key => $ct) {
            $result['message'] .= '<option value="' . $key . '"' . ($key == $model->phanloai ? "selected" : "") . '>' . $ct . '</option>';
        }
        $result['message'] .= '</select>';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="col-md-6 mt-2 mb-2">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Số thứ tự<span class="require">*</span></label>';
        $result['message'] .= '<input type="text" name="stt" value="' . $model->stt . '" class="form-control">';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="col-md-12 mt-2 mb-2">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Tên công cụ<span class="require">*</span></label>';
        $result['message'] .= '<input type="text" name="tencongcu" value="' . $model->tencongcu . '" class="form-control">';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="col-md-12 mt-2 mb-2">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Tiếng Hàn<span class="require">*</span></label>';
        $result['message'] .= '<input type="text" name="tiengHan" value="' . $model->tiengHan . '" class="form-control">';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="col-md-12 mt-2 mb-2">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Hình ảnh</label>';
        $result['message'] .= '<input type="file" name="hinhanh" accept=".jpg;.png" class="form-control">';
        $result['message'] .= '</div>';


        $result['status'] = 'success';

        return response()->json($result);
    }
    public function CapNhat(Request $request)
    {
        $inputs = $request->all();
        // dd($inputs);
        $model = congcu::where('macongcu', $inputs['macongcu'])->first();
        if (isset($model)) {

            $model->tencongcu = $inputs['tencongcu'];
            $model->tiengHan = $inputs['tiengHan'];
            $model->stt = $inputs['stt'];
            $model->phanloai = $inputs['phanloai'];
            if (isset($inputs['hinhanh'])) {
                $url=ltrim($model->hinhanh,'/');
                if (File::exists($url)) {
                    File::Delete($url);
                }
                $file = $inputs['hinhanh'];
                $name = time() . $file->getClientOriginalName();
                $file->move('data/congcu/'.getNganhfodder()[$inputs['phanloai']], $name);
                $inputs['hinhanh'] = '/data/congcu/'.getNganhfodder()[$inputs['phanloai']] .'/'. $name;
                $model->hinhanh = $inputs['hinhanh'];
            }
            $model->save();
        }
        return redirect('CongCu/ThongTin?phanloai='.$model->phanloai)
            ->with('success', 'Cập nhật thành công');
    }
    public function NhanExcel(Request $request)
    {
        $inputs=$request->all();
        $dataObj = new ColectionImport();
        $theArray = Excel::toArray($dataObj, $inputs['fexcel']);
        $data = $theArray[0];

        $phanloai=congcu::where('phanloai',$inputs['phanloai'])->get();
            $stt=count($phanloai) > 0?$phanloai->max('stt'):'1';

        $a_data=array();
        for ($i = ($inputs['tudong']-1); $i <= $inputs['dendong']; $i++) {

            if (!isset($data[$i][ColumnName()[$inputs['tiengHan']]])) {
                continue;
            }
            $hinhanh=removeVietnameseTones($data[$i][ColumnName()[$inputs['tiengViet']]]).'.webp';
            $inputs['hinhanh'] = '/data/congcu/'.getNganhfodder()[$inputs['phanloai']].'/'.$hinhanh;
            $a_data[]=array(
                'phanloai'=>$inputs['phanloai'],
                'macongcu'=>getdate()[0].'_'.$i,
                'tencongcu'=>$data[$i][ColumnName()[$inputs['tiengViet']]],
                'tiengHan'=>$data[$i][ColumnName()[$inputs['tiengHan']]],
                'hinhanh'=>$inputs['hinhanh'],
                'stt'=>$stt++
            );
        }

        foreach (array_chunk($a_data, 100) as $data) {
            congcu::insert($data);
        }

        return redirect('/CongCu/ThongTin?phanloai='.$inputs['phanloai'])
                        ->with('success','Nhận Excel thành công');
    }
}
