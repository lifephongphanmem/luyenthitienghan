<div class="flex-row-fluid ml-lg-8">
    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header py-3">
            <div class="card-title align-items-start flex-column">
                <h3 class="card-label font-weight-bolder text-dark">Đổi mật khẩu</h3>
                <span class="text-muted font-weight-bold font-size-sm mt-1">Cập nhật mật khẩu tài khoản</span>
            </div>
            <div class="card-toolbar">
               
                {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
            </div>
        </div>
        <!--end::Header-->

        {{-- @if(Session::has('admin') && !in_array(session('admin')->sadmin,['SSA','ADMIN']) && session('admin')->dnlandau == 0)
        <div class="alert alert-custom alert-outline-2x alert-outline-danger fade show mb-5" role="alert">
            <div class="alert-icon">
                <i class="flaticon-warning"></i>
            </div>
            <div class="alert-text">Đổi mật khẩu khi đăng nhập lần đầu !</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="ki ki-close"></i>
                    </span>
                </button>
            </div>
        </div>
        @endif --}}
        <!--begin::Form-->
        <form action="{{'/TaiKhoan/DoiMatKhau'}}" method="POST" class="form">
            @csrf
            <div class="card-body">
                {{-- <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">Current Password</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" class="form-control form-control-lg form-control-solid mb-2" value="" placeholder="Current password" />
                        <a href="#" class="text-sm font-weight-bold">Forgot password ?</a>
                    </div>
                </div> --}}
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">Mật khẩu mới</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" name="password" id="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" class="form-control form-control-lg form-control-solid" value="" placeholder="Mật khẩu mới" />
                        <span class="text-muted font-weight-bold font-size-sm mt-1">Mật khẩu ít nhất 8 ký tự, ít nhất 1 chữ cái và chữ số</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label text-alert">Nhập lại mật khẩu</label>
                    <div class="col-lg-9 col-xl-6">
                        <input type="password" name="cpass" id="cpass" onkeyup="checkpass()" class="form-control form-control-lg form-control-solid" value="" placeholder="Nhập lại mật khẩu"/>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                @if (chkPhanQuyen('quanlytaikhoan', 'thaydoi'))
                <button id="cpass_submit" type="submit"  class="btn btn-success mr-2" disabled>Cập nhật</button>
                @endif
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>