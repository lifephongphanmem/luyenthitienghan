@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <style>
        .no-padding {
            padding: 0;
            !important
        }
    </style>
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
            TableManaged1.init();
            $('#made').change(function() {
                window.location.href = "{{ $inputs['url'] }}" + '?made=' + $('#made').val();
            });
        });
    </script>
    <script>
        var a_loaicauhoi = {!! json_encode($a_loaicauhoi) !!};

        var nguoncauhoi = {!! json_encode($nguoncauhoi) !!};
        var loaicauhoi = {!! json_encode($loaicauhoi) !!};
        var loaicauhoict = {!! json_encode($loaicauhoict) !!};

        var nguoncauhoiopt = '1684121372';
        var loaicauhoiopt = '1683685323';
        var loaicauhoictopt = '1683687307';

        $('#nguoncauhoi').change(function() {
            nguoncauhoiopt = $(this).val();
            if (nguoncauhoiopt == '1684121372') {
                var loaicauhoihtml = "";
                var loaicauhoicthtml = "";
                for (let i = 0; i < loaicauhoi.length; i++) {
                    if (loaicauhoi[i].madm == '1683685323') {
                        loaicauhoihtml += "<option value=\"" + loaicauhoi[i].madm + "\" selected>" + loaicauhoi[
                                i].tendm +
                            "</option>";
                        loaicauhoiopt = loaicauhoi[i].madm;
                    } else {
                        loaicauhoihtml += "<option value=\"" + loaicauhoi[i].madm + "\">" + loaicauhoi[
                                i].tendm +
                            "</option>";
                    }
                }
                $('#loaicauhoi').html(loaicauhoihtml);
                $('#loaicauhoi').attr('disabled', '');

                for (let i = 0; i < loaicauhoict.length; i++) {
                    if (loaicauhoict[i].madm == '1683685323' && loaicauhoicthtml == "") {
                        loaicauhoicthtml += "<option value=\"" + loaicauhoict[i].madmct + "\" selected>" +
                            loaicauhoict[i].tendmct + "</option>";
                        loaicauhoictopt = loaicauhoict[i].madmct;
                    } else if (loaicauhoict[i].madm == '1683685323' && loaicauhoicthtml != "") {
                        loaicauhoicthtml += "<option value=\"" + loaicauhoict[i].madmct + "\">" + loaicauhoict[i]
                            .tendmct + "</option>";
                    }
                }
                $('#loaicauhoict').html(loaicauhoicthtml);
            } else if (nguoncauhoiopt == '1684121327') {
                var loaicauhoihtml = "";
                var loaicauhoicthtml = "";
                for (let i = 0; i < loaicauhoi.length; i++) {
                    if (loaicauhoihtml == "") {
                        loaicauhoihtml += "<option value=\"" + loaicauhoi[i].madm + "\" selected>" + loaicauhoi[
                                i].tendm +
                            "</option>";
                        loaicauhoiopt = loaicauhoi[i].madm;
                    } else {
                        loaicauhoihtml += "<option value=\"" + loaicauhoi[i].madm + "\">" + loaicauhoi[i].tendm +
                            "</option>";
                    }
                }
                for (let i = 0; i < loaicauhoict.length; i++) {
                    if (loaicauhoict[i].madm == loaicauhoi[0].madm && loaicauhoicthtml == "") {
                        loaicauhoicthtml += "<option value=\"" + loaicauhoict[i].madmct + "\" selected>" +
                            loaicauhoict[i].tendmct + "</option>";
                        loaicauhoictopt = loaicauhoict[i].madmct;
                    } else if (loaicauhoict[i].madm == loaicauhoi[0].madm && loaicauhoicthtml != "") {
                        loaicauhoicthtml += "<option value=\"" + loaicauhoict[i].madmct + "\">" +
                            loaicauhoict[i].tendmct + "</option>";
                    }
                }
                $('#loaicauhoi').html(loaicauhoihtml);
                $('#loaicauhoi').removeAttr('disabled');

                $('#loaicauhoict').html(loaicauhoicthtml);
            }
        });

        $('#loaicauhoi').change(function() {
            loaicauhoiopt = $(this).val();
            var loaicauhoicthtml = "";
            for (let i = 0; i < loaicauhoict.length; i++) {
                if (loaicauhoict[i].madm == loaicauhoiopt && loaicauhoicthtml == "") {
                    loaicauhoicthtml += "<option value=\"" + loaicauhoict[i].madmct + "\" selected>" +
                        loaicauhoict[i].tendmct + "</option>";
                    loaicauhoictopt = loaicauhoict[i].madmct;
                } else if (loaicauhoict[i].madm == loaicauhoiopt && loaicauhoicthtml != "") {
                    loaicauhoicthtml += "<option value=\"" + loaicauhoict[i].madmct + "\">" + loaicauhoict[i]
                        .tendmct + "</option>";
                }
            }
            $('#loaicauhoict').html(loaicauhoicthtml);
        });

        $('#loaicauhoict').change(function() {
            loaicauhoictopt = $(this).val();
        });

        $('#locbtn').click(function() {
            // console.log(nguoncauhoiopt);
            // console.log(loaicauhoiopt);
            // console.log(loaicauhoictopt);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ '/DeThi/ChiTiet/' . $model->made . '/DanhSachCauHoi' }}',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    nguoncauhoi: nguoncauhoiopt,
                    loaicauhoi: loaicauhoiopt,
                    loaicauhoict: loaicauhoictopt
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    datathemmoi(data);
                },
                error: function(message) {
                    toastr.error(message, "Lỗi")
                }
            });
        });

        function datathemmoi(data) {
            var baseURL = window.location.origin + "/";
            var html = "";
            html += "<table id=\"sample_1\" class=\"table table-striped table-bordered table-hover dataTable no-footer\">";
            html += "<thead>";
            html += "<tr class=\"text-center\">";
            html += "<th style=\"width: 4%\">STT</th>";
            html += "<th style=\"width: 3%\">Loại câu hỏi</th>";
            html += "<th style=\"width: 10%\">Câu hỏi</th>";
            html += "<th style=\"width: 20%\">Nội dung</th>";
            html += "<th style=\"width: 20%\">Ảnh</th>";
            html += "<th style=\"width: 20%\">Audio</th>";
            html += "<th>Thao tác</th>";
            html += "</tr>";
            html += "</thead>";
            html += "<tbody>";
            for (let i = 0; i < data.length; i++) {
                html += "<tr class=\"text-center\">";
                html += "<td>" + (i + 1) + "</td>";
                html += "<td class=\"text-left\">";
                if (data[i].loaicauhoi) {
                    html += a_loaicauhoi[data[i].loaicauhoi];
                }
                html += "</td>";
                html += "<td class=\"text-left\">";
                if (data[i].cauhoi) {
                    html += data[i].cauhoi;
                }
                html += "</td>";
                html += "<td class=\"text-left\">";
                if (data[i].noidung) {
                    html += data[i].noidung;
                }
                html += "</td>";
                html += "<td class=\"text-left\">";
                if (data[i].anh) {
                    html += "<img src=\"" + baseURL + data[i].anh + "\" style=\"width:25%\">";
                }
                html += "</td>";
                html += "<td class=\"text-left\" style=\"width: 8%\">";
                if (data[i].audio) {
                    html += "<audio title=\"Nghe K-4\" controls=\"controls\" style=\"width:103px\">";
                    html += "<source src=\"" + baseURL + data[i].audio + "\">";
                    html += "</audio>";
                }
                html += "</td>";
                html += "<td class=\"text-center\" style=\"width:8%\">";
                html += "<label class=\"checkbox checkbox-outline checkbox-success\">";
                html += "<input type=\"checkbox\" name=\"macauhoi[]\" value=\"" + data[i].macauhoi + "\">";
                html += "<span></span>&nbsp;Chọn";
                html += "</label>";
                html += "</td>";
                html += "</tr>";
            }
            html += "</tbody>";
            html += "</table>";
            document.getElementById('tablethemmoi').innerHTML = html;
            TableManaged1.init();
        }
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
                        @if (count($m_cauhoi) < 40)
                            <button onclick="add()" data-target="#themmoi" data-toggle="modal"
                                class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i>Thêm câu hỏi</button>
                        @endif
                        {{-- <button class="btn btn-xs btn-icon btn-success mr-2" title="Nhận dữ liệu từ file Excel"
                            data-target="#modal-nhanexcel" data-toggle="modal">
                            <i class="fas fa-file-import"></i>
                        </button> --}}
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label style="font-weight: bold">Đề thi</label>
                            <select name="made" id="made" class="form-control select2basic">
                                {{-- <option value="">Chọn đề thi</option> --}}
                                @foreach ($a_dethi as $key => $ct)
                                    <option value="{{ $key }}" {{ $key == $inputs['made'] ? 'selected' : '' }}>
                                        {{ $ct }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th style="width: 2%">STT</th>
                                <th style="width: 10%">Loại câu hỏi</th>
                                <th style="width: 10%">Câu hỏi</th>
                                <th style="width: 20%">Nội dung</th>
                                <th>Audio</th>
                                <th>Ảnh</th>
                                {{-- <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th> --}}
                                <th style="width: 7%">Đáp án</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($m_cauhoi as $key => $ch)
                                <tr class="text-center">
                                    <td>{{ ++$key }}</td>
                                    <td name='loaicauhoi' class="text-left">
                                        {{ isset($ch->loaicauhoi) ? $a_loaicauhoi[$ch->loaicauhoi] : '' }}</td>
                                    <td name='cauhoi' class="text-left">{{ $ch->cauhoi }}</td>
                                    <td name='noidung' class="text-left">{{ $ch->noidung }}</td>
                                    <td>
                                        @if (isset($ch->audio))
                                            <audio title="Nghe K-4" controls="controls" style="width:103px">
                                                <source src="{{ asset($ch->audio) }}">
                                            </audio>
                                        @endif
                                    </td>
                                    <td>
                                        @if (isset($ch->anh))
                                            <img src="{{ url($ch->anh) }}" style="width:30%">
                                        @endif
                                    </td>
                                    {{-- <td class="text-left" >{{ $ch->A }}</td>
                                    <td class="text-left" >{{ $ch->B }}</td>
                                    <td class="text-left" >{{ $ch->C }}</td>
                                    <td class="text-left" >{{ $ch->D }}</td> --}}
                                    <td>{{ $ch->dapan }}</td>
                                    <td class="text-center" style="width:5%">
                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/DeThi/ChiTiet/' . $model->made . '/XoaCauHoi/' . $ch->macauhoi }}')"
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
    <!--Thêm câu hỏi -->
    <div id="themmoi" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="{{ '/DeThi/ThemCauHoi' }}" method="POST" id="frm_them" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Danh sách câu hỏi
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex">
                            <div class="col-6 no-padding">
                                <label style="font-weight: bold">Nguồn câu hỏi</label>
                                <select name="nguoncauhoi" id="nguoncauhoi" class="form-control" style="width: 90%">
                                    @foreach ($nguoncauhoi as $ct)
                                        @if ($ct->madm == '1684121372')
                                            <option value="{{ $ct->madm }}" selected>{{ $ct->tendm }}</option>
                                        @else
                                            <option value="{{ $ct->madm }}">{{ $ct->tendm }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 no-padding">
                                <label style="font-weight: bold">Loại câu hỏi</label>
                                <select name="loaicauhoi" id="loaicauhoi" class="form-control" style="width: 90%" disabled>
                                    @foreach ($loaicauhoi as $ct)
                                        @if ($ct->madm == '1683685323')
                                            <option value="{{ $ct->madm }}" selected>{{ $ct->tendm }}</option>
                                        @else
                                            <option value="{{ $ct->madm }}">{{ $ct->tendm }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex pt-2 pb-2">
                            <div class="col-8 no-padding">
                                <label style="font-weight: bold">Loại câu hỏi chi tiết</label>
                                <select name="loaicauhoict" id="loaicauhoict" class="form-control" style="width: 90%">
                                    @foreach ($loaicauhoict as $key => $ct)
                                        @if ($ct->madm == '1683685323' && $key == 0)
                                            <option value="{{ $ct->madmct }}" selected>{{ $ct->tendmct }}</option>
                                        @elseif($ct->madm == '1683685323' && $key > 0)
                                            <option value="{{ $ct->madmct }}">{{ $ct->tendmct }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4 no-padding text-center align-self-center">
                                
                            </div>
                        </div>

                        <div class="text-center pb-2">
                            <button type="button" class="btn btn-outline-success" id="locbtn">Lọc</button>
                        </div>

                        <input type="hidden" name='made' id='them_made' value="{{ $inputs['made'] }}">
                        <div id="tablethemmoi">
                            <table id="sample_1"
                                class="table table-striped table-bordered table-hover dataTable no-footer">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 4%">STT</th>
                                        <th style="width: 3%">Loại câu hỏi</th>
                                        <th style="width: 10%">Câu hỏi</th>
                                        <th style="width: 20%">Nội dung</th>
                                        <th style="width: 20%">Ảnh</th>
                                        <th style="width: 20%">Audio</th>
                                        {{-- <th>Trạng thái</th> --}}
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($m_cauhoi_khac as $key => $ch)
                                        <tr class="text-center">
                                            <td>{{ ++$i }}</td>
                                            <td class="text-left">
                                                {{ isset($ch->loaicauhoi) ? $a_loaicauhoi[$ch->loaicauhoi] : '' }}
                                            </td>
                                            <td class="text-left">{{ $ch->cauhoi }}</td>
                                            <td class="text-left">{{ $ch->noidung }}</td>
                                            <td class="text-left">
                                                @if (isset($ch->anh))
                                                    <img src="{{ url($ch->anh) }}" style="width:25%">
                                                @endif

                                            </td>
                                            <td class="text-left" style="width: 8%">
                                                @if (isset($ch->audio))
                                                    <audio title="Nghe K-4" controls="controls" style="width:103px">
                                                        <source src="{{ asset($ch->audio) }}">
                                                    </audio>
                                                @endif
                                            </td>
                                            <td class="text-center" style="width:8%">
                                                <label class="checkbox checkbox-outline checkbox-success">
                                                    <input type="checkbox" name="macauhoi[]"
                                                        value="{{ $ch->macauhoi }}">
                                                    <span></span>&nbsp;Chọn
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickthem()">Đồng
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

        function clickthem() {
            $('#frm_them').submit();
        }


        function edit(e, id) {
            var url = '/GiaoTrinh/update/' + id;
            var tr = $(e).closest('tr');

            $('#tengiaotrinh').val($(tr).find('td[name=tengiaotrinh]').text());
            $('#soluongbai').val($(tr).find('td[name=soluongbai]').text());
            $('#ghichu').val($(tr).find('td[name=ghichu]').text());

            $('#frm_edit').attr('action', url);

        }
    </script>

@stop
