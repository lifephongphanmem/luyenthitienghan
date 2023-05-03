<html class="no-js" lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1">
    <title>Thi Thử EPS-Topik</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Play" />
    <link href="{{ url('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ url('css/customer-thithu.css') }}">
    <script src="{{ url('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ url('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ url('assets/js/scripts.bundle.js') }}"></script>
    {{-- <style type="text/css"
        data-fbcssmodules="css:fb.css.base css:fb.css.dialog css:fb.css.iframewidget css:fb.css.customer_chat_plugin_iframe">
        .fb_hidden {
            position: absolute;
            top: -10000px;
            z-index: 10001
        }

        .fb_reposition {
            overflow: hidden;
            position: relative
        }

        .fb_invisible {
            display: none
        }

        .fb_reset {
            background: none;
            border: 0;
            border-spacing: 0;
            color: #000;
            cursor: auto;
            direction: ltr;
            font-family: 'lucida grande', tahoma, verdana, arial, sans-serif;
            font-size: 11px;
            font-style: normal;
            font-variant: normal;
            font-weight: normal;
            letter-spacing: normal;
            line-height: 1;
            margin: 0;
            overflow: visible;
            padding: 0;
            text-align: left;
            text-decoration: none;
            text-indent: 0;
            text-shadow: none;
            text-transform: none;
            visibility: visible;
            white-space: normal;
            word-spacing: normal
        }

        .fb_reset>div {
            overflow: hidden
        }

        @keyframes fb_transform {
            from {
                opacity: 0;
                transform: scale(.95)
            }

            to {
                opacity: 1;
                transform: scale(1)
            }
        }

        .fb_animate {
            animation: fb_transform .3s forwards
        }

        .fb_hidden {
            position: absolute;
            top: -10000px;
            z-index: 10001
        }

        .fb_reposition {
            overflow: hidden;
            position: relative
        }

        .fb_invisible {
            display: none
        }

        .fb_reset {
            background: none;
            border: 0;
            border-spacing: 0;
            color: #000;
            cursor: auto;
            direction: ltr;
            font-family: 'lucida grande', tahoma, verdana, arial, sans-serif;
            font-size: 11px;
            font-style: normal;
            font-variant: normal;
            font-weight: normal;
            letter-spacing: normal;
            line-height: 1;
            margin: 0;
            overflow: visible;
            padding: 0;
            text-align: left;
            text-decoration: none;
            text-indent: 0;
            text-shadow: none;
            text-transform: none;
            visibility: visible;
            white-space: normal;
            word-spacing: normal
        }

        .fb_reset>div {
            overflow: hidden
        }

        @keyframes fb_transform {
            from {
                opacity: 0;
                transform: scale(.95)
            }

            to {
                opacity: 1;
                transform: scale(1)
            }
        }

        .fb_animate {
            animation: fb_transform .3s forwards
        }

        .fb_dialog {
            background: rgba(82, 82, 82, .7);
            position: absolute;
            top: -10000px;
            z-index: 10001
        }

        .fb_dialog_advanced {
            border-radius: 8px;
            padding: 10px
        }

        .fb_dialog_content {
            background: #fff;
            color: #373737
        }

        .fb_dialog_close_icon {
            background: url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;
            cursor: pointer;
            display: block;
            height: 15px;
            position: absolute;
            right: 18px;
            top: 17px;
            width: 15px
        }

        .fb_dialog_mobile .fb_dialog_close_icon {
            left: 5px;
            right: auto;
            top: 5px
        }

        .fb_dialog_padding {
            background-color: transparent;
            position: absolute;
            width: 1px;
            z-index: -1
        }

        .fb_dialog_close_icon:hover {
            background: url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent
        }

        .fb_dialog_close_icon:active {
            background: url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent
        }

        .fb_dialog_iframe {
            line-height: 0
        }

        .fb_dialog_content .dialog_title {
            background: #6d84b4;
            border: 1px solid #365899;
            color: #fff;
            font-size: 14px;
            font-weight: bold;
            margin: 0
        }

        .fb_dialog_content .dialog_title>span {
            background: url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yd/r/Cou7n-nqK52.gif) no-repeat 5px 50%;
            float: left;
            padding: 5px 0 7px 26px
        }

        body.fb_hidden {
            height: 100%;
            left: 0;
            margin: 0;
            overflow: visible;
            position: absolute;
            top: -10000px;
            transform: none;
            width: 100%
        }

        .fb_dialog.fb_dialog_mobile.loading {
            background: url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/ya/r/3rhSv5V8j3o.gif) white no-repeat 50% 50%;
            min-height: 100%;
            min-width: 100%;
            overflow: hidden;
            position: absolute;
            top: 0;
            z-index: 10001
        }

        .fb_dialog.fb_dialog_mobile.loading.centered {
            background: none;
            height: auto;
            min-height: initial;
            min-width: initial;
            width: auto
        }

        .fb_dialog.fb_dialog_mobile.loading.centered #fb_dialog_loader_spinner {
            width: 100%
        }

        .fb_dialog.fb_dialog_mobile.loading.centered .fb_dialog_content {
            background: none
        }

        .loading.centered #fb_dialog_loader_close {
            clear: both;
            color: #fff;
            display: block;
            font-size: 18px;
            padding-top: 20px
        }

        #fb-root #fb_dialog_ipad_overlay {
            background: rgba(0, 0, 0, .4);
            bottom: 0;
            left: 0;
            min-height: 100%;
            position: absolute;
            right: 0;
            top: 0;
            width: 100%;
            z-index: 10000
        }

        #fb-root #fb_dialog_ipad_overlay.hidden {
            display: none
        }

        .fb_dialog.fb_dialog_mobile.loading iframe {
            visibility: hidden
        }

        .fb_dialog_mobile .fb_dialog_iframe {
            position: sticky;
            top: 0
        }

        .fb_dialog_content .dialog_header {
            background: linear-gradient(from(#738aba), to(#2c4987));
            border-bottom: 1px solid;
            border-color: #043b87;
            box-shadow: white 0 1px 1px -1px inset;
            color: #fff;
            font: bold 14px Helvetica, sans-serif;
            text-overflow: ellipsis;
            text-shadow: rgba(0, 30, 84, .296875) 0 -1px 0;
            vertical-align: middle;
            white-space: nowrap
        }

        .fb_dialog_content .dialog_header table {
            height: 43px;
            width: 100%
        }

        .fb_dialog_content .dialog_header td.header_left {
            font-size: 12px;
            padding-left: 5px;
            vertical-align: middle;
            width: 60px
        }

        .fb_dialog_content .dialog_header td.header_right {
            font-size: 12px;
            padding-right: 5px;
            vertical-align: middle;
            width: 60px
        }

        .fb_dialog_content .touchable_button {
            background: linear-gradient(from(#4267B2), to(#2a4887));
            background-clip: padding-box;
            border: 1px solid #29487d;
            border-radius: 3px;
            display: inline-block;
            line-height: 18px;
            margin-top: 3px;
            max-width: 85px;
            padding: 4px 12px;
            position: relative
        }

        .fb_dialog_content .dialog_header .touchable_button input {
            background: none;
            border: none;
            color: #fff;
            font: bold 12px Helvetica, sans-serif;
            margin: 2px -12px;
            padding: 2px 6px 3px 6px;
            text-shadow: rgba(0, 30, 84, .296875) 0 -1px 0
        }

        .fb_dialog_content .dialog_header .header_center {
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            line-height: 18px;
            text-align: center;
            vertical-align: middle
        }

        .fb_dialog_content .dialog_content {
            background: url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/y9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;
            border: 1px solid #4a4a4a;
            border-bottom: 0;
            border-top: 0;
            height: 150px
        }

        .fb_dialog_content .dialog_footer {
            background: #f5f6f7;
            border: 1px solid #4a4a4a;
            border-top-color: #ccc;
            height: 40px
        }

        #fb_dialog_loader_close {
            float: left
        }

        .fb_dialog.fb_dialog_mobile .fb_dialog_close_icon {
            visibility: hidden
        }

        #fb_dialog_loader_spinner {
            animation: rotateSpinner 1.2s linear infinite;
            background-color: transparent;
            background-image: url(https://z-p3-static.xx.fbcdn.net/rsrc.php/v3/yD/r/t-wz8gw1xG1.png);
            background-position: 50% 50%;
            background-repeat: no-repeat;
            height: 24px;
            width: 24px
        }

        @keyframes rotateSpinner {
            0% {
                transform: rotate(0deg)
            }

            100% {
                transform: rotate(360deg)
            }
        }

        .fb_iframe_widget {
            display: inline-block;
            position: relative
        }

        .fb_iframe_widget span {
            display: inline-block;
            position: relative;
            text-align: justify
        }

        .fb_iframe_widget iframe {
            position: absolute
        }

        .fb_iframe_widget_fluid_desktop,
        .fb_iframe_widget_fluid_desktop span,
        .fb_iframe_widget_fluid_desktop iframe {
            max-width: 100%
        }

        .fb_iframe_widget_fluid_desktop iframe {
            min-width: 220px;
            position: relative
        }

        .fb_iframe_widget_lift {
            z-index: 1
        }

        .fb_iframe_widget_fluid {
            display: inline
        }

        .fb_iframe_widget_fluid span {
            width: 100%
        }

        .fb_mpn_mobile_landing_page_slide_out {
            animation-duration: 200ms;
            animation-name: fb_mpn_landing_page_slide_out;
            transition-timing-function: ease-in
        }

        .fb_mpn_mobile_landing_page_slide_out_from_left {
            animation-duration: 200ms;
            animation-name: fb_mpn_landing_page_slide_out_from_left;
            transition-timing-function: ease-in
        }

        .fb_mpn_mobile_landing_page_slide_up {
            animation-duration: 500ms;
            animation-name: fb_mpn_landing_page_slide_up;
            transition-timing-function: ease-in
        }

        .fb_mpn_mobile_bounce_in {
            animation-duration: 300ms;
            animation-name: fb_mpn_bounce_in;
            transition-timing-function: ease-in
        }

        .fb_mpn_mobile_bounce_out {
            animation-duration: 300ms;
            animation-name: fb_mpn_bounce_out;
            transition-timing-function: ease-in
        }

        .fb_mpn_mobile_bounce_out_v2 {
            animation-duration: 300ms;
            animation-name: fb_mpn_fade_out;
            transition-timing-function: ease-in
        }

        .fb_customer_chat_bounce_in_v2 {
            animation-duration: 300ms;
            animation-name: fb_bounce_in_v2;
            transition-timing-function: ease-in
        }

        .fb_customer_chat_bounce_in_from_left {
            animation-duration: 300ms;
            animation-name: fb_bounce_in_from_left;
            transition-timing-function: ease-in
        }

        .fb_customer_chat_bounce_out_v2 {
            animation-duration: 300ms;
            animation-name: fb_bounce_out_v2;
            transition-timing-function: ease-in
        }

        .fb_customer_chat_bounce_out_from_left {
            animation-duration: 300ms;
            animation-name: fb_bounce_out_from_left;
            transition-timing-function: ease-in
        }

        .fb_invisible_flow {
            display: inherit;
            height: 0;
            overflow-x: hidden;
            width: 0
        }

        @keyframes fb_mpn_landing_page_slide_out {
            0% {
                margin: 0 12px;
                width: 100% - 24px
            }

            60% {
                border-radius: 18px
            }

            100% {
                border-radius: 50%;
                margin: 0 24px;
                width: 60px
            }
        }

        @keyframes fb_mpn_landing_page_slide_out_from_left {
            0% {
                left: 12px;
                width: 100% - 24px
            }

            60% {
                border-radius: 18px
            }

            100% {
                border-radius: 50%;
                left: 12px;
                width: 60px
            }
        }

        @keyframes fb_mpn_landing_page_slide_up {
            0% {
                bottom: 0;
                opacity: 0
            }

            100% {
                bottom: 24px;
                opacity: 1
            }
        }

        @keyframes fb_mpn_bounce_in {
            0% {
                opacity: .5;
                top: 100%
            }

            100% {
                opacity: 1;
                top: 0
            }
        }

        @keyframes fb_mpn_fade_out {
            0% {
                bottom: 30px;
                opacity: 1
            }

            100% {
                bottom: 0;
                opacity: 0
            }
        }

        @keyframes fb_mpn_bounce_out {
            0% {
                opacity: 1;
                top: 0
            }

            100% {
                opacity: .5;
                top: 100%
            }
        }

        @keyframes fb_bounce_in_v2 {
            0% {
                opacity: 0;
                transform: scale(0, 0);
                transform-origin: bottom right
            }

            50% {
                transform: scale(1.03, 1.03);
                transform-origin: bottom right
            }

            100% {
                opacity: 1;
                transform: scale(1, 1);
                transform-origin: bottom right
            }
        }

        @keyframes fb_bounce_in_from_left {
            0% {
                opacity: 0;
                transform: scale(0, 0);
                transform-origin: bottom left
            }

            50% {
                transform: scale(1.03, 1.03);
                transform-origin: bottom left
            }

            100% {
                opacity: 1;
                transform: scale(1, 1);
                transform-origin: bottom left
            }
        }

        @keyframes fb_bounce_out_v2 {
            0% {
                opacity: 1;
                transform: scale(1, 1);
                transform-origin: bottom right
            }

            100% {
                opacity: 0;
                transform: scale(0, 0);
                transform-origin: bottom right
            }
        }

        @keyframes fb_bounce_out_from_left {
            0% {
                opacity: 1;
                transform: scale(1, 1);
                transform-origin: bottom left
            }

            100% {
                opacity: 0;
                transform: scale(0, 0);
                transform-origin: bottom left
            }
        }

        @keyframes slideInFromBottom {
            0% {
                opacity: .1;
                transform: translateY(100%)
            }

            100% {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes slideInFromBottomDelay {
            0% {
                opacity: 0;
                transform: translateY(100%)
            }

            97% {
                opacity: 0;
                transform: translateY(100%)
            }

            100% {
                opacity: 1;
                transform: translateY(0)
            }
        }
    </style> --}}
</head>

<body>
    <div class="ajax-loader"></div>
    <div class="right">
        <div class="bg_gradient wrapper">

            <div id="fb-root" class=" fb_reset">
                <div style="position: absolute; top: -10000px; width: 0px; height: 0px;">
                    <div></div>
                </div>
            </div>
            <div class="box_dark thi-tracnghiem">
                <div id="containerWrap" style="background: rgb(255, 255, 255);height: 100vh;">
                    <div id="headerWrap">
                        <div class="bg_l"><img src="{{ url('images/bg_left.gif') }}"></div>
                        <div class="bg_r"><img src="{{ url('images/bg_right.gif') }}"></div>
                        <div class="title">Test of proficiency in Korean 2020-2021</div>
                        <div class="logo"><img src="{{ url('images/logo-thithu.png') }}"></div>
                        <div class="ver" style="float: left;">Version: 5.00.1.24 </div>

                        <div class="info">
                            <span class="appno">5.00.1.24</span>
                        </div>

                        <div class="control">

                        </div>

                    </div>

                    <div class="center1 bg-thongtin-thi">
                        <div class="thongtin_de">
                            <div class="thongtinmade"> 218 </div>
                        </div>
                        <div class="thongtin_avatar">
                            <img class="avatar-img" src="{{url('images/no-avatar-chat.png')}}">
                        </div>
                        <div class="thongtin_thi">
                            <div class="thongtin thongtin1"> 218 </div>
                            <div class="thongtin thongtin2"> <span>THI THỬ EPS </span></div>
                            <div class="thongtin thongtin3"> THI THỬ EPS 2022 </div>
                            <div class="thongtin thongtin4"> 5.00.1.24 </div>
                            <div class="thongtin thongtin5"> {{session('admin')->tentaikhoan}}</div>
                        </div>
                    </div>
                    <div class="center2 thongtin_infoview">
                        <center>
                        </center>
                        <div class="center2"><a href="{{ '/ThiThu/LamBai' }}">
                                <img src="{{url('images/btn_confirm_on.jpg')}}" onmouseover="this.src='{{url('images/btn_confirm_on.jpg')}}';"
                                    onmouseout="this.src='{{url('images/btn_confirm_on.jpg')}}';" style="cursor:pointer;"></a>
                        </div>
                        <center>
                            <font color="blue"></font>Ấn nút F11 trên máy tính để thi chuẩn EPS-TOPIK 2020.
                        </center>
                    </div>
                    <center> <br>
                        <div class="vetrangchu"> <a href="{{ '/dashboard' }}"> &lt;&lt; Trở Về Trang Chủ &gt;&gt; </a>
                        </div>
                    </center>
                </div>
                <div id="footerWrap"></div>

            </div>

            <div style="clear: both"></div>
        </div> <span style="display:none"> Designed by LTEPS </span>
    </div>

    <!-- Google tag (gtag.js) -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=G-2BYRQ6FK8F"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-2BYRQ6FK8F');
    </script>

</body>

</html>
