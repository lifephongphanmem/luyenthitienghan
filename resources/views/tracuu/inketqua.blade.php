@extends('main_baocao')

@section('content')

    <p id='data_header' style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase">KẾT QUẢ TRA CỨU<br>
    </p>
    <table id="data_body2" border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr class="text-center">
                <th rowspan="2">STT</th>
                <th rowspan="2">Họ tên</th>
                <th rowspan="2">Phân loại</th>
                <th rowspan="2">Số điện thoại</th>
                <th rowspan="2">Số CCCD</th>
                <th rowspan="2">Giới tính</th>
                <th rowspan="2">Ngày sinh</th>
                <th colspan="2">Kết quả thi thử</th>
                <th rowspan="2">Lớp</th>
            </tr>
            <tr class="text-center">
                <th>Ngày thi</th>
                <th>Điểm thi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ketqua as $key => $kq)
                <tr class="text-center">
                    <td style="width: 5%">{{ ++$key }}</td>
                    <td style="width: 20%">
                        @if (isset($kq['tengiaovien']))
                            {{ $kq['tengiaovien'] }}
                        @elseif (isset($kq['tenhocvien']))
                            {{ $kq['tenhocvien'] }}
                        @endif
                    </td>
                    <td style="width: 10%">
                        @if (isset($kq['tenhocvien']))
                            Học viên
                        @elseif (isset($kq['tengiaovien']))
                            Giáo viên
                        @endif
                    </td>
                    <td style="width: 10%">{{ $kq['sdt'] }}</td>
                    <td style="width: 10%">{{ $kq['cccd'] }}</td>
                    <td style="width: 5%">
                        @if ($kq['gioitinh'] == 1)
                            Nam
                        @elseif ($kq['gioitinh'] == 0)
                            Nữ
                        @endif
                    </td>
                    <td style="width: 5%">
                        {{ getDayVn($kq['ngaysinh']) }}
                    </td>
                    <td style="width: 10%">
                        @if (isset($kq['ngaythi']))
                            {{ getDayVn($kq['ngaythi']) }}
                        @endif
                    </td>
                    <td style="width: 10%">
                        @if (isset($kq['diemthi']))
                            {{ $kq['diemthi'] }}
                        @endif
                    </td>
                    <td style="width: 10%">
                        @if (isset($kq['tenlop']))
                            {{ $kq['tenlop'] }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop