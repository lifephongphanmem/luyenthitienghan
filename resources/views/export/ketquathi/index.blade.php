@extends('main_baocao')

@section('content')

<p id='data_header' style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase">kết quả thi thử<br>
</p>
<table id="data_body" width="96%" cellspacing="0" cellpadding="8" style="margin:20px auto 20px; text-align: center;">
    <tr>
        <td style="text-align:left;width:5%">Lớp học</td>
        <td class="text-left">: {{$a_lophoc[$inputs['malop']]}}</td>
    </tr>
    {{-- <tr>
        <td style="text-align:left">Đề thi</td>
        <td class="text-left">: {{$a_dethi[$thongtin_thithu->madethi]??''}}</td>
    </tr> --}}
    <tr >
        <td style="text-align:left">Thời gian thi thử</td>
        <td width="40%" style="vertical-align: top;text-align:left">
            : {{getDayVn($inputs['ngaythi'])}}
        </td>
    </tr>
</table>
<table id="data_body2" border="1" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th rowspan="2">TT</th>
            <th rowspan="2">Họ và tên </th>
            <th colspan="2" style="width:10%">Ngày tháng năm sinh<br></th>
            <th rowspan="2">Số CCCD/CMND </th>
            <th rowspan="2">Địa chỉ</th>
            <th rowspan="2">Điểm thi</th>
            <th rowspan="2">Thời gian làm bài</th>
        </tr>
        <tr>
            <th>Nam</th>
            <th>Nữ</th>
        </tr>
        <tr>
            @for ($i = 1; $i < 9; $i++)
                <td style="font-weight:bold; text-decoration: underline;font-style: italic;text-align: center">
                    {{ $i }}</td>
            @endfor
        </tr>

    </thead>
    <?php $stt = 1; ?>
    <tbody>
        @foreach ($a_madeketqua as $key=>$made )
            <tr style="font-weight:bold">
                <td>{{convert2Roman(++$key)}}</td>
                <td colspan="7">{{$a_dethi[$made]??''}}</td>
            </tr>
            <?php $m_hocvien=$hocvien->where('madethi',$made); ?>
            @foreach ($m_hocvien as $item)
            <tr>
                <td style="text-align: center ; vertical-align: middle">{{ $stt++ }}</td>
                <td style="vertical-align: middle">{{ $item->tenhocvien }}</td>

                @if ($item->gioitinh == 1)
                    <td style="text-align: center ; vertical-align: middle">{{ getDayVn($item->ngaysinh) }}</td>
                @else
                    <td></td>
                @endif
                @if ($item->gioitinh == 0)
                    <td style="text-align: center ; vertical-align: middle">{{ $item->ngaysinh }}</td>
                @else
                    <td></td>
                @endif

                <td style="text-align: center ; vertical-align: middle">{{ $item->cccd }}</td>
                <td style="vertical-align: middle">{{ $item->diachi }}</td>
                <td style="text-align: center ; vertical-align: middle">{{ $item->diemthi }}</td>
                <td style="text-align: center ; vertical-align: middle">{{gmdate("H:i:s",$item->thoigianlambai)  }}</td>

                {{-- <td style="text-align: center ; vertical-align: middle">{{ $item->mqh }}</td> --}}

                {{-- @if ($item->mqh == 'CH')
                    <td style="text-align: center ; vertical-align: middle">{{ $item->mqh }}</td>
                @else
                    <td></td>
                @endif --}}

            </tr>
        @endforeach
        @endforeach


    </tbody>
</table>
@stop
