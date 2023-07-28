<ul class="menu-nav">
    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
        <a href="{{'/TrangChu'}}" class="menu-link">
            <span class="menu-text">TRANG CHỦ</span>
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
                <a href="{{'/GiaoTrinh/ThongTin'}}" class="menu-link "><i class="icon-sm la la-angle-double-right"></i>&nbsp;
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
                <a href="javascript:;" class="menu-link menu-toggle"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                    <span class="menu-text">QUẢN LÝ BÀI HỌC</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                    <ul class="menu-subnav">
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{'/BaiHocChinh/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
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
                            <a href="{{'/TuVung/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                {{-- <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i> --}}
                                <span class="menu-text">TỪ VỰNG</span>
                            </a>
                        </li>
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{'/HinhAnh/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                {{-- <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i> --}}
                                <span class="menu-text">HÌNH ẢNH</span>
                            </a>
                        </li>
                        <li class="menu-item" aria-haspopup="true">
                            <a href="{{'/BaiTap/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
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
                <a href="{{'/GiaoTrinh/60-bai-eps-topik'}}" class="menu-link "><i class="icon-sm la la-angle-double-right"></i>&nbsp;
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
                <a href="{{'/960CauDocHieu'}}" class="menu-link "><i class="icon-sm la la-angle-double-right"></i>&nbsp;
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
                <a href="{{'/960CauNgheHieu'}}" class="menu-link "><i class="icon-sm la la-angle-double-right"></i>&nbsp;
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
                    
                    <a href="{{'/DeThi/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                        <span class="menu-text">QUẢN LÝ ĐỀ THI</span>
                        {{-- <span class="menu-desc"></span> --}}
                    </a>
                </li>
                @endif
                @if (chkPhanQuyen('cauhoi', 'phanquyen'))
                <li class="menu-item" aria-haspopup="true">
                    <a href="{{'/CauHoi/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                        <span class="menu-text">QUẢN LÝ CÂU HỎI</span>
                        {{-- <span class="menu-desc"></span> --}}
                    </a>
                </li>
                @endif
                @if (chkPhanQuyen('dethi', 'phanquyen'))
                <li class="menu-item" aria-haspopup="true">
                    <a href="{{'/PhongThi/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                        <span class="menu-text">QUẢN LÝ THI THỬ</span>
                        {{-- <span class="menu-desc"></span> --}}
                    </a>
                </li>
                @endif
                <li class="menu-item" aria-haspopup="true">
                    <a href="{{'/LuyenThi_EPS'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                        <span class="menu-text">LUYỆN THI EPS</span>
                        {{-- <span class="menu-desc"></span> --}}
                    </a>
                </li>
                @if (session('admin')?chkThiThu(session('admin')->manguoidung):'')
                <li class="menu-item" aria-haspopup="true">
                    <a href="{{'/ThiThu/EPS-TOPIK'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                        <span class="menu-text">THI THỬ EPS</span>
                        {{-- <span class="menu-desc"></span> --}}
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </li>
    <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="hover" aria-haspopup="true">
        <a href="javascript:;" class="menu-link menu-toggle">
            <span class="menu-text">HỒ SƠ&nbsp;<i class="icon-xl fas fa-caret-down"></i></span>
            {{-- <span class="menu-desc">Giáo viên & Học viên</span> --}}
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
            <ul class="menu-subnav">
                @if (chkPhanQuyen('thongtin', 'phanquyen'))
                <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                    <a href="{{'/QuanLyThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                        {{-- <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Box2.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000" />
                                    <path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span> --}}
                        <span class="menu-text">QUẢN LÝ THÔNG TIN</span>
                        {{-- <i class="menu-arrow"></i> --}}
                    </a>
                </li>
                @endif
                @if (chkPhanQuyen('giaovien', 'phanquyen'))
                <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                    <a href="{{'/GiaoVien/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                        {{-- <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Box2.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000" />
                                    <path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span> --}}
                        <span class="menu-text">QUẢN LÝ GIÁO VIÊN</span>
                        {{-- <i class="menu-arrow"></i> --}}
                    </a>
                </li>
                @endif
                @if (chkPhanQuyen('hocvien', 'phanquyen'))
                <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                    <a href="{{'/HocVien/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                        {{-- <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Box2.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000" />
                                    <path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span> --}}
                        <span class="menu-text">QUẢN LÝ HỌC VIÊN</span>
                        {{-- <i class="menu-arrow"></i> --}}
                    </a>
                </li>
                @endif

                @if (chkPhanQuyen('lophoc', 'phanquyen'))
                <li class="menu-item menu-item-submenu" data-menu-toggle="hover" aria-haspopup="true">
                    <a href="{{'/LopHoc/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                        {{-- <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Box2.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000" />
                                    <path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span> --}}
                        <span class="menu-text">QUẢN LÝ LỚP HỌC</span>
                        {{-- <i class="menu-arrow"></i> --}}
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
                    <a href="javascript:;" class="menu-link menu-toggle"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
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
                                <a href="{{'/LoaiCauHoi/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                    {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                    <span class="menu-text">Loại câu hỏi</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{'/DiaBan/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                    {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                    <span class="menu-text">Danh mục hành chính</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{'/TrinhDoGDPT/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                    {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                    <span class="menu-text">Trình độ GDPT</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{'/TrinhDoCMKT/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                    {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                    <span class="menu-text">Trình độ CMKT</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{'/DoiTuongUuTien/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                    {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                    <span class="menu-text">Đối tượng ưu tiên</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{'/NganhHoc/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                    {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                    <span class="menu-text">Ngành học</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{'/dmLopHoc/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                    {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                    <span class="menu-text">Lớp học</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="menu-subnav">
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{'/NguonCauHoi/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
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
                    <a href="javascript:;" class="menu-link menu-toggle"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                        {{-- <span class="svg-icon menu-icon">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Address-card.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span> --}}
                        <span class="menu-text">HỆ THỐNG CHUNG</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="menu-submenu menu-submenu-classic menu-submenu-right">
                        <ul class="menu-subnav">

                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{'/TaiKhoan/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                    {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                    <span class="menu-text">Tài khoản</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{'/Chuc_nang/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                    {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                    <span class="menu-text">Chức năng</span>
                                </a>
                            </li>
                            <li class="menu-item" aria-haspopup="true">
                                <a href="{{'/nhomchucnang/ThongTin'}}" class="menu-link"><i class="icon-sm la la-angle-double-right"></i>&nbsp;
                                    {{-- <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i> --}}
                                    <span class="menu-text">Nhóm tài khoản</span>
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