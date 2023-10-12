<ul class="menu-nav">
    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
        <a href="{{ '/TrangChu' }}" class="menu-link">
           <span class="menu-text" style="text-transform: uppercase"> <i class="text-dark-50 fas fa-home" style="font-size: 1.35rem"></i>&nbsp;trang chủ</span>          
            {{-- <span class="menu-desc">Recent Updates &amp; Reports</span> --}}
            <i class="menu-arrow"></i>
        </a>

    </li>
    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="menu-text">GIÁO TRÌNH &nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
            {{-- <span class="menu-desc">EPS-TOPIK</span> --}}

        </a>
        </a>
        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
            <ul class="menu-subnav">
                @if (chkPhanQuyen('giaotrinhchitiet', 'phanquyen'))
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="{{ '/GiaoTrinh/ThongTin' }}" class="menu-link "><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            {{-- <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span> --}}
                            <span class="menu-text">GIÁO TRÌNH</span>
                            {{-- <i class="menu-arrow"></i> --}}
                        </a>
                    </li>
                @endif
                @if (chkPhanQuyen('baihoc', 'phanquyen'))
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="menu-link menu-toggle"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ BÀI HỌC</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/BaiHoc/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i> --}}
                                        <span class="menu-text">QUẢN LÝ BÀI HỌC</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/BaiHocChinh/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i> --}}
                                        <span class="menu-text">BÀI HỌC CHÍNH</span>
                                    </a>
                                </li>
                                {{-- <li class="menu-item" aria-haspopup="true">
                            <a href="{{'/TracNghiem/ThongTin'}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">TRẮC NGHIỆM</span>
                            </a>
                        </li> --}}
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/TuVung/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i> --}}
                                        <span class="menu-text">TỪ VỰNG</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/HinhAnh/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i> --}}
                                        <span class="menu-text">HÌNH ẢNH</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/BaiTap/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i> --}}
                                        <span class="menu-text">BÀI TẬP</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                    <a href="{{ '/GiaoTrinh/60-bai-eps-topik' }}" class="menu-link "><i
                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                        {{-- <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span> --}}
                        <span class="menu-text">60 BÀI EPS-TOPIK</span>
                        {{-- <i class="menu-arrow"></i> --}}
                    </a>
                </li>
                <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                    <a href="{{ '/960CauDocHieu' }}" class="menu-link "><i
                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                        {{-- <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span> --}}
                        <span class="menu-text">960 CÂU ĐỌC HIỂU</span>
                        {{-- <i class="menu-arrow"></i> --}}
                    </a>
                </li>
                <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                    <a href="{{ '/960CauNgheHieu' }}" class="menu-link "><i
                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                        {{-- <span class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span> --}}
                        <span class="menu-text">960 CÂU NGHE HIỂU</span>
                        {{-- <i class="menu-arrow"></i> --}}
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="menu-text">THI THỬ&nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
            {{-- <span class="menu-desc">Luyện thi</span> --}}
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu menu-submenu-classic menu-submenu-right">
            <ul class="menu-subnav">
                @if (chkPhanQuyen('dethi', 'phanquyen'))
                    <li class="menu-item" aria-haspopup="true">

                        <a href="{{ '/DeThi/ThongTin' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ ĐỀ THI</span>
                            {{-- <span class="menu-desc"></span> --}}
                        </a>
                    </li>
                @endif
                @if (chkPhanQuyen('cauhoi', 'phanquyen'))
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ '/CauHoi/ThongTin' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ CÂU HỎI</span>
                            {{-- <span class="menu-desc"></span> --}}
                        </a>
                    </li>
                @endif
                @if (chkPhanQuyen('phongthi', 'phanquyen'))
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ '/PhongThi/ThongTin' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ THI THỬ</span>
                            {{-- <span class="menu-desc"></span> --}}
                        </a>
                    </li>
                @endif
                <li class="menu-item" aria-haspopup="true">
                    <a href="{{ '/LuyenThi_EPS' }}" class="menu-link"><i
                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                        <span class="menu-text">LUYỆN THI EPS</span>
                        {{-- <span class="menu-desc"></span> --}}
                    </a>
                </li>
                @if (session('admin') ? chkThiThu(session('admin')->manguoidung) : '')
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ '/ThiThu/EPS-TOPIK' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">THI THỬ EPS</span>
                            {{-- <span class="menu-desc"></span> --}}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </li>
    @if (chkPhanQuyen('quanlyhoso', 'phanquyen'))
    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="menu-text">HỒ SƠ&nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
            {{-- <span class="menu-desc">Giáo viên & Học viên</span> --}}
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
            <ul class="menu-subnav">
                {{-- @if (chkPhanQuyen('thongtin', 'phanquyen'))
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="{{ '/QuanLyThongTin' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">THÔNG TIN NGƯỜI DÙNG</span>
                        </a>
                    </li>
                @endif --}}
                @if (chkPhanQuyen('giaovien', 'phanquyen'))
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="{{ '/GiaoVien/ThongTin' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ GIÁO VIÊN</span>
                            {{-- <i class="menu-arrow"></i> --}}
                        </a>
                    </li>
                @endif
                @if (chkPhanQuyen('hocvien', 'phanquyen'))
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="{{ '/HocVien/ThongTin' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ HỌC VIÊN</span>
                            {{-- <i class="menu-arrow"></i> --}}
                        </a>
                    </li>
                @endif

                @if (chkPhanQuyen('lophoc', 'phanquyen'))
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="{{ '/LopHoc/ThongTin' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ LỚP HỌC</span>
                            {{-- <i class="menu-arrow"></i> --}}
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </li>
    @endif

    @if (chkPhanQuyen('baocao', 'phanquyen'))
        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
            <a href="javascript:;" class="menu-link menu-toggle">
                <span class="menu-text">BÁO CÁO &nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
                {{-- <span class="menu-desc">EPS-TOPIK</span> --}}
            </a>
            @if (chkPhanQuyen('thongke', 'phanquyen'))
                <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                            <a href="javascript:;" class="menu-link menu-toggle"><i
                                    class="icon-sm la la-angle-double-right"></i>&nbsp;
                                <span class="menu-text">THỐNG KÊ</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                                <ul class="menu-subnav">
                                    <li class="menu-item" aria-haspopup="true">
                                        <a data-target="#modify-modal-danhsach" data-toggle="modal"
                                            class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                            <span class="menu-text">DANH SÁCH HỌC VIÊN</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            @endif
        </li>
    @endif

    @if (chkPhanQuyen('tracuu', 'phanquyen'))
        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
            <a href="{{ '/TraCuu' }}" class="menu-link">
                <span class="menu-text">TRA CỨU</span>
                {{-- <span class="menu-desc">Recent Updates &amp; Reports</span> --}}
                <i class="menu-arrow"></i>
            </a>
        </li>
    @endif

    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="menu-text">TIN TỨC&nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu menu-submenu-classic menu-submenu-right">
            <ul class="menu-subnav">
                <li class="menu-item" aria-haspopup="true">
                    <a href="{{ '/TinTuc/TrangChu' }}" class="menu-link"><i
                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                        <span class="menu-text">TIN TỨC</span>
                        {{-- <span class="menu-desc"></span> --}}
                    </a>
                </li>
                @if (chkPhanQuyen('tintuc', 'phanquyen'))
                    <li class="menu-item" aria-haspopup="true">
                        <a href="{{ '/TinTuc/QuanLy' }}" class="menu-link"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">QUẢN LÝ TIN TỨC</span>
                            {{-- <span class="menu-desc"></span> --}}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </li>

    @if (chkPhanQuyen('hethong', 'phanquyen'))
        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
            <a href="javascript:;" class="menu-link menu-toggle">
                <span class="menu-text">HỆ THỐNG&nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
                {{-- <span class="menu-desc">Quản trị hệ thống</span> --}}
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu menu-submenu-classic menu-submenu-left">
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="menu-link menu-toggle"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            {{-- <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Gift.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M4,6 L20,6 C20.5522847,6 21,6.44771525 21,7 L21,8 C21,8.55228475 20.5522847,9 20,9 L4,9 C3.44771525,9 3,8.55228475 3,8 L3,7 C3,6.44771525 3.44771525,6 4,6 Z M5,11 L10,11 C10.5522847,11 11,11.4477153 11,12 L11,19 C11,19.5522847 10.5522847,20 10,20 L5,20 C4.44771525,20 4,19.5522847 4,19 L4,12 C4,11.4477153 4.44771525,11 5,11 Z M14,11 L19,11 C19.5522847,11 20,11.4477153 20,12 L20,19 C20,19.5522847 19.5522847,20 19,20 L14,20 C13.4477153,20 13,19.5522847 13,19 L13,12 C13,11.4477153 13.4477153,11 14,11 Z" fill="#000000" />
                                    <path d="M14.4452998,2.16794971 C14.9048285,1.86159725 15.5256978,1.98577112 15.8320503,2.4452998 C16.1384028,2.90482849 16.0142289,3.52569784 15.5547002,3.83205029 L12,6.20185043 L8.4452998,3.83205029 C7.98577112,3.52569784 7.86159725,2.90482849 8.16794971,2.4452998 C8.47430216,1.98577112 9.09517151,1.86159725 9.5547002,2.16794971 L12,3.79814957 L14.4452998,2.16794971 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span> --}}
                            <span class="menu-text">DANH MỤC</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/LoaiCauHoi/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text">Loại câu hỏi</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/DiaBan/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text">Danh mục hành chính</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/TrinhDoGDPT/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text">Trình độ GDPT</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/TrinhDoCMKT/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text">Trình độ CMKT</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/DoiTuongUuTien/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text">Đối tượng ưu tiên</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/NganhHoc/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text">Ngành học</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/dmLopHoc/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text">Lớp học</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="menu-subnav">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/NguonCauHoi/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text">Nguồn câu hỏi</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="menu-link menu-toggle"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text">HỆ THỐNG CHUNG</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                            <ul class="menu-subnav">

                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/TaiKhoan/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text">Tài khoản</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/Chuc_nang/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text">Chức năng</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/nhomchucnang/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text">Nhóm tài khoản</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                        <a href="javascript:;" class="menu-link menu-toggle"><i
                                class="icon-sm la la-angle-double-right"></i>&nbsp;
                            <span class="menu-text text-uppercase">quản trị hệ thống</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                            <ul class="menu-subnav">

                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/LogHeThong/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text text-uppercase">Nhật ký sử dụng</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{ '/CauHinhHeThong/ThongTin' }}" class="menu-link"><i
                                            class="icon-sm la la-angle-double-right"></i>&nbsp;
                                        {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                        <span class="menu-text text-uppercase">Cấu hình hệ thống</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
    @endif
</ul>
