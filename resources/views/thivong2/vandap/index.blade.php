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
                        <h3 class="card-label text-uppercase">Danh sách câu hỏi</h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="add()" data-target="#themmoi" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i> Thêm mới</button>
                        <button class="btn btn-xs btn-success mr-2" title="Nhận dữ liệu từ file Excel"
                            data-target="#modal-nhanexcel" data-toggle="modal">
                            <i class="fas fa-file-import"></i>Nhận Excel
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label style="font-weight: bold">Loại câu</label>

                            <select name="phanloai" id="a_baihoc" class="form-control select2basic">
                                @foreach ($a_phanloai as $key => $ct)
                                    <option value="{{ $key }}"
                                        {{ $ct == $inputs['phanloai'] ? 'selected' : '' }}>{{ $ct }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Câu hỏi</th>
                                {{-- <th>Tiếng Việt</th> --}}
                                <th>Câu trả lời</th>
                                <th>Audio</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $ch)
                            <?php $cautraloi=$m_cautraloi->where('macau',$ch->macau) ?>
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name='cauhoi' class="text-left" style="width: 20%">{{ $ch->noidung }}</td>
                                    {{-- <td name='cauhoi' class="text-left" style="width: 20%">{{ $ch->nghiatiengviet }}</td> --}}

                                    <td name='cautraloi' style="width: 8%">
                                        @foreach ($cautraloi as $ct )
                                            <p>{{$ct->stt}}. {{$ct->noidung}}</p>
                                        @endforeach
                                    </td>
                                    <td name='audio' style="width: 10%">
                                        @if (isset($ch->audio))
                                            <audio title="Nghe" controls="controls" style="width:103px">
                                                <source src="{{ asset($ch->audio) }}">
                                            </audio>
                                        @endif
                                    </td>
                                    <td class="text-center" style="width:8%">
                                        {{-- <a href="{{'/GiaoTrinh/chitiet/'.$gt->id}}" title="Chi tiết"
                                            class="btn btn-sm btn-clean btn-icon">
                                             <i class="icon-lg la la-th-list text-primary "></i>
                                         </a> --}}
                                        <button title="Sửa thông tin"
                                            onclick="edit(this,'{{ $ch->id }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>

                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/ThiVong2/VanDap/XoaCauHoi/' . $ch->id }}')"
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
        <form action="{{ '/ThiVong2/VanDap/LuuCauHoi' }}" method="POST" id="frm_themcauhoi" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin câu hỏi
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6 mt-2 mb-2">
                                <label class="control-label font-weight-bolder">Phân loại<span class="require">*</span></label>
                                <select name="phanloai" class="form-control">
                                    @foreach ($a_phanloai as $key => $ct)
                                        <option value="{{ $key }}" {{ $key == $inputs['phanloai']?'selected':'' }}>{{ $ct }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mt-2 mb-2">
                                <label class="control-label font-weight-bolder">Số thứ tự<span class="require">*</span></label>
                                <input type="text" name="stt" value="{{++$stt}}" class="form-control">
                            </div>
                            {{-- <div class="col-md-1" style="padding-left: 0px;">
                                <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" class="btn btn-default" data-target="#modal-tenbaihoc"
                                    data-toggle="modal">
                                    <i class="fa fa-plus"></i></button>
                            </div> --}}
                            <div class="col-md-12 mt-2 mb-2">
                                <label class="control-label font-weight-bolder">Câu hỏi<span class="require">*</span></label>
                                <input type="text" name="noidung" class="form-control">
                            </div>
                            <div class="col-md-12 mt-2 mb-2">
                                <label class="control-label font-weight-bolder">Nghĩa tiếng việt<span class="require">*</span></label>
                                <input type="text" name="nghiatiengviet" class="form-control">
                            </div>
                            <div class="col-md-12 mt-2 mb-2" id="cautl">
                                <label class="control-label font-weight-bolder">Câu trả lời</label>
                                <input type="text" name="cautraloi[]" class="form-control">
                                
                            </div>

                            <div class="col-md-12">
                                <button type="button" class="btn btn-xs btn-primary" title="Thêm câu trả lời" onclick="addAns()" ><i class="fa fa-plus"></i>Thêm câu trả lời</button>
                            </div>
                            <div class="col-md-12 mt-2 mb-2">
                                <label class="control-label font-weight-bolder">Audio</label>
                                <input type="file" name="audio" accept=".mp3" class="form-control">
                            </div>
                            {{-- <div class="col-md-12 mt-2 mb-2">
                                <label class="control-label font-weight-bolder">Số thứ tự<span class="require">*</span></label>
                                <input type="text" name="stt" value="{{++$stt}}" class="form-control">
                            </div> --}}
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

    <!--Nhận excel -->
    {{-- <div id="modal-nhanexcel" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="{{ '/BaiHocChinh/import' }}" method="POST" id="frm_import" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin bài giảng chính
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-10">
                                <label class="control-label">Tên bài học<span class="require">*</span></label>
                                <select name="tenbaihoc" id="tenbaihoc_excel" class="form-control">
                                    @foreach ($m_baihoc as $key => $ct)
                                        <option value="{{ $ct->mabaihoc }}">{{ $ct->tenbaihoc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1" style="padding-left: 0px;">
                                <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" class="btn btn-default" data-target="#modal-tenbaihoc"
                                    data-toggle="modal">
                                    <i class="fa fa-plus"></i></button>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="control-label">File excel<span class="require">*</span></label>
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <a href="{{url('/mauexcel/baihocchinh.xlsx')}}" style="text-decoration: underline" class="float-right">Tải file mẫu excel</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" data-dismiss="modal" class="btn btn-primary"
                            onclick="clickNhanexcel()">Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div> --}}

    {{-- <div id="modal-tenbaihoc" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin bài học</h4>
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>

                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-control-label">Tên bài học<span class="require">*</span></label>
                            <input type="text" name='tenbaihoc_add' id="tenbaihoc_add" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button class="btn btn-primary" onclick="add_tenbaihoc()">Đồng ý</button>
                </div>
            </div>
        </div>
    </div> --}}

    <!--Cập nhật -->
    <div id="edit" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="" method="POST" id="frm_edit" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin câu hỏi
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row" id='edit_cauhoi'>

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
    {{-- <div id="delete-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
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
    </div> --}}
    @include('includes.delete')
    <script>
        function cfDel(url) {
            $('#frmDelete').attr('action', url);
        }

        function subDel() {
            $('#frmDelete').submit();
        }

        function clickNhanvaTKT() {
            $('#frm_themcauhoi').submit();
        }

        function clickNhanexcel() {
            $('#frm_import').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }
        function add()
        { 
            $('#frm_themcauhoi').find("[name='noidung']").val('');
            $('#frm_themcauhoi').find("[name='nghiatiengviet']").val('');
            $('#frm_themcauhoi').find("[name='cautraloi[]']").val('');
        }
        function addAns()
        {
            $('#cautl').append('<input type="text" name="cautraloi[]" class="form-control mt-2">');
        }
        function edit(e,id)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var url='/ThiVong2/VanDap/CapNhat'
        $.ajax({
            url: '/ThiVong2/VanDap/edit',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: id,
            },
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if (data.status == 'success') {
                    $('#edit_cauhoi').replaceWith(data.message);
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
        function addAns_edit()
        {
            $('#cautl_edit').append('<input type="text" name="cautraloi[]" class="form-control mt-2">');
        }

    </script>

@stop
