@extends('thithu.index')

@section('title')
    <title>Làm Bài Thi Thử EPS-Topik</title>
@endsection

@section('header')
    <div class="p-2" style="flex: 1; margin: auto">
        <img src="{{ url('/assets/media/logos/logo-thithu.png') }}" />
    </div>
    <div class="p-2 h2 text-center" style="flex: 1; margin: auto">
        Test of proficiency in Korean
    </div>
    <div class="p-2" style="flex: 1">

    </div>
@endsection

@section('subheader')
    <div class="" style="flex: 1">

    </div>
    <div class="p-2 font-weight-bold text-center align-self-center" style="flex: 1; font-size: 13pt">
        Manufacturing
    </div>
    <div class="text-right mr-5 p-2" style="flex: 1">
        <a>
            <img src="{{ url('assets/media/logos/btn_txtsize_minus.png') }}"
                onmouseover="this.src='{{ url('assets/media/logos/btn_txtsize_minus_on.png') }}'"
                onmouseout="this.src='{{ url('assets/media/logos/btn_txtsize_minus.png') }}'" />
        </a>
        <a>
            <img src="{{ url('assets/media/logos/btn_txtsize_plus.png') }}"
                onmouseover="this.src='{{ url('assets/media/logos/btn_txtsize_plus_on.png') }}'"
                onmouseout="this.src='{{ url('assets/media/logos/btn_txtsize_plus.png') }}'" />
        </a>
    </div>
@endsection

@section('content')
    <div class="row" style="background-color: rgba(202, 207, 210); height: 100%">
        <div class="col-9 mt-12" style="background-color: rgba(112, 123, 124);">
            <div class="pt-4 pl-12 pr-12 pb-5" style="height: 100%">
                <div style="background-color: white; height: 100%">
                    <div class="pt-10 pb-10 pl-4 pr-4" id="danhsach" style="height: 100%">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 pt-5">
            <div class="text-center">
                <a href="javascript:;">
                    <img src="{{ url('assets/media/logos/btn_answer.png') }}"
                        onmouseover="this.src='{{ url('assets/media/logos/btn_answer_on.png') }}'"
                        onmouseout="this.src='{{ url('assets/media/logos/btn_answer.png') }}'"
                        onclick="nopbai()" />
                </a>
            </div>
            <div class="pt-3 text-center" style="">
                <div class="" style="height: 80px; width: 233px; display: inline-block;">
                    <div class="row" style="margin: auto">
                        <div class="col-sm-6 border border-primary pt-1 pb-1 text-left"
                            style="color: white; background-color: rgba(127, 179, 213);">
                            READING
                        </div>
                        <div class="col-sm-6 border-top border-right border-bottom border-primary pt-1 pb-1 text-left"
                            style="color: white; background-color: rgba(127, 179, 213)">
                            LISTENING
                        </div>
                    </div>
                    <div class="row" style="margin: auto">
                        <div class="col-sm-6 border-left border-bottom border-right border-primary p-0"
                            style="background-color: rgba(127, 179, 213);">
                            <div class="m-1" style="background-color: rgba(202, 207, 210);">
                                <div class="row" style="margin: auto">
                                    <div class="col-6 p-0" style="margin: auto">
                                        <div class="m-1"
                                            style="background-color: rgba(144, 148, 151); color: white; font-size: 8pt">
                                            REMAIN TIME
                                        </div>
                                    </div>
                                    <div class="col-6 p-0" style="margin: auto;">
                                        <div class="text-center font-weight-bold" id="reading" style="font-size: 9pt">
                                            25:00
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 border-right border-bottom border-primary p-0"
                            style="background-color: rgba(127, 179, 213)">
                            <div class="m-1" style="background-color: rgba(202, 207, 210);">
                                <div class="row" style="margin: auto">
                                    <div class="col-6 p-0" style="margin: auto">
                                        <div class="m-1"
                                            style="background-color: rgba(144, 148, 151); color: white; font-size: 8pt">
                                            REMAIN TIME
                                        </div>
                                    </div>
                                    <div class="col-6 p-0" style="margin: auto;">
                                        <div class="text-center font-weight-bold" id="listening" style="font-size: 9pt">
                                            25:00
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @for ($i = 0; $i < 20; $i++)
                        <div class="row" style="margin: auto">
                            <div class="col-6 border-left border-top border-bottom p-0" style="background-color: white">
                                <div class="row" style="margin: auto">
                                    <div class="col-4 p-0 border-right">
                                        <div class="qlist" onclick="thayDoiCauHoi({{ $i + 1 }})">
                                            {{ $i + 1 }}
                                        </div>
                                    </div>
                                    <div class="col-8" id="dachon-{{ $i + 1 }}">

                                    </div>
                                </div>
                            </div>
                            <div class="col-6 border p-0" style="background-color: white">
                                <div class="row" style="margin: auto">
                                    <div class="col-4 p-0 border-right">
                                        <div class="" style="cursor: not-allowed; user-select: none; background-color: white" {{-- onclick="thayDoiCauHoi({{ $i + 21 }})" --}}>
                                            {{ $i + 21 }}
                                        </div>
                                    </div>
                                    <div class="col-8" id="dachon-{{ $i + 21 }}">

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="text-center pt-3">
                <a>
                    <img src="{{ url('assets/media/logos/btn_prev.png') }}"
                        onmouseover="this.src='{{ url('assets/media/logos/btn_prev_on.png') }}'"
                        onmouseout="this.src='{{ url('assets/media/logos/btn_prev.png') }}'"
                        onclick="luilai()" />
                </a>
                <a>
                    <img src="{{ url('assets/media/logos/btn_next.png') }}"
                        onmouseover="this.src='{{ url('assets/media/logos/btn_next_on.png') }}'"
                        onmouseout="this.src='{{ url('assets/media/logos/btn_next.png') }}'"
                        onclick="tieptheo()" />
                </a>
            </div>
        </div>
    </div>
@endsection

@section('custom-style')
    <style>
        .question-container {
            height: 100%;
            display: none;
        }

        .question-container.active {
            display: block;
        }

        .qlist {
            cursor: pointer;
            background-color: white;
        }

        .qlist:hover {
            background-color: rgba(214, 219, 223);
        }

        .question {
            line-height: 20px;
            height: 22px;
            width: 22px;
            text-align: center;
            border-radius: 18px;
            display: inline-block;
            border: solid 1px #230082;
            margin-right: 3px;
            background: none;
            color: #000;
        }

        .question.qmark {
            border: solid 1px #50a3df;
            color: #fff;
            background-color: #50a3df;
            
        }

        .answer {
            font-size: 14pt;
            padding: 0;
        }

        .answer.amark {
            color: #50a3df;
        }
    </style>
@endsection

@section('scripts')
    @for ($i = 0; $i < 40; $i++)
        <script>
            function danhDau{{ $i + 1 }}(luachondapan) {
                document.getElementById("dachon-{{ $i + 1 }}").innerHTML =
                    "<img src='{{ url('assets/media/logos/select.png') }}'/>";

                for (let i = 0; i < 4; i++) {
                    if (document.getElementById('dapan-stt-{{ $i + 1 }}-' + (i + 1)).classList.contains('qmark') && 
                        document.getElementById('dapan-noidung-{{ $i + 1 }}-' + (i + 1)).classList.contains('amark')) {
                        document.getElementById('dapan-stt-{{ $i + 1 }}-' + (i + 1)).classList.remove('qmark');
                        document.getElementById('dapan-noidung-{{ $i + 1 }}-'+ (i + 1)).classList.remove('amark');
                    }
                }

                document.getElementById('dapan-stt-{{ $i + 1 }}-' + luachondapan).classList.add('qmark');
                document.getElementById('dapan-noidung-{{ $i + 1 }}-' + luachondapan).classList.add('amark');

                danhsachcauhoi[{{ $i }}].luachon = danhsachcauhoi[{{ $i }}].dapan[luachondapan - 1].noidung;
            }
        </script>
    @endfor

    <script>
        function thayDoiCauHoi(vitri) {
            for(let i = 0; i < danhsachcauhoi.length; i++){                                     // phai sua lai
                if(document.getElementById('cauhoi-' + (i + 1)).classList.contains('active')){
                    document.getElementById('cauhoi-' + (i + 1)).classList.remove('active');
                }
            }
            document.getElementById('cauhoi-' + vitri).classList.add('active');
        }
    </script>

    <script>
        function tieptheo() {
            for(let i = 0; i < danhsachcauhoi.length; i++){                                     // phai sua lai
                if(document.getElementById('cauhoi-' + (i + 1)).classList.contains('active') && i + 1 < danhsachcauhoi.length){
                    document.getElementById('cauhoi-' + (i + 1)).classList.remove('active');
                    document.getElementById('cauhoi-' + (i + 2)).classList.add('active');
                    break;
                }
            }
        }
    </script>

    <script>
        function luilai() {
            for(let i = 0; i < danhsachcauhoi.length; i++){                                     // phai sua lai
                if(document.getElementById('cauhoi-' + (i + 1)).classList.contains('active') && i > 0){
                    document.getElementById('cauhoi-' + (i + 1)).classList.remove('active');
                    document.getElementById('cauhoi-' + i).classList.add('active');
                    break;
                }
            }
        }
    </script>

    <script>
        var danhsachcauhoi = [
            {
                made: `[MA-486]`,
                tieudecauhoi: `Tìm từ đồng nghĩa:`,
                noidungcauhoi: `I didn't think his comments were very <u>appropriate</u> at the time.`,
                dapan: [
                    {
                        noidung: `correct`
                    },
                    {
                        noidung: `right`
                    },
                    {
                        noidung: `exact`
                    },
                    {
                        noidung: `suitable`
                    }
                ],
                luachon: ``
            },
            {
                made: `[MA-1024]`,
                tieudecauhoi: `Tìm từ đồng nghĩa:`,
                noidungcauhoi: `When being interviewed, you should <u>concentrate on</u> what the interviewer is saying or asking you.`,
                dapan: [
                    {
                        noidung: `relate on`
                    },
                    {
                        noidung: `be interested in`
                    },
                    {
                        noidung: `impress on`
                    },
                    {
                        noidung: `pay attention to`
                    }
                ],
                luachon: ``
            },
            {
                made: `[MA-2048]`,
                tieudecauhoi: `Tìm từ đồng nghĩa:`,
                noidungcauhoi: `S. Mayo Hospital in New Orleans was so named in recognition of Dr. Mayo's <u>outstanding</u> humanitarianism.`,
                dapan: [
                    {
                        noidung: `unpopular`
                    },
                    {
                        noidung: `widespread`
                    },
                    {
                        noidung: `remarkable`
                    },
                    {
                        noidung: `charitable`
                    }
                ],
                luachon: ``
            },
            {
                made: `[MA-3096]`,
                tieudecauhoi: `Chọn đáp án đúng:`,
                noidungcauhoi: `Those students are working very _____ for their next exams.`,
                dapan: [
                    {
                        noidung: `hardly`
                    },
                    {
                        noidung: `hard`
                    },
                    {
                        noidung: `harder`
                    },
                    {
                        noidung: `hardest`
                    }
                ],
                luachon: ``
            },
            {
                made: `[MA-4040]`,
                tieudecauhoi: `Chọn đáp án đúng:`,
                noidungcauhoi: `Frede came to the meeting but Charles ________.`,
                dapan: [
                    {
                        noidung: `isn't`
                    },
                    {
                        noidung: `hasn't`
                    },
                    {
                        noidung: `didn't`
                    },
                    {
                        noidung: `wasn't`
                    }
                ],
                luachon: ``
            },
        ];

        function questionUI() {
            for (let i = 0; i < danhsachcauhoi.length; i++){
                let cauhoi = '';
                cauhoi += `
                    <div class="question-container" id="cauhoi-` + (i + 1) + `">
                        <div style="font-size: 10px">
                            ` + danhsachcauhoi[i].made + `
                        </div>
                        <div class="pl-15 pr-15">
                            <div style="font-weight: bold; font-size: 14pt">
                                ` + (i + 1) + '. ' + danhsachcauhoi[i].tieudecauhoi + `
                            </div>
                            <div class="pt-3 pb-3 pl-2 pr-2 mt-3 mb-3"
                                style="font-size: 14pt; width: 90%; margin-left: auto; margin-right: auto; border: double">
                                <div class="ml-2 mr-2">
                                    ` + danhsachcauhoi[i].noidungcauhoi + `
                                </div>
                            </div>
                        </div>
                        <div class="ml-30 mr-30">
                            <div class="flex-container ">
                                <div class="row flex-wrap" style="cursor: pointer">`;
                for (let j = 0; j < 4; j++) {
                    cauhoi += `
                                    <div class="col-6 p-3" onclick="danhDau` + (i + 1) + `(` + (j + 1) + `)">
                                        <div class="d-flex">
                                            <div class="align-self-center question" id="dapan-stt-` + (i + 1) + `-` + (j + 1) +`">
                                                ` + (j + 1) + `
                                            </div>
                                            <div class="ml-1 align-self-center answer" id="dapan-noidung-` + (i + 1) + `-` + (j + 1) +`">
                                                ` + danhsachcauhoi[i].dapan[j].noidung + `
                                            </div>
                                        </div>
                                    </div>`;
                }
                cauhoi += `
                                </div>
                            </div>
                        </div>
                    </div>`;
                document.getElementById('danhsach').innerHTML += cauhoi;
            }

            document.getElementById('cauhoi-1').classList.add('active');
        }

        window.onload = questionUI();
    </script>

    <script>
        function nopbai() {
            console.log(danhsachcauhoi);
        }
    </script>

    <script>
        var countdownReading = 1500000;
        var countReading = 0;

        var countdownListening = 1500000;
        var countListening = 0;

        var reading = setInterval(() => {
            var distance = countdownReading - countReading;

            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (minutes < 10) {
                minutes = '0' + minutes;
            }

            if (seconds < 10) {
                seconds = '0' + seconds;
            }

            document.getElementById("reading").innerHTML = minutes + ":" + seconds;
  
            countReading += 1000;
    
            if (distance < 1) {
                clearInterval(reading);
                
            }
        }, 1000);
        
        setTimeout(() => {
            var listening = setInterval(() => {
                var distance = countdownListening - countListening;

                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                if (minutes < 10) {
                    minutes = '0' + minutes;
                }

                if (seconds < 10) {
                    seconds = '0' + seconds;
                }

                document.getElementById("listening").innerHTML = minutes + ":" + seconds;
  
                countListening += 1000;
    
                if (distance < 1) {
                    clearInterval(listening);
                }
            }, 1000);
        }, countdownReading);
        
    </script>
@endsection
