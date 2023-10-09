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
    <script src="{{ url('js/custome-form.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

    <script type="text/javascript">
        var changed = false;
        let browseFile = $('#browseFile');

        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    </script>

    <script>
        $('#edit').on('hidden.bs.modal', function() {
            /* $('#video-link').removeAttr('value');
            $('#videoPreview').removeAttr('src');
            $('#browseFile').html('Chọn Tệp');
            $('#videoPreview').hide(); */
            if (changed) {
                location.reload();
            }
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
                            class="btn btn-xs btn-success mr-2"><i class="fa fa-plus"></i> Tạo mới</button>
                        {{-- <button class="btn btn-xs btn-icon btn-success mr-2" title="Nhận dữ liệu từ file Excel"
                            data-target="#modal-nhanexcel" data-toggle="modal">
                            <i class="fas fa-file-import"></i>
                        </button> --}}
                    </div>
                </div>

                <div class="card-body">
                    <table id="sample_3" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <thead>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>Tên bài học</th>
                                <th>STT của bài</th>
                                <th>Video</th>
                                <th>Ảnh nền video</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model as $key => $bh)
                                <tr class="text-center">
                                    <td style="width: 2%">{{ ++$key }}</td>
                                    <td name='tenbaihoc' class="text-left" style="width: 20%">{{ $bh->tenbaihoc }}</td>
                                    <td name='stt' style="width: 8%">{{ $bh->stt }}</td>
                                    <td name='video' style="width: 10%">
                                        @if ($bh->link1 && Illuminate\Support\Facades\File::exists($bh->link1))
                                            <video controls width="100%">
                                                <source src="{{ url($bh->link1) }}">
                                            </video>
                                        @endif
                                    </td>
                                    <td name='anhnenvideo' style="width: 10%">
                                        @if ($bh->link3 && Illuminate\Support\Facades\File::exists($bh->link3))
                                            <img src="{{ url($bh->link3) }}" height="90" width="160">
                                        @endif
                                    </td>
                                    <td class="text-center" style="width:8%">
                                        <button title="Sửa thông tin"
                                            onclick="edit(this,'{{ $bh->id }}', '{{ $bh->link1 }}', '{{ $bh->link3 }}')"
                                            data-target="#edit" data-toggle="modal" class="btn btn-sm btn-clean btn-icon">
                                            <i class="icon-lg la flaticon-edit-1 text-primary "></i>
                                        </button>
                                        <button title="Xóa thông tin" type="button"
                                            onclick="cfDel('{{ '/BaiHoc/delete/' . $bh->id }}')"
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
        <form action="{{ '/BaiHoc/store' }}" method="POST" id="frm_add" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin bài học
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="control-label">Tên bài học<span class="require">*</span></label>
                                <input type="text" name="tenbaihoc" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label class="control-label">Số thứ tự của bài học</label>
                                <input type="number" name="stt" class="form-control">
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <h4 id="modal-header-primary-label" class="modal-title">Thông tin bài học
                        </h4>
                        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12 mb-5">
                                <label class="control-label">Tên bài học<span class="require">*</span></label>
                                <input type="text" name="tenbaihoc" id="tenbaihoc" class="form-control" required>
                            </div>

                            <div class="col-md-12 mb-5">
                                <label class="control-label">Số thứ tự của bài học</label>
                                <input type="text" name="stt" id="stt" class="form-control">
                            </div>

                            <div class="col-md-12 mb-5">
                                <label class="control-label">Video</label>
                                <div class="col-md-12">
                                    <video id="videoPreview" src="" controls
                                        style="width: 100%; height: auto; display: none;"></video>
                                </div>
                                <div id="upload-container" class="text-center">
                                    <button type="button" id="browseFile" class="btn btn-outline-primary">Chọn
                                        Tệp</button>
                                </div>
                                <div style="display: none" class="progress mt-3" style="height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 75%; height: 100%">75%</div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="control-label">Ảnh nền của video</label>
                                <input class="form-control" type="file" id="link3" name="anh-nen-video" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default" id="cancel-edit">Hủy thao tác</button>
                        <button type="submit" data-dismiss="modal" class="btn btn-primary" id="submit-edit"
                            onclick="clickedit()">Đồng
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
            $('#frm_add').submit();
        }

        function clickedit() {
            $('#frm_edit').submit();
        }


        function edit(e, id, link1, link3) {
            var url = '/BaiHoc/update/' + id;
            var tr = $(e).closest('tr');
            var baseURL = window.location.origin + "/";

            $('#tenbaihoc').val($(tr).find('td[name=tenbaihoc]').text());
            $('#stt').val($(tr).find('td[name=stt]').text());
            if (link1 != '') {
                $('#video-link').val(link1);
                $('#videoPreview').attr('src', baseURL + link1);
                $('#browseFile').html('Thay Đổi')
                $('#videoPreview').show();
            }

            var resumable = new Resumable({
                target: "{{ '/BaiHoc/uploadvideo/' }}" + id,
                query: {
                    _token: '{{ csrf_token() }}',
                }, // CSRF token
                fileType: ['mp4'],
                chunkSize: 10 * 1024 *
                    1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
                headers: {
                    'Accept': 'application/json'
                },
                testChunks: false,
                throttleProgressCallbacks: 1,
            });

            resumable.assignBrowse(browseFile[0]);

            resumable.on('fileAdded', function(file) { // trigger when file picked
                showProgress();
                resumable.upload() // to actually start uploading.
                $('#submit-edit').attr('disabled', '');
                $('#cancel-edit').attr('disabled', '');
                $('#edit').attr('data-bs-backdrop', 'static');
                $('.close').removeAttr('data-dismiss');
            });

            resumable.on('fileProgress', function(file) { // trigger when file progress update
                updateProgress(Math.floor(file.progress() * 100));
            });

            resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
                response = JSON.parse(response);
                $('#videoPreview').attr('src', response.path + '/' + response.name);
                $('#videoPreview').show();
                $('#browseFile').html('Thay Đổi');
                $('#submit-edit').removeAttr('disabled');
                $('.progress').hide();
                $('#cancel-edit').removeAttr('disabled', '');
                $('#edit').removeAttr('data-bs-backdrop');
                $('.close').attr('data-dismiss', 'modal');
                changed = true;
                resumable.removeFile(file);
            });

            resumable.on('fileError', function(file, response) { // trigger when there is any error
                alert('Tệp tải lên KHÔNG thành công. Lỗi không xác định');
                $('#submit-edit').removeAttr('disabled');
                $('#cancel-edit').removeAttr('disabled', '');
                $('#edit').removeAttr('data-bs-backdrop');
                $('.close').attr('data-dismiss', 'modal');
                $('.progress').hide();
            });

            $('#frm_edit').attr('action', url);
        }
    </script>

@stop
