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
            $('#made').change(function() {
                // window.location.href = "{{ $inputs['url'] }}" + '?made='+$('#made').val();
                window.location.href = "{{ $inputs['url'] }}" +$('#made').val();
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
                        <h3 class="card-label text-uppercase">Danh sách câu hỏi</h3>
                    </div>
                    <div class="card-toolbar">
                        @if(count($m_cauhoi)<40)
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
                            <select name="made" id="made"  class="form-control select2basic">
                                {{-- <option value="">Chọn đề thi</option> --}}
                                @foreach ($a_dethi as $key=>$ct )
                                    <option value="{{$key}}" {{$key == $inputs['made']?'selected':''}}>{{$ct}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th  style="width: 2%">STT</th>
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
                                    <td name='loaicauhoi' class="text-left" >{{ isset($ch->loaicauhoi)?$a_loaicauhoi[$ch->loaicauhoi]:'' }}</td>
                                    <td name='loaicauhoi' class="text-left" >{{ $ch->cauhoi }}</td>
                                    <td name='noidung' class="text-left" >{{ $ch->noidung }}</td>
                                    <td >
                                        @if (isset($ch->audio))
                                        <audio title="Nghe K-4" controls="controls" style="width:103px">
                                            <source src="{{ asset($ch->audio) }}">
                                        </audio> 
                                        @endif
                                    </td>
                                    <td >
                                         @if (isset($ch->anh))
                                        <img src="{{url($ch->anh)}}" style="width:30%">
                                        @endif
                                    </td>
                                    {{-- <td class="text-left" >{{ $ch->A }}</td>
                                    <td class="text-left" >{{ $ch->B }}</td>
                                    <td class="text-left" >{{ $ch->C }}</td>
                                    <td class="text-left" >{{ $ch->D }}</td> --}}
                                    <td >{{ $ch->dapan }}</td>
                                    <td class="text-center" style="width:5%">
                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/DeThi/XoaCauHoi/' . $ch->macauhoi }}')"
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
                        <input type="hidden" name='made' id='them_made' value="{{$inputs['made']}}">
                        <table id="sample_1" class="table table-striped table-bordered table-hover dataTable no-footer">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 2%">STT</th>
                                    <th style="width: 5%">Loại câu hỏi</th>
                                    <th style="width: 10%">Câu hỏi</th>
                                    <th style="width: 20%">Nội dung</th>
                                    <th style="width: 20%">Ảnh</th>
                                    <th style="width: 20%">Audio</th>
                                    {{-- <th>Trạng thái</th> --}}
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0 ?>
                                @foreach ($m_cauhoi_khac as $key => $ch)

                                    <tr class="text-center">
                                        <td >{{++$i }}</td>
                                        <td class="text-left" >{{ $ch->loaicauhoi }}</td>
                                        <td class="text-left" >{{ $ch->cauhoi }}</td>
                                        <td class="text-left" >{{ $ch->noidung }}</td>
                                        <td class="text-left" >
                                            @if (isset($ch->anh))
                                            <img src="{{url($ch->anh)}}" style="width:25%">
                                            @endif
                                            
                                        </td>
                                        <td class="text-left" style="width: 8%">
                                            @if (isset($ch->audio))
                                            <audio title="Nghe K-4" controls="controls" style="width:103px">
                                                <source src="{{ asset($ch->audio) }}">
                                            </audio> 
                                            @endif
                                        <td class="text-center" style="width:8%">
                                            <label class="checkbox checkbox-outline checkbox-success">
                                                <input type="checkbox" name="macauhoi[]" value="{{$ch->macauhoi}}">
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
            var url='/GiaoTrinh/update/'+id;
            var tr = $(e).closest('tr');

            $('#tengiaotrinh').val($(tr).find('td[name=tengiaotrinh]').text());
            $('#soluongbai').val($(tr).find('td[name=soluongbai]').text());
            $('#ghichu').val($(tr).find('td[name=ghichu]').text());

            $('#frm_edit').attr('action', url);
          
        }
    </script>

@stop
