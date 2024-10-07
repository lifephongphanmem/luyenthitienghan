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
                        <div class="btn-toolbar justify-content-between mr-5" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="First group">
                                <button type="button" data-target="#themmoi" data-toggle="modal" class="btn btn-primary  btn-icon" title="Thêm học viên"><i class="fa fa-plus"></i></button>
                                <button type="button" data-target="#thithu" data-toggle="modal" class="btn btn-success btn-icon" title="Kết quả thi"><i class="flaticon-list"></i></button>
                                <button type="button" data-target="#modal-nhanexcel" data-toggle="modal" class="btn btn-warning btn-icon" title="Nhận excel"><i class="fas fa-file-import"></i></button>
                                {{-- <button type="button" class="btn btn-info btn-icon"><i class="la la-scissors"></i></button> --}}
                            </div>
                        </div>
                        {{-- <button  data-target="#themmoi" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i>Thêm học viên</button>
                        <button  class="btn btn-xs btn-success mr-2" onclick="kq_thithu()" data-target="#thithu" data-toggle="modal">
                            <i class="flaticon-list"></i> Kết quả thi
                        </button> --}}
                        <a onclick="history.back()" class="btn btn-primary"><i
                            class="fa fa-reply"></i>&nbsp;Quay lại</a>
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
                                    <td  class="text-left" style="width: 20%">{{ $hv->tentaikhoan }}</td>
                                    <td class="text-left" style="width: 10%">{{ $hv->cccd }}</td>
                                    <td  style="width: 10%">{{  $hv->gioitinh == 0?'Nữ':'Nam' }}</td>
                                    <td class="text-left" style="width: 8%">
                                        {{ getDayVn($hv->ngaysinh)}}</td>
                                     <td class="text-left" style="width: 10%">{{ $hv->sodienthoai }}</td>
                                     <td class="text-left" style="width: 20%">{{ $hv->diachi }}</td>
                                    <td class="text-center">
                                        <button title="Chuyển lớp"
                                            onclick="chuyenlop(this,'{{ $hv->id }}')"
                                            data-target="#chuyenlop" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-xl la la-exchange-alt text-success"></i>
                                        </button>
                                        <div class="btn-group dropup">
                                            <button type="button" class="btn btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-lg fas fa-users-cog text-primary"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" style="cursor: default"
                                                    onclick="phanquyenluyenthi('{{ $hv->cccd }}','{{ $hv->phanquyenluyenthi }}')"
                                                    data-target="#luyenthi" data-toggle="modal">Luyện thi</a>
                                                <a class="dropdown-item" style="cursor: default"
                                                    onclick="phanquyenkhoahoc('{{ $hv->cccd }}','{{ $hv->giaotrinhhoc }}','{{ $hv->phanquyengiaotrinhhoc }}')"
                                                    data-target="#phanquyenkhoahoc" data-toggle="modal">Giáo trình
                                                    học</a>
                                                <a class="dropdown-item" style="cursor: default"
                                                    onclick="khoataikhoan('{{ $hv->cccd }}','{{ $hv->khoataikhoan }}')"
                                                    data-target="#khoataikhoan" data-toggle="modal">Khóa tài khoản</a>
                                            </div>
                                        </div>
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
                                            <td class="text-left" style="width: 20%">{{ $hv->tentaikhoan }}</td>
                                            <td style="width: 8%">{{ $hv->cccd }}</td>
                                            <td style="width: 6%">{{ $hv->gioitinh == 0?'Nữ':'Nam' }}</td>
                                            <td style="width: 7%">{{ getDayVn($hv->ngaysinh) }}</td>
                                            <td class="text-left" style="width: 8%">
                                                {{ $hv->sodienthoai }}</td>
                                                <td style="width:20%">{{$hv->diachi}}</td>
                                                {{-- <td name='trangthai' style="width:10%" class="{{$a_texttrangthai[$gv->trangthai]}}">{{$a_trangthai[$gv->trangthai]}}</td> --}}
                                            <td class="text-center" style="width:8%">
                                                <label class="checkbox checkbox-outline checkbox-success">
                                                    <input type="checkbox" name="mahocvien[]" value="{{$hv->mataikhoan}}">
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
                                        <option value="{{$ct->ngaythi}}">{{getDayVn($ct->ngaythi)}}</option>
                                    @endforeach

                                </select>
                            </div>
                            {{-- <div class="col-md-12 mt-1">
                                <label class="control-label">Ngày thi</label>
                                <select name="giothi" id="giothi" class="form-control "style="width:100%">
                                    <option value="">-- Chọn giờ thi --</option>
                                    @foreach ($ketquathi as $ct )
                                        <option value="{{$ct->giothi}}">{{$ct->giothi}}</option>
                                    @endforeach

                                </select>
                            </div> --}}
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
    <!--Khóa luyện thi -->
    <div id="luyenthi" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frmLuyenthi" method="POST" action="{{ '/TaiKhoan/phanquyenluyenthi' }}" accept-charset="UTF-8">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý?</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 mt-1">
                            <label class="control-label">Trạng thái luyện thi</label>
                            <select name="trangthai" id='phanquyenluyenthi' class="form-control select2basic"
                                style="width:100%">
                                <option value="0">Khóa</option>
                                <option value="1">Kích hoạt</option>
                            </select>
                        </div>
                        {{-- <input type="hidden" name='malop' id='malop_luyenthi'> --}}
                        <input type="hidden" name='mahocvien' id='mahocvien_luyenthi'>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy thao tác</button>
                        <button type="submit" class="btn btn-primary">Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--Khóa tài khoản -->
    <div id="khoataikhoan" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frmkhoatk" method="POST" action="{{ '/TaiKhoan/khoataikhoan' }}" accept-charset="UTF-8">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý?</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12 mt-1">
                            <label class="control-label">Trạng thái tài khoản</label>
                            <select name="trangthai" id='khoataikhoan' class="form-control"style="width:100%">
                                <option value="1">Kích hoạt</option>
                                <option value="2">Khóa tài khoản</option>
                            </select>
                        </div>
                        {{-- <input type="hidden" name='malop' id='malop_khoatk'> --}}
                        <input type="hidden" name='mahocvien' id='mahocvien_khoatk'>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy thao tác</button>
                        <button type="submit" class="btn btn-primary">Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--Phân quyền giáo trình học -->
    <div id="phanquyenkhoahoc" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frmphanquyenkhoahoc" method="POST" action="{{ '/TaiKhoan/phanquyenkhoahoc' }}"
            accept-charset="UTF-8">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Phân quyền giáo trình học</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Giáo trình học</label>
                            <div class="col-9 col-form-label">
                                <div class="checkbox-inline">
                                    <label class="checkbox checkbox-primary">
                                    <input type="checkbox" name="60baieps" value="60baieps" id='60baieps' />
                                    <span></span>60 bài eps</label>
                                    <label class="checkbox checkbox-primary">
                                    <input type="checkbox" name="960caudoc" value="960caudoc" id="960caudoc" />
                                    <span></span>960 câu đọc</label>
                                    <label class="checkbox checkbox-primary">
                                        <input type="checkbox" name="960caunghe" value="960caunghe" id="960caunghe" />
                                        <span></span>960 câu hiểu</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 col-form-label">Trạng thái</label>
                            <div class="col-9 col-form-label">
                                <div class="radio-inline">
                                    <label class="radio radio-primary">
                                    <input type="radio" name="kh_khoahoc" value="1" id="kh_khoahoc" />
                                    <span></span>Kích hoạt</label>
                                    <label class="radio radio-primary">
                                    <input type="radio" name="kh_khoahoc" value="0" id="khoa_khoahoc" />
                                    <span></span>Khóa</label>
                                </div>
                            </div>
                        </div>
                        {{-- <input type="hidden" name='malop' id='malop_khoahoc'> --}}
                        <input type="hidden" name='mahocvien' id='mahocvien_khoahoc'>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Hủy thao tác</button>
                        <button type="submit" class="btn btn-primary">Đồng
                            ý</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('modal.modal_excel')
    <script>
          function phanquyenluyenthi(mahocvien, phanquyenluyenthi) {
            $('#mahocvien_luyenthi').val(mahocvien);
            $('#phanquyenluyenthi option[value=' + phanquyenluyenthi + ' ]').attr('selected', 'selected');
        }

        function phanquyenkhoahoc(malop, giaotrinh,phanquyen) {
            $('#mahocvien_khoahoc').val(malop);
           
            if (giaotrinh != null) {
                var arr_giaotrinh = giaotrinh.split(';')
                arr_giaotrinh.forEach(element => {
                    $('#'+element).prop('checked',true);
                });
                

            }
            if(phanquyen == 1){
                $('#kh_khoahoc').prop('checked',true);
            }else{
                $('#khoa_khoahoc').prop('checked',true);
            }
        }

        function khoataikhoan(malop, khoataikhoan) {
            $('#mahocvien_khoatk').val(malop);
            $('#khoataikhoan option[value=' + khoataikhoan + ' ]').attr('selected', 'selected');
        }

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
