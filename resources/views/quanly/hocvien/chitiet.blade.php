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
                        <h3 class="card-label text-uppercase">Thông tin học viên</h3>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row" style="padding-bottom: 10px">
                        <div class="col-6">
                            <div class="row align-items-center" style="padding-left: 5%">
                                <div class="col-sm-3">Họ tên:</div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ $hocvien->tentaikhoan }}">
                                </div>
                            </div>
                            <div class="row align-items-center" style="padding-left: 5%">
                                <div class="col-sm-3">Số CCCD:</div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ $hocvien->cccd }}">
                                </div>
                            </div>
                            <div class="row align-items-center" style="padding-left: 5%">
                                <div class="col-sm-3">Số điện thoại:</div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ $hocvien->sodienthoai }}">
                                </div>
                            </div>
                            <div class="row align-items-center" style="padding-left: 5%">
                                <div class="col-sm-3">Địa chỉ email:</div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ $hocvien->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row align-items-center" style="padding-left: 5%">
                                <div class="col-sm-3">Ngày sinh:</div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ getDayVn($hocvien->ngaysinh) }}">
                                </div>
                            </div>
                            <div class="row align-items-center" style="padding-left: 5%">
                                <div class="col-sm-3">Giới tính:</div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ $hocvien->gioitinh == '1' ? 'Nam' : 'Nữ' }}">
                                </div>
                            </div>
                            <div class="row align-items-center" style="padding-left: 5%">
                                <div class="col-sm-3">Địa chỉ:</div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ $hocvien->diachi }}">
                                </div>
                            </div>
                            <div class="row align-items-center" style="padding-left: 5%">
                                <div class="col-sm-3">Ghi chú:</div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" readonly
                                        value="{{ $hocvien->ghichu }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="card-label text-uppercase pb-3" style="padding-top: 10px">Kết quả thi thử</h5>
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
                                    <td class="text-left" style="width: 30%">{{ $ketqua->tende }}</td>
                                    <td style="width: 20%">{{ $ketqua->diemthi }}</td>
                                    <td style="width: 20%">{{ getDayVn($ketqua->ngaythi) }}</td>
                                    <td style="width: 20%">{{ $ketqua->giothi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Card-->
        <hr>

    </div>
    <!--end::Row-->
@stop
