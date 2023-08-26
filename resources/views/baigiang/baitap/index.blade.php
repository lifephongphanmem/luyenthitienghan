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
            $('#a_baihoc').change(function() {
                window.location.href = "{{ $inputs['url'] }}" + '?mabaihoc=' + $('#a_baihoc').val();
            });
        });
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


        });
        $('#hoithoai').on('change', function() {
            var hoithoai = $(this).val();
            $('#noidung').remove();
            if (hoithoai == 0) {
                var html = '<div class="col-md-12 mt-2" id="noidung">';
                html += '<label class="control-label">Nội dung<span class="require">*</span></label>';
                html += '<textarea name="noidung" id="noidungcau" rows="5" class="form-control"></textarea>';
                html += '</div>'


            } else {
                var html = '<div class="col-md-12 mt-2" id="noidung">'
                html += '<div class="row mt-2">'
                html += '<div class="col-md-6 mt-2">'

                html += '<label class="control-label">Hội thoại 1<span class="require">*</span></label>';
                html += '<input type="text" name="hoithoai1" class="form-control">';
                html += '</div>';
                html += '<div class="col-md-6 mt-2">'
                html += '<label class="control-label">Hội thoại 2<span class="require">*</span></label>';
                html += '<input type="text" name="hoithoai2" class="form-control">';
                html += '</div>';
                html += '<div class="col-md-6 mt-2">'
                html += '<label class="control-label">Hội thoại 3<span class="require">*</span></label>';
                html += '<input type="text" name="hoithoai3" class="form-control">';
                html += '</div>';
                html += '<div class="col-md-6 mt-2">'
                html += '<label class="control-label">Hội thoại 4<span class="require">*</span></label>';
                html += '<input type="text" name="hoithoai4" class="form-control">';
                html += '</div>';
                html += '</div>';
                html += '</div>';

            }
            $('#cauhoithoai').append(html);
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
                        <h3 class="card-label text-uppercase">Danh sách bài tập</h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="add()" data-target="#themmoi" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i> Thêm mới</button>
                        <button class="btn btn-xs  btn-success mr-2" title="Nhận dữ liệu từ file Excel"
                            data-target="#modal-nhanexcel" data-toggle="modal">
                            <i class="fas fa-file-import"></i>Nhận Excel
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label style="font-weight: bold">Bài học</label>

                            <select name="mabaihoc" id="a_baihoc" class="form-control select2basic">
                                @foreach ($m_baihoc as $key => $ct)
                                    <option value="{{ $ct->mabaihoc }}"
                                        {{ $ct->mabaihoc == $inputs['mabaihoc'] ? 'selected' : '' }}>{{ $ct->tenbaihoc }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Bài học</th>
                                <th>Hình ảnh</th>
                                <th>Audio</th>
                                <th>Câu hỏi</th>
                                <th>Đáp án A</th>
                                <th>Đáp án B</th>
                                <th>Đáp án C</th>
                                <th>Đáp án D</th>
                                <th>Đáp án đúng</th>
                                {{-- <th>Hình Ảnh</th> --}}
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $bt)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name='mabaihoc' style="width: 2%">{{ $bt->mabaihoc }}</td>
                                    <td name='anh' class="text-left" style="width: 5%">
                                        @if (isset($bt->anh))
                                        <img src="{{url($bt->anh)}}" alt="" style="width:82px">    
                                        @endif
                                   
                                    </td>
                                    <td name='audio' style="width: 8%">
                                        <audio title="Nghe K-4" controls="controls" style="width:103px">
                                            <source src="{{ asset($bt->audio) }}">
                                        </audio>  
                                    </td>
                                    <td name='audio' style="width: 8%">{{ $bt->cauhoi }}</td>
                                    <td name='A' style="width: 10%">{{ $bt->A }}</td>
                                    <td name='B' style="width: 10%">{{ $bt->B }}</td>
                                    <td name='C' style="width: 10%">{{ $bt->C }}</td>
                                    <td name='D' style="width: 10%">{{ $bt->D }}</td>
                                    <td name='dapan' style="width: 10%">{{ $bt->dapan }}</td>
                                    <td class="text-center" style="width:8%">
                                        <button title="Sửa thông tin"
                                            onclick="edit(this,'{{ $bt->mabaitap }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>

                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/BaiTap/delete/' . $bt->mabaitap }}')"
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
    <div id="themmoi_cu" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="{{ '/BaiTap/store' }}" method="POST" id="frm_baitap" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin bài tập
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-11">
                                <label class="control-label">Tên bài học<span class="require">*</span></label>
                                <select name="tenbaihoc" id="tenbaihoc" class="form-control">
                                    @foreach ($m_baihoc as $key=>$ct )
                                        <option value="{{$ct->mabaihoc}}">{{$ct->tenbaihoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1" style="padding-left: 0px;">
                                <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" class="btn btn-default" data-target="#modal-tenbaihoc" data-toggle="modal">
                                    <i class="fa fa-plus"></i></button>
                            </div>

                            {{-- <div class="col-md-12">
                                <label class="control-label">Hình ảnh<span class="require">*</span></label>
                                <input type="file" name="hinhanh" class="form-control">
                            </div> --}}
                            <div class="col-md-4 mt-2">
                                <label class="control-label">Ảnh</label>
                                <input type="file" name="anh" class="form-control">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label class="control-label">Audio<span class="require">*</span></label>
                                <input type="file" name="audio" class="form-control">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label class="control-label">Câu hỏi<span class="require">*</span></label>
                                <input type="text" name="cauhoi" class="form-control">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label class="control-label">Đáp án A<span class="require">*</span></label>
                                <input type="text" name="A" class="form-control">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label class="control-label">Đáp án B<span class="require">*</span></label>
                                <input type="text" name="B" class="form-control">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label class="control-label">Đáp án C<span class="require">*</span></label>
                                <input type="text" name="C" class="form-control">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label class="control-label">Đáp án D<span class="require">*</span></label>
                                <input type="text" name="D" class="form-control">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Đáp án đúng<span class="require">*</span></label>
                                <select name="dapan" class="form-control">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
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

        <!--Thêm mới -->
        <div id="themmoi" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
            <form action="{{ '/BaiTap/store' }}" method="POST" id="frm_cauhoi" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                            <h4 id="modal-header-primary-label" class="modal-title">Thông tin bài tập
                            </h4>
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        </div>
                        <div class="modal-body">
    
                            <div class="form-group row">

                                <div class="col-md-6 mt-2">
                                    <label class="control-label">Tên bài học<span class="require">*</span></label>
                                    <select name="tenbaihoc" id="tenbaihoc" class="form-control">
                                        @foreach ($m_baihoc as $key=>$ct )
                                            <option value="{{$ct->mabaihoc}}">{{$ct->tenbaihoc}}</option>
                                        @endforeach
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
                                    <label class="control-label">Ảnh</label>
                                    <input type="file" name="anh" class="form-control">
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="control-label">Audio<span class="require">*</span></label>
                                    <input type="file" name="audio" class="form-control">
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
        <!--Thêm mới excel -->
        <div id="modal-nhanexcel" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
            <form action="{{ '/BaiTap/import' }}" method="POST" id="frm_baitap_excel" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                            <h4 id="modal-header-primary-label" class="modal-title">Thông tin bài tập
                            </h4>
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-11">
                                    <label class="control-label">Tên bài học<span class="require">*</span></label>
                                    <select name="tenbaihoc" id="tenbaihoc" class="form-control">
                                        @foreach ($m_baihoc as $key=>$ct )
                                            <option value="{{$ct->mabaihoc}}">{{$ct->tenbaihoc}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1" style="padding-left: 0px;">
                                    <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                    <button type="button" class="btn btn-default" data-target="#modal-tenbaihoc" data-toggle="modal">
                                        <i class="fa fa-plus"></i></button>
                                </div>
    
                                {{-- <div class="col-md-12">
                                    <label class="control-label">Hình ảnh<span class="require">*</span></label>
                                    <input type="file" name="hinhanh" class="form-control">
                                </div> --}}
                                <div class="col-md-4 mt-2">
                                    <label class="control-label">File Excel</label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                            <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickImport()">Đồng
                                ý</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    <div id="modal-tenbaihoc" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
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
                            {{-- {!!Form::text('vanphong_add', null, array('id' => 'vanphong_add','class' => 'form-control','required'=>'required'))!!} --}}
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
    </div>


    <!--Cập nhật -->
    <div id="edit" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="" method="POST" id="frm_edit" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin câu trắc nghiệm
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-11">
                                <label class="control-label">Tên bài học<span class="require">*</span></label>
                                <select name="tenbaihoc" id="mabaihoc" class="form-control">
                                    @foreach ($m_baihoc as $key=>$ct )
                                        <option value="{{$ct->mabaihoc}}">{{$ct->tenbaihoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1" style="padding-left: 0px;">
                                <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" class="btn btn-default" data-target="#modal-tenbaihoc" data-toggle="modal">
                                    <i class="fa fa-plus"></i></button>
                            </div>

                            {{-- <div class="col-md-12">
                                <label class="control-label">Hình ảnh<span class="require">*</span></label>
                                <input type="file" name="hinhanh" class="form-control">
                            </div> --}}
                            <div class="col-md-6 mt-2">
                                <label class="control-label">Tên câu hỏi</label>
                                <input type="text" name="tencautracnghiem" id="tencauhoi" class="form-control">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="control-label">Nội dung<span class="require">*</span></label>
                                <input type="text" name="noidung" id="noidung" class="form-control">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label class="control-label">Đáp án A<span class="require">*</span></label>
                                <input type="text" name="A" id="A" class="form-control">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label class="control-label">Đáp án B<span class="require">*</span></label>
                                <input type="text" name="B" id="B" class="form-control">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label class="control-label">Đáp án C<span class="require">*</span></label>
                                <input type="text" name="C" id="C" class="form-control">
                            </div>
                            <div class="col-md-3 mt-2">
                                <label class="control-label">Đáp án D<span class="require">*</span></label>
                                <input type="text" name="D" id="D" class="form-control">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Đáp án đúng<span class="require">*</span></label>
                                <select name="dapan" id="dapan" class="form-control">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
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
            $('#frm_baitap').submit();
        }
        function clickImport() {
            $('#frm_baitap_excel').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }

        function add_tenbaihoc(){
            $('#modal-tenbaihoc').modal('hide');
            var gt = $('#tenbaihoc_add').val();
            $('#tenbaihoc').append(new Option(gt, gt, true, true));
            $('#tenbaihoc').val(gt).trigger('change');
        }

        function add_cumtu(){
            $('#modal-cumtu').modal('hide');
            var gt = $('#cumtu_add').val();
            $('#cumtuvung').append(new Option(gt, gt, true, true));
            $('#cumtuvung').val(gt).trigger('change');
        }
        function edit(e, matracnghiem) {
            var url='/TracNghiem/update/'+matracnghiem;
            var tr = $(e).closest('tr');

            $('#tencauhoi').val($(tr).find('td[name=tencauhoi]').text());
            $('#noidung').val($(tr).find('td[name=noidung]').text());
            $('#A').val($(tr).find('td[name=A]').text());
            $('#B').val($(tr).find('td[name=B]').text());
            $('#C').val($(tr).find('td[name=C]').text());
            $('#D').val($(tr).find('td[name=D]').text());

            var dapan=$(tr).find('td[name=dapan]').text();
            var tenbaihoc=$(tr).find('td[name=mabaihoc]').text();

            $('#dapan option[value=' + dapan + ' ]').attr('selected', false);
            $('#dapan option[value=' + dapan + ' ]').attr('selected', 'selected');

            $('#mabaihoc option[value=' + tenbaihoc + ' ]').attr('selected', false);
            $('#mabaihoc option[value=' + tenbaihoc + ' ]').attr('selected', 'selected');

            $('#frm_edit').attr('action', url);
          
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
    </script>

@stop
