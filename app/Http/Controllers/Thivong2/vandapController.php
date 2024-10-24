<?php

namespace App\Http\Controllers\Thivong2;

use App\Http\Controllers\Controller;
use App\Models\ThiVong2\vandap;
use App\Models\ThiVong2\vandap_cautraloi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class vandapController extends Controller
{
    public function ThongTin()
    {
        $model = vandap::all();
        $m_cautraloi = vandap_cautraloi::wherein('macau', array_column($model->toarray(), 'macau'))->get();
        $stt = $model->max('stt') ?? 1;
        // dd($m_cautraloi);
        return view('thivong2.vandap.index')
            ->with('model', $model)
            ->with('m_cautraloi', $m_cautraloi)
            ->with('stt', $stt)
            ->with('baocao', getdulieubaocao())
            ->with('pageTitle', 'Quản lý câu hỏi vấn đáp');
    }

    public function LuuCauHoi(Request $request)
    {
        $inputs = $request->all();
        $macau = getdate()[0];
        //file audio
        if (isset($inputs['audio'])) {
            $file = $inputs['audio'];
            $name = time() . $file->getClientOriginalName();
            $file->move('data/vandap/audio/', $name);
            $inputs['audio'] = 'data/vandap/audio/' . $name;
        }

        $data_cauhoi = [
            'audio' => $inputs['audio'],
            'macau' => $macau,
            'noidung' => $inputs['noidung'],
            'nghiatiengviet' => $inputs['nghiatiengviet'],
            'stt' => $inputs['stt']
        ];
        foreach ($inputs['cautraloi'] as $key => $ct) {
            $data_cautraloi = [
                'macau' => $macau,
                'macautraloi' => $macau . '_' . $key,
                'noidung' => $ct,
                'stt' => ++$key
            ];
            vandap_cautraloi::create($data_cautraloi);
        }

        vandap::create($data_cauhoi);

        return redirect('ThiVong2/VanDap/ThongTin')
            ->with('success', 'Thêm thành công');
    }

    public function edit(Request $request)
    {
        $inputs = $request->all();

        $model = vandap::findOrFail($inputs['id']);
        $m_cautraloi = vandap_cautraloi::where('macau', $model->macau)->get();

        $result = array(
            'status' => 'fail',
            'message' => 'error',
        );

        $result['message'] = '<div class="form-group row" id="edit_cauhoi">';
        $result['message'] .= '<input type="hidden" name="macau" value="' . $model->macau . '">';
        $result['message'] .= '<div class="col-md-12 mt-2 mb-2">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Câu hỏi<span class="require">*</span></label>';
        $result['message'] .= '<input type="text" name="noidung" value="' . $model->noidung . '" class="form-control">';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="col-md-12 mt-2 mb-2">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Nghĩa tiếng việt<span class="require">*</span></label>';
        $result['message'] .= '<input type="text" name="nghiatiengviet" value="' . $model->nghiatiengviet . '" class="form-control">';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="col-md-12 mt-2 mb-2" id="cautl_edit">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Câu trả lời<span class="require">*</span></label>';
        foreach ($m_cautraloi as $ct) {
            $result['message'] .= '<input type="text" name="cautraloi[]" value="' . $ct->noidung . '" class="form-control mt-2">';
        }

        $result['message'] .= '</div>';

        $result['message'] .= '<div class="col-md-12">';
        $result['message'] .= '<button type="button" class="btn btn-xs btn-primary" title="Thêm câu trả lời" onclick="addAns_edit()" ><i class="fa fa-plus"></i>Thêm câu trả lời</button>';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="col-md-12 mt-2 mb-2">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Audio</label>';
        $result['message'] .= '<input type="file" name="audio" accept=".mp3" class="form-control">';
        $result['message'] .= '</div>';
        $result['message'] .= '<div class="col-md-12 mt-2 mb-2">';
        $result['message'] .= '<label class="control-label font-weight-bolder">Số thứ tự<span class="require">*</span></label>';
        $result['message'] .= '<input type="text" name="stt" value="' . $model->stt . '" class="form-control">';
        $result['message'] .= '</div>';

        $result['status'] = 'success';

        return response()->json($result);
    }
    public function CapNhat(Request $request)
    {
        $inputs = $request->all();
        // dd($inputs);
        $model = vandap::where('macau', $inputs['macau'])->first();
        if (isset($model)) {

            $model->noidung = $inputs['noidung'];
            $model->nghiatiengviet = $inputs['nghiatiengviet'];
            $model->stt = $inputs['stt'];
            if (isset($inputs['audio'])) {
                if (File::exists($model->audio)) {
                    File::Delete($model->audio);
                }
                $file = $inputs['audio'];
                $name = time() . $file->getClientOriginalName();
                $file->move('data/vandap/audio/', $name);
                $inputs['audio'] = 'data/vandap/audio/' . $name;
                $model->audio = $inputs['audio'];
            }
            $model->save();

            vandap_cautraloi::where('macau', $inputs['macau'])->delete();
            foreach ($inputs['cautraloi'] as $key => $ct) {
                $data_cautraloi = [
                    'macau' => $model->macau,
                    'macautraloi' => $model->macau . '_' . $key,
                    'noidung' => $ct,
                    'stt' => ++$key
                ];
                if (isset($ct)) {
                    vandap_cautraloi::create($data_cautraloi);
                }
            }
        }
        return redirect('ThiVong2/VanDap/ThongTin')
            ->with('success', 'Cập nhật thành công');
    }
    public function XoaCauHoi(Request $request, $id)
    {
        $model = vandap::findOrFail($id);
        if (isset($model)) {
            vandap_cautraloi::where('macau', $model->macau)->delete();
            if (File::exists($model->audio)) {
                File::Delete($model->audio);
            }
            $model->delete();
        }
        return redirect('ThiVong2/VanDap/ThongTin')
            ->with('success', 'Xóa thành công');
    }
}
