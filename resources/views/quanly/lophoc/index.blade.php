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
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
            $('#a_khoahoc').change(function() {
                window.location.href = "{{ $inputs['url'] }}" + '?khoahoc=' + $('#a_khoahoc').val();
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
                        <h3 class="card-label text-uppercase">Danh sách lớp học</h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="add()" data-target="#themmoi" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i> Tạo mới</button>
                        {{-- <button class="btn btn-xs btn-icon btn-success mr-2" title="Nhận dữ liệu từ file Excel"
                            data-target="#modal-nhanexcel" data-toggle="modal">
                            <i class="fas fa-file-import"></i>
                        </button> --}}
                        <button class="btn btn-xs btn-success mr-2" data-target="#tuychonin" data-toggle="modal">
                            <i class="flaticon-list"></i> In danh sách
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label style="font-weight: bold">Khóa học</label>

                            <select name="khoahoc" id="a_khoahoc" class="form-control select2basic">
                                <option value="">Tất cả</option>
                                @foreach ($a_khoahoc as $key => $ct)
                                    <option value="{{ $key }}" {{ $key == $inputs['khoahoc'] ? 'selected' : '' }}>
                                        {{ $ct }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Tên lớp</th>
                                <th>Khóa học</th>
                                <th>Học viên</th>
                                <th>Giáo viên chủ nhiệm</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $lh)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name='tenlop' class="text-left" style="width: 20%">{{ $lh->tenlop }}</td>
                                    <td name='khoahoc' class="text-left" style="width: 10%">{{ $lh->khoahoc }}</td>
                                    <td name='soluonghocvien' style="width: 10%">{{ $lh->soluonghocvien }}</td>
                                    <td name='giaovienchunhiem' class="text-left" style="width: 30%">
                                        {{ isset($a_giaovien[$lh->giaovienchunhiem]) ? $a_giaovien[$lh->giaovienchunhiem] : '' }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ '/LopHoc/chitiet?lophoc=' . $lh->malop }}" title="Chi tiết"
                                            class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la la-th-list text-primary "></i>
                                        </a>
                                        <button title="Sửa thông tin"
                                            onclick="edit(this,'{{ $lh->id }}','{{ $lh->tenlop }}','{{ $lh->khoahoc }}','{{ $lh->giaovienchunhiem }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>

                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/LopHoc/delete/' . $lh->id }}')"
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
        <form action="{{ '/LopHoc/store' }}" method="POST" id="frm_lophoc" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin lớp học
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>

                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label">Tên lớp học<span class="require">*</span></label>
                                <input type="text" name="tenlop" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Khóa học</label>
                                <input type="text" name="khoahoc" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-1">
                                <label class="control-label">Giáo viên chủ nhiệm</label>
                                <select name="giaovienchunhiem" class="form-control select2basic"style="width:100%">
                                    <option value="">-- Chọn giáo viên --</option>
                                    @foreach ($a_giaovien as $k => $ct)
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
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin lớp học
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>

                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label">Tên lớp học<span class="require">*</span></label>
                                <input type="text" name="tenlop" id="tenlop" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Khóa học</label>
                                <input type="text" name="khoahoc" id="khoahoc" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-1">
                                <label class="control-label">Giáo viên chủ nhiệm</label>
                                <select name="giaovienchunhiem" id="giaovienchunhiem"
                                    class="form-control "style="width:100%">
                                    <option value="">-- Chọn giáo viên --</option>
                                    @foreach ($a_giaovien as $k => $ct)
                                        <option value="{{ $k }}">{{ $ct }}</option>
                                    @endforeach
                                </select>
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
    <div id="tuychonin" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="{{ '/LopHoc/ThongTin/InDanhSach' }}" method="POST" id="frm_print" enctype="multipart/form-data"
            target="_blank" rel="noopener noreferrer">
            @csrf
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Tuỳ chọn in danh sách
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>

                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label">Khóa học</label>
                                <select name="khoahoc" id="" class="form-control select2basic" style="width:100%">
                                    <option value="">Tất cả</option>
                                    @foreach ($baocao['khoahoc'] as $ct)
                                        <option value="{{ $ct->khoahoc }}">{{ $ct->khoahoc }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickprint()">Đồng
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
            $('#frm_lophoc').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }

        function clickprint() {
            $('#frm_print').submit();
        }

        function edit(e, id, tenlop, khoahoc, giaovienchunhiem) {
            var url = '/LopHoc/update/' + id;
            var tr = $(e).closest('tr');
            $('#tenlop').val($(tr).find('td[name=tenlop]').text());
            $('#khoahoc').val($(tr).find('td[name=khoahoc]').text());
            if (giaovienchunhiem != '') {
                $('#giaovienchunhiem option[value=' + giaovienchunhiem + ' ]').attr('selected', 'selected');
            }

            $('#frm_edit').attr('action', url);
        }
    </script>

@stop
