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

        $('#loaicauhoi').on('change', function() {
            var loaicauhoi = $(this).val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/CauHoi/LoaiCauHoi',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    loaicauhoi: loaicauhoi
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#xoadangcaudoc').remove();
                    $('#xoadangcaunghe').remove();
                    $('#xoaxemtranh').remove();
                    $('#caudoc').append(data);
                },
                error: function(message) {
                    toastr.error(message, "Lỗi")
                }
            });

        });

        function xemtranh(e) {
            var dangcaudoc = $(e).val();
            $('#xoaxemtranh').remove();
            if (dangcaudoc == 1683687307) {
                var html = '<div class="col-md-12 mt-2" id="xoaxemtranh">';
                html += '<label class="control-label">Loại câu xem tranh<span class="require">*</span></label>';
                html += '<select name="dangcauxemtranh" class="form-control" id="loaicauxemtranh">';
                html += '<option value="1">Chỉ đồ vật</option>';
                html += '<option value="2">Chỉ hành động</option>';
                html += '<option value="3">Số lượng</option>';
                html += '</select>';
                html += '</div>';
                $('#xemtranh').append(html);
            }
        }

        $('#loaidapan').on('change', function() {
            var loaidapan = $(this).val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/CauHoi/LoaiDapAn',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    loaidapan: loaidapan
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#A').remove();
                    $('#B').remove();
                    $('#C').remove();
                    $('#D').remove();
                    $('#Atiengviet').remove();
                    $('#Btiengviet').remove();
                    $('#Ctiengviet').remove();
                    $('#Dtiengviet').remove();
                    $('#dapan').append(data);
                },
                error: function(message) {
                    toastr.error(message, "Lỗi")
                }
            });


        })

        $('#hoithoai').on('change', function() {
            var hoithoai = $(this).val();
            $('#noidung').remove();
            if (hoithoai == 0) {
                var html = '<div class="col-md-12 mt-2" id="noidung">';
                html += '<label class="control-label">Nội dung<span class="require">*</span></label>';
                html += ' <input type="text" name="noidung" class="form-control">';
                html += '</div>'


            } else {
                var html = '<div class="col-md-12 mt-2" id="noidung">'
                html += '<div class="row mt-2">'
                html += '<div class="col-md-6 mt-2">'

                html += '<label class="control-label">Người 1<span class="require">*</span></label>';
                html += '<input type="text" name="nguoi1" class="form-control">';
                html += '</div>';
                html += '<div class="col-md-6 mt-2">'
                html += '<label class="control-label">Người 2<span class="require">*</span></label>';
                html += '<input type="text" name="nguoi2" class="form-control">';
                html += '</div>';
                html += '</div>';
                html += '</div>';

            }
            $('#cauhoithoai').append(html);
        });
        $('#madanhmuc').on('change', function() {
            window.location.href = "{{ $inputs['url'] }}" + '?madm=' + $('#madanhmuc').val() + '&dangcau=' + $(
                '#dangcauhoi').val();
        });
        $('#dangcauhoi').on('change', function() {
            window.location.href = "{{ $inputs['url'] }}" + '?madm=' + $('#madanhmuc').val() + '&dangcau=' + $(
                '#dangcauhoi').val();
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
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i> Tạo mới</button>
                        {{-- <button class="btn btn-xs btn-icon btn-success mr-2" title="Nhận dữ liệu từ file Excel"
                            data-target="#modal-nhanexcel" data-toggle="modal">
                            <i class="fas fa-file-import"></i>
                        </button> --}}
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label style="font-weight: bold">Loại câu hỏi</label>
                            <select name="madm" id="madanhmuc" class="form-control select2basic">
                                @foreach ($loaicauhoi as $key => $ct)
                                    <option value="{{ $ct->madm }}"
                                        {{ $ct->madm == $inputs['madm'] ? 'selected' : '' }}>
                                        {{ $ct->tendm }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label style="font-weight: bold">Dạng câu</label>
                            <select name="dangcau" id="dangcauhoi" class="form-control select2basic">
                                <option value="1" {{ $inputs['dangcau'] == 1 ? 'selected' : '' }}>Câu đơn</option>
                                <option value="2" {{ $inputs['dangcau'] == 2 ? 'selected' : '' }}>Câu ghép</option>
                            </select>
                        </div>
                    </div>
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                {{-- <th>Mã câu hỏi</th> --}}
                                {{-- <th>Loại câu hỏi</th> --}}
                                <th width="20%">Câu hỏi</th>
                                <th width="35%">Nội dung</th>
                                <th width="15%">Audio</th>
                                <th width="15%">Ảnh</th>
                                {{-- <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>Đáp án</th> --}}
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $ch)
                                <tr class="text-center">
                                    <td>{{ ++$key }}</td>
                                    {{-- <td name="macauhoi">{{ $ch->macauhoi }}</td> --}}
                                    {{-- <td name='loaicauhoi'>{{ $ch->loaicauhoi }}</td> --}}
                                    <td name='cauhoi'>{{ $ch->cauhoi }}</td>
                                    <td name='noidung'>{{ $ch->noidung }}</td>
                                    <td name='audio'>
                                        @if (isset($ch->audio))
                                            <audio title="Nghe K-4" controls="controls" style="width:103px">
                                                <source src="{{ asset($ch->audio) }}">
                                            </audio>
                                        @endif
                                    </td>
                                    <td name='anh'>
                                        @if (isset($ch->anh))
                                            <img src="{{ url($ch->anh) }}" style="width:30%">
                                        @endif
                                    </td>
                                    {{-- <td name='A'>{{ $ch->A }}</td>
                                    <td name='B'>{{ $ch->B }}</td>
                                    <td name='C'>{{ $ch->C }}</td>
                                    <td name='D'>{{ $ch->D }}</td>
                                    <td name='dapan'>{{ $ch->dapan }}</td> --}}
                                    <td class="text-center">

                                        @if ($ch->dangcau == 2 && $luottrung[$ch->macaughep] < 2)
                                            <button title="Thêm câu" onclick="themcau(this,'{{ $ch->macauhoi }}')"
                                                data-target="#themmoi" data-toggle="modal"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="fa fa-plus text-success "></i>
                                            </button>
                                        @endif
                                        <button title="Sửa thông tin" onclick="edit(this,'{{ $ch->macauhoi }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>


                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/CauHoi/delete/' . $ch->macauhoi }}')"
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
        <form action="{{ '/CauHoi/store' }}" method="POST" id="frm_cauhoi" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin câu hỏi
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <div class="col-md-6 mt-2">
                                <label class="control-label">Nguồn câu hỏi<span class="require">*</span></label>
                                <select name="nguoncauhoi" class="form-control" id='nguoncauhoi'>
                                    @foreach ($nguoncauhoi as $ct)
                                        <option value="{{ $ct->madm }}">{{ $ct->tendm }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="control-label">Dạng câu hỏi<span class="require">*</span></label>
                                <select name="dangcau" class="form-control" id='dangcau'>
                                    <option value="1">Câu đơn</option>
                                    <option value="2">Câu ghép</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="control-label">Câu hội thoại/không<span class="require">*</span></label>
                                <select name="hoithoai" class="form-control" id='hoithoai'>
                                    <option value="0">Không hội thoại</option>
                                    <option value="1">Câu hội thoại</option>
                                </select>
                            </div>
                            <div id='cauhoithoai' style="width:100%">

                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Câu hỏi<span class="require">*</span></label>
                                <input type="text" name="cauhoi" class="form-control">
                            </div>

                            <div class="col-md-4 mt-2">
                                <label class="control-label">Loại câu hỏi<span class="require">*</span></label>
                                <select name="loaicauhoi" class="form-control" id='loaicauhoi'>
                                    @foreach ($loaicauhoi as $ct)
                                        <option value="{{ $ct->madm }}">{{ $ct->tendm }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label class="control-label">Ảnh</label>
                                <input type="file" name="anh" class="form-control">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label class="control-label">Audio<span class="require">*</span></label>
                                <input type="file" name="audio" class="form-control">
                            </div>
                            <div id='caudoc' style="width:100%">
                                <div class="col-md-12 mt-2" id="xoadangcaunghe">
                                    <label class="control-label">Dạng câu nghe<span class="require">*</span></label>
                                    <select name="loaicaunghe" class="form-control" id="loaicaunghe">
                                        @foreach ($caunghe as $ct)
                                            <option value="{{ $ct->madmct }}"> {{ $ct->tendmct }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id='xemtranh' style="width:100%">

                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="control-label">Loại đáp án<span class="require">*</span></label>
                                <select name="loaidapan" class="form-control " id="loaidapan">
                                    <option value="1">Text</option>
                                    <option value="2">Hình ảnh</option>
                                </select>
                            </div>
                            <div class=" row" id='dapan' style="width:100%">

                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Đáp án đúng<span class="require">*</span></label>
                                <select name="dapan" class="form-control">
                                    <option value="A">1</option>
                                    <option value="B">2</option>
                                    <option value="C">3</option>
                                    <option value="D">4</option>
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
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin đề thi
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label">Tên đề thi<span class="require">*</span></label>
                                <input type="text" name="tende" id="tende" class="form-control" required>
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
            $('#frm_cauhoi').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }

        function add() {
            $('#A').remove();
            $('#B').remove();
            $('#C').remove();
            $('#D').remove();
            $('#Atiengviet').remove();
            $('#Btiengviet').remove();
            $('#Ctiengviet').remove();
            $('#Dtiengviet').remove();
            $('#noidung').remove();
            var html = '<div class="col-md-3 mt-2" id="A">';
            html += '<label class="control-label ml-3">Đáp án 1<span class="require">*</span></label>';
            html += '<input type="text" name="A" class="form-control ml-3">';
            html += '</div>';
            html += '<div class="col-md-3 mt-2" id="B">';
            html += '<label class="control-label ml-3">Đáp án 2<span class="require">*</span></label>';
            html += '<input type="text" name="B" class="form-control ml-3">';
            html += '</div>';
            html += '<div class="col-md-3 mt-2" id="C">';
            html += '<label class="control-label ml-3">Đáp án 3<span class="require">*</span></label>';
            html += '<input type="text" name="C" class="form-control ml-3">';
            html += '</div>';
            html += '<div class="col-md-3 mt-2" id="D">';
            html += '<label class="control-label ml-3">Đáp án 4<span class="require">*</span></label>';
            html += '<input type="text" name="D" class="form-control ml-3">';
            html += '</div>';

            // html += '<div class="col-md-3 mt-2" id="Atiengviet">';
            // html += '<label class="control-label ml-3">Đáp án 1 tiếng việt<span class="require">*</span></label>';
            // html += '<input type="text" name="Atiengviet" class="form-control ml-3">';
            // html += '</div>';
            // html += '<div class="col-md-3 mt-2" id="Btiengviet">';
            // html += '<label class="control-label ml-3">Đáp án 2 tiếng việt<span class="require">*</span></label>';
            // html += '<input type="text" name="Btiengviet" class="form-control ml-3">';
            // html += '</div>';
            // html += '<div class="col-md-3 mt-2" id="Ctiengviet">';
            // html += '<label class="control-label ml-3">Đáp án 3 tiếng việt<span class="require">*</span></label>';
            // html += '<input type="text" name="Ctiengviet" class="form-control ml-3">';
            // html += '</div>';
            // html += '<div class="col-md-3 mt-2" id="Dtiengviet">';
            // html += '<label class="control-label ml-3">Đáp án 4 tiếng việt<span class="require">*</span></label>';
            // html += '<input type="text" name="Dtiengviet" class="form-control ml-3">';
            // html += '</div>';
            $('#dapan').append(html);

            var html1 = '<div class="col-md-12 mt-2" id="noidung">';
            html1 += '<label class="control-label">Nội dung<span class="require">*</span></label>';
            html1 += '<textarea name="noidung" id="noidungcau" rows="5" class="form-control"></textarea>';
            html1 += '</div>';
            $('#cauhoithoai').append(html1);
        }

        function themcau(e, id) {
            add();
            var html = ' <input type="hidden" name="macaughep" value="' + id + '">';
            var tr = $(e).closest('tr');
            $('#xoadangcaudoc').remove();
            $('#xoaxemtranh').remove();
            $('#noidungcau').text($(tr).find('td[name=noidung]').text());
            $('#dangcau option[value=2 ]').attr('selected', 'selected');
            $('#loaicauhoi option[value=1683685323 ]').attr('selected', 'selected');

            $('#frm_cauhoi').append(html);
        }

        function edit(e, id) {
            var url = '/DeThi/update/' + id;
            var tr = $(e).closest('tr');

            $('#tende').val($(tr).find('td[name=tende]').text());

            $('#frm_edit').attr('action', url);

        }

        function loaicauhoi() {
            alert(1);
        }
    </script>

@stop
