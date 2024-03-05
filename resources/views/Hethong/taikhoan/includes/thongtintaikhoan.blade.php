<!--begin::Card-->
<div class="card card-custom">
    <!--begin::Header-->
    <div class="card-header py-3">
        <div class="card-title align-items-start flex-column">
            <h3 class="card-label font-weight-bolder text-dark">Thông tin cá nhân</h3>
            <span class="text-muted font-weight-bold font-size-sm mt-1">Cập nhật thông tin cá nhân</span>
        </div>
        <div class="card-toolbar">
            {{-- <button type="reset" class="btn btn-success mr-2">Cập nhật</button> --}}
            {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Form-->
    <form class="form" action="{{'/TaiKhoan/CapNhatThongTin'}}" method="POST">
        @csrf
        <div class="card-body">
            <!--begin::Heading-->
            <!--begin::Form Group-->
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Họ và tên</label>
                <div class="col-lg-9 col-xl-6">
                    {{-- <div class="spinner spinner-sm spinner-success spinner-right"> --}}
                    <input class="form-control form-control-lg form-control-solid" type="text" name="hoten"
                        value="{{ $model->tentaikhoan }}" placeholder="Họ và tên" />
                    {{-- </div> --}}
                </div>
            </div>
            <!--begin::Form Group-->
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Email</label>
                <div class="col-lg-9 col-xl-6">
                    <div class="input-group input-group-lg input-group-solid">
                        <input type="text" name="email" class="form-control form-control-lg form-control-solid"
                            value="{{ $model->email }}" placeholder="Email" />
                    </div>
                </div>
            </div>
            <!--begin::Form Group-->
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Điện thoại</label>
                <div class="col-lg-9 col-xl-6">
                    <div class="input-group input-group-lg input-group-solid">
                        <input type="text" name="sdt" class="form-control form-control-lg form-control-solid"
                            value="{{ $model->sodienthoai }}" placeholder="Điện thoại" />
                    </div>
                </div>
            </div>
            <!--begin::Form Group-->
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Giới tính</label>
                <div class="col-lg-9 col-xl-6">
                    <select class="form-control form-control-lg form-control-solid" name="gioitinh">
                        <option>Chọn giới tính...</option>
                        <option value="1" {{ $model->gioitinh == 1?"selected":'' }}>Nam</option>
                        <option value="0" {{ $model->gioitinh == 0?"selected":'' }}>Nữ</option>

                    </select>
                </div>
            </div>
            <!--begin::Form Group-->
            <!--begin::Form Group-->
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Ngày sinh</label>
                <div class="col-lg-9 col-xl-6">
                    <div class="input-group input-group-lg input-group-solid">
                        <input type="date" name="ngaysinh" class="form-control form-control-lg form-control-solid"
                            value="{{ $model->ngaysinh }}" placeholder="Ngày sinh" />
                    </div>
                </div>
            </div>
            <!--begin::Form Group-->
            <div class="form-group row">
                <label class="col-xl-3 col-lg-3 col-form-label">Địa chỉ</label>
                <div class="col-lg-9 col-xl-6">
                    <div class="input-group input-group-lg input-group-solid">
                        <input type="text" name="diachi" class="form-control form-control-lg form-control-solid"
                            value="{{ $model->diachi }}" placeholder="Địa chỉ" />
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer text-center">
            @if (chkPhanQuyen('quanlytaikhoan', 'thaydoi'))
            <button type="submit"  class="btn btn-success mr-2">Cập nhật</button>
            @endif
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::Card-->
