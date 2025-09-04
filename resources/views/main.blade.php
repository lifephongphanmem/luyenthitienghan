<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    {{-- <meta charset="utf-8" /> --}}
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    {{-- <title>Lifesc</title> --}}
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <!--begin::Fonts-->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" /> --}}
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{ url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ url('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->

    <link href="{{ url('assets/css/custom-style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/player.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/customer_main.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ url('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
    <link href="{{ url('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->
    @yield('custom-style')
    <link rel="shortcut icon" href="{{ url('assets/media/logos/ttdvvl.png') }}" />

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
    <div class="ajax-loader" style="display: none;"></div>
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile bg-primary header-mobile-fixed">
        <!--begin::Logo-->
        <a href="{{ '/' }}">
            <img alt="Logo" src="{{ url('assets/media/logos/ttdvvl.png') }}" class="max-h-30px" />
        </a>
        <!--end::Logo-->
        <div class="logo_slogan" style="padding-left:17px">
            <div class="text">
                <h3>SỞ NỘI VỤ QUẢNG TRỊ</h3>
                <h2>TRUNG TÂM DỊCH VỤ VIỆC LÀM QUẢNG TRỊ </h2>
            </div>
        </div>
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
                <span></span>
            </button>
            <button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </button>
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header flex-column header-fixed">
                    <!--begin::Top-->
                    <div class="header-top">
                        <!--begin::Container-->
                        <div class="container">
                            <div class="d-none d-lg-flex align-items-center mr-3">
                                <div class="logo_slogan">
                                    <a href="/">
                                        <img src="{{ url('assets/media/logos/ttdvvl.png') }}"
                                            alt="Trung tâm Dịch vụ việc làm Quảng Trị">
                                        <div class="text">
                                            <h3 class="text-left">SỞ NỘI VỤ QUẢNG TRỊ</h3>
                                            <h2>TRUNG TÂM DỊCH VỤ VIỆC LÀM QUẢNG TRỊ </h2>
                                        </div>
                                        <img src="{{ url('/images/main/anhbacgiap.png') }}">
                                    </a>
                                </div>
                            </div>
                            <div class="hotline_account d_flex d_flex_center">
                                <div class="d-none d-lg-flex align-items-center mr-3">
                                    <div class="hotline ">
                                        <a class="d_flex d_flex_center" href="tel:0232.6250999">
                                            <img src="{{ url('/images/main/hl.png') }}">
                                            <p><strong>Hotline:</strong><span>0232.6250999</span></p>
                                        </a>
                                    </div>
                                </div>
                                <div class="account topbar">
                                    @if (Session::has('admin'))
                                        {{-- <a class="d_flex d_flex_center" href="{{ '/DangNhap' }}">
                                        <img src="{{ url('/images/main/us.png') }}">
                                        <p><span>{{ session('admin') ? session('admin')->tentaikhoan : '' }}</span></p>
                                    </a> --}}
                                        <div class="topbar-item">
                                            <div class="btn btn-icon btn-hover-transparent-white w-auto d-flex align-items-center btn-lg px-2"
                                                id="kt_quick_user_toggle">
                                                <span class="symbol symbol-20">
                                                    <div class="symbol symbol-20 mr-3">
                                                        <img alt="Pic" src="{{ url('/images/main/us.png') }}" />
                                                    </div>
                                                </span>
                                                <div class="d-flex flex-column pr-3 text-left">
                                                    <span
                                                        class="text-white font-weight-bolder font-size-sm d-none d-md-inline">{{ session('admin') ? session('admin')->tentaikhoan : '' }}</span>
                                                </div>

                                            </div>
                                        </div>
                                    @else
                                        <a class="d_flex d_flex_center" href="{{ '/DangNhap' }}">
                                            {{-- <img src="{{ url('/images/main/us.png') }}"> --}}
                                            <span class="symbol symbol-35">
                                                <div class="symbol symbol-35 mr-3">
                                                    <i class="icon-xl fas fa-sign-in-alt text-white"></i>
                                                </div>
                                            </span>
                                            <p><span>Đăng nhập</span></p>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Top-->
                    <!--begin::Bottom-->
                    <div class="header-bottom">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Header Menu Wrapper-->
                            <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                                <!--begin::Header Menu-->
                                <div id="kt_header_menu"
                                    class="header-menu header-menu-left header-menu-mobile header-menu-layout-default">
                                    <!--begin::Header Nav-->
                                    @include('main_sub')
                                    <!--end::Header Nav-->
                                </div>
                                <!--end::Header Menu-->
                            </div>
                            <!--end::Header Menu Wrapper-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Bottom-->
                </div>
                <!--end::Header-->
                @yield('banner')
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid quanly" id="kt_content">
                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Dashboard-->
                            @yield('content')
                            @include('includes.modal')
                            <!--end::Dashboard-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted font-weight-bold mr-2">Copyright © 2013-2023</span>
                            <a href="https://phanmemcuocsong.com/" target="_blank"
                                class="text-dark-75 text-hover-primary">LifeSoft</a>
                            <span class="text-muted font-weight-bold mr-2">Tiện ích hơn - Hiệu quả hơn</span>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Nav-->
                        <div class="nav nav-dark order-1 order-md-2">
                            <a href="https://phanmemcuocsong.com/gioi-thieu/" target="_blank"
                                class="nav-link pl-0 pr-5">Về chúng tôi</a>
                            <a href="https://phanmemcuocsong.com/lien-he/" target="_blank"
                                class="nav-link pl-0 pr-0">Liên hệ</a>
                        </div>
                        <!--end::Nav-->
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
    </div>
    <!--end::Main-->
    <!-- begin::User Panel-->
    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
        <!--begin::Header-->
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
            <h3 class="font-weight-bold m-0">Thông tin người dùng
                <small class="text-muted font-size-sm ml-2"></small>
            </h3>
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="offcanvas-content pr-5 mr-n5">
            <!--begin::Header-->
            <div class="d-flex align-items-center mt-5">
                <div class="symbol symbol-100 mr-5">
                    <div class="symbol-label" style="background-image:url({{ '/assets/media/users/blank.png' }})">
                    </div>
                    <i class="symbol-badge bg-success"></i>
                </div>
                <div class="d-flex flex-column" style="width:100%">
                    <a href="#"
                        class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ session('admin') ? session('admin')->tentaikhoan : '' }}</a>
                    <div class="text-muted mt-1">{{ session('admin')->vitri ?? '' }}</div>
                    <div class="navi mt-2">
                        @if (chkPhanQuyen('quanlytaikhoan', 'phanquyen'))
                            <a href="{{ '/TaiKhoan/QuanLyTaiKhoan' }}" class="navi-item">
                                <span class="navi-link p-0 pb-2">
                                    <span class="navi-icon mr-1">
                                        <i class="icon-md fas fa-user-cog"></i>
                                    </span>
                                    <span class="navi-text text-muted text-hover-primary">Quản lý tài khoản</span>
                                </span>
                            </a>
                        @endif
                        <a href="{{ '/DangXuat' }}"
                            class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Đăng xuất</a>
                    </div>
                </div>
            </div>
            <!--end::Header-->


        </div>
        <!--end::Content-->
    </div>
    <!-- end::User Panel-->
    <!--begin::Quick Panel-->
    {{-- <div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
        <!--begin::Header-->
        <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
            <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10"
                role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_logs">Audit Logs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_notifications">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_settings">Settings</a>
                </li>
            </ul>
            <div class="offcanvas-close mt-n1 pr-5">
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary"
                    id="kt_quick_panel_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
        </div>
        <!--end::Header-->
    </div> --}}
    <!--end::Quick Panel-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop">
        <span class="svg-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10"
                        rx="1" />
                    <path
                        d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                        fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <!--end::Scrolltop-->
    @if (Session::has('success'))
        <script>
            toastr.success("{!! Session::get('success') !!}");
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            toastr.error("{!! Session::get('error') !!}");
        </script>
    @endif
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1200
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#0BB783",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#F3F6F9",
                        "dark": "#212121"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#D7F9EF",
                        "secondary": "#ECF0F3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#212121",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#ECF0F3",
                    "gray-300": "#E5EAEE",
                    "gray-400": "#D6D6E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#80808F",
                    "gray-700": "#464E5F",
                    "gray-800": "#1B283F",
                    "gray-900": "#212121"
                }
            },
            // "font-family": "Poppins"
            "font-family": "Open Sans"
        };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{ url('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ url('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ url('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ url('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ url('assets/js/pages/widgets.js') }}"></script>
    <script src="{{ url('assets/js/pages/main.js') }}"></script>
    {{-- <script src="{{ url('assets/js/pages/select2.js') }}"></script> --}}

    @yield('custom-script')
    <!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>
