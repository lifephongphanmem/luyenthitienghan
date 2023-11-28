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
                            <div class="thongtin thongtin3"> {{$phongthi??'THI THỬ EPS 2022'}} </div>
                            <div class="thongtin thongtin4"> 5.00.1.24 </div>
                            <div class="thongtin thongtin5"> {{session('admin')->tentaikhoan}}</div>
                        </div>
                    </div>
                    <div class="center2 thongtin_infoview">
                        <center>
                        </center>
                        <div class="center2"><a href="{{$url}}">
                                <img src="{{url('images/btn_confirm_on.jpg')}}" onmouseover="this.src='{{url('images/btn_confirm_on.jpg')}}';"
                                    onmouseout="this.src='{{url('images/btn_confirm_on.jpg')}}';" style="cursor:pointer;"></a>
                        </div>
                        <center>
                            <font color="blue"></font>Ấn nút F11 trên máy tính để thi chuẩn EPS-TOPIK 2020.
                        </center>
                    </div>
                    <center> <br>
                        <div class="vetrangchu"> <a href="{{ '/' }}"> &lt;&lt; Trở Về Trang Chủ &gt;&gt; </a>
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
