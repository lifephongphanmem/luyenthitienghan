@extends('main_baocao')

@section('content')

    <p id='data_header' style="text-align: center;font-weight: bold;font-size: 20px; text-transform: uppercase">Nhật ký sử dụng hệ thống<br>
    </p>
    <table  id="data_body2" border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr class="text-center">
                <th>STT</th>
                <th >IP</th>
                <th >Tài khoản truy cập</th>
                <th >Tên tài khoản</th>
                <th >Thời gian</th>
                <th >Nội dung</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($model as $key => $cauhinh)
                <tr class="text-center">
                    <td style="width: 1%">{{ ++$key }}</td>
                    <td name='machucnang' class="text-left" style="width: 8%">{{ $cauhinh->ip }}</td>
                    <td name='thumuc' class="text-left" style="width: 10%">{{ $cauhinh->taikhoantruycap }}</td>
                    <td  class="text-left" style="width: 10%">{{ $cauhinh->tentaikhoan }}</td>
                    <td name='thoigianluu' style="width: 10%">{{ Carbon\Carbon::parse($cauhinh->thoigian)->format('H:i:s d-m-Y') }}</td>
                    <td name='noidung' style="width: 20%">{{ $cauhinh->noidung }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
