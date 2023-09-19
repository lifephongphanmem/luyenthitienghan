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
            TableManaged1.init();
            $('#giaotrinh').change(function() {
                window.location.href = "{{ $inputs['url'] }}" + '?magiaotrinh='+$('#giaotrinh').val();
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
                        <h3 class="card-label text-uppercase">Danh sách bài học</h3>
                    </div>
                    <div class="card-toolbar">
                        <button onclick="add()" data-target="#themmoi" data-toggle="modal"
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i>Thêm bài học</button>
                        {{-- <button class="btn btn-xs btn-icon btn-success mr-2" title="Nhận dữ liệu từ file Excel"
                            data-target="#modal-nhanexcel" data-toggle="modal">
                            <i class="fas fa-file-import"></i>
                        </button> --}}
                        <a href="{{'/GiaoTrinh/ThongTin'}}" class="btn btn-primary"><i
                            class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label style="font-weight: bold">Giáo trình</label>
                            <select name="magiaotrinh" id="giaotrinh"  class="form-control select2basic">
                                <option value="">Chọn giáo trình</option>
                                @foreach ($a_giaotrinh as $key=>$ct )
                                    <option value="{{$key}}" {{$key == $inputs['magiaotrinh']?'selected':''}}>{{$ct}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Tên bài học</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($m_baihoc as $key => $bh)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name='tengiaotrinh' class="text-left" style="width: 20%">{{ $bh->tenbaihoc }}</td>
                                    <td class="text-center" style="width:8%">

                                        {{-- <button title="Sửa thông tin"
                                            onclick="edit(this,'{{ $bh->id }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button> --}}

                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/GiaoTrinh/XoaBaiHoc/' . $bh->mabaihoc }}')"
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
    <!--Thêm bài học -->
    <div id="themmoi" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <form action="{{ '/GiaoTrinh/thembaihoc' }}" method="POST" id="frm_them" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Danh sách bài học
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name='magiaotrinh' id='them_magiaotrinh' value="{{$model->magiaotrinh}}">
                        <table id="sample_1" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>Tên bài học</th>
                                    {{-- <th>Trạng thái</th> --}}
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0 ?>
                                @foreach ($a_baihoc as $key => $bh)

                                    <tr class="text-center">
                                        <td style="width: 2%">{{++$i }}</td>
                                        <td class="text-left" style="width: 20%">{{ $bh }}</td>
                                        <td class="text-center" style="width:8%">
                                            <label class="checkbox checkbox-outline checkbox-success">
                                                <input type="checkbox" name="mabaihoc[]" value="{{$key}}">
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

    <div id="delete-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <form id="frmDelete" method="POST" action="#" accept-charset="UTF-8">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Đồng ý xoá?</h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                        <input type="hidden" name='magiaotrinh' id='magiaotrinh_del'>
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
            $('#magiaotrinh_del').val($('#giaotrinh').val())
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
            var url='/GiaoTrinh/update/'+id;
            var tr = $(e).closest('tr');

            $('#tengiaotrinh').val($(tr).find('td[name=tengiaotrinh]').text());
            $('#soluongbai').val($(tr).find('td[name=soluongbai]').text());
            $('#ghichu').val($(tr).find('td[name=ghichu]').text());

            $('#frm_edit').attr('action', url);
          
        }
    </script>

@stop
