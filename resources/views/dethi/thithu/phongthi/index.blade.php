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
    <script src="{{url('js/custome-form.js')}}"></script>
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
                        <h3 class="card-label text-uppercase">Danh sách phòng thi</h3>
                    </div>
                    <div class="card-toolbar">
                        <button data-target="#themmoi" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i> Tạo phòng thi</button>
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
                                <th>Mã phòng thi</th>
                                <th>Tên phòng thi</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $dt)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name="maphongthi" style="width: 2%">{{ $dt->maphongthi }}</td>
                                    <td name='tenphongthi' class="text-left" style="width: 20%">{{ $dt->tenphongthi }}</td>
                                    <td name='trangthai' style="width: 5%" class="{{$dt->trangthai == 1?'text-primary':'text-warning'}}">{{isset($dt->trangthai)?$a_trangthai[$dt->trangthai]:''}}</td>
                                    <td class="text-center" style="width:8%">
                                        <button onclick="trangthai('{{ $dt->maphongthi }}','{{ $dt->trangthai }}')"
                                            data-target="#open" data-toggle="modal" title="Đóng/Mở phòng thi"
                                            class="btn btn-sm btn-clean btn-icon">
                                            @if ($dt->trangthai == 0)
                                                <i class="icon-xl fas fa-unlock-alt text-primary"></i>
                                            @else
                                                <i class="icon-xl fas fa-lock text-warning"></i>
                                            @endif

                                        </button>
                                        <a href="{{'/PhongThi/ChiTiet/'.$dt->maphongthi}}" title="Chi tiết"
                                            class="btn btn-sm btn-clean btn-icon">
                                             <i class="icon-lg la la-th-list text-primary "></i>
                                         </a>
                                        {{-- <button title="Sửa thông tin"
                                            onclick="edit(this,'{{ $dt->maphongthi }}','{{$dt->trangthai}}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button> --}}

                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/PhongThi/delete/' . $dt->maphongthi }}')"
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
        <form action="{{ '/PhongThi/store' }}" method="POST" id="frm_phongthi" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin phòng thi
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label">Tên phòng thi<span class="require">*</span></label>
                                <input type="text" name="tenphongthi" class="form-control" required>
                            </div>

                        <div class="col-md-12 mt-2">
                            <label class="control-label">Trạng thái<span class="require">*</span></label>
                            <select name="trangthai" class="form-control ">
                                <option value="1">Mở phòng</option>
                                <option value="0">Đóng</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit"  class="btn btn-primary">Đồng
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
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin phòng thi
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label">Tên phòng thi<span class="require">*</span></label>
                                <input type="text" name="tenphongthi" id="tenphongthi" class="form-control" required>
                            </div>

                        <div class="col-md-12 mt-2">
                            <label class="control-label">Trạng thái<span class="require">*</span></label>
                            <select name="trangthai" class="form-control " id="trangthai">
                                <option value="1">Mở phòng</option>
                                <option value="0">Đóng</option>
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
    <div id="open" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frm_trangthai" method="POST" action="#" accept-charset="UTF-8">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý thay đổi trạng thái</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <input type="hidden" name="trangthai" id="tt">
                    <input type="hidden" name="maphongthi" id="mapt">
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy thao tác</button>
                        <button type="submit" onclick="dongy()" data-dismiss="modal" class="btn btn-primary">Đồng
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
        function dongy() {
            $('#frm_trangthai').submit();
        }
        function trangthai(maphongthi, trangthai) {
            var url = '/PhongThi/DongPhongThi';
            $('#tt').val(trangthai);
            $('#mapt').val(maphongthi);
            $('#frm_trangthai').attr('action', url);
        }
        function edit(e, id,trangthai) {
            var url='/PhongThi/update/'+id;
            var tr = $(e).closest('tr');

            $('#tenphongthi').val($(tr).find('td[name=tenphongthi]').text());
            $('#trangthai option[value=' + trangthai + ' ]').attr('selected', false);
            $('#trangthai option[value=' + trangthai + ' ]').attr('selected', 'selected');
            $('#frm_edit').attr('action', url);
          
        }
    </script>

@stop
