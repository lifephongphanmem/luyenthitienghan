@extends('main_baocao')

@section('content')

    <p id='data_header' style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase">DANH SÁCH LỚP
        HỌC<br>
    </p>
    <table id="data_body2" border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th>Tên lớp</th>
                <th>Khóa học</th>
                <th>Học viên</th>
                <th>Giáo viên chủ nhiệm</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($khoahoc as $k => $ct)
                <tr style="font-weight:bold">
                    <td>{{ convert2Roman(++$k) }}</td>
                    <td colspan="4">Khóa: {{ $ct->khoahoc }}</td>
                </tr>
                @foreach ($model as $key => $lh)
                    <tr class="text-center">
                        <td style="width: 2%">{{ ++$key }}</td>
                        <td name='tenlop' class="text-left" style="width: 20%">{{ $lh->tenlop }}</td>
                        <td name='khoahoc' class="text-left" style="width: 10%">{{ $lh->khoahoc }}</td>
                        <td name='soluonghocvien' style="width: 10%">{{ $lh->soluonghocvien }}</td>
                        <td name='giaovienchunhiem' class="text-left" style="width: 30%">
                            {{ isset($a_giaovien[$lh->giaovienchunhiem]) ? $a_giaovien[$lh->giaovienchunhiem] : '' }}
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
@stop
