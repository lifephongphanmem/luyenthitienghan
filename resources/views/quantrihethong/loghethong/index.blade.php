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

        });
        $('#thaotac').change(function() {
            window.location.href = "{{ $inputs['url'] }}" + '?thaotac=' + $('#thaotac').val();
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
                        <h3 class="card-label text-uppercase">nhật ký sử dụng</h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="innhatky()" data-target="#in" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-print"></i> In nhật ký</button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label style="font-weight: bold">Thao tác</label>

                            <select name="thaotac" id="thaotac" class="form-control select2basic">
                                <option value="">Tất cả</option>
                                @foreach (thaotac() as $key => $ct)
                                    <option value="{{ $key }}" {{ $key == $inputs['thaotac'] ? 'selected' : '' }}>
                                        {{ $ct }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-md-4">
                            <label style="font-weight: bold">Ngày</label>

                            <select name="ngay" id="ngay" class="form-control select2basic">
                                <option value="">Tất cả</option>
                                @foreach (thaotac() as $key => $ct)
                                    <option value="{{$key}}" {{$key == $inputs['thaotac']?'selected':''}}>{{$ct}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>IP</th>
                                <th>Tài khoản truy cập</th>
                                <th>Tên tài khoản</th>
                                <th>Thời gian</th>
                                <th>Nội dung</th>
                                {{-- <th >Thao tác</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $cauhinh)
                                <tr class="text-center">
                                    <td style="width: 1%">{{ ++$key }}</td>
                                    <td name='machucnang' class="text-left" style="width: 8%">{{ $cauhinh->ip }}</td>
                                    <td name='thumuc' class="text-left" style="width: 10%">{{ $cauhinh->taikhoantruycap }}
                                    </td>
                                    <td class="text-left" style="width: 10%">{{ $cauhinh->tentaikhoan }}</td>
                                    <td name='thoigianluu' style="width: 10%">
                                        {{ Carbon\Carbon::parse($cauhinh->thoigian)->format('H:i:s d-m-Y') }}</td>
                                    <td name='noidung' style="width: 20%">{{ $cauhinh->noidung }}</td>

                                    {{-- <td class="text-center"  style="width: 8%">

                                        <button title="Sửa thông tin"
                                            onclick="edit(this,)"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>

                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/CauHinhHeThong/delete/' . $cauhinh->id }}')"
                                            class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm"
                                            data-toggle="modal">
                                            <i class="icon-lg la fa-trash-alt text-danger icon-2x"></i></button>
                                    </td> --}}
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
    <div id="in" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="{{ '/LogHeThong/InNhatKy' }}" method="POST" id="frm_innhatky" enctype="multipart/form-data" target="_blank">
            @csrf
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin nhật ký
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>

                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label">Thao tác<span class="require">*</span></label>
                                <select name="thaotac" id="in_thaotac" class="form-control">
                                    <option value="">Tất cả</option>
                                    @foreach (thaotac() as $key => $ct)
                                        <option value="{{ $key }}"
                                            {{ $key == $inputs['thaotac'] ? 'selected' : '' }}>{{ $ct }}</option>
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

    </script>

@stop
