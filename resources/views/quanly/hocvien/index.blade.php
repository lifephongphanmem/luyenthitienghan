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
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">Danh sách học viên</h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="add()" data-target="#themmoi" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i> Tạo mới</button>
                        {{-- <button class="btn btn-xs btn-icon btn-success mr-2" title="Nhận dữ liệu từ file Excel"
                            data-target="#modal-nhanexcel" data-toggle="modal">
                            <i class="fas fa-file-import"></i>
                        </button> --}}
                    </div>
                </div>

                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>CCCD/CMND</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                {{-- <th>Trạng thái</th> --}}
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $hv)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td class="text-left" style="width: 12%">{{ $hv->tentaikhoan }}</td>
                                    <td style="width: 6%">{{ $hv->cccd }}</td>
                                    <td style="width: 6%">{{ $hv->gioitinh == 0 ? 'Nữ' : 'Nam' }}</td>
                                    <td style="width: 7%">{{ getDayVn($hv->ngaysinh) }}</td>
                                    <td class="text-left" style="width: 8%">
                                        {{ $hv->sodienthoai }}</td>
                                    <td style="width:15%">{{ $hv->diachi }}</td>
                                    {{-- <td name='trangthai' style="width:10%" class="{{$a_texttrangthai[$gv->trangthai]}}">{{$a_trangthai[$gv->trangthai]}}</td> --}}
                                    <td class="text-center" style="width:8%">
                                        <button title="Sửa thông tin" onclick="edit(this,'{{ $hv->id }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>
                                        <a href="{{ '/HocVien/ThongTin/ChiTiet/' . $hv->mataikhoan }}"
                                            rel="noopener noreferrer">
                                            <button title="Chi tiết" class="btn btn-sm btn-clean btn-icon">
                                                <i class="icon-xl fas fa-atlas text-success "></i>
                                            </button>
                                        </a>
                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/HocVien/delete/' . $hv->id }}')"
                                            class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm"
                                            data-toggle="modal">
                                            <i class="icon-lg la fa-trash-alt text-danger icon-2x"></i></button>
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
    <!--Thêm mới -->
    <div id="themmoi" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="{{ '/HocVien/store' }}" method="POST" id="frm_giaovien" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin học viên
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="control-label">Họ tên<span class="require">*</span></label>
                                <input type="text" name="tenhocvien" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Email<span class="require">*</span></label>
                                <input type="text" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="control-label">Ngày sinh <span class="require">*</span></label>
                                <input type="date" name="ngaysinh" class="form-control" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="control-label">CCCD/CMND <span class="require">*</span></label>
                                <input type="text" name="cccd" class="form-control" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="control-label">Giới tính</label>
                                <select name="gioitinh" class="form-control select2basic"style="width:100%">
                                    <option value="0">Nữ</option>
                                    <option value="1">Nam</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label class="control-label">Số điện thoại</label>
                                <input type="text" name="sdt" class="form-control">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="control-label">Trạng thái</label>
                                <select name="trangthai" class="form-control select2basic"style="width:100%">
                                    <option value="1">Đang học</option>
                                    <option value="2">Hoàn thành khóa học</option>
                                    <option value="3">Nghỉ học</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="control-label">Địa chỉ</label>
                                <input type="text" name="diachi" class="form-control">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="control-label">Ghi chú</label>
                                <textarea name="ghichu" id="" cols="" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" class="btn btn-primary">Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--Cập nhật -->
    <div id="edit" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="" method="POST" id="frm_edit" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin học viên
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="control-label">Họ tên<span class="require">*</span></label>
                                <input type="text" name="tenhocvien" id="tenhocvien" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Email<span class="require">*</span></label>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="control-label">Ngày sinh <span class="require">*</span></label>
                                <input type="date" name="ngaysinh" id="ngaysinh" class="form-control" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="control-label">CCCD/CMND <span class="require">*</span></label>
                                <input type="text" name="cccd" id="cccd" class="form-control" readonly>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="control-label">Giới tính</label>
                                <select name="gioitinh" id="gioitinh" class="form-control "style="width:100%">
                                    <option value="0">Nữ</option>
                                    <option value="1">Nam</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label class="control-label">Số điện thoại</label>
                                <input type="text" name="sdt" id="sdt" class="form-control">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="control-label">Trạng thái</label>
                                <select name="trangthai" id="trangthai" class="form-control "style="width:100%">
                                    <option value="1">Đang học</option>
                                    <option value="2">Đã hoàn thành</option>
                                    <option value="3">Đã nghỉ học</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="control-label">Địa chỉ</label>
                                <input type="text" name="diachi" id="diachi" class="form-control">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="control-label">Ghi chú</label>
                                <textarea name="ghichu" id="" cols="" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickedit()">Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="delete-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frmDelete" method="POST" action="#" accept-charset="UTF-8">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý xoá?</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy thao tác</button>
                        <button type="submit" onclick="subDel()" data-dismiss="modal" class="btn btn-primary">Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- @include('includes.delete') --}}
    <script>
        function cfDel(url) {
            $('#frmDelete').attr('action', url);
        }

        function subDel() {
            $('#frmDelete').submit();
        }

        function clickNhanvaTKT() {
            $('#frm_giaovien').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }


        function edit(e, id) {

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/HocVien/CapNhat/' + id,
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#tenhocvien').val(data.tentaikhoan);
                    $('#email').val(data.email);
                    $('#cccd').val(data.cccd);
                    $('#sdt').val(data.sodienthoai);
                    $('#diachi').val(data.diachi);
                    $('#ngaysinh').val(data.ngaysinh);
                    $('#ghichu').text(data.ghichu);
                    $('#trangthai option[value=' + data.trangthai + ' ]').attr('selected', false);
                    $('#trangthai option[value=' + data.trangthai + ' ]').attr('selected', 'selected');
                    $('#gioitinh option[value=' + data.gioitinh + ' ]').attr('selected', false);
                    $('#gioitinh option[value=' + data.gioitinh + ' ]').attr('selected',
                        'selected');

                    var url = '/HocVien/update/' + id;
                    $('#frm_edit').attr('action', url);
                },
                error: function(message) {
                    toastr.error(message, 'Lỗi!');
                }
            });

        }
    </script>

@stop
