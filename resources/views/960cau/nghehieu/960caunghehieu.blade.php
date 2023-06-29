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
        const audio = new Audio();
        function playAudio(hientai, mp3) {
            $('.sm2_button').removeClass('sm2_playing');
            audio.src=mp3;
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
        <div id="content-tab" class="result_tab result_view_tracnghiem">
            <?php $arr_ha = ['1' => 'A', '2' => 'B', '3' => 'C', '4' => 'D']; ?>
            @foreach ($model as $key => $ct)
                @if ($dangcau == 1)
                    <div id="question" class="question entry-tracnghiem-test cauhoi-1" data-id="1350">
                        <div class="cauhoitracnghiem"> <b>{{ ++$key }}</b> <audio controls="controls"
                                src="{{ url($ct->audio) }}"></audio> <a onclick="playAudio(this,'{{ url($ct->audio) }}')"
                                class="sm2_button" data-div="1" style="margin-left:10px;"> </a> </div>
                        <div class="quiz-list">
                            @foreach ($arr_ha as $k => $tl)
                                <div class="qselect {{ $ch->loaidapan == 1 ? 'cot4' : 'cot2' }}" data-id="{{ $ct->id }}"
                                    data-traloi="{{ $ct->dapan == $tl ? 'T' : 'F' }}">
                                    <div class="mark">{{ $k }}</div>
                                    <div class="qsign">
                                        @if ($ct->loaidapan == 1)
                                            {{ $ct->$tl }}
                                        @else
                                            <img src="{{ url($ct->tl) }}" width="120" height="120">
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                 <?php $arr_ch=[
                    '1'=>['macauhoi'=>'macauhoi1','cauhoi'=>'cauhoi1','audio'=>'audio','stt'=>'stt','dapan'=>'dapan1','loaidapan'=>'loaidapan1'],
                    '2'=>['macauhoi'=>'macauhoi2','cauhoi'=>'cauhoi2','audio'=>'','stt'=>'stt','dapan'=>'dapan2','loaidapan'=>'loaidapan2']
                ];
                $a_dapan=[
                    '1'=>[ '1'=>'A','2'=>'B','3'=>'C','4'=>'D'],
                    '2'=>['1'=>'A','2'=>'B','3'=>'C','4'=>'D']
                ]
                ?>
                 @foreach ($arr_ch as $tt=>$val)
                 <div id="question" class="question entry-tracnghiem-test cauhoi-1" data-id="2235">
                    <div class="cauhoitracnghiem"> <b>{{ $ct[$val['stt']] }}.</b> <audio controls="controls"
                            src="{{ url($val['audio'] ==''?'':$ct[$val['audio']]) }}" audio=""></audio>{{$tt}} - {{ $ct[$val['cauhoi']] }} <a onclick="playAudio(this,'{{ url($val['audio'] ==''?'':$ct[$val['audio']]) }}')"
                            class="sm2_button" data-div="1" style="margin-left:10px;"> </a> </div>
                    <div class="quiz-list">
                        @foreach ($a_dapan[$tt] as $stt=>$item)
                        <?php $cauhoi=$item.$tt; ?>
                        <div class="qselect cot2" data-id="{{ $ct[$val['macauhoi']] }}"
                        data-traloi="{{ $ct[$val['dapan']] == $item ? 'T' : 'F' }}">
                        <div class="mark">{{$stt}}</div>
                        <div class="qsign">
                            @if ($ct[$val['loaidapan']] == 1)
                            {{ $ct[$cauhoi] }}
                        @else
                            <img src="{{ url($ct[$cauhoi]) }}" width="120" height="120">
                        @endif
                            </div>
                    </div>
                        @endforeach

                       
                    </div>
                </div>
                 @endforeach
                    {{-- <div id="question" class="question entry-tracnghiem-test cauhoi-1" data-id="2235">
                        <div class="cauhoitracnghiem"> <b>{{ $ct['stt'] }}.</b> <audio controls="controls"
                                src="{{ url($ct['audio']) }}" audio=""></audio>1 - {{ $ct['cauhoi1'] }} <a onclick="playAudio(this,'{{ url($ct['audio']) }}')"
                                class="sm2_button" data-div="1" style="margin-left:10px;"> </a> </div>
                        <div class="quiz-list">
                            <div class="qselect cot2" data-id="{{ $ct['macauhoi1'] }}"
                                data-traloi="{{ $ct['dapan1'] == 'A' ? 'T' : 'F' }}">
                                <div class="mark">1</div>
                                <div class="qsign">{{ $ct['A1'] }}</div>
                            </div>
                            <div class="qselect cot2" data-id="{{ $ct['macauhoi1'] }}"
                                data-traloi="{{ $ct['dapan1'] == 'B' ? 'T' : 'F' }}">
                                <div class="mark">2</div>
                                <div class="qsign"> {{ $ct['B1'] }}</div>
                            </div>
                            <div class="qselect cot2" data-id="{{ $ct['macauhoi1'] }}"
                                data-traloi="{{ $ct['dapan1'] == 'C' ? 'T' : 'F' }}">
                                <div class="mark">3</div>
                                <div class="qsign">{{ $ct['C1'] }}</div>
                            </div>
                            <div class="qselect cot2" data-id="{{ $ct['macauhoi1'] }}"
                                data-traloi="{{ $ct['dapan1'] == 'D' ? 'T' : 'F' }}">
                                <div class="mark">4</div>
                                <div class="qsign"> {{ $ct['D1'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div id="question" class="question entry-tracnghiem-test cauhoi-2" data-id="2236">
                        <div class="cauhoitracnghiem"> <b>{{ $ct['stt'] }}.</b> 2 - {{ $ct['cauhoi2'] }} <a onclick="playAudio(this,'')"
                                class="sm2_button" data-div="2" style="margin-left:10px;"> </a> </div>
                        <div class="quiz-list">
                                <div class="qselect cot2" data-id="{{ $ct['macauhoi2'] }}"
                                    data-traloi="{{ $ct['dapan2'] == 'A' ? 'T' : 'F' }}">
                                    <div class="mark">1</div>
                                    <div class="qsign">{{ $ct['A2'] }}</div>
                                </div>
                                <div class="qselect cot2" data-id="{{ $ct['macauhoi2'] }}"
                                    data-traloi="{{ $ct['dapan2'] == 'B' ? 'T' : 'F' }}">
                                    <div class="mark">2</div>
                                    <div class="qsign"> {{ $ct['B2'] }}</div>
                                </div>
                                <div class="qselect cot2" data-id="{{ $ct['macauhoi2'] }}"
                                    data-traloi="{{ $ct['dapan2'] == 'C' ? 'T' : 'F' }}">
                                    <div class="mark">3</div>
                                    <div class="qsign">{{ $ct['C2'] }}</div>
                                </div>
                                <div class="qselect cot2" data-id="{{ $ct['macauhoi2'] }}"
                                    data-traloi="{{ $ct['dapan2'] == 'D' ? 'T' : 'F' }}">
                                    <div class="mark">4</div>
                                    <div class="qsign"> {{ $ct['D2'] }}</div>
                                </div>
                        </div>
                    </div> --}}
                @endif
            @endforeach
        </div>

    </article>
@stop
