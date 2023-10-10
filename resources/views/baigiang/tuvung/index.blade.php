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
                        <h3 class="card-label text-uppercase">Danh sách từ vựng</h3>
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
                                <th>Mã bài học</th>
                                <th>Cụm từ</th>
                                <th>Tiếng Hàn</th>
                                <th>Tiếng Việt</th>
                                {{-- <th>Audio</th> --}}
                                {{-- <th>Hình Ảnh</th> --}}
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $tv)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name='mabaihoc' style="width: 2%">{{ $tv->mabaihoc }}</td>
                                    <td name='cumtu' class="text-left" style="width: 5%">{{ $tv->cumtuvung }}</td>
                                    <td name='tutienghan' style="width: 8%">{{ $tv->tutienghan }}</td>
                                    <td name='tiengviet' style="width: 10%">{{ $tv->tiengviet }}</td>
                                    {{-- <td name='tengiaotrinh' class="text-left" style="width: 20%">{{ $tv->audio }}</td> --}}
                                    <td class="text-center" style="width:8%">
                                        <button title="Sửa thông tin"
                                            onclick="edit(this,'{{ $tv->id }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>

                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/TuVung/delete/' . $tv->id }}')"
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
        <form action="{{ '/TuVung/store' }}" method="POST" id="frm_tuvung" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin từ vựng
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-10">
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
                            <div class="col-md-10">
                                <label class="control-label">Cụm từ<span class="require">*</span></label>
                                <select name="cumtuvung" id="cumtuvung" class="form-control">
                                    @foreach ($a_cumtuvung as $key=>$ct )
                                        <option value="{{$ct}}">{{$ct}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1" style="padding-left: 0px;">
                                <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" class="btn btn-default" data-target="#modal-cumtu" data-toggle="modal">
                                    <i class="fa fa-plus"></i></button>
                            </div>
                            {{-- <div class="col-md-12">
                                <label class="control-label">Hình ảnh<span class="require">*</span></label>
                                <input type="file" name="hinhanh" class="form-control">
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <label class="control-label">Audio</label>
                                <input type="file" name="audio" class="form-control">
                            </div> --}}
                            <div class="col-md-12">
                                <label class="control-label">Tiếng Hàn</label>
                                <input type="text" name="tutienghan" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Tiếng Việt</label>
                                <input type="text" name="tiengviet" class="form-control">
                            </div>
                            {{-- <div class="col-md-12">
                                <label class="control-label">Số thứ tự<span class="require">*</span></label>
                                <input type="text" name="stt" class="form-control">
                            </div> --}}
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

        <!--Thêm mới excel -->
        <div id="modal-nhanexcel" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
            <form action="{{ '/TuVung/import' }}" method="POST" id="frm_tuvung_import" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog modal-xs">
                    <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                            <h4 id="modal-header-primary-label" class="modal-title">Thông tin từ vựng
                            </h4>
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-10">
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
                                <div class="col-md-12 mt-2">
                                    <label class="control-label">File Excel</label>
                                    <input type="file" name="file" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-12 mt-2">
                                <a href="{{url('/mauexcel/tuvung.xlsx')}}" style="text-decoration: underline" class="float-right">Tải file mẫu excel</a>
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
            <!--Cập nhật -->
    <div id="edit" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="" method="POST" id="frm_edit" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin từ vựng
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-10">
                                <label class="control-label">Tên bài học<span class="require">*</span></label>
                                <select name="tenbaihoc" id="tenbaihoc_update" class="form-control">
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
                            <div class="col-md-10">
                                <label class="control-label">Cụm từ<span class="require">*</span></label>
                                <select name="cumtuvung" id="cumtu_update" class="form-control">
                                    @foreach ($a_cumtuvung as $key=>$ct )
                                        <option value="{{$ct}}">{{$ct}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1" style="padding-left: 0px;">
                                <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" class="btn btn-default" data-target="#modal-cumtu" data-toggle="modal">
                                    <i class="fa fa-plus"></i></button>
                            </div>
                            {{-- <div class="col-md-12">
                                <label class="control-label">Hình ảnh<span class="require">*</span></label>
                                <input type="file" name="hinhanh" class="form-control">
                            </div> --}}
                            {{-- <div class="col-md-12">
                                <label class="control-label">Audio</label>
                                <input type="file" name="audio" class="form-control">
                            </div> --}}
                            <div class="col-md-12">
                                <label class="control-label">Tiếng Hàn</label>
                                <input type="text" name="tutienghan" id="tutienghan" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Tiếng Việt</label>
                                <input type="text" name="tiengviet" id="tiengviet" class="form-control">
                            </div>
                            {{-- <div class="col-md-12">
                                <label class="control-label">Số thứ tự<span class="require">*</span></label>
                                <input type="text" name="stt" class="form-control">
                            </div> --}}
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
    <div id="modal-cumtu" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin cụm từ</h4>
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-control-label">Cụm từ vựng<span class="require">*</span></label>
                            {{-- {!!Form::text('vanphong_add', null, array('id' => 'vanphong_add','class' => 'form-control','required'=>'required'))!!} --}}
                            <input type="text" name='cumtu_add' id="cumtu_add" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button class="btn btn-primary" onclick="add_cumtu()">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>


    <!-- delete modal -->
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
        function add(){
            $('#tenbaihoc').val('');
            $('#cumtuvung').val('');
        }
        function cfDel(url) {
            $('#frmDelete').attr('action', url);
        }

        function subDel() {
            $('#frmDelete').submit();
        }

        function clickNhanvaTKT() {
            $('#frm_tuvung').submit();
        }
        function clickImport() {
            $('#frm_tuvung_import').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }

        function add_tenbaihoc(){
            $('#modal-tenbaihoc').modal('hide');
            var gt = $('#tenbaihoc_add').val();
            $('#tenbaihoc').append(new Option(gt, gt, true, true));
            $('#tenbaihoc').val(gt).trigger('change');

            $('#tenbaihoc_update').append(new Option(gt, gt, true, true));
            $('#tenbaihoc_update').val(gt).trigger('change');
        }

        function add_cumtu(){
            $('#modal-cumtu').modal('hide');
            var gt = $('#cumtu_add').val();
            $('#cumtuvung').append(new Option(gt, gt, true, true));
            $('#cumtuvung').val(gt).trigger('change');
            $('#cumtu_update').append(new Option(gt, gt, true, true));
            $('#cumtu_update').val(gt).trigger('change');
        }
        function edit(e, id) {
            var url='/TuVung/update/'+id;
            var tr = $(e).closest('tr');
            // $('cumtu_update').removeAttr('selected');
            cumtu = $(tr).find('td[name=cumtu]').text();
            tenbaihoc = $(tr).find('td[name=mabaihoc]').text();
            $('#tutienghan').val($(tr).find('td[name=tutienghan]').text());
            $('#tiengviet').val($(tr).find('td[name=tiengviet]').text());

            $('#cumtu_update option[value=' + cumtu + ' ]').removeAttr('selected').attr('selected', 'selected');
            $('#tenbaihoc_update option[value=' + tenbaihoc + ' ]').removeAttr('selected').attr('selected', 'selected');
            $('#frm_edit').attr('action', url);
          
        }
    </script>

@stop
