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
                    <td>{{ strtoupper(toAlpha(++$k)) }}</td>
                    <td colspan="7">Khóa: {{ $ct->khoahoc }}</td>
                </tr>
                <?php $m_hocvien_khoahoc = $model->where('khoahoc', $ct->khoahoc); ?>
                @foreach ($lophoc as $key=>$val )
                    <?php $m_hocvien=$m_hocvien_khoahoc->where('malop',$val->malop);
                    $stt=0;
                    ?>
                    <tr style="font-weight:bold; font-style:italic">
                        <td>{{ convert2Roman(++$key) }}</td>
                        <td colspan="7">Lớp: {{ $val->tenlop }}</td>
                    </tr>
                    
                    @foreach ($m_hocvien as $item)   
                    <tr>
                        <td style="text-align: center ; vertical-align: middle">{{ ++$stt }}</td>
                        <td style="vertical-align: middle">{{ $item->tentaikhoan }}</td>

                        @if ($item->gioitinh == 1)
                            <td style="text-align: center ; vertical-align: middle">{{ getDayVn($item->ngaysinh) }}</td>
                        @else
                            <td></td>
                        @endif
                        @if ($item->gioitinh == 0)
                            <td style="text-align: center ; vertical-align: middle">{{  getDayVn($item->ngaysinh) }}</td>
                        @else
                            <td></td>
                        @endif

                        <td style="text-align: center ; vertical-align: middle">{{ $item->cccd }}</td>
                        <td style="text-align: center ; vertical-align: middle">{{ $item->sodienthoai }}</td>
                        <td style="vertical-align: middle">{{ $item->diachi }}</td>
                        <td style="text-align: center ; vertical-align: middle">{{ $item->diemthi }}</td>


                    </tr>
                @endforeach
                @endforeach
            @endforeach


        </tbody>
    </table>
@stop
