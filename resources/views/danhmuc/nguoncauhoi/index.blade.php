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
                        <h3 class="card-label text-uppercase">DANH MỤC NGUỒN CÂU HỎI</h3>
                    </div>
                    <div class="card-toolbar">
                        @if (chkPhanQuyen('dmnguoncauhoi', 'thaydoi'))
                            <button onclick="create()" data-toggle="modal" data-target="#create_edit_modal"
                                class="btn btn-sm btn-success mr-2" title="Thêm mới"><i class="fa fa-plus"></i>Thêm
                                mới</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                        <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%"> STT </th>
                                    <th width="10%">Mã danh mục </th>
                                    <th>Tên danh mục</th>
                                    <th width="20%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  foreach ($model as $k=>$item ){
                                ?>
                                <tr class="text-center">
                                    <td>{{++$k }} </td>
                                    <td>{{ $item->madm }} </td>
                                    <td class="text-left">{{ $item->tendm }}</td>
                                    <td>
                                        @if (chkPhanQuyen('dmnguoncauhoi', 'thaydoi'))
                                        <button title="Sửa thông tin" data-toggle="modal" data-target="#create_edit_modal"
                                            type="button" onclick="edit('{{ $item->id }}')"
                                            class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary"></i>
                                        </button>
                                        <button title="Xóa thông tin" data-toggle="modal"
                                            data-target="#delete-modal-confirm" type="button"
                                            onclick="cfDel('{{ '/NguonCauHoi/delete/' . $item->id }}')"
                                            class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg flaticon-delete text-danger"></i>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                </div>
            </div>
            <!--end::Card-->
            <!--end::Example-->
        </div>
    </div>
    <!--end::Row-->



    <!--create Modal-->
    <div class="modal fade" id="create_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="card-label">
                        Thông tin danh mục
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form action="{{'/NguonCauHoi/store_update'}}" method="post" id="frm_create_edit">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="number" id="id" name="id" hidden />
                        <div class="col-xl-12">
                            <div class="form-group fv-plugins-icon-container">
                                <label><b>Tên danh mục*</b></label>
                                <input type="text" id="tendm" name="tendm" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Đóng</button>
                    <button type="button" onclick="validate()" class="btn btn-danger font-weight-bold">Đồng ý</button>
                </div>
                </form>

            </div>
        </div>
    </div>

    @include('includes.delete')
    <script>
        function validate() {
            if ($('#stt').val() <= 0) {
                toastr.error('số thứ tự phải là số tự nhiên và lớn hơn 0', 'Lỗi!');
            } else {
                $('#frm_create_edit').submit();

            }
        }

        function edit(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/NguonCauHoi/edit/' + id,
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    var form = $('#frm_create_edit');
                    form.find("[name='id']").val(data.id);
                    form.find("[name='tendm']").val(data.tendm);
                },
                error: function(message) {
                    toastr.error(message, "Lỗi")
                }
            });
        }

        function create() {
            var form = $('#frm_create_edit');
            form.find("[name='id']").val(null);
            form.find("[name='tendm']").val('');
        }
    </script>
@endsection