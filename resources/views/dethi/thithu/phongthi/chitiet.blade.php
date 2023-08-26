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
                        <h3 class="card-label text-uppercase">Danh sách lớp thi phòng: {{ $phongthi->tenphongthi }}</h3>
                    </div>
                    <div class="card-toolbar">
                        <button data-target="#themmoi" data-toggle="modal" class="btn btn-xs btn-success mr-2"><i
                                class="fa fa-plus"></i> Thêm lớp</button>
                        {{-- <button class="btn btn-xs btn-success mr-2" title="Chọn đề thi"
                            data-target="#modal-chondethi" data-toggle="modal">
                            <i class="fa fa-plus"></i> Chọn đề thi
                        </button> --}}
                    </div>
                </div>

                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Mã lớp</th>
                                <th>Tên lớp</th>
                                <th>Đề thi</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $dt)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name="maphongthi" style="width: 2%">{{ $dt->malop }}</td>
                                    <td name='tenphongthi' class="text-left" style="width: 10%">
                                        {{ $tenlop[$dt->malop] ? $tenlop[$dt->malop] . '-' . $khoa[$dt->malop] : '' }}</td>
                                        <td name="maphongthi" style="width: 2%">{{ $a_dethi[$dt->made] }}</td>
                                    <td name='trangthai' style="width: 2%">
                                        {{ isset($dt->trangthai) ? $a_trangthai[$dt->trangthai] : '' }}</td>
                                       
                                    <td class="text-center" style="width:8%">

                                        <button title="Đổi đề thi"
                                            onclick="edit(this,'{{ $dt->maphongthi }}','{{ $dt->made }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>
                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/PhongThi/XoaLop/' . $dt->malop . '?maphongthi=' . $dt->maphongthi }}')"
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
        <form action="{{ '/PhongThi/ThemLop' }}" method="POST" id="frm_phongthi" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Chọn lớp thi
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="maphongthi" value="{{ $phongthi->maphongthi }}">
                        <div class="form-group row">

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Lớp học<span class="require">*</span></label>
                                <select name="malop[]" class="form-control select2basic" multiple style="width:100%">
                                    @foreach ($lophoc as $lh)
                                        <option value="{{ $lh->malop }}">{{ $lh->tenlop }} - {{ $lh->khoahoc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Đề thi<span class="require">*</span></label>
                                <select name="made" class="form-control select2basic" style="width:100%">
                                    @foreach ($m_dethi as $dt)
                                        <option value="{{ $dt->made }}">{{ $dt->tende }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickNhanvaTKT()">Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="modal-chondethi" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="{{ '/PhongThi/ThemLop' }}" method="POST" id="frm_phongthi" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Danh sách đề thi
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="maphongthi" value="{{ $phongthi->maphongthi }}">
                        <div class="form-group row">

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Lớp học<span class="require">*</span></label>
                                <select name="malop[]" class="form-control" style="width:100%">
                                    @foreach ($m_dethi as $dt)
                                        <option value="{{ $dt->made }}">{{ $dt->tende }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" data-dismiss="modal" class="btn btn-primary"
                            onclick="clickNhanvaTKT()">Đồng
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
                        <h4 id="modal-header-primary-label" class="modal-title">Đổi đề thi
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            {{-- <div class="col-md-12 mt-2">
                            <label class="control-label">Lớp học<span class="require">*</span></label>
                            <select name="malop[]" class="form-control select2basic" multiple style="width:100%">
                                @foreach ($lophoc as $lh)
                                    <option value="{{ $lh->malop }}">{{ $lh->tenlop }} - {{ $lh->khoahoc }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="col-md-12 mt-2">
                            <label class="control-label">Đề thi<span class="require">*</span></label>
                            <select name="made" class="form-control select2basic" id="made_edit" style="width:100%">
                                @foreach ($m_dethi as $dt)
                                    <option value="{{ $dt->made }}">{{ $dt->tende }}</option>
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


    {{-- @include('includes.delete') --}}
    <script>
        function cfDel(url) {
            $('#frmDelete').attr('action', url);
        }

        function subDel() {
            $('#frmDelete').submit();
        }



        function clickNhanvaTKT() {
            $('#frm_phongthi').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }



        function edit(e, id, made) {
            var url = '/PhongThi/update/' + id;
            var tr = $(e).closest('tr');
// console.log(made);
            // $('#tenphongthi').val($(tr).find('td[name=tenphongthi]').text());
            // $('#trangthai option[value=' + trangthai + ' ]').attr('selected', false);
            // $('#made_edit option[value=' + made + ' ]').attr('selected', 'selected');
            $('#made_edit').val(made).change();
            $('#frm_edit').attr('action', url);

        }
    </script>

@stop
