@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
@endsection

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>

    <script src="{{ url('assets/admin/pages/scripts/table-lifesc.js') }}"></script>
    <script src="{{ url('js/custome-form.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
        });
    </script>
    {{-- <script>
        var str = '{{ json_encode($ketqua) }}';
        str = str.replace(/&quot;/ig, '"');
        console.log(JSON.parse(str))
    </script> --}}
@endsection

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">Kết quả tra cứu</h3>
                    </div>
                    <div class="card-toolbar"></div>
                </div>

                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
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
                </div>
            </div>
        </div>
        <!--end::Card-->
        <!--end::Example-->
    </div>
    <!--end::Row-->
@endsection
