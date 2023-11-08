@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/60baieps.css') }}">
    <style>
        .cauhoi-tracnghiem .traloidung,
        .cauhoi-tracnghiem-hinhanh .traloidung,
        .entry-tracnghiem-test .traloidung,
        .thi-thu .traloidung {
            background: url(../../images/correctx.png) no-repeat 20px 0;
            background-size: 10px;
        }

        .cauhoi-tracnghiem .traloisai,
        .cauhoi-tracnghiem-hinhanh .traloisai,
        .entry-tracnghiem-test .traloisai,
        .thi-thu .traloisai {
            background: url(../../images/wrongx.png) no-repeat 20px 0;
            background-size: 10px;
        }

        .cauhoi-tracnghiem .traloidung .mark,
        .cauhoi-tracnghiem-hinhanh .traloidung .mark,
        .entry-tracnghiem-test .traloidung .mark {
            border: solid 1px #4dde7d;
            background-color: #4dde7d !important;
            color: #fff !important;
        }

        .cauhoi-tracnghiem .traloisai .mark,
        .cauhoi-tracnghiem-hinhanh .traloisai .mark,
        .entry-tracnghiem-test .traloisai .mark {
            border: solid 1px #fc7272;
            background-color: #fc7272 !important;
            color: #fff !important;
        }

        hr {
            margin-top: 20px;
            margin-bottom: 30px;
            border-top: 1px solid #0091c7;
            width: 100%;
            float: left;
            opacity: 0.1;
        }
    </style>
@stop

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>

    <script src="{{ url('assets/admin/pages/scripts/table-lifesc.js') }}"></script>
    <script src="{{ url('js/custome-form.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
        });

        function clickChonLoai(e, phanloai) {
            // console.log($(this).val());
            $('.row').find('.btn-warning').removeClass('btn-warning').addClass('btn-primary');
            $(e).addClass('btn-warning').removeClass('btn-primary');

            var baihocchinh = $('.baihocchinh').hasClass('d-none');
            var tuvung = $('.tuvung').hasClass('d-none');
            var tracnghiem = $('.tracnghiem').hasClass('d-none');
            var hinhanh = $('.hinhanh').hasClass('d-none');
            var baitap = $('.baitap').hasClass('d-none');

            if (!baihocchinh) {
                $('.baihocchinh').addClass('d-none');
            }
            if (!tuvung) {
                $('.tuvung').addClass('d-none');
            }
            if (!tracnghiem) {
                $('.tracnghiem').addClass('d-none');
            }
            if (!hinhanh) {
                $('.hinhanh').addClass('d-none');
            }
            if (!baitap) {
                $('.baitap').addClass('d-none');
            }

            $('.' + phanloai).removeClass('d-none');

        }

        function playAudio(hientai, mp3) {
            var audio = new Audio(mp3);
            audio.play();
            $(hientai).addClass('sm2_playing');
            audio.onloadedmetadata = (event) => {
                var time = audio.duration
                setTimeout(function() {
                    $(hientai).removeClass('sm2_playing');
                }, time * 1000)
            }
        }
    </script>
@stop
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">{{ $model->tenbaihoc }}</h3>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row" style="align-items: center;justify-content: center;">
                        <div class="ml-3">
                            <button class="btn btn-sm btn-warning btn-square"
                                onclick="clickChonLoai(this,'baihocchinh')">BÀI HỌC CHÍNH</button>
                        </div>
                        <div class=" ml-3">
                            <button class="btn btn-sm btn-primary btn-square" onclick="clickChonLoai(this,'tuvung')">TỪ
                                VỰNG</button>
                        </div>
                        {{-- <div class=" ml-3">
                            <button class="btn btn-sm btn-primary btn-square"
                                onclick="clickChonLoai(this,'tracnghiem')">TRẮC NGHIỆM</button>
                        </div> --}}
                        <div class=" ml-3">
                            <button class="btn btn-sm btn-primary btn-square" onclick="clickChonLoai(this,'hinhanh')">HÌNH
                                ẢNH</button>
                        </div>
                        <div class=" ml-3">
                            <button class="btn btn-sm btn-primary btn-square" onclick="clickChonLoai(this,'baitap')">BÀI
                                TẬP</button>
                        </div>

                    </div>

                    <div class="baihocchinh">
                        {{-- <div class="box_dark">
                            <iframe width="100%" height="720"
                                src="https://www.youtube.com/embed/ewKUARpZ2Tw?list=PLbE1A9P3lz9zki9ehzjGyc2HIaGwd6jlV"
                                title="Bài 2.1:  PATCHIM VÀ PHÁT ÂM TRONG TIẾNG HÀN" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen="allowfullscreen"></iframe>
                            <p class="mt-5 text-center">Link youtube</p>
                        </div> --}}
                        <marquee width="100%" bgcolor="pink" onmouseover="this.stop();" onmouseout="this.start();">Video
                            bài giảng được đăng ký bản quyền. Nghiêm cấm sao chép dưới mọi hình thức</marquee>
                        @if (file_exists($model->link1))
                            <div class="box_dark">
                                <video controls width="100%" poster="{{ url($model->link3) }}">
                                    <source src="{{ url($model->link1) }}">
                                </video>
                                {{-- <p class="mt-5 mb-5 text-center">Link local</p> --}}
                            </div>
                        @endif
                        <hr>
                        @for ($i = 1; $i <= $trang; $i++)
                            <?php $a_baihocchinh = $m_baihocchinh->where('stt', $i); ?>
                            @foreach ($a_baihocchinh as $ct)
                                <div class="box_dark">
                                    <p><img style="width:100%" src="{{ url($ct->anh) }}"></p>
                                    @if ($ct->audio != null)
                                        <p
                                            style="background-color: #fef4eb; text-align: center; margin: -27px 0px 0px 0px;">
                                            <br><audio title="Nghe K-4" controls="controls">
                                                <source src="{{ asset($ct->audio) }}">
                                            </audio>
                                        </p>
                                    @endif
                                    @if ($ct->anh2 != null)
                                        <p><img style="width:100%" src="{{ url($ct->anh2) }}"></p>
                                    @endif

                                </div>
                            @endforeach
                        @endfor
                    </div>
                    <div class=" tuvung d-none">
                        <br />
                        <hr>

                        @foreach ($a_cumtuvung as $key => $val)
                            <?php $cumtu = $m_tuvung->where('cumtuvung', $val); ?>
                            <div class="col-md-4" style="float:left; padding: 10px 0px;"> <span
                                    class="sothutu_nhomtuvung">{{ $val }}.</span>
                                <div class="bg-nhomtuvung" style="font-size: 16px">
                                    @foreach ($cumtu as $tuvung)
                                        <div class="audio-play mt-2">
                                            {{-- <a class="sm2_button audio-play-1"
                                                onclick="playAudio(this,'{{ asset($tuvung->audio) }}')"></a> &nbsp; --}}
                                            <a href="https://korean.dict.naver.com/kovidict/vietnamese/#/search?query={{ $tuvung->tutienghan }}"
                                                target="_bank">{{ $tuvung->tutienghan }}</a> : {{ $tuvung->tiengviet }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                    </div>
                    {{-- <div class="tracnghiem d-none result_view_tracnghiem">
                        <br />
                        <hr>
                        <?php $arr = ['A', 'B', 'C', 'D']; ?>
                        @foreach ($m_tracnghiem as $k => $tn)
                            <div id="question-tracnghiem"
                                style="background-color: #fbfbfb; border-radius: 3px; border: 1px solid #e8e8e8; margin-left: 2px; margin-right: 2px; margin-top: 12px;"
                                class="cauhoi-tienghan question cauhoi-tracnghiem">
                                <div>
                                    <div class="cauhoitracnghiem"
                                        style="float: none; width: 100%; height: 100%; display: block; justify-content: center; align-items: center; font-weight: 700; font-size: 16px; text-align: center; border-bottom: 2px solid #d8d8d8; padding: 5px; background-color: #006767; color: white;">
                                        {{ $tn->noidung }} </div>
                                    <div class="quiz-list" style="float: none; width: 100%; padding: 5px;">
                                        @foreach ($arr as $tl)
                                            <div class="qselect" data-id="{{ $tn->id }}"
                                                data-traloi="{{ $tn->dapan == $tl ? 'T' : 'F' }}">
                                                <div class="mark">{{ $tl }}</div>
                                                <div class="qsign">{{ $tn->$tl }}</div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div> --}}
                    <div class="hinhanh d-none result_view_hinhanh">
                        <br>
                        <hr>
                        <?php $arr_ha = ['A', 'B', 'C', 'D']; ?>
                        @foreach ($m_hinhanh as $k => $ha)
                            <div id="question-tracnghiem-hinhanh"
                                class="hinhanh-tienghan question cauhoi-tracnghiem-hinhanh">
                                <div class="voca_list_show_img">
                                    <div class="voca_show_img text-center"><img class="vcimg"
                                            src="{{ asset($ha->hinhanh) }}" style="width: 245px; height: 150px;"></div>
                                    <div class="voca_show_audio" style="background-color: #005d5d; color: white;"><a
                                            onclick="playAudio(this,'{{ asset($ha->audio) }}')" class="sm2_button"></a>
                                        {{ $ha->tienghan }}</div>
                                    <div class="quiz-list-hinhanh">
                                        @foreach ($arr_ha as $tl)
                                            <div class="qselect" data-id="{{ $ha->id }}"
                                                data-traloi="{{ $ha->dapan == $tl ? 'T' : 'F' }}">
                                                <div class="mark">{{ $tl }}</div>
                                                <div class="qsign">{{ $ha->$tl }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="baitap d-none">
                        <br>
                        @foreach ($m_baitap as $k => $bt)
                            <div id="question" class="question entry-tracnghiem-test">
                                <div class="cauhoibaitap"> <b>❖ CÂU HỎI: {{ ++$k }}</b>
                                    <hr>
                                    {{-- <div style="margin-top: 20px;margin-left: 10px;"> --}}
                                    <div
                                        style="margin-top: 20px;padding: 10px;box-shadow: inset 0px 0px 5px 2px #cfcfcf;border-radius: 5px;">
                                        <p><strong>{{ $bt->cauhoi }}</strong></p>
                                        @if (isset($bt->audio))
                                            <p><strong><audio controls="controls"
                                                        src="{{ asset($bt->audio) }}"></audio></strong></p>
                                        @endif
                                        @if ($bt->noidung != null)
                                            <table border="1"
                                                style="height: 70px; width: 99%; margin-top: 20px; margin-left: auto; margin-right: auto;"
                                                height="70">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 99%; padding: 10px; text-align: center;">
                                                            {{ $bt->noidung }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                        @if ($bt->hoithoai1 != null)
                                            <table border="1"
                                                style="height: 70px; width: 99%; margin-top: 20px; margin-left: auto; margin-right: auto;"
                                                height="70">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 99%; padding: 10px;">
                                                            <?php $a_hoithoai = ['hoithoai1', 'hoithoai2', 'hoithoai3', 'hoithoai4']; ?>
                                                            @foreach ($a_hoithoai as $ng => $ht)
                                                                @if ($bt->$ht != null)
                                                                    {{ in_array($ng, ['1', '3']) ? '가' : '나' }} :
                                                                    {{ $bt->$ht }}<br>
                                                                @endif
                                                            @endforeach
                                                            {{-- 가： 지금 김 과장님 자리에 안 계신데요. 메모를 남겨 드릴까요?<br>나： 아니요, 제가 나중에 다시 전화 _______________. --}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                        @if (isset($bt->anh))
                                            <p style="text-align: center;"><strong><img src="{{ asset($bt->anh) }}"
                                                        alt="" width="112" height="163"></strong></p>
                                        @endif

                                    </div>
                                </div>
                                <div class="quiz-list">
                                    @foreach ($arr_ha as $tl)
                                        <div class="qselect cot2" data-id="{{ $bt->id }}"
                                            data-traloi="{{ $bt->dapan == $tl ? 'T' : 'F' }}">
                                            <div class="mark">{{ $tl }}</div>
                                            <div class="qsignbt">
                                                {{-- <p>{{ $bt->$tl }}</p> --}}
                                                @if ($bt->loaidapan == 1)
                                                    {{ $bt->$tl }}
                                                @else
                                                    <img src="{{ url($bt->$tl) }}" width="120" height="120">
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <!--end::Card-->
        <!--end::Example-->
    </div>
    <!--end::Row-->

    <script>
        $('.qselect').on('click', function() {
            var a = $(this).data('traloi');
            var b = $(this).data('id');
            $(this).addClass('trloi' + b)
            $('.trloi' + b).removeClass('traloisai');
            $('.trloi' + b).removeClass('traloidung');
            // $(this).removeClass('traloisai');
            if (a == 'T') {
                $(this).addClass('traloidung');
            } else {
                $(this).addClass('traloisai');
            }
        })
    </script>
@stop
