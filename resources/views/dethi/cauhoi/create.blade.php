@extends('main')
@section('custom-style')
    <link href="{{ url('assets/css/pages/wizard/wizard-3.css') }}" rel="stylesheet" type="text/css" />
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
    <script src="{{ url('js/cauhoi.js') }}"></script>
    <script src="{{ url('assets/js/pages/custom/wizard/wizard-3.js') }}"></script>
    <style>
        .hide {
            display: none;
        }

        .form-group {
            margin-left: 3px;
        }
    </style>
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
            var avatar1 = new KTImageInput('kt_image_1');
            var avatar2 = new KTImageInput('kt_image_2');
            var avatar3 = new KTImageInput('kt_image_3');
            var avatar4 = new KTImageInput('kt_image_4');
            var avatar5 = new KTImageInput('kt_image_5');
        });

        const audioInput = document.getElementById('audioInput');
        const audioPlayer = document.getElementById('audioPlayer');

        // Thêm sự kiện onchange
        audioInput.addEventListener('change', function(event) {
            const file = event.target.files[0]; // Lấy file đầu tiên được chọn

            if (file) {
                // Tạo URL cho file được chọn
                const audioURL = URL.createObjectURL(file);

                // Gắn URL vào audio player
                audioPlayer.src = audioURL;
                audioPlayer.play(); // Tự động phát (tuỳ chọn)
            } else {
                console.log("Không có file nào được chọn.");
            }
        });

        function xemtranh(e) {
            var dangcaudoc = $(e).val();
            $('#xoaxemtranh').remove();
            if (dangcaudoc == 1683687307) {
                var html = '<div class="col-md-12 mt-2" id="xoaxemtranh">';
                html += '<label class="control-label">Loại câu xem tranh<span class="require">*</span></label>';
                html += '<select name="dangcauxemtranh" class="form-control" id="loaicauxemtranh">';
                html += '<option value="1">Chỉ đồ vật</option>';
                html += '<option value="2">Chỉ hành động</option>';
                html += '<option value="3">Số lượng</option>';
                html += '</select>';
                html += '</div>';
                $('#xemtranh').append(html);
            }
        }

        $('#loaidapan').on('change', function() {
            var loaidapan = $(this).val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/CauHoi/LoaiDapAn',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    loaidapan: loaidapan
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    $('#A').remove();
                    $('#B').remove();
                    $('#C').remove();
                    $('#D').remove();
                    $('#dapan').append(data);

                    var avatar1 = new KTImageInput('kt_image_1');
                    var avatar2 = new KTImageInput('kt_image_2');
                    var avatar3 = new KTImageInput('kt_image_3');
                    var avatar4 = new KTImageInput('kt_image_4');
                    var avatar5 = new KTImageInput('kt_image_5');
                },
                error: function(message) {
                    toastr.error(message, "Lỗi")
                }
            });
        })
    </script>
@stop
@section('content')
    <!--begin::Row-->
    {{-- <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">Thêm câu hỏi</h3>
                    </div>
                </div> --}}
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5 text-uppercase">Thêm câu hỏi</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a onclick="history.back()" class="btn btn-light-primary font-weight-bolder btn-sm">Quay lại</a>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->

    {{-- <div class="card-body"> --}}
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card-body p-0">
                    <!--begin: Wizard-->
                    <div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="step-first"
                        data-wizard-clickable="true">
                        <!--begin: Wizard Nav-->
                        <div class="wizard-nav">
                            <div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3" id='wizard'>
                                <!--begin::Wizard Step 1 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                            <span>1.</span>Thông tin chung
                                        </h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 1 Nav-->
                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                            <span>2.</span>Chi tiết câu hỏi
                                        </h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 2 Nav-->

                            </div>
                        </div>
                        <!--end: Wizard Nav-->
                        <!--begin: Wizard Body-->
                        <div class=" py-10 px-8 py-lg-12 px-lg-10">
                            <div class="">
                                <!--begin: Wizard Form-->
                                <form action="{{ '/CauHoi/store' }}" method="POST" class="form" id="kt_form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!--begin: Wizard Step 1-->
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                        {{-- <h4 class="mb-10 font-weight-bold text-dark">Setup Your Current Location</h4> --}}

                                        <!--end::Input-->
                                        <div class="row mb-6">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <label class="control-label">Nguồn câu hỏi<span
                                                        class="require">*</span></label>
                                                <select name="nguoncauhoi" class="form-control" id='nguoncauhoi'>
                                                    @foreach ($nguoncauhoi as $ct)
                                                        <option value="{{ $ct->madm }}">{{ $ct->tendm }}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <label class="control-label">Dạng câu hỏi<span
                                                        class="require">*</span></label>
                                                <select name="dangcau" class="form-control" id='dangcau'>
                                                    <option value="1">Câu đơn</option>
                                                    <option value="2">Câu ghép</option>
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label class="control-label">Loại câu hỏi<span class="require">*</span></label>
                                            <select name="loaicauhoi" class="form-control" id='loaicauhoi'>
                                                @foreach ($loaicauhoi as $ct)
                                                    <option value="{{ $ct->madm }}">{{ $ct->tendm }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div id='caudoc' style="width:100%">
                                                <div id="xoadangcaunghe">
                                                    <label class="control-label">Dạng câu nghe hiểu<span
                                                            class="require">*</span></label>
                                                    <select name="loaicaunghe" class="form-control" id="loaicaunghe">
                                                        @foreach ($caunghe as $ct)
                                                            <option value="{{ $ct->madmct }}"> {{ $ct->tendmct }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                        {{-- <div id='xemtranh' style="width:100%">

                                        </div> --}}
                                    </div>
                                    <!--end: Wizard Step 1-->
                                    <!--begin: Wizard Step 2-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        {{-- <h4 class="mb-10 font-weight-bold text-dark">Enter the Details of your Delivery</h4> --}}
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label class="control-label">Câu hỏi<span class="require">*</span></label>
                                            <input type="text" name="cauhoi[]" class="form-control">
                                        </div>
                                        <!--end::Input-->
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label class="control-label">Câu hội thoại/không<span
                                                    class="require">*</span></label>
                                            <select name="hoithoai[]" class="form-control" id='hoithoai'>
                                                <option value="0">Không hội thoại</option>
                                                <option value="1">Câu hội thoại</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div id='cauhoithoai' style="width:100%">
                                                <div id="noidung">
                                                    <label class="control-label">Nội dung / Đoạn văn<span
                                                            class="require">*</span></label>
                                                    <textarea name="noidung[]" id="noidungcau" rows="5" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="control-label">Loại đáp án<span
                                                            class="require">*</span></label>
                                                    <select name="loaidapan[]" class="form-control " id="loaidapan">
                                                        <option value="1">Text</option>
                                                        <option value="2">Hình ảnh</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="control-label">Đáp án đúng<span
                                                            class="require">*</span></label>
                                                    <select name="dapan[]" class="form-control">
                                                        <option value="A">1</option>
                                                        <option value="B">2</option>
                                                        <option value="C">3</option>
                                                        <option value="D">4</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                {{-- <div class="form-group">
                                                    <label class="control-label">Ảnh</label>
                                                    <input type="file" name="anh[]" class="form-control"
                                                        accept=".jpg,.png">
                                                </div> --}}
                                                <div class="form-group row" style="margin-left:32px">
                                                    <label class="col-form-label">Ảnh<span
                                                            class="require">*</span></label>
                                                    <div class="image-input image-input-outline" id="kt_image_5">
                                                        <div class="image-input-wrapper"
                                                            style="background-image:url(/images/no-image.jpg)"></div>

                                                        <label
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="change" data-toggle="tooltip" title=""
                                                            data-original-title="Đổi ảnh">
                                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                                            <input type="file" name="anh[]"
                                                                accept=".png, .jpg, .jpeg" />
                                                            <input type="hidden" name="profile_avatar_remove" />
                                                        </label>

                                                        <span
                                                            class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                                            data-action="cancel" data-toggle="tooltip" title="Cancel">
                                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="control-label">Audio</label>
                                                    <input type="file" name="audio[]" id="audioInput" class="form-control"
                                                        accept=".mp3,.m4a">
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3" style="line-height: 128px">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <audio title="Nghe K-4" controls="controls" id="audioPlayer">
                                                        <source src="">
                                                    </audio>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="row" id='dapan'>
                                            <div class="col-xl-3" id='A'>
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="control-label">Đáp án 1<span
                                                            class="require">*</span></label>
                                                    <input type="text" name="A[]" class="form-control">
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3" id='B'>
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="control-label">Đáp án 2<span
                                                            class="require">*</span></label>
                                                    <input type="text" name="B[]" class="form-control">
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3" id='C'>
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="control-label">Đáp án 3<span
                                                            class="require">*</span></label>
                                                    <input type="text" name="C[]" class="form-control">
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3" id='D'>
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="control-label">Đáp án 4<span
                                                            class="require">*</span></label>
                                                    <input type="text" name="D[]" class="form-control">
                                                </div>
                                                <!--end::Input-->
                                            </div>

                                        </div>
                                        {{-- <div class="form-group">
                                            <div class=" row" id='dapan' style="width:100%">
                                                <div class="col-md-3 " id="A">
                                                    <label class="control-label ml-3">Đáp án 1<span
                                                            class="require">*</span></label>
                                                    <input type="text" name="A" class="form-control ml-3">
                                                </div>
                                                <div class="col-md-3" id="B">
                                                    <label class="control-label ml-3">Đáp án 2<span
                                                            class="require">*</span></label>
                                                    <input type="text" name="B" class="form-control ml-3">
                                                </div>
                                                <div class="col-md-3" id="C">
                                                    <label class="control-label ml-3">Đáp án 3<span
                                                            class="require">*</span></label>
                                                    <input type="text" name="C" class="form-control ml-3">
                                                </div>
                                                <div class="col-md-3" id="D">
                                                    <label class="control-label ml-3">Đáp án 4<span
                                                            class="require">*</span></label>
                                                    <input type="text" name="D" class="form-control ml-3">
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div id='caughep2' class="hide">
                                            <hr>
                                            <div class="mb-3">
                                                <span class="text-uppercase text-primary"
                                                    style="text-decoration: underline">Nội dung câu thứ 2</span>
                                            </div>
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label class="control-label">Câu hỏi<span class="require">*</span></label>
                                                <input type="text" name="cauhoi[]" class="form-control">
                                            </div>
                                            <!--end::Input-->
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label class="control-label">Câu hội thoại/không<span
                                                        class="require">*</span></label>
                                                <select name="hoithoai[]" class="form-control" id='hoithoai2'>
                                                    <option value="0">Không hội thoại</option>
                                                    <option value="1">Câu hội thoại</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <div id='cauhoithoai2' style="width:100%">
                                                    <div id="noidung2">
                                                        <label class="control-label">Nội dung / Đoạn văn<span
                                                                class="require">*</span></label>
                                                        <textarea name="noidung[]" id="noidungcau" rows="5" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Input-->
                                            <div class="row">
                                                <div class="col-xl-3">
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Ảnh</label>
                                                        <input type="file" name="anh[]" class="form-control"
                                                            accept=".jpg,.png">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-3">
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Audio</label>
                                                        <input type="file" name="audio[]" class="form-control"
                                                            accept=".mp3,.m4a">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-3">
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Loại đáp án<span
                                                                class="require">*</span></label>
                                                        <select name="loaidapan[]" class="form-control " id="loaidapan2">
                                                            <option value="1">Text</option>
                                                            <option value="2">Hình ảnh</option>
                                                        </select>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-3">
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án đúng<span
                                                                class="require">*</span></label>
                                                        <select name="dapan[]" class="form-control">
                                                            <option value="A">1</option>
                                                            <option value="B">2</option>
                                                            <option value="C">3</option>
                                                            <option value="D">4</option>
                                                        </select>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            </div>
                                            <div class="row" id='dapan2'>
                                                <div class="col-xl-3" id='A2'>
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án 1<span
                                                                class="require">*</span></label>
                                                        <input type="text" name="A[]" class="form-control">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-3" id='B2'>
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án 2<span
                                                                class="require">*</span></label>
                                                        <input type="text" name="B[]" class="form-control">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-3" id='C2'>
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án 3<span
                                                                class="require">*</span></label>
                                                        <input type="text" name="C[]" class="form-control">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-3" id='D2'>
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án 4<span
                                                                class="require">*</span></label>
                                                        <input type="text" name="D[]" class="form-control">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <!--end: Wizard Step 2-->
                                    <!--begin: Wizard Actions-->
                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div class="mr-2">
                                            <button type="button"
                                                class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4"
                                                data-wizard-type="action-prev">Quay lại</button>
                                        </div>
                                        <div>
                                            <button type="submit"
                                                class="btn btn-success font-weight-bolder text-uppercase px-9 py-4"
                                                data-wizard-type="action-submit">Đồng ý</button>
                                            <button type="button"
                                                class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4"
                                                data-wizard-type="action-next">Kế tiếp</button>
                                        </div>
                                    </div>
                                    <!--end: Wizard Actions-->
                                </form>
                                <!--end: Wizard Form-->
                            </div>
                        </div>
                        <!--end: Wizard Body-->
                    </div>
                    <!--end: Wizard-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    {{-- </div>
            </div>
        </div>
        <!--end::Card--
        <!--end::Example-->
    </div>
    <!--end::Row--> --}}

    <script type="text/javascript">
        $('#dangcau').on('change', function() {
            var dangcau = $('#dangcau').val();
            if (dangcau == 2) {
                $('#caughep2').removeClass('hide');
            } else {
                $('#caughep2').addClass('hide');
            }
        });

        $('#hoithoai2').on('change', function() {
            var hoithoai = $(this).val();
            $('#noidung2').remove();
            if (hoithoai == 0) {
                var html = '<div  id="noidung2">';
                html += '<label class="control-label">Nội dung<span class="require">*</span></label>';
                html +=
                    '<textarea name="noidung[]" id="noidungcau" rows="5" class="form-control"></textarea>';
                html += '</div>'


            } else {
                var html = '<div id="noidung2">'
                html += '<div class="row mt-2">'
                html += '<div class="col-md-6 mt-2">'

                html +=
                    '<label class="control-label">Hội thoại 1<span class="require">*</span></label>';
                html += '<input type="text" name="hoithoai1[]" class="form-control">';
                html += '</div>';
                html += '<div class="col-md-6 mt-2">'
                html +=
                    '<label class="control-label">Hội thoại 2<span class="require">*</span></label>';
                html += '<input type="text" name="hoithoai2[]" class="form-control">';
                html += '</div>';
                html += '<div class="col-md-6 mt-2">'
                html +=
                    '<label class="control-label">Hội thoại 3<span class="require">*</span></label>';
                html += '<input type="text" name="hoithoai3[]" class="form-control">';
                html += '</div>';
                html += '<div class="col-md-6 mt-2">'
                html +=
                    '<label class="control-label">Hội thoại 4<span class="require">*</span></label>';
                html += '<input type="text" name="hoithoai4[]" class="form-control">';
                html += '</div>';
                html += '</div>';
                html += '</div>';

            }
            $('#cauhoithoai2').append(html);
        });

        $('#loaidapan2').on('change', function() {
            var loaidapan = $(this).val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/CauHoi/LoaiDapAn',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    loaidapan: loaidapan,
                    caughep: 2
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#A2').remove();
                    $('#B2').remove();
                    $('#C2').remove();
                    $('#D2').remove();
                    $('#dapan2').append(data);
                },
                error: function(message) {
                    toastr.error(message, "Lỗi")
                }
            });
        })
    </script>





@stop
