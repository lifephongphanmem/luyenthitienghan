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
    <script src="{{ url('assets/js/pages/crud/file-upload/image-input.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
            $('#a_nganh').change(function() {
                window.location.href = "/CongCu/ThongTin" + '?phanloai=' + $('#a_nganh').val();
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
                        <h3 class="card-label text-uppercase">Danh sách công cụ lao động</h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="add()" data-target="#themmoi" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i> Thêm mới</button>
                        {{-- <button class="btn btn-xs btn-success mr-2" title="Nhận dữ liệu từ file Excel"
                            data-target="#modal-nhanexcel" data-toggle="modal">
                            <i class="fas fa-file-import"></i>Nhận Excel
                        </button> --}}
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label style="font-weight: bold">Phân loại</label>

                            <select name="phanloai" id="a_nganh" class="form-control select2basic">
                                @foreach (getNganhXK() as $key => $ct)
                                    <option value="{{ $key }}"
                                        {{ $key == $inputs['phanloai'] ? 'selected' : '' }}>{{ $ct }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Tên công cụ</th>
                                {{-- <th>Tiếng Việt</th> --}}
                                <th>Tiếng Hàn</th>
                                <th>Ảnh</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $cc)

                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name='cauhoi' class="text-left" style="width: 20%">{{ $cc->tencongcu }}</td>
                                    {{-- <td name='cauhoi' class="text-left" style="width: 20%">{{ $ch->nghiatiengviet }}</td> --}}

                                    <td name='tienghan' style="width: 8%">{{$cc->tiengHan}}</td>
                                    <td name='hinhanh' style="width: 8%">
                                        @if(isset($cc->hinhanh))
                                        <img src="{{url($cc->hinhanh)}}" alt="Mô tả ảnh" style="width:82px"> 
                                        {{-- <picture>
                                            <source srcset="{{url($cc->hinhanh)}}" type="image/webp">
                                            <img src="{{url($cc->hinhanh)}}" alt="Mô tả ảnh">
                                          </picture> --}}
                                        @endif 
                                    </td>
                                    <td class="text-center" style="width:8%">
                                        <button title="Sửa thông tin"
                                            onclick="edit(this,'{{ $cc->id }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>

                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/CongCu/XoaCongCu/' . $cc->id }}')"
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
        <form action="{{ '/CongCu/LuuCongCu' }}" method="POST" id="frm_themcongcu" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin công cụ
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6 mt-2 mb-2">
                                <label class="control-label font-weight-bolder">Phân loại<span class="require">*</span></label>
                                <select name="phanloai" class="form-control">
                                    @foreach (getNganhXK() as $key => $ct)
                                        <option value="{{ $key }}" {{ $key == $inputs['phanloai']?'selected':'' }}>{{ $ct }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mt-2 mb-2">
                                <label class="control-label font-weight-bolder">Số thứ tự<span class="require">*</span></label>
                                <input type="text" name="stt" value="{{++$stt}}" class="form-control">
                            </div>
                            <div class="col-md-12 mt-2 mb-2">
                                <label class="control-label font-weight-bolder">Tên công cụ<span class="require">*</span></label>
                                <input type="text" name="tencongcu" class="form-control">
                            </div>
                            <div class="col-md-12 mt-2 mb-2">
                                <label class="control-label font-weight-bolder">Tiếng Hàn<span class="require">*</span></label>
                                <input type="text" name="tiengHan" class="form-control">
                            </div>
                            {{-- <div class="col-md-12 mt-2 mb-2">
                                <label class="control-label font-weight-bolder">Nghĩa tiếng việt<span class="require">*</span></label>
                                <input type="text" name="tiengViet" class="form-control">
                            </div> --}}

                            <div class="col-md-12 mt-2 mb-2">
                                <label class="control-label font-weight-bolder">Hình ảnh</label>
                                <input type="file" name="hinhanh" accept=".jpg;.png" class="form-control">
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin công cụ
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row" id='edit_congcu'>

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

    @include('includes.delete')
    <script>
        function cfDel(url) {
            $('#frmDelete').attr('action', url);
        }

        function subDel() {
            $('#frmDelete').submit();
        }

        function clickNhanvaTKT() {
            $('#frm_themcongcu').submit();
        }

        function clickNhanexcel() {
            $('#frm_import').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }
        function add()
        { 
            $('#frm_themcongcu').find("[name='tencongcu']").val('');
            $('#frm_themcongcu').find("[name='tiengHan']").val('');
            // $('#frm_themcongcu').find("[name='cautraloi[]']").val('');
        }
        function edit(e, id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var url = '/CongCu/CapNhat'
            $.ajax({
                url: '/CongCu/edit',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id,
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    if (data.status == 'success') {
                        $('#edit_congcu').replaceWith(data.message);
                        TableManagedclass.init();
                        // TableManaged4.init();
                        $('#frm_edit').attr('action', url);
                    }
                },
                // error: function (message) {
                //     toastr.error(message, 'Lỗi!');
                // }
            });
        }




    </script>

@stop
