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
                        <h3 class="card-label text-uppercase">Danh sách loại câu hỏi chi tiết</h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="add()" data-target="#themmoi" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i> Tạo mới</button>
                    </div>
                </div>

                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Mã danh mục ct</th>
                                <th>Tên danh mục ct</th>
                                <th>Tên danh mục</th>
                                <th>Số lượng câu</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $dmct)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name='madm' style="width: 2%">{{ $dmct->madmct }}</td>
                                    <td name='tendm' style="width: 25%">{{ isset($dmct->madmct)?$a_dmct[$dmct->madmct]:'' }}</td>
                                    <td name='tendmct2'>{{$dmct->tendmct2}}</td>
                                    <td name='soluongcau'>{{$dmct->soluongcau}}</td>

                                    <td class="text-center" style="width:8%">
                                        <button title="Sửa thông tin"
                                            onclick="edit(this,'{{ $dmct->madmct2 }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>

                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/ChiTietLoaiCauHoiCt/delete/' . $dmct->madmct2 }}')"
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
        <form action="{{ '/ChiTietLoaiCauHoiCt/store' }}" method="POST" id="frm_loaicauhoict" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin loại câu hỏi chi tiết
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name='madmct' value="{{$madmct}}">
                        <div class="form-group row">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Tên danh mục chi tiết<span class="require">*</span></label>
                                <input type="text" name="tendmct2" class="form-control">
                            </div> 
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Số lượng câu<span class="require">*</span></label>
                                <input type="number" name="soluongcau" value="1" class="form-control">
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


    <!--Cập nhật -->
    <div id="edit" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="" method="POST" id="frm_edit" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-sx">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin loại câu hỏi chi tiết
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Tên danh mục<span class="require">*</span></label>
                                <input type="text" name="tendmct2" id='tendmct2' class="form-control">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Số lượng câu<span class="require">*</span></label>
                                <input type="number" name="soluongcau" id="soluongcau" class="form-control">
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
            $('#frm_loaicauhoict').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }

        function edit(e, madm) {
            var url='/ChiTietLoaiCauHoiCt/update/'+madm;
            var tr = $(e).closest('tr');

            $('#tendmct2').val($(tr).find('td[name=tendmct2]').text());
            $('#soluongcau').val($(tr).find('td[name=soluongcau]').text());
            $('#frm_edit').attr('action', url);
          
        }
    </script>

@stop
