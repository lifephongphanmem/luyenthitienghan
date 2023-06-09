@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
@stop

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
@stop

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">Thông tin người dùng</h3>
                    </div>
                    {{-- <div class="card-toolbar">
                    
                </div> --}}
                </div>

                <div class="card-body">
                    <div class="row" style="padding-left: 10%; padding-right: 10%">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="tenhocvien">Tên học viên</label>
                                <input type="text" class="form-control-plaintext" readonly id="tenhocvien"
                                    value="{{ $hocvien->tenhocvien }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="cccd">Số CCCD</label>
                                <input type="text" class="form-control-plaintext" readonly id="cccd"
                                    value="{{ $hocvien->cccd }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="sdt">Số điện thoại</label>
                                <input type="text" class="form-control-plaintext" readonly id="sdt"
                                    value="{{ $hocvien->sdt }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="email">Địa chỉ email</label>
                                <input type="text" class="form-control-plaintext" readonly id="email"
                                    value="{{ $hocvien->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="padding-left: 10%; padding-right: 10%">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="ngaysinh">Ngày sinh</label>
                                <input type="text" class="form-control-plaintext" readonly id="ngaysinh"
                                    value="{{ getDayVn($hocvien->ngaysinh) }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="gioitinh">Giới tính</label>
                                <input type="text" class="form-control-plaintext" readonly id="gioitinh"
                                    value={{ $hocvien->gioitinh == '1' ? 'Nam' : 'Nữ' }}>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="diachi">Địa chỉ</label>
                                <input type="text" class="form-control-plaintext" readonly id="diachi"
                                    value="{{ $hocvien->diachi }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="ghichu">Ghi chú</label>
                                <input type="text" class="form-control-plaintext" readonly id="ghichu"
                                    value="{{ $hocvien->ghichu }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Row-->
    <!--begin::Row-->
    <div class="row" style="padding-top: 20px">
        <div class="col-xl-12">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">Kết quả thi thử</h3>
                    </div>
                    {{-- <div class="card-toolbar">
                    
                </div> --}}
                </div>

                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Tên đề thi</th>
                                <th>Điểm thi</th>
                                <th>Ngày thi</th>
                                <th>Giờ thi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ketquathi as $key => $ketqua)
                                <tr class="text-center">
                                    <td style="width: 10%">{{ ++$key }}</td>
                                    <td style="width: 30%">{{ $ketqua->tende }}</td>
                                    <td style="width: 20%">{{ $ketqua->diemthi }}</td>
                                    <td style="width: 20%">{{ getDayVn($ketqua->ngaythi) }}</td>
                                    <td style="width: 20%">{{ $ketqua->giothi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Row-->
@stop
