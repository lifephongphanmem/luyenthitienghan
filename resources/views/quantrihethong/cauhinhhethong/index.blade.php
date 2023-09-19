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
                        <h3 class="card-label text-uppercase">Danh sách thư mục</h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="add()" data-target="#themmoi" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i> Tạo mới</button>
                    </div>
                </div>

                <div class="card-body">
                    {{-- <div class="form-group row">
                        <div class="col-md-4">
                            <label style="font-weight: bold">Khóa học</label>

                            <select name="khoahoc" id="a_khoahoc"  class="form-control select2basic">
                                <option value="">Tất cả</option>
                                @foreach ($a_khoahoc as $key=>$ct )
                                    <option value="{{$key}}" {{$key == $inputs['khoahoc']?'selected':''}}>{{$ct}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th >Mã chức năng</th>
                                <th >Thư mục</th>
                                <th >Trạng thái</th>
                                <th >Thời gian lưu </br> (Ngày)</th>
                                <th >Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $cauhinh)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name='machucnang' class="text-left" style="width: 20%">{{ $cauhinh->machucnang }}</td>
                                    <td name='thumuc' class="text-left" style="width: 20%">{{ $cauhinh->thumuc }}</td>
                                    <td  class="text-left" style="width: 10%">{{ $cauhinh->status }}</td>
                                    <td name='thoigianluu' style="width: 10%">{{ $cauhinh->thoigianluu }}</td>

                                    <td class="text-center"  style="width: 8%">

                                        <button title="Sửa thông tin"
                                            onclick="edit(this,'{{$cauhinh->macauhinh}}','{{$cauhinh->trangthai}}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>

                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/CauHinhHeThong/delete/' . $cauhinh->macauhinh }}')"
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
        <form action="{{ '/CauHinhHeThong/store' }}" method="POST" id="frm_lophoc" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin thư mục
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>

                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label">Mã chức năng<span class="require">*</span></label>
                                <input type="text" name="machucnang" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Tên thư mục<span class="require">*</span></label>
                                <input type="text" name="thumuc" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Thời gian lưu (Ngày)</label>
                                <input type="number" name="thoigianluu" value="7" class="form-control" required>
                            </div>
                            <div class="col-md-12 mt-1">
                                <label class="control-label">Trạng thái</label>
                                <select name="trangthai" class="form-control select2basic"style="width:100%">
                                    <option value="1">Lưu trữ</option>
                                    <option value="0">Không lưu trữ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit"  class="btn btn-primary" >Đồng
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
                    <h4 id="modal-header-primary-label" class="modal-title">Thông tin thư mục
                    </h4>
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
    
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="control-label">Mã chức năng<span class="require">*</span></label>
                            <input type="text" name="machucnang" id='machucnang' class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Tên thư mục<span class="require">*</span></label>
                            <input type="text" name="thumuc" id='thumuc' class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Thời gian lưu (Ngày)</label>
                            <input type="number" name="thoigianluu" id='thoigianluu' class="form-control" required>
                        </div>
                        <div class="col-md-12 mt-1">
                            <label class="control-label">Trạng thái</label>
                            <select name="trangthai" id='trangthai' class="form-control"style="width:100%">
                                <option value="1">Lưu trữ</option>
                                <option value="0">Không lưu trữ</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit"  class="btn btn-primary" >Đồng
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
            $('#frm_lophoc').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }


        function edit(e, macauhinh, trangthai) {
            var url = '/CauHinhHeThong/update/' + macauhinh;
            var tr = $(e).closest('tr');
            $('#machucnang').val($(tr).find('td[name=machucnang]').text());
            $('#thumuc').val($(tr).find('td[name=thumuc]').text());
            $('#thoigianluu').val($(tr).find('td[name=thoigianluu]').text());
            if(trangthai != ''){
                $('#trangthai option[value=' + trangthai + ' ]').attr('selected', 'selected');
            }

            $('#frm_edit').attr('action', url);
        }
    </script>

@stop
