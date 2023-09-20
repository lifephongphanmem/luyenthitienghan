@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
@endsection

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
        });
    </script>
    {{-- <script>
        var str = '{{ json_encode($baiviet) }}';
        str = str.replace(/&quot;/ig, '"');
        console.log(JSON.parse(str))
    </script> --}}
    <script>
        function deleteTintuc(url) {
            document.getElementById('btn-delete').setAttribute('href', url);
        }
    </script>
@endsection

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">Quản lý tin tức</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ '/TinTuc/TaoBai' }}">
                            <button type="button" class="btn btn-xs btn-success mr-2">
                                <i class="fa fa-plus"></i> Tạo mới
                            </button>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Mô tả</th>
                                <th>Người đăng</th>
                                <th>Ngày đăng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($baiviet as $key => $bai)
                                <tr class="text-center">
                                    <td style="width: 3%">{{ ++$key }}</td>
                                    <td style="width: 20%">{{ $bai->tieude }}</td>
                                    <td style="width: 15%">{{ Str::limit($bai->phude, 100) }}</td>
                                    <td style="width: 8%">
                                        @isset($bai->user->tentaikhoan)
                                            {{ $bai->user->tentaikhoan }}
                                        @endisset
                                    </td>
                                    <td style="width: 7%">
                                        {{ Carbon\Carbon::createFromTimeString($bai->created_at)->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                                    </td>
                                    <td style="width: 7%">
                                        <a href="{{ '/TinTuc/' . $bai->slug }}" target="_blank" rel="noopener noreferrer">
                                            <button title="Xem bài viết" type="button"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="icon-lg la flaticon-interface-11 text-primary "></i>
                                            </button>
                                        </a>
                                        <a href="{{ '/TinTuc/' . $bai->slug . '/Sua' }}">
                                            <button title="Sửa bài viết" type="button"
                                                class="btn btn-sm btn-clean btn-icon">
                                                <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                            </button>
                                        </a>
                                        <button title="Xóa bài viết" type="button" class="btn btn-sm btn-clean btn-icon"
                                            data-target="#xacnhan" data-toggle="modal"
                                            onclick="deleteTintuc('{{ '/TinTuc/' . $bai->slug . '/Xoa' }}')">
                                            <i class="icon-lg la fa-trash-alt text-danger icon-2x"></i>
                                        </button>
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
    <div id="xacnhan" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade kt_select2_modal">
        <div class="modal-dialog modal-sm align-middle">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h4 id="modal-header-primary-label" class="modal-title">Xác nhận xoá bài viết!</h4>
                    <div class="pt-3">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <a id="btn-delete" href="#">
                            <button type="button" class="btn btn-danger">Đồng ý</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
