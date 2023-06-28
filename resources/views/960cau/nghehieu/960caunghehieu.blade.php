@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ '/css/960cau.css' }}">
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
            $("#tab-menu").on("click", ".title_hoc", function() {
                var tab_id = $(this).data("id");
                var bai_id = $(this).data("bai");
                $('.title_hoc').removeClass("active");
                $(this).addClass("active");
                $('.ajax-loader').fadeOut('slow');
                if (tab_id == 1) {
                    $('.result_view_noidung').show();
                    $('.result_view_tracnghiem').hide();
                } else if (tab_id == 2) {
                    $('.result_view_noidung').hide();
                    $('.result_view_tracnghiem').show();
                }
            });
            $(".hentry").on("click", ".qselect", function() {
                var classid = $(this).data("id");
                $('.qselect.trloi' + classid).removeClass("qchecked");
                $('.qselect.trloi' + classid).removeClass("traloidung");
                $('.qselect.trloi' + classid).removeClass("traloisai");
                $(this).addClass("qchecked");
                $(this).addClass("trloi" + classid);
                var traloi = $(this).data("traloi");
                if (traloi == 'T')
                    $(this).addClass('traloidung');
                else $(this).addClass('traloisai');
            });
        });
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

    <article class="type-post status-publish format-standard has-post-thumbnail hentry">
        <header class="archive-page-header">
            <center>
                <h1 class="page-title is-large uppercase tieude-giaotrinh mt-3">{{ $title }}</h1>
            </center>
        </header>
        <div id="tab-menu">
            {{-- <div class="tab-menu tab-menu-baihoc">
                <a class="view_baihocchinh"><span id="ctl00_ContentPlaceHolder1_Label1" class="title_hoc active"
                        data-id="1" data-bai="132">BÀI HỌC CHÍNH</span></a>
            </div> --}}
            <div class="tab-menu tab-menu-baihoc">
                <a class="view_tracnghiem"><span id="ctl00_ContentPlaceHolder1_Label3" class="title_hoc" data-id="2"
                        data-bai="132">TRẮC NGHIỆM</span></a>
            </div>
        </div>
        <div id="content-tab">
            <?php $arr_ha = ['A', 'B', 'C', 'D']; ?>
            <div id="question" class="question entry-tracnghiem-test cauhoi-1" data-id="1350">
                <div class="cauhoitracnghiem"> <b>41.</b> <audio controls="controls" src="https://luyenthieps.vn/audio/dethieps/76.mp3"></audio> <a  onclick="playAudio(this,'https://luyenthieps.vn/audio/dethieps/76.mp3')" class="sm2_button" data-div="1" style="margin-left:10px;"> </a> </div>
                <div class="quiz-list"><div class="qselect cot4" data-id="1" data-traloi="F">
                        <div class="mark">1</div>
                        <div class="qsign"> 전화하세요</div> 
                    </div><div class="qselect cot4" data-id="1" data-traloi="F">
                        <div class="mark">2</div>
                        <div class="qsign"> 주문하세요</div> 
                    </div><div class="qselect cot4" data-id="1" data-traloi="T">
                        <div class="mark">3</div>
                        <div class="qsign"> 조심하세요</div> 
                    </div><div class="qselect cot4" data-id="1" data-traloi="F">
                        <div class="mark">4</div>
                        <div class="qsign"> 도와주세요</div> 
                    </div>
                </div>
            </div>
           
        </div>

    </article>
@stop
