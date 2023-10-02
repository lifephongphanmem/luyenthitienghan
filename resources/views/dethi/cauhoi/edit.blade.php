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
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
        });

        $('#loaidapan').on('change', function() {
            var loaidapan = $(this).val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var edit=1;
            $.ajax({
                url: '/CauHoi/LoaiDapAn',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    loaidapan: loaidapan,
                    edit:edit
                },
                dataType: 'JSON',
                success: function(data) {
                    console.log(data);
                    $('#A').remove();
                    $('#B').remove();
                    $('#C').remove();
                    $('#D').remove();
                    $('#dapan').append(data);
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
                    <h5 class="text-dark font-weight-bold my-1 mr-5 text-uppercase">Cập nhật câu hỏi</h5>
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
                <a href="{{ '/CauHoi/ThongTin?madm=' . $model->loaicauhoi . '&dangcau=' . $model->dangcau . '&nguoncauhoi=' . $model->nguoncauhoi }}"
                    class="btn btn-light-primary font-weight-bolder btn-sm">Quay lại</a>
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
                            <div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3">
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
                                <form action="{{ '/CauHoi/update/' . $model->macauhoi }}" method="POST" class="form"
                                    id="kt_form" enctype="multipart/form-data">
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
                                                        <option value="{{ $ct->madm }}"
                                                            {{ $model->nguoncauhoi == $ct->madm ? 'selected' : '' }}>
                                                            {{ $ct->tendm }}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-6">
                                                <!--begin::Input-->
                                                <label class="control-label">Dạng câu hỏi<span
                                                        class="require">*</span></label>
                                                <select name="dangcau" class="form-control" id='dangcau'>
                                                    <option value="1"{{ $model->dangcau == 1 ? 'selected' : '' }}>Câu
                                                        đơn
                                                    </option>
                                                    <option value="2" {{ $model->dangcau == 2 ? 'selected' : '' }}>Câu
                                                        ghép</option>
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label class="control-label">Loại câu hỏi<span class="require">*</span></label>
                                            <select name="loaicauhoi" class="form-control" id='loaicauhoi'>
                                                @foreach ($loaicauhoi as $ct)
                                                    <option value="{{ $ct->madm }}"
                                                        {{ $model->loaicauhoi == $ct->madm ? 'selected' : '' }}>
                                                        {{ $ct->tendm }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div id='caudoc' style="width:100%">
                                                @if ($model->loaicauhoi == 1683685241)
                                                    <div id="xoadangcaunghe">
                                                        <label class="control-label">Dạng câu nghe hiểu<span
                                                                class="require">*</span></label>
                                                        <select name="loaicaunghe" class="form-control" id="loaicaunghe">
                                                            @foreach ($caunghe as $ct)
                                                                <option value="{{ $ct->madmct }}"
                                                                    {{ $model->loaicaunghe == $ct->madmct ? 'selected' : '' }}>
                                                                    {{ $ct->tendmct }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @else
                                                    <div id="xoadangcaudoc">
                                                        <label class="control-label">Dạng câu đọc hiểu<span
                                                                class="require">*</span></label>
                                                        <select name="dangcaudochieu" class="form-control" id="dangcaudoc">
                                                            @foreach ($caudoc as $ct)
                                                                <option value="{{ $ct->madmct }}"
                                                                    {{ $model->dangcaudochieu == $ct->madmct ? 'selected' : '' }}>
                                                                    {{ $ct->tendmct }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif

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
                                            <input type="text" name="cauhoi" value="{{ $model->cauhoi }}"
                                                class="form-control">
                                        </div>
                                        <!--end::Input-->
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label class="control-label">Câu hội thoại/không<span
                                                    class="require">*</span></label>
                                            <select name="hoithoai" class="form-control" id='hoithoai'>
                                                <option value="0" {{ $model->hoithoai == 1 ? 'selected' : '' }}>Không
                                                    hội
                                                    thoại</option>
                                                <option value="1" {{ $model->hoithoai == 2 ? 'selected' : '' }}>Câu
                                                    hội
                                                    thoại</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div id='cauhoithoai' style="width:100%">
                                                <div id="noidung">
                                                    <label class="control-label">Nội dung / Đoạn văn<span
                                                            class="require">*</span></label>
                                                    <textarea name="noidung" id="noidungcau" rows="5" class="form-control">{{ $model->noidung }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                        <div class="row">
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="control-label">Ảnh</label>
                                                    <input type="file" name="anh" class="form-control"
                                                        accept=".jpg,.png">
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="control-label">Audio</label>
                                                    <input type="file" name="audio" class="form-control"
                                                        accept=".mp3,.m4a">
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="control-label">Loại đáp án<span
                                                            class="require">*</span></label>
                                                    <select name="loaidapan" class="form-control " id="loaidapan">
                                                        <option value="1"
                                                            {{ $model->loaidapan == 1 ? 'selected' : '' }}>
                                                            Text</option>
                                                        <option value="2"
                                                            {{ $model->loaidapan == 2 ? 'selected' : '' }}>
                                                            Hình ảnh</option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-3">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label class="control-label">Đáp án đúng<span
                                                            class="require">*</span></label>
                                                    <select name="dapan" class="form-control">
                                                        <option value="A"
                                                            {{ $model->dapan == 'A' ? 'selected' : '' }}>1
                                                        </option>
                                                        <option value="B"
                                                            {{ $model->dapan == 'B' ? 'selected' : '' }}>2
                                                        </option>
                                                        <option value="C"
                                                            {{ $model->dapan == 'C' ? 'selected' : '' }}>3
                                                        </option>
                                                        <option value="D"
                                                            {{ $model->dapan == 'D' ? 'selected' : '' }}>4
                                                        </option>
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div>
                                        <div class="row" id='dapan'>
                                            @if ($model->loaidapan == 1)
                                                <div class="col-xl-3" id='A'>
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án 1<span
                                                                class="require">*</span></label>
                                                        <input type="text" name="A" value="{{ $model->A }}"
                                                            class="form-control">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-3" id='B'>
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án 2<span
                                                                class="require">*</span></label>
                                                        <input type="text" name="B" value="{{ $model->B }}"
                                                            class="form-control">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-3" id='C'>
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án 3<span
                                                                class="require">*</span></label>
                                                        <input type="text" name="C" value="{{ $model->C }}"
                                                            class="form-control">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-3" id='D'>
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án 4<span
                                                                class="require">*</span></label>
                                                        <input type="text" name="D" value="{{ $model->D }}"
                                                            class="form-control">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            @else
                                                <div class="col-xl-3" id='A'>
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án 1<span
                                                                class="require">*</span></label>
                                                        <input type="file" name="A" value="{{ $model->A }}"
                                                            class="form-control" accept=".jpg,.png">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-3" id='B'>
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án 2<span
                                                                class="require">*</span></label>
                                                        <input type="file" name="B" value="{{ $model->B }}"
                                                            class="form-control" accept=".jpg,.png">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-3" id='C'>
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án 3<span
                                                                class="require">*</span></label>
                                                        <input type="file" name="C" value="{{ $model->C }}"
                                                            class="form-control" accept=".jpg,.png">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-xl-3" id='D'>
                                                    <!--begin::Input-->
                                                    <div class="form-group">
                                                        <label class="control-label">Đáp án 4<span
                                                                class="require">*</span></label>
                                                        <input type="file" name="D" value="{{ $model->D }}"
                                                            class="form-control" accept=".jpg,.png">
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                            @endif

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







@stop
