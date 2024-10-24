<?php

namespace App\Http\Controllers\Thivong2;

use App\Http\Controllers\Controller;
use App\Models\ThiVong2\vandap;
use Illuminate\Http\Request;

class vandapController extends Controller
{
    public function ThongTin()
    {
        $model = vandap::all();

        return view('thivong2.vandap.index')
            ->with('model', $model)
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

        $data_cauhoi=[
            'audio'=>$inputs['audio'],
            'macau'=>$macau,
            'noidung'=>$inputs['noidung'],
            'nghiatiengviet'=>$inputs['nghiatiengviet'],
            'stt'=>$inputs['stt']
        ];
        foreach($inputs['cautraloi'] as $key=> $ct){
            $data_cautraloi=[
                'macau'=>$macau,
                'macautraloi'=>$macau.'_'.$key,
                'noidung'=>$ct,
                'stt'=>++$key
            ];
        }

    }
}
