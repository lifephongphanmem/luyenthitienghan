@extends('main_baocao')

@section('content')

    <p id='data_header' style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase">DANH SÁCH HỌC
        VIÊN<br>
    </p>
    <table id="data_body2" border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th rowspan="2">TT</th>
                <th rowspan="2">Họ và tên </th>
                <th colspan="2" style="width:10%">Ngày tháng năm sinh<br></th>
                <th rowspan="2">Số CCCD/CMND </th>
                <th rowspan="2">Điện thoại </th>
                <th rowspan="2">Địa chỉ</th>
                <th rowspan="2">Điểm thi</th>
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
            @foreach ($khoahoc as $k => $ct)
                <tr style="font-weight:bold">
                    <td>{{ convert2Roman(++$k) }}</td>
                    <td colspan="6">Khóa: {{ $ct->khoahoc }}</td>
                </tr>
                <?php $m_hocvien = $model->where('khoahoc', $ct->khoahoc); ?>
                @foreach ($m_hocvien as $key => $made)
                    @foreach ($m_hocvien as $k=>$item)
                        <tr>
                            <td style="text-align: center ; vertical-align: middle">{{ ++$k }}</td>
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
                            <td style="text-align: center ; vertical-align: middle">{{ $item->sdt }}</td>
                            <td style="vertical-align: middle">{{ $item->diachi }}</td>
                            <td style="text-align: center ; vertical-align: middle">{{ $item->diemthi }}</td>


                        </tr>
                    @endforeach
                @endforeach
            @endforeach


        </tbody>
    </table>
@stop
