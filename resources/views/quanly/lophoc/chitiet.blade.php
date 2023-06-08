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
            TableManaged1.init();
            $('#a_khoahoc').change(function() {
                window.location.href = "{{ $inputs['url'] }}" + '?lophoc=' +$('#lophoc').val()+'&khoahoc='+$('#a_khoahoc').val();
                var url= "/LopHoc/KetQuaThiThu" + '?lophoc=' +$('#lophoc').val()+'&khoahoc='+$('#a_khoahoc').val();
                $('a#kq_thithu').attr('href', url);
            });
            $('#lophoc').change(function() {
                window.location.href = "{{ $inputs['url'] }}" + '?lophoc=' +$('#lophoc').val()+'&khoahoc='+$('#a_khoahoc').val();
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
                        <h3 class="card-label text-uppercase">Danh sách học viên</h3>
                    </div>
                    <div class="card-toolbar">
                        <button  data-target="#themmoi" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i>Thêm học viên</button>
                        <button  class="btn btn-xs btn-success mr-2" onclick="kq_thithu()" data-target="#thithu" data-toggle="modal">
                            <i class="flaticon-list"></i> Kết quả thi
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label style="font-weight: bold">Lớp học</label>
                            <select name="lophoc" id="lophoc"  class="form-control select2basic">
                                <option value="">Tất cả</option>
                                @foreach ($a_lophoc as $key=>$ct )
                                    <option value="{{$key}}" {{$key == $inputs['lophoc']?'selected':''}}>{{$ct}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label style="font-weight: bold">Khóa học</label>
                            <select name="khoahoc" id="a_khoahoc"  class="form-control select2basic">
                                <option value="">Tất cả</option>
                                @foreach ($a_khoahoc as $key=>$ct )
                                    <option value="{{$key}}" {{$key == $inputs['khoahoc']?'selected':''}}>{{$ct}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Họ tên</th>
                                <th>CCCD</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hocvien as $key => $hv)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td  class="text-left" style="width: 20%">{{ $hv->tenhocvien }}</td>
                                    <td class="text-left" style="width: 10%">{{ $hv->cccd }}</td>
                                    <td  style="width: 10%">{{  $hv->gioitinh == 0?'Nữ':'Nam' }}</td>
                                    <td class="text-left" style="width: 8%">
                                        {{ getDayVn($hv->ngaysinh)}}</td>
                                     <td class="text-left" style="width: 10%">{{ $hv->sdt }}</td>
                                     <td class="text-left" style="width: 20%">{{ $hv->diachi }}</td>
                                    <td class="text-center">
                                        <button title="Chuyển lớp"
                                            onclick="chuyenlop(this,'{{ $hv->id }}')"
                                            data-target="#chuyenlop" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-xl la la-exchange-alt text-success"></i>
                                        </button>

                                        {{-- <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/LopHoc/delete/' . $lh->id }}')"
                                            class="btn btn-sm btn-clean btn-icon" data-target="#delete-modal-confirm"
                                            data-toggle="modal">
                                            <i class="icon-lg la fa-trash-alt text-danger icon-2x"></i></button> --}}
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
    <!--Thêm học viên -->
        <div id="themmoi" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
            <form action="{{ '/LopHoc/themhocvien' }}" method="POST" id="frm_them" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                            <h4 id="modal-header-primary-label" class="modal-title">Danh sách học viên
                            </h4>
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name='malop' id='them_malop' value="{{$inputs['lophoc']}}">
                            <table id="sample_1" class="table table-striped table-bordered table-hover dataTable no-footer">
                                <thead>
                                    <tr class="text-center">
                                        <th>STT</th>
                                        <th>Họ tên</th>
                                        <th>CCCD/CMND</th>
                                        <th>Giới tính</th>
                                        <th>Ngày sinh</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        {{-- <th>Trạng thái</th> --}}
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($m_hocvien as $key => $hv)
                                        <tr class="text-center">
                                            <td style="width: 2%">{{ ++$key }}</td>
                                            <td class="text-left" style="width: 20%">{{ $hv->tenhocvien }}</td>
                                            <td style="width: 8%">{{ $hv->cccd }}</td>
                                            <td style="width: 6%">{{ $hv->gioitinh == 0?'Nữ':'Nam' }}</td>
                                            <td style="width: 7%">{{ getDayVn($hv->ngaysinh) }}</td>
                                            <td class="text-left" style="width: 8%">
                                                {{ $hv->sdt }}</td>
                                                <td style="width:20%">{{$hv->diachi}}</td>
                                                {{-- <td name='trangthai' style="width:10%" class="{{$a_texttrangthai[$gv->trangthai]}}">{{$a_trangthai[$gv->trangthai]}}</td> --}}
                                            <td class="text-center" style="width:8%">
                                                <label class="checkbox checkbox-outline checkbox-success">
                                                    <input type="checkbox" name="mahocvien[]" value="{{$hv->mahocvien}}">
                                                    <span></span>&nbsp;Chọn</label>
        

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        <div id="thithu" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
            <form action="{{'/Export/KetQuaThi'}}" method="POST" id="frm_kq_thithu" enctype="multipart/form-data" target="_blank">
                @csrf
                <div class="modal-dialog modal-sx">
                    <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                            <h4 id="modal-header-primary-label" class="modal-title">Xem kết quả thi thử
                            </h4>
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id='malop_thi' name='malop'>
                            <input type="hidden" id='khoahoc_malop_thi' name='khoahoc'>
                            <div class="col-md-12 mt-1">
                                <label class="control-label">Ngày thi</label>
                                <select name="ngaythi" id="ngaythi" class="form-control "style="width:100%">
                                    <option value="">-- Chọn ngày thi --</option>
                                    @foreach ($ketquathi as $ct )
                                        <option value="{{$ct->ngaythi}}">{{$ct->ngaythi}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-md-12 mt-1">
                                <label class="control-label">Ngày thi</label>
                                <select name="giothi" id="giothi" class="form-control "style="width:100%">
                                    <option value="">-- Chọn giờ thi --</option>
                                    @foreach ($ketquathi as $ct )
                                        <option value="{{$ct->giothi}}">{{$ct->giothi}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                            <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickxemkq()">Đồng
                                ý</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div id="chuyenlop" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
            <form action="" method="POST" id="frm_chuyen" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog modal-sx">
                    <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                            <h4 id="modal-header-primary-label" class="modal-title">Danh sách lớp học
                            </h4>
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12 mt-1">
                                <label class="control-label">Lớp học</label>
                                <select name="malop" id="malop" class="form-control "style="width:100%">
                                    <option value="">-- Chọn lớp học --</option>
                                    @foreach ($a_lophoc as $k=>$ct )
                                        <option value="{{$k}}">{{$ct}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                            <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="clickchuyen()">Đồng
                                ý</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <!--Xóa -->
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

        function clickthem() {
            $('#frm_them').submit();
        }
        function clickxemkq() {
            $('#frm_kq_thithu').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }
        function clickchuyen() {
            $('#frm_chuyen').submit();
        }
        function kq_thithu(){
            $('#malop_thi').val($('#lophoc').val());
            $('#khoahoc_malop_thi').val($('#a_khoahoc').val());
        }

        function edit(e, id, tenlop, khoahoc, giaovienchunhiem) {
            var url = '/LopHoc/update/' + id;
            var tr = $(e).closest('tr');
            $('#tenlop').val($(tr).find('td[name=tenlop]').text());
            $('#khoahoc').val($(tr).find('td[name=khoahoc]').text());
            if(giaovienchunhiem != ''){
                $('#giaovienchunhiem option[value=' + giaovienchunhiem + ' ]').attr('selected', 'selected');
            }

            $('#frm_edit').attr('action', url);
        }

        function chuyenlop(e,id){
            var url='/LopHoc/chuyenlop/'+id;
            $('#frm_chuyen').attr('action', url);
        }
    </script>

@stop
