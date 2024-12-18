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
                        @if ($dangcau == 1)
                            <div id="question" class="question entry-tracnghiem-test cauhoi-{{ ++$k }}"
                                data-id="4058">
                                <div class="cauhoitracnghiem"> <b>{{ $cau++ }}.</b> <strong>{{$ct->cauhoi}}</strong>
                                    <p style="display: block;"></p>
                                    @if(trim($ct->noidung) != null)
                                    <table style="height: 70px; width: 99%; margin-top: 20px; margin-left: auto; margin-right: auto;border: 1px solid" height="70">
                                        <tbody>
                                            <tr>
                                                <td style="width: 99%; padding: 10px;">{{$ct->noidung}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @endif
                                    @if(trim($ct->hoithoai1) != null)
                                    <table border="1" style="height: 70px; width: 99%; margin-top: 20px; margin-left: auto; margin-right: auto;" height="70">
                                        <tbody>
                                            <tr>
                                                <td style="width: 99%; padding: 10px;">
                                                    <?php $a_hoithoai=['hoithoai1','hoithoai2','hoithoai3','hoithoai4'] ?>
                                                    @foreach ($a_hoithoai as $ng=>$ht)
                                                    @if($ct->$ht != null)
                                                        {{in_array($ng,['1','3'])?'가':'나'}} : {{$ct->$ht}}<br>
                                                    @endif
                                                    @endforeach
                                                    {{-- 가： 지금 김 과장님 자리에 안 계신데요. 메모를 남겨 드릴까요?<br>나： 아니요, 제가 나중에 다시 전화 _______________. --}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @endif
                                    @if(trim($ct->anh) != null)
                                    <img src="{{ asset($ct->anh) }}" alt="11"
                                        width="244" height="207">
                                    @endif
                                </div>
                                <div class="quiz-list">
                                    @foreach ($arr_ha as $key => $tl)
                                        <div class="qselect cot2" data-id="{{ $ct->macauhoi }}"
                                            data-traloi="{{ $ct->dapan == $tl ? 'T' : 'F' }}">
                                            <div class="mark">{{ ++$key }}</div>
                                            <div class="qsign">
                                                @if ($ct->loaidapan == 1)
                                            {{ $ct->$tl }}
                                        @else
                                            <img src="{{ asset($ct->$tl) }}" width="120" height="120">

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
                                @if($tt==1)
                                <div class="cauhoitracnghiem"> <b>{{ $ct[$val['stt']] }}.</b> 
                                    <table border="1" style="height: 70px; width: 99%; margin-top: 20px; margin-left: auto; margin-right: auto;" height="70">
                                        <tbody>
                                            <tr>
                                                <td style="width: 99%; padding: 10px;">
                                                    {{$ct['noidung']}}
                                                  </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p style="display: block;"></p><strong>1 -&nbsp;{{ $ct[$val['cauhoi']] }}</strong>  </div>
                                @else
                                <div class="cauhoitracnghiem"> <b>{{ $ct[$val['stt']] }}.</b> {{$tt}} - {{ $ct[$val['cauhoi']] }} </div>
                                @endif
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
                        @endif
                    @endforeach
                </div>
            </div>
    </article>
@stop
