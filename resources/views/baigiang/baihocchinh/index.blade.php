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
                        <h3 class="card-label text-uppercase">Danh sách bài giảng chính</h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="add()" data-target="#themmoi" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i> Tạo mới</button>
                        <button class="btn btn-xs btn-success mr-2" title="Nhận dữ liệu từ file Excel"
                            data-target="#modal-nhanexcel" data-toggle="modal">
                            <i class="fas fa-file-import"></i>Nhận Excel
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Tên bài học</th>
                                <th>Hình ảnh 1</th>
                                <th>Hình ảnh 2</th>
                                <th>Audio</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $gt)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name='tengiaotrinh' class="text-left" style="width: 20%">{{ $gt->tenbaihoc }}</td>
                                    <td name='soluongbai' style="width: 8%">
                                        @if (isset($gt->anh))
                                        <img src="{{ url($gt->anh) }}" style="width:30%">
                                    @endif
                                    </td>
                                    <td name='soluongbai' style="width: 8%">
                                        @if (isset($gt->anh2))
                                        <img src="{{ url($gt->anh2) }}" style="width:30%">
                                    @endif
                                    </td>
                                    <td name='ghichu' style="width: 10%">
                                        @if (isset($gt->audio))
                                        <audio title="Nghe" controls="controls" style="width:103px">
                                            <source src="{{ asset($gt->audio) }}">
                                        </audio>
                                    @endif
                                    </td>
                                    <td class="text-center" style="width:8%">
                                        <a href="{{'/GiaoTrinh/chitiet/'.$gt->id}}" title="Chi tiết"
                                            class="btn btn-sm btn-clean btn-icon">
                                             <i class="icon-lg la la-th-list text-primary "></i>
                                         </a>
                                        <button title="Sửa thông tin"
                                            onclick="edit(this,'{{ $gt->id }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>

                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/BaiHocChinh/delete/' . $gt->id }}')"
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
        <form action="{{ '/BaiHocChinh/store' }}" method="POST" id="frm_baihocchinh" enctype="multipart/form-data">
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
                            <div class="col-md-12">
                                <label class="control-label">Hình ảnh 1<span class="require">*</span></label>
                                <input type="file" name="anh" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Audio</label>
                                <input type="file" name="audio" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Hình ảnh 2</label>
                                <input type="file" name="anh2" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Số thứ tự<span class="require">*</span></label>
                                <input type="text" name="stt" class="form-control">
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

        <!--Nhận excel -->
        <div id="modal-nhanexcel" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
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
                                <div class="col-md-12 mt-2">
                                    <label class="control-label">File excel<span class="require">*</span></label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                            <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickNhanexcel()">Đồng
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
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin giáo trình
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label">Tên giáo trình<span class="require">*</span></label>
                                <input type="text" name="tengiaotrinh" id="tengiaotrinh" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Số lượng bài<span class="require">*</span></label>
                                <input type="text" name="soluongbai" id="soluongbai" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="control-label">Ghi chú</label>
                                <textarea name="ghichu" id="ghichu" cols="" rows="5" class="form-control"></textarea>
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
            $('#frm_baihocchinh').submit();
        }
        function clickNhanexcel(){
            $('#frm_import').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }
        function add(){
            var form = $('#frm_baihocchinh');
            form.find("[name='stt']").val('{{ $stt + 1 }}');
        }
        function add_tenbaihoc(){
            $('#modal-tenbaihoc').modal('hide');
            var gt = $('#tenbaihoc_add').val();
            $('#tenbaihoc').append(new Option(gt, gt, true, true));
            $('#tenbaihoc').val(gt).trigger('change');
            $('#tenbaihoc_excel').append(new Option(gt, gt, true, true));
            $('#tenbaihoc_excel').val(gt).trigger('change');
        }
        function add_tenbaihoc_excel(){
            $('#modal-tenbaihoc').modal('hide');
            var gt = $('#tenbaihoc_add').val();
            $('#tenbaihoc_excel').append(new Option(gt, gt, true, true));
            $('#tenbaihoc_excel').val(gt).trigger('change');
        }
        function edit(e, id) {
            var url='/GiaoTrinh/update/'+id;
            var tr = $(e).closest('tr');

            $('#tengiaotrinh').val($(tr).find('td[name=tengiaotrinh]').text());
            $('#soluongbai').val($(tr).find('td[name=soluongbai]').text());
            $('#ghichu').val($(tr).find('td[name=ghichu]').text());

            $('#frm_edit').attr('action', url);
          
        }
    </script>

@stop
