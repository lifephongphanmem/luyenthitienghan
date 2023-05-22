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
    </script>
@stop
@section('content')

    <article class="type-post status-publish format-standard has-post-thumbnail hentry">
        <header class="archive-page-header">
            <center>
                <h1 class="page-title is-large uppercase tieude-giaotrinh mt-3">{{$title}}</h1>
            </center>
        </header>
        <div id="tab-menu">
            <div class="tab-menu tab-menu-baihoc">
                <a class="view_baihocchinh"><span id="ctl00_ContentPlaceHolder1_Label1" class="title_hoc active"
                        data-id="1" data-bai="132">BÀI HỌC CHÍNH</span></a>
            </div>
            <div class="tab-menu tab-menu-baihoc">
                <a class="view_tracnghiem"><span id="ctl00_ContentPlaceHolder1_Label3" class="title_hoc" data-id="2"
                        data-bai="132">TRẮC NGHIỆM</span></a>
            </div>
        </div>
        <div id="content-tab">
            <div class="result_tab result_view_noidung" style="display: block;">
                @foreach ($model as $k => $ct)
                    <div class="dochieu">
                        <div class="list-tracnghiem">
                            <div
                                class="question entry-tracnghiem cauhoi-{{ ++$k }} @if ($k == 1) active @endif">
                                <div class="cauhoitracnghiem">
                                    <p><span
                                            style="color: #005aff; font-size: 18pt; font-family: helvetica, arial, sans-serif;"><strong>
                                                @if ($k < 10)
                                                    0{{ $k }}
                                                @else
                                                    {{ $k }}
                                                @endif
                                            </strong></span>
                                    </p>
                                    <img src="{{ $ct->anh }}"
                                        alt="@if ($k < 10) 0{{ $k }}
                            @else
                                {{ $k }} @endif"
                                        width="125" height="125">
                                </div>
                                <div class="quiz-list">
                                    <div class="no2qselect cot2">
                                        <div class="mark">1</div>
                                        <div class="qsign">{{ $ct->A }}</div>
                                    </div>
                                    <div class="no2qselect cot2">
                                        <div class="mark">2</div>
                                        <div class="qsign">{{ $ct->B }}</div>
                                    </div>
                                    <div class="no2qselect cot2">
                                        <div class="mark">3</div>
                                        <div class="qsign">{{ $ct->C }}</div>
                                    </div>
                                    <div class="no2qselect cot2">
                                        <div class="mark">4</div>
                                        <div class="qsign">{{ $ct->D }}</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div
                                class="question entry-tracnghiem cauhoi-{{ ++$k }} @if ($k == 1) active @endif">
                                <div class="cauhoitracnghiem"></div>
                                <div class="quiz-list">
                                    <div class="no2qselect cot2">
                                        <div class="mark">1</div>
                                        <div class="qsign">1. {{ $ct->Atiengviet }}</div>
                                    </div>
                                    <div class="no2qselect cot2">
                                        <div class="mark">2</div>
                                        <div class="qsign">2. {{ $ct->Btiengviet }}</div>
                                    </div>
                                    <div class="no2qselect cot2">
                                        <div class="mark">3</div>
                                        <div class="qsign">3. {{ $ct->Ctiengviet }}</div>
                                    </div>
                                    <div class="no2qselect cot2">
                                        <div class="mark">4</div>
                                        <div class="qsign">4. {{ $ct->Dtiengviet }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="result_tab result_view_tracnghiem">
                {{-- <center>
                    <div style="text-align: center; width: 80%">
                        <select title="Đảo câu" class="drd icon icon-star change-select" style="display: none;">
                            <option value="1">» HÀN - VIỆT</option>
                        </select>
                        <button class="change-select-dc" style="height: 30px;">CHUYỂN / ĐẢO CÂU</button>
                    </div>
                </center> --}}
                <div class="data-tracnghiem">
                    <?php $arr_ha = ['A', 'B', 'C', 'D']; ?>
                    @foreach ($model as $k => $ct)
                    <div id="question" class="question entry-tracnghiem-test cauhoi-{{++$k}}" data-id="4058">
                        <div class="cauhoitracnghiem"> <b>{{$k}}.</b> <strong>다음 그림을 보고 맞는 단어나 문장을 고르십시오.</strong>
                            <p style="display: block;"></p><img src="{{ asset($ct->anh) }}" alt="11"
                                width="244" height="207">
                        </div>
                        <div class="quiz-list">
                            @foreach ($arr_ha as $key=>$tl)
                            <div class="qselect cot4" data-id="{{$ct->macauhoi}}" data-traloi="{{ $ct->dapan == $tl ? 'T' : 'F' }}">
                                <div class="mark">{{++$key}}</div>
                                <div class="qsign">{{$ct->$tl}}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
    </article>
@stop
