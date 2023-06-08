<html  lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1">
    <title>Làm Bài Thi Thử EPS-Topik</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <base href="{{ url('') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index">
    <meta name="googlebot" content="index">
    <meta itemprop="name" content="Làm Bài Thi Thử EPS-Topik">
    <meta itemprop="description" content="">
    <meta property="og:title" content="Làm Bài Thi Thử EPS-Topik">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:type" content="website">
    <meta property="og:description" content="">
    <meta property="og:site_name" content="Luyện Thi EPS">
    <meta name="twitter:title" content="Làm Bài Thi Thử EPS-Topik">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Play" />
    <link href="{{ url('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="{{ url('css/customer-thithu.css') }}"> --}}
    <script src="{{ url('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/global/plugins/jquery-migrate.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ url('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ url('assets/js/scripts.bundle.js') }}"></script>
    <link rel="stylesheet" href="{{ url('css/style_lambai.css') }}">
</head>

<body>
    <div class="ajax-loader"></div>
    <div class="right">
        <div class="bg_gradient wrapper">

            <div class="box_dark thi-tracnghiem">
                <div id="containerWrap">
                    <div id="headerWrap">
                        <div class="bg_l"><img src="{{ url('images/bg_left.gif') }}"></div>
                        <div class="bg_r"><img src="{{ url('images/bg_right.gif') }}"></div>
                        <div class="title"
                            style="padding-left: inherit;text-align: center;font-size: 20px; font-weight: 600;">Test of
                            proficiency in Korean</div>
                        <div class="logo"><img src="{{ url('images/logo-thithu.png') }}"></div>
                        <div class="ver">
                            <center><b style="font-size: 18px;">Manufacturing</b></center>
                        </div>

                        <div class="control">
                            <a style="width: 0;  float: inherit;  padding: 0;  margin-left: 0;  margin-right: 0;  margin-top: 0;  background: none;  min-height: 0;"
                                class="list-tracnghiem plus"><img src="{{ url('images/btn_txtsize_plus.png') }}"
                                    onmouseover="this.src='{{ url('images/btn_txtsize_plus_on.png') }}';"
                                    onmouseout="this.src='{{ url('images/btn_txtsize_plus.png') }}';"
                                    style="cursor:pointer;"></a>&nbsp;
                            <a style="width: 0;  float: inherit;  padding: 0;  margin-left: 0;  margin-right: 0;  margin-top: 0;  background: none;  min-height: 0;"
                                class="list-tracnghiem minus"><img src="{{ url('images/btn_txtsize_minus.png') }}"
                                    onmouseover="this.src='{{ url('images/btn_txtsize_minus_on.png') }}';"
                                    onmouseout="this.src='{{ url('images/btn_txtsize_minus.png') }}';"
                                    style="cursor:pointer;"></a>&nbsp;&nbsp;
                        </div>

                    </div>
                    <div id="contentWrap" style="background: #d7e4f2;margin: 0px;">
                        <div>
                            {{-- <marquee width="100%" bgcolor="pink" onmouseover="this.stop();"
                                onmouseout="this.start();">Để được đăng ký sử dụng phần mềm có nội dung đề sưu tầm thi
                                thật vui lòng liên hệ số ĐT: 024 6287 6287.</marquee> --}}
                        </div>
                        <div class="list-tracnghiem diemthi-tracnghiem" style="background-color: white;display:none;">
                        </div>
                        <div>
                            <div id="question-panel"
                                style="-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"
                                class="bailam-tracnghiem list-tracnghiem">
                                <div class="bailam-tracnghiem-center">
                                    <input type="hidden" name="madethi" id="madethi" value="{{$made}}">
                                    <input type="hidden" name="timestart" id="timestart" value="{{$timestart}}">
                                    <input type="hidden" name="malop" id="malop" value="{{$malop}}">
                                    <input type="hidden" name="maphongthi" id="maphongthi" value="{{$maphongthi}}">
                                    @foreach ($m_cauhoi as $k => $ct)
                                        @if ($ct->loaicauhoi == 1683685323)
                                            <div id="question" class="question thi-thu entry-tracnghiem cauhoi-{{++$k}} @if($k == 1) active @endif"
                                                data-id="{{$k}}" data-code="{{$ct->macauhoi}}:F">
                                                <div class="cauhoitracnghiem">
                                                    <p style="font-size: 10px;">[MA-{{ $ct->macauhoi }}]</p>
                                                    <div class="noidung-cauhoi">
                                                        <font class="cauhoi-stt">{{ $k }}. </font>
                                                        <strong>{{ $ct->cauhoi }}</strong>
                                                        <p style="display: block;"></p>
                                                        @if (isset($ct->anh))
                                                            <img src="{{ url($ct->anh) }}">
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="quiz-list" style="margin-left: 10%;">
                                                    <div class="qselect cot2" id="{{$ct->macauhoi}}_A" data-id="{{$k}}"
                                                        data-traloi="{{$ct->macauhoi}}:A">
                                                        <div class="mark">1</div>
                                                        <div class="qsign">{{ $ct->A }}</div>
                                                    </div>
                                                    <div class="qselect cot2" id="{{$ct->macauhoi}}_B" data-id="{{$k}}"
                                                        data-traloi="{{$ct->macauhoi}}:B">
                                                        <div class="mark">2</div>
                                                        <div class="qsign"> {{ $ct->B }}</div>
                                                    </div>
                                                    <div class="qselect cot2" id="{{$ct->macauhoi}}_C" data-id="{{$k}}"
                                                        data-traloi="{{$ct->macauhoi}}:C">
                                                        <div class="mark">3</div>
                                                        <div class="qsign"> {{ $ct->C }}</div>
                                                    </div>
                                                    <div class="qselect cot2" id="{{$ct->macauhoi}}_D" data-id="{{$k}}"
                                                        data-traloi="{{$ct->macauhoi}}:D">
                                                        <div class="mark">4</div>
                                                        <div class="qsign">{{ $ct->D }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div id="question" class="question thi-thu entry-tracnghiem cauhoi-{{++$k}}"
                                                data-id="{{$k}}" data-code="{{$ct->macauhoi}}:F">
                                                <div class="cauhoitracnghiem"> <b>Câu: {{$k }}.
                                                        [MA-{{ $ct->macauhoi }}]</b> <audio controls="controls"
                                                        src="{{ url($ct->audio) }}"></audio><strong>{{ $ct->cauhoi }}</strong>
                                                    <p style="display: block;"></p>
                                                    @if (isset($ct->anh))
                                                        <img src="{{ $ct->anh }}">
                                                    @endif
                                                </div>
                                                <div class="quiz-list">
                                                    <div class="qselect cot4" id="{{$ct->macauhoi}}_A" data-id="{{$k}}"
                                                        data-traloi="{{$ct->macauhoi}}:A">
                                                        <div class="mark">1</div>
                                                        <div class="qsign">
                                                            @if ($ct->loaidapan == 1)
                                                                {{ $ct->A }}
                                                            @else
                                                                <img src="{{ url($ct->A) }}" width="120"
                                                                    height="120">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="qselect cot4" id="{{$ct->macauhoi}}_B" data-id="{{$k}}"
                                                        data-traloi="{{$ct->macauhoi}}:B">
                                                        <div class="mark">2</div>
                                                        <div class="qsign">
                                                            @if ($ct->loaidapan == 1)
                                                                {{ $ct->B }}
                                                            @else
                                                                <img src="{{ url($ct->B) }}" width="120"
                                                                    height="120">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="qselect cot4" id="{{$ct->macauhoi}}_C" data-id="{{$k}}"
                                                        data-traloi="{{$ct->macauhoi}}:C">
                                                        <div class="mark">3</div>
                                                        <div class="qsign">
                                                            @if ($ct->loaidapan == 1)
                                                                {{ $ct->C }}
                                                            @else
                                                                <img src="{{ url($ct->C) }}" width="120"
                                                                    height="120">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="qselect cot4" id="{{$ct->macauhoi}}_D" data-id="{{$k}}"
                                                        data-traloi="{{$ct->macauhoi}}:D">
                                                        <div class="mark">4</div>
                                                        <div class="qsign">
                                                            @if ($ct->loaidapan == 1)
                                                                {{ $ct->D }}
                                                            @else
                                                                <img src="{{ url($ct->D) }}" width="120"
                                                                    height="120">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="pagination">

                            <div class="content-pagination">
                                <div class="button view-mobile" id="examNextPreviousMB">
                                    <a class="cautruoc"><img src="{{ url('images/btn_prev.png') }}"
                                            onmouseover="this.src='{{ url('images/btn_prev_on.png') }}';"
                                            onmouseout="this.src='images/btn_prev.png';" style="cursor:pointer;"></a>
                                    <a class="causau"><img src="{{ url('images/btn_next.png') }}"
                                            onmouseover="this.src='images/btn_next_on.png';"
                                            onmouseout="this.src='images/btn_next.png';" style="cursor:pointer;"></a>
                                </div>
                                <div class="answer">
                                    <a class="nopbai">
                                        <img id="anwer_img" src="{{ url('images/btn_answer.png') }}"
                                            onmouseover="this.src='{{ url('images/btn_answer_on.png') }}';"
                                            onmouseout="this.src='{{ url('images/btn_answer.png') }}';"
                                            style="cursor:pointer;">
                                    </a>
                                </div>
                                <div class="time">
                                    <span class="test" id="show_thoigian1">25:00</span>
                                    <span class="remain" id="show_thoigian2">25:00</span>
                                </div>
                                <div class="stt-cauhoi">
                                    <div class="ds-cauhoi cauhoi-doc">
                                        <div class="td-ch cauhoi cau1" data-id="1"> 1 </div>
                                        <div class="td-ch traloi trloi1"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau2" data-id="2"> 2 </div>
                                        <div class="td-ch traloi trloi2"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau3" data-id="3"> 3 </div>
                                        <div class="td-ch traloi trloi3"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau4" data-id="4"> 4 </div>
                                        <div class="td-ch traloi trloi4"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau5" data-id="5"> 5 </div>
                                        <div class="td-ch traloi trloi5"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau6" data-id="6"> 6 </div>
                                        <div class="td-ch traloi trloi6"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau7" data-id="7"> 7 </div>
                                        <div class="td-ch traloi trloi7"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau8" data-id="8"> 8 </div>
                                        <div class="td-ch traloi trloi8"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau9" data-id="9"> 9 </div>
                                        <div class="td-ch traloi trloi9"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau10" data-id="10"> 10 </div>
                                        <div class="td-ch traloi trloi10"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau11" data-id="11"> 11 </div>
                                        <div class="td-ch traloi trloi11"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau12" data-id="12"> 12 </div>
                                        <div class="td-ch traloi trloi12"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau13" data-id="13"> 13 </div>
                                        <div class="td-ch traloi trloi13"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau14" data-id="14"> 14 </div>
                                        <div class="td-ch traloi trloi14"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau15" data-id="15"> 15 </div>
                                        <div class="td-ch traloi trloi15"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau16" data-id="16"> 16 </div>
                                        <div class="td-ch traloi trloi16"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau17" data-id="17"> 17 </div>
                                        <div class="td-ch traloi trloi17"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau18" data-id="18"> 18 </div>
                                        <div class="td-ch traloi trloi18"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau19" data-id="19"> 19 </div>
                                        <div class="td-ch traloi trloi19"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau20" data-id="20"> 20 </div>
                                        <div class="td-ch traloi trloi20"> &nbsp;&nbsp; </div>
                                    </div>
                                    <div class="ds-cauhoi cauhoi-nghe">
                                        <div class="td-ch cauhoi cau21" data-id="21"> 21 </div>
                                        <div class="td-ch traloi trloi21"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau22" data-id="22"> 22 </div>
                                        <div class="td-ch traloi trloi22"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau23" data-id="23"> 23 </div>
                                        <div class="td-ch traloi trloi23"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau24" data-id="24"> 24 </div>
                                        <div class="td-ch traloi trloi24"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau25" data-id="25"> 25 </div>
                                        <div class="td-ch traloi trloi25"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau26" data-id="26"> 26 </div>
                                        <div class="td-ch traloi trloi26"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau27" data-id="27"> 27 </div>
                                        <div class="td-ch traloi trloi27"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau28" data-id="28"> 28 </div>
                                        <div class="td-ch traloi trloi28"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau29" data-id="29"> 29 </div>
                                        <div class="td-ch traloi trloi29"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau30" data-id="30"> 30 </div>
                                        <div class="td-ch traloi trloi30"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau31" data-id="31"> 31 </div>
                                        <div class="td-ch traloi trloi31"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau32" data-id="32"> 32 </div>
                                        <div class="td-ch traloi trloi32"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau33" data-id="33"> 33 </div>
                                        <div class="td-ch traloi trloi33"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau34" data-id="34"> 34 </div>
                                        <div class="td-ch traloi trloi34"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau35" data-id="35"> 35 </div>
                                        <div class="td-ch traloi trloi35"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau36" data-id="36"> 36 </div>
                                        <div class="td-ch traloi trloi36"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau37" data-id="37"> 37 </div>
                                        <div class="td-ch traloi trloi37"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau38" data-id="38"> 38 </div>
                                        <div class="td-ch traloi trloi38"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau39" data-id="39"> 39 </div>
                                        <div class="td-ch traloi trloi39"> &nbsp;&nbsp; </div>
                                        <div class="td-ch cauhoi cau40" data-id="40"> 40 </div>
                                        <div class="td-ch traloi trloi40"> &nbsp;&nbsp; </div>
                                    </div>
                                    <span class="tongcauhoi" data-id="40"> </span>
                                </div>
                                <div class="button" id="examNextPrevious">
                                    <a class="cautruoc"><img src="{{ url('images/btn_prev.png') }}"
                                            onmouseover="this.src='{{ url('images/btn_prev_on.png') }}';"
                                            onmouseout="this.src='{{ url('images/btn_prev.png') }}';"
                                            style="cursor:pointer;"></a>
                                    <a class="causau"><img src="{{ url('images/btn_next.png') }}"
                                            onmouseover="this.src='{{ url('images/btn_next_on.png') }}';"
                                            onmouseout="this.src='{{ url('images/btn_next.png') }}';"
                                            style="cursor:pointer;"></a>
                                </div>
                            </div>
                            <p style="clear: both;"></p>
                            <center>
                            </center>
                        </div>
                    </div>
                    <div id="footerWrap"></div>

                </div>

                <div style="clear: both"></div>
            </div>

            <style>
                .giuseart-nav {
                    box-shadow: none;
                    left: 90%;
                    transform: translate(-50%, 0);
                    background: url(images/player.gif) no-repeat;
                    background-size: contain;
                    width: 160px;
                    height: 160px;
                    line-height: 50px;
                    position: fixed;
                    bottom: 30px;
                    z-index: 999;
                    padding: 5px;
                    margin: 0;
                }
            </style>

            <script>
                const soundEffect = new Audio();
                var danopbai = 0;
                var online = 1;
                var tong_nghe = 20;
                var thoigian_tongnghe = 25;
                var thoigian_caunghe = Math.floor((thoigian_tongnghe * 60) / tong_nghe);
                var cau_batdaunghe = 0;
                var amthanh_lan1 = 0;
                var amthanh_lan2 = 0;
                var danop = 0;
                var giay = 0;
                var phut = 0;
                var listening = 0;
                var thoigian = 1500;
                var dodai_amthanh = 0;
                var thoigianmoicau = 0;
                var tong_doc = 20;
                var thoigian_tb = 0;
                var dodai_audio = 0;
                var amthanh_lan1 = 0;
                var amthanh_lan2 = 0;

                function timecount() {
                    if (danop == 0) {
                        if (thoigian > 0) {
                            if (listening == 1) {
                                if (dodai_amthanh == 0) {
                                    for (var ng = 1; ng <= tong_nghe; ng++) {
                                        idcaunghe = ng + tong_doc;
                                        if ($('.entry-tracnghiem.cauhoi-' + idcaunghe + ' audio')[0].duration > 0)
                                            dodai_amthanh += ($('.entry-tracnghiem.cauhoi-' + idcaunghe + ' audio')[0].duration *
                                                2) + 3;
                                        else dodai_amthanh += 13;
                                    }
                                    thoigian_tb = Math.ceil(((thoigian_tongnghe * 60) - dodai_amthanh) / tong_nghe);
                                    if (thoigian_tb < 5) {
                                        Swal.fire({
                                            type: 'error',
                                            title: 'Đề thi gặp lỗi độ dài các file âm thanh vượt giới hạn cho phép. Vui lòng báo cho Quản trị hệ thống giúp. Cám ơn !',
                                            showConfirmButton: false,
                                            timer: 120000
                                        })
                                    }
                                }
                                var sosanh = Math.ceil(thoigian_tongnghe * 60 - thoigianmoicau);
                                if (thoigian == sosanh) {
                                    cau_batdaunghe++;
                                    idcau = cau_batdaunghe + tong_doc;
                                    if (idcau <= (tong_nghe + tong_doc)) {
                                        $('.entry-tracnghiem').removeClass("active");
                                        $('.entry-tracnghiem.cauhoi-' + idcau).addClass('active');
                                        amthanh_lan1 = thoigian - 1;
                                        dodai_audio = $('.entry-tracnghiem.cauhoi-' + idcau + ' audio')[0].duration;
                                        if (dodai_audio > 0)
                                            amthanh_lan2 = Math.ceil(thoigian - (dodai_audio + 3));
                                        else {
                                            var macauhoiloi = $('.entry-tracnghiem.cauhoi-' + idcau).data("code");
                                            amthanh_lan2 = Math.ceil(thoigian - 8);
                                            dodai_audio = 5;
                                            Swal.fire({
                                                type: 'error',
                                                title: 'Câu hỏi này âm thanh lỗi, vui lòng chụp ảnh Báo Mã [MA-XXXX] cho Quản trị hệ thống giúp. Cám ơn !',
                                                showConfirmButton: false,
                                                timer: 120000
                                            })
                                        }
                                        thoigianmoicau += Math.floor((dodai_audio * 2) + 3 + thoigian_tb);
                                    }
                                }
                                if (idcau <= (tong_nghe + tong_doc)) {
                                    if (thoigian == amthanh_lan1 && idcau < (tong_nghe + tong_doc)) {
                                        soundEffect.src = $('.entry-tracnghiem.cauhoi-' + idcau + ' audio').attr('src');
                                        soundEffect.play();
                                    } else if (thoigian == amthanh_lan2) {
                                        soundEffect.src = $('.entry-tracnghiem.cauhoi-' + idcau + ' audio').attr('src');
                                        soundEffect.play();
                                    }
                                }
                            }
                            phut = Math.floor(thoigian / 60);
                            giay = thoigian - phut * 60;
                            if (phut < 10)
                                phut = "0" + phut;
                            if (giay < 10)
                                giay = "0" + giay;
                            if (listening == 0)
                                $('#show_thoigian1').text(phut + ":" + giay);
                            else $('#show_thoigian2').text(phut + ":" + giay);
                            thoigian--;
                            setTimeout("timecount()", 1000);
                        } else {
                            if (listening == 0) {
                                $('#show_thoigian1').text("00:00");
                                $('#examNextPrevious').html('');
                                $('#examNextPreviousMB').html('');
                                $(".box_dark.thi-tracnghiem .ds-cauhoi .td-ch.cauhoi").css("cursor", "no-drop");
                                listening = 1;
                                thoigian = 1500;
                                setTimeout("timecount()", 1000);
                            } else {
                                $('#show_thoigian2').text("00:00");
                                nopbai();
                            }

                        }
                    }
                }

                function checkLog() {
                    queryString = '';
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    jQuery.ajax({
                        url: "/ThiThu/checklog",
                        data: {
                            queryString: queryString,
                            _token: CSRF_TOKEN,
                        },
                        type: "POST",
                        success: function(data) {
                            if (data == 'online')
                                online = 1;
                            else online = 0;
                        }
                    });
                }

                function nopbai() {
                    soundEffect.pause();
                    tong_tatcacauhoi = 40;
                    bailam_thisinh = '';
                    for (var a = 1; a <= tong_tatcacauhoi; a++) {
                        if ($('.cauhoi-' + a + ' .qselect.qchecked').length > 0)
                            bailam_thisinh += $('.cauhoi-' + a + ' .qselect.qchecked').data("traloi") + '|';
                        else {
                            bailam_thisinh += $('.cauhoi-' + a).data("code") + '|';
                            $('.cauhoi-' + a + ' .qselect').addClass('traloisai');
                        }
                    }
                    madethi=$('#madethi').val();
                    malop=$('#malop').val();
                    maphongthi=$('#maphongthi').val();
                    timestart=$('#timestart').val()
                    danopbai = 1;
                    queryString = bailam_thisinh;
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    jQuery.ajax({
                        url: "/ThiThu/NopBai",
                        data: {
                            queryString: queryString,
                            madethi: madethi,
                            malop: malop,
                            maphongthi: maphongthi,
                            timestart: timestart,
                            _token: CSRF_TOKEN,
                        },
                        type: "POST",
                        success: function(data) {
                            danop = 1;
                            console.log(data);
                            if (data == 'ErrorLogin') {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Cảnh báo tài khoản thực thi gian lận.',
                                    showConfirmButton: false,
                                    timer: 5000
                                })
                            } else {

                                // console.log(data);
                                $('.box_dark.thi-tracnghiem .ds-cauhoi .td-ch').removeClass("select");
                                var kq_chon = data['kq_chon'];
                                var kq_dung = data['dapandung'];
                                var dapan_dung = data['kq_dung'];
                                var kq_sai = data['dapansai'];
                                // var kq_sai = kq_data[3].split(':');
                                for (var kq = 1; kq <= 40; kq++) {
                                    mang = kq - 1;
                                    $('.box_dark.thi-tracnghiem .ds-cauhoi .td-ch.trloi' + kq).addClass(kq_chon[mang]);
                                    $('#'+dapan_dung[mang]).addClass('traloidung');
                                }
                                for($i=0;$i<kq_dung.length;$i++){
                                    $('#'+kq_dung[$i]).addClass('traloidung');
                                }
                                for($j=0;$j<kq_sai.length;$j++){
                                    $('#'+kq_sai[$j]).addClass('traloisai');
                                }
                                var tonglambai = 40;
                                // var tongsai = tonglambai - kq_data[0];
                                // for (var sai = 0; sai < tongsai; sai++) {
                                //     $(kq_sai[sai]).addClass('traloisai');
                                // }
                                $('.box_dark.thi-tracnghiem .ds-cauhoi .td-ch.cauhoi').addClass('chophep');
                                var btnext =
                                    '<a class="cautruoc"><img src="images/btn_prev.png" style="cursor:pointer;"></a><a class="causau"><img src="images/btn_next.png" style="cursor:pointer;"></a>';
                                $('#examNextPrevious').html(btnext);
                                $('#examNextPreviousMB').html(btnext);
                                $('.pagination .answer').html(
                                    '<div class="bt-chucnang"> <div class="tab-menu-baihoc"> <a class="view_baihocchinh"><span id="ctl00_ContentPlaceHolder1_Label1" class="title_hoc active" data-id="1">KẾT QUẢ THI</span></a> <div style="clear: both; padding-top: 5px"></div> </div> <div class="tab-menu-baihoc"> <a class="view_tracnghiem"><span id="ctl00_ContentPlaceHolder1_Label1" class="title_hoc" data-id="2">XEM ĐÁP ÁN</span></a> <div style="clear: both; padding-top: 5px"></div> </div></div>'
                                );
                                var tongdiem = data['diemthi'];
                                $('.box_dark.thi-tracnghiem .bailam-tracnghiem').hide();
                                if(data['madethi'] == 1){
                                    $('.box_dark.thi-tracnghiem .diemthi-tracnghiem').html('<div class="kq-thi">' +
                                    tongdiem +
                                    '</div><div class="ketquathi"><a href="/dashboard" style="margin-right: 10px;"> Về Trang Chủ </a> <a href="/ThiThu/LamBai?loai=1"> Thi tiếp </a></div>'
                                );
                                }else{
                                    $('.box_dark.thi-tracnghiem .diemthi-tracnghiem').html('<div class="kq-thi">' +
                                    tongdiem +
                                    '</div><div class="ketquathi"><a href="/dashboard" style="margin-right: 10px;"> Về Trang Chủ </a> </div>'
                                );
                                }

                                $('.box_dark.thi-tracnghiem .diemthi-tracnghiem').show();
                                $('#question audio').addClass("show-audio");
                                Swal.fire({
                                    type: 'success',
                                    title: 'Bạn đã hoàn thành bài thi. Điểm đạt được: ' + tongdiem + ' điểm',
                                    timer: 10000
                                })
                            }
                        }
                    });
                }

                function clickIE() {
                    if (document.all) {
                        return false;
                    }
                }

                function clickNS(e) {
                    if (document.layers || (document.getElementById && !document.all)) {
                        if (e.which == 2 || e.which == 3) {
                            return false;
                        }
                    }
                }
                if (document.layers) {
                    document.captureEvents(Event.MOUSEDOWN);
                    document.onmousedown = clickNS;
                } else {
                    document.onmouseup = clickNS;
                    document.oncontextmenu = clickIE;
                }

                document.oncontextmenu = new Function("return false");
                document.onkeydown = function(e) {
                    if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117 || e
                            .keycode === 17 || e.keycode === 85)) {
                        return false;
                    }

                };

                function disableSelect(event) {
                    event.preventDefault();
                }

                function startDrag(event) {
                    window.addEventListener('mouseup', onDragEnd);
                    window.addEventListener('selectstart', disableSelect);
                }

                function onDragEnd() {
                    window.removeEventListener('mouseup', onDragEnd);
                    window.removeEventListener('selectstart', disableSelect);
                }

                $(document).ready(function() {
                    timecount();
                    $(".pagination").on("click", ".title_hoc", function() {
                        var tab_id = $(this).data("id");
                        $('.title_hoc').removeClass("active");
                        $(this).addClass("active");
                        if (tab_id == 2) {
                            $('.entry-tracnghiem').removeClass("active");
                            $('.entry-tracnghiem.cauhoi-1').addClass('active');
                            $('.box_dark.thi-tracnghiem .bailam-tracnghiem').show();
                            $('.box_dark.thi-tracnghiem .diemthi-tracnghiem').hide();
                        } else {
                            $('.box_dark.thi-tracnghiem .bailam-tracnghiem').hide();
                            $('.box_dark.thi-tracnghiem .diemthi-tracnghiem').show();
                        }
                    });
                    $('.qselect').click(function() {
                        checkLog();
                        if (online == 1) {
                            var classid = $(this).data("id");
                            $('.qselect.trloi' + classid).removeClass("qchecked");
                            $(this).addClass("qchecked");
                            $(this).addClass("trloi" + classid);
                            $('.traloi.trloi' + classid).addClass('select');
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Cảnh báo tài khoản thực thi gian lận.',
                                showConfirmButton: false,
                                timer: 5000
                            })
                        }
                    });

                    $('.cauhoi-doc .td-ch.cauhoi').click(function() {
                        if (danopbai == 0 && listening == 0)
                            soundEffect.play();
                        checkLog();
                        if (online == 1) {
                            if (listening == 0 || danopbai == 1) {
                                var classid = $(this).data("id");
                                $('.entry-tracnghiem').removeClass("active");
                                $('.entry-tracnghiem.cauhoi-' + classid).addClass('active');
                            }
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Cảnh báo tài khoản thực thi gian lận.',
                                showConfirmButton: false,
                                timer: 5000
                            })
                        }
                    });
                    $('.cauhoi-nghe .td-ch.cauhoi').click(function() {
                        checkLog();
                        if (online == 1) {
                            if (danopbai == 1) {
                                var classid = $(this).data("id");
                                $('.entry-tracnghiem').removeClass("active");
                                $('.entry-tracnghiem.cauhoi-' + classid).addClass('active');
                            }
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Cảnh báo tài khoản thực thi gian lận.',
                                showConfirmButton: false,
                                timer: 5000
                            })
                        }
                    });

                    $('.view-play-mb').click(function() {
                        var sounds = document.getElementsByTagName('audio');
                        for (i = 0; i < sounds.length; i++) sounds[i].pause();
                        $(this).parent().find('audio')[0].play();
                    });
                    $(".pagination").on("click", ".button .cautruoc", function() {
                        if (danopbai == 0 && listening == 0)
                            soundEffect.play();
                        checkLog();
                        if (online == 1) {
                            var classid = $('.entry-tracnghiem.active').data("id");
                            if (classid > 1)
                                var truoc = classid - 1;
                            else var truoc = classid;
                            var tongcaudoc = 20;
                            if ((listening == 0 && truoc < tongcaudoc) || danopbai == 1) {
                                $('.entry-tracnghiem').removeClass("active");
                                $('.entry-tracnghiem.cauhoi-' + truoc).addClass('active');
                            }
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Cảnh báo tài khoản thực thi gian lận.',
                                showConfirmButton: false,
                                timer: 5000
                            })
                        }
                    });
                    $(".pagination").on("click", ".button .causau", function() {
                        if (danopbai == 0 && listening == 0)
                            soundEffect.play();
                        checkLog();
                        if (online == 1) {
                            var classid = $('.entry-tracnghiem.active').data("id");
                            if (classid < $('.tongcauhoi').data("id"))
                                var sau = classid + 1;
                            else var sau = classid;
                            var tongcaudoc = 20;
                            var tong_time = 1500;
                            if ((listening == 0 && sau <= tongcaudoc) || danopbai == 1) {
                                $('.entry-tracnghiem').removeClass("active");
                                $('.entry-tracnghiem.cauhoi-' + sau).addClass('active');
                            } else if (listening == 0 && thoigian < tong_time) {
                                $('#examNextPrevious').html('');
                                $('#examNextPreviousMB').html('');
                                $(".box_dark.thi-tracnghiem .ds-cauhoi .td-ch.cauhoi").css("cursor", "no-drop");
                                listening = 1;
                                thoigian = 1500;
                            }
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Cảnh báo tài khoản thực thi gian lận.',
                                showConfirmButton: false,
                                timer: 5000
                            })
                        }
                    });

                    $('.nopbai').click(function() {
                        Swal.fire({
                            title: 'Nộp bài?',
                            text: "Bạn chắc chắn đã trả lời tất cả câu hỏi trước khi nộp bài",
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                nopbai();
                            } else return false;
                        })
                        return false;
                    });
                    $(".box_dark.thi-tracnghiem").mousedown(function() {

                        window.addEventListener('mouseup', onDragEnd);
                        window.addEventListener('selectstart', disableSelect);
                    });
                });
            </script>
            {{-- <script type="text/javascript">
                $(function() {
                    $(".list-tracnghiem").bind("click", function() {
                        var size = parseInt($('.cauhoitracnghiem').css("font-size"));
                        var size = parseInt($('.qsign').css("font-size"));
                        var imgwidth = parseInt($('.cauhoitracnghiem img').css("width"));
                        var size = parseInt($('.mark').css("font-size"));
                        if ($(this).hasClass("plus")) {
                            size = size + 2;
                            imgwidth = imgwidth + 50;
                        } else if ($(this).hasClass("minus")) {
                            size = size - 2;
                            imgwidth = imgwidth - 50;
                        }
                        $('.cauhoitracnghiem').css("font-size", size);
                        $('.qsign').css("font-size", size);
                        $('.cauhoitracnghiem img').css("width", imgwidth);
                        $('.mark').css("font-size", size);

                    });
                });
            </script> --}}

            <span style="display:none"> Designed by LTEPS </span>
        </div>
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
