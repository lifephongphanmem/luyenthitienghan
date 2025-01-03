@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <style>
        #message {
            color: red;
            font-size: 12px;
            display: none;
        }

        #message_update {
            color: red;
            font-size: 12px;
            display: none;
        }
    </style>
@stop

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>

    <script src="{{ url('assets/admin/pages/scripts/table-lifesc.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
            $('#nhomcn').change(function() {
                window.location.href = "{{ $inputs['url'] }}" + '?nhomcn=' + $('#nhomcn').val();
            });
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
                        <h3 class="card-label text-uppercase">Danh sách tài khoản</h3>
                    </div>
                    <div class="card-toolbar">
                        <button data-target="#themmoi" data-toggle="modal" class="btn btn-xs btn-success mr-2"><i
                                class="fa fa-plus" onclick="add()"></i> Tạo mới</button>
                        <a class="btn btn-xs btn-success mr-2" title="Chuyển dữ liệu" href="{{ '/TaiKhoan/ChuyenDuLieu' }}">
                            <i class="fas fa-file-import"></i>Chuyển
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label style="font-weight: bold">Nhóm tài khoản</label>

                            <select name="manhomchucnang" id="nhomcn" class="form-control select2basic">
                                <option value="">Tất cả</option>
                                @foreach ($a_nhomtk as $k => $ct)
                                    <option value="{{ $k }}" {{ $k == $inputs['nhomcn'] ? 'selected' : '' }}>
                                        {{ $ct }}</option>
                                @endforeach
                                @if (session('admin')->sadmin == 'SSA')
                                    <option value="4" {{ 4 == $inputs['nhomcn'] ? 'selected' : '' }}>Khác</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Tài khoản truy cập</th>
                                <th>Tên tài khoản</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $tk)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name='sdt' class="text-left" style="width: 15%">{{ $tk->sodienthoai }}</td>
                                    <td name='tentaikhoan' class="text-left" style="width: 50%">{{ $tk->tentaikhoan }}</td>
                                    @if ($tk->trangthai == 1)
                                        <td class="text-center">
                                            <button title="Tài khoản đang được kích hoạt"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="icon-lg la fa-check text-primary icon-2x"></i></button>
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <button title="Tài khoản bị vô hiệu" class="btn btn-sm btn-clean btn-icon">
                                                <i class="icon-lg la fa-times-circle text-danger icon-2x"></i></button>
                                        </td>
                                    @endif
                                    <td class="text-center">
                                        <button title="Sửa thông tin"
                                            onclick="edit(this,'{{ $tk->id }}','{{ $tk->trangthai }}','{{ $tk->phanloai }}','{{ $tk->manhomchucnang }}','{{ $tk->email }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>
                                        @if ($tk->trangthai == 1)
                                            <a title="Phân quyền"
                                                href="{{ '/TaiKhoan/PhanQuyen?tendangnhap=' . $tk->cccd }}"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="icon-lg la flaticon-user-settings text-primary icon-2x"></i></a>

                                            <button type="button"
                                                onclick="setPerGroup('{{ $tk->manhomchucnang }}','{{ $tk->cccd }}')"
                                                class="btn btn-sm btn-clean btn-icon" data-target="#modify-nhomchucnang"
                                                data-toggle="modal" title="Đặt lại quyền theo nhóm chức năng">
                                                <i class="icon-lg la flaticon-network text-primary icon-2x"></i>
                                            </button>

                                            <button title="Xóa thông tin" type="button"
                                                onclick="cfDel('{{ '/TaiKhoan/delete/' . $tk->id }}')"
                                                class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm"
                                                data-toggle="modal">
                                                <i class="icon-lg la fa-trash-alt text-danger icon-2x"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->
    <!--Thêm mới -->
    <div id="themmoi" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="{{ '/TaiKhoan/store' }}" method="POST" id="frm_nhomchucnang" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin tài khoản
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>

                    </div>
                    <div class="modal-body">

                        <div class="form-group row">

                            <div class="col-md-4">
                                <label class="control-label">Tên tài khoản<span class="require">*</span></label>
                                <input type="text" name="tentaikhoan" id="tentaikhoan" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Số điện thoại<span class="require">*</span></label>
                                <input type="text" name="sodienthoai" id="sodienthoai" class="form-control" required>
                                <span class="font-weight-bold font-size-sm mt-1" id="message">Số điện thoại không hợp
                                    lệ</span>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>

                            <div class="col-md-6 mt-2">
                                <label class="control-label">Mật khẩu<span class="require">*</span></label>
                                <input type="password" name="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                                    value="123456abc" class="form-control" required>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">Mật khẩu ít nhất 8 ký tự, ít
                                    nhất 1 chữ cái và 1 chữ số</span>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="control-label">Trạng thái</label>
                                <select name="trangthai" class="form-control select2basic" style="width:100%">

                                    <option value="1">Kích hoạt</option>
                                    <option value="0">Vô hiệu</option>


                                </select>
                            </div>
                            <div class="col-md-6 mt-1">
                                <label class="control-label">Phân loại<span class="require">*</span></label>
                                <select name="phanloai" id='phanloai' class="form-control select2basic"
                                    onchange="Phanloai('add')" style="width:100%">
                                    <option value="">-- Chọn phân loại --</option>
                                    <option value="1">Giáo viên</option>
                                    <option value="2">Học viên</option>
                                    <option value="3">Hệ thống</option>

                                </select>
                            </div>
                            <div class="col-md-6 mt-1" id="manhomchucnang">
                                <label class="control-label">Tên nhóm chức năng<span class="require">*</span></label>
                                <select name="manhomchucnang" class="form-control select2basic" style="width:100%"
                                    required>
                                    <option value="">-- Chọn nhóm chức năng --</option>
                                    @foreach ($a_nhomtk as $k => $ct)
                                        <option value="{{ $k }}">{{ $ct }}</option>
                                    @endforeach
                                </select>
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
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin tài khoản
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>

                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id='id'>
                        <div class="form-group row">
                            {{-- <div class="col-md-12"> --}}
                            <div class="col-md-4">
                                <label class="control-label">Tên tài khoản<span class="require">*</span></label>
                                <input type="text" name="tentaikhoan" class="form-control" id='tentaikhoan_update' required>
                            </div>
                            {{-- <div class="col-md-4">
                                <label class="control-label">CCCD/CMND<span class="require">*</span></label>
                                <input type="text" name="cccd" class="form-control" id='cccd_update' required>
                                @if ($errors->has('cccd'))
                                    <span class="text-danger">{{ $errors->first('cccd') }}</span>
                                @endif
                            </div> --}}
                            <div class="col-md-4">
                                <label class="control-label">Số điện thoại<span class="require">*</span></label>
                                <input type="text" name="sodienthoai" class="form-control" id='sdt_update' required>
                                <span class="font-weight-bold font-size-sm mt-1" id="message_update">Số điện thoại không
                                    hợp lệ</span>
                                @if ($errors->has('sodienthoai'))
                                    <span class="text-danger">{{ $errors->first('sodienthoai') }}</span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Email</label>
                                <input type="text" name="email" id='email_update' class="form-control">
                            </div>
                            {{-- </div> --}}

                            <div class="col-md-6 mt-2">
                                <label class="control-label">Mật khẩu<span class="require">*</span></label>
                                <input type="password" name="password" placeholder="Nếu không đổi thì không cần nhập"
                                    pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" class="form-control">
                                <span class="text-muted font-weight-bold font-size-sm mt-1">Mật khẩu ít nhất 8 ký tự, ít
                                    nhất 1 chữ cái và 1 chữ số</span>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="control-label">Trạng thái</label>
                                <select name="trangthai" class="form-control" id='trangthai' style="width:100%">

                                    <option value="1">Kích hoạt</option>
                                    <option value="0">Vô hiệu</option>


                                </select>
                            </div>
                            <div class="col-md-6 mt-1">
                                <label class="control-label">Phân loại<span class="require">*</span></label>
                                <select name="phanloai" class="form-control" onchange="Phanloai('update')"
                                    id='phanloai_update' style="width:100%">

                                    <option value="1">Giáo viên</option>
                                    <option value="2">Học viên</option>
                                    <option value="3">Hệ thống</option>

                                </select>
                            </div>
                            <div class="col-md-6 mt-1" id="manhomchucnang_update">
                                <label class="control-label">Tên nhóm chức năng<span class="require">*</span></label>
                                <select name="manhomchucnang" id='nhomchucnang' class="form-control "style="width:100%">
                                    {{-- <option value="">-- Chọn nhóm chức năng --</option> --}}
                                    @foreach ($a_nhomtk as $k => $ct)
                                        <option value="{{ $k }}">{{ $ct }}</option>
                                    @endforeach
                                </select>
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
            {{-- {!! Form::close() !!} --}}
        </form>
    </div>
    <!--nhóm chức năng -->
    <div id="modify-nhomchucnang" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        {{-- {!! Form::open(['url' => '/TaiKhoan/NhomChucNang', 'id' => 'frm_nhomchucnang']) !!} --}}
        <form action="{{ '/TaiKhoan/NhomChucNang' }}" method="POST" id="frm_ncn">
            @csrf
            <input type="hidden" name="tendangnhap" />
            {{-- <input type="hidden" name="nhomchucnang" /> --}}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý tải lại phân quyền của tài khoản?
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>

                    </div>
                    <div class="modal-body">
                        <p style="color: #0000FF">Các phân quyền của tài khoản sẽ được tải lại theo nhóm chức năng và không
                            thể khôi phục lại</p>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label">Tên nhóm chức năng<span class="require">*</span></label>
                                {{-- {!! Form::select('manhomchucnang', $a_nhomtk, null, ['class' => 'form-control select2_modal', 'required'=>'true']) !!} --}}
                                <select name="manhomchucnang" class="form-control select2_modal" required>
                                    <option value="">-- Chọn nhóm chức năng --</option>
                                    @foreach ($a_nhomtk as $k => $ct)
                                        <option value="{{ $k }}">{{ $ct }}</option>
                                    @endforeach
                                </select>
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
            {{-- {!! Form::close() !!} --}}
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
            $('#frm_nhomchucnang').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }

        function setPerGroup(manhomchucnang, tendangnhap) {
            $('#frm_ncn').find("[name='manhomchucnang']").val(manhomchucnang);
            $('#frm_ncn').find("[name='tendangnhap']").val(tendangnhap);
            // $('#frm_ncn').find("[name='nhomchucnang']").val($('#nhomcn').val());
        }
        function add(){
            $('#tentaikhoan').val('');
            $('#email').val('');
            $('#sodienthoai').val('');
            $('#phanloai option[value= ]').attr('selected', 'selected');
        }
        function edit(e, id, trangthai, phanloai, nhomchucnang, email) {
            var url = '/TaiKhoan/update/' + id;
            var tr = $(e).closest('tr');
            $('#tentaikhoan_update').val($(tr).find('td[name=tentaikhoan]').text());
            // $('#cccd_update').val($(tr).find('td[name=cccd]').text());
            $('#sdt_update').val($(tr).find('td[name=sdt]').text());
            $('#email_update').val(email)
            $('#phanloai_update option[value=' + phanloai + ' ]').attr('selected', 'selected');
            $('#trangthai option[value=' + trangthai + ' ]').attr('selected', 'selected');
            if (nhomchucnang != '') {
                $('#nhomchucnang option[value=' + nhomchucnang + ' ]').attr('selected', 'selected');
            }


            $('#frm_edit').attr('action', url);

        }

        $('#password_update').on('change', function() {
            // var password=
            if ($('#password_update').val() != '') {
                $('#password_update').attr('pattern', '^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$');

            } else {
                $('#password_update').removeAttr('pattern');
            }
        });

        function Phanloai(action) {
            if (action === 'add') {
                var phanloai = $('#phanloai').val();
            } else {
                var phanloai = $('#phanloai_update').val();
            }

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "/TaiKhoan/phanloai",
                type: "GET",
                data: {
                    _token: CSRF_TOKEN,
                    phanloai: phanloai,
                    action: action,
                },
                dataType: 'JSON',
                success: function(data) {
                    if (action === 'add') {
                        $('#manhomchucnang').replaceWith(data);
                    } else {
                        $('#manhomchucnang_update').replaceWith(data);
                    }

                }
            });
        }


        $('#sodienthoai', '#sodienthoai_update').on('change', function() {
            const input = document.getElementById('sodienthoai');
            const message = document.getElementById('message');

            const phoneNumber = input.value;
            // Regex to match valid phone numbers (e.g., 10-digit numbers starting with 09 or 03)
            // const phoneRegex = /^(09|03|07|08|05)\d{8}$/;
            const phoneRegex = /((09|03|07|08|05)+([0-9]{8})\b)/g;

            if (!phoneRegex.test(phoneNumber)) {
                message.style.display = 'block';
            } else {
                message.style.display = 'none';
            }
        });

        $('#sdt_update').on('change', function() {
            const input = document.getElementById('sdt_update');
            const message = document.getElementById('message_update');
            const phoneNumber = input.value;
            // Regex to match valid phone numbers (e.g., 10-digit numbers starting with 09 or 03)
            // const phoneRegex = /^(09|03|07|08|05)\d{8}$/;
            const phoneRegex = /((09|03|07|08|05)+([0-9]{8})\b)/g;

            if (!phoneRegex.test(phoneNumber)) {
                message.style.display = 'block';
            } else {
                message.style.display = 'none';
            }
        });
    </script>

@stop
