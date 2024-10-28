@extends('thivong2.thivong2')
@section('content_thivong2')
    <audio src="" id="audio"></audio>
    {{-- <audio title="Nghe" controls="controls" style="width:103px" autoplay>
        <source src="{{'/data/vandap/audio/17298183631.mp3'}}">
    </audio> --}}
    <div class="col-lg-12 text-center text-warning">
        <h1>Vấn đáp</h1>
    </div>
    <div class="col-lg-12 text-center mt-1 mb-1 bg-gray-800" style="border-radius:5px;" id="hienchu">
        <img class="mt-1 mb-2" id='image' src="{{ asset('images/icons/loading.gif') }}" alt=""
            style="filter: invert(1) hue-rotate(180deg) saturate(200%)">
        <div id="hidden_view" class="disable">
            <h5 id="text-hidden"
                class="text-center align-middle bg-gray-800 fw-bold p-3 ps-3 pe-3 m-0 text-logo-y text-warning"
                style="border-bottom-left-radius:0;border-bottom-right-radius:0;font-size:2rem">Chưa chọn hoặc đã kết thúc
                câu hỏi
            </h5>
        </div>

    </div>
    <div class="btn btn-success" disabled="disabled" onclick="Test()">click</div>
    <div class="d-flex">
        <buton class="btn btn-success mr-2 mt-2" style="width:49.5%" onclick="HienChu()">Hiện chữ</buton>
        <buton class="btn btn-success ml-2 mt-2" style="width:49.5%" onclick="location.reload()">Khởi động lại</buton>
    </div>
    <div class="d-flex">
        <buton class="btn btn-primary mr-2 mt-2" style="width:49.5%" onclick="PlayQuest_Order()">Tự động theo thứ tự</buton>
        <buton class="btn btn-primary ml-2 mt-2" type='button' style="width:49.5%" onclick="PlayQuest_Random()" id="randomButton">Tự động ngẫu nhiên</buton>
    </div>
    <div class="d-flex">
        <buton class="btn btn-primary mr-2 mt-2" style="width:49.5%" onclick="Handle_Question()">Thủ công theo thứ tự
        </buton>
        <buton class="btn btn-primary ml-2 mt-2" style="width:49.5%" onclick="Handle_Question_Random()">Thủ công ngẫu nhiên
        </buton>
    </div>
    <div class="d-flex">
        <buton class="btn btn-primary mr-2 mt-2" style="width:49.5%" onclick="stop()">Dừng</buton>
        <buton class="btn btn-primary ml-2 mt-2" style="width:49.5%" onclick="NgheLai()">Nghe lại</buton>
    </div>
    <div class="col-lg-12 text-center mt-2 p-0">
        <buton class="btn btn-info" style="width:100%" onclick="HienCauHoi()">Hiện toàn bộ câu hỏi</buton>

    </div>
    <?php $i = 1; ?>
    <div class="disable" id="cauhoi">
        <div class="p-0 m-0" style="max-height: 600px; overflow: scroll;" id="cauhoict">
            @foreach ($model as $key => $ct)
                <li class="question-item border-bottom border-warning text-dl text-start list-unstyled"
                    data-code="{{ $ct->macau }}" data-index="{{ $key }}">
                    <button class="text-dl btn p-0 text-start m-0"><span class="btn text-dl text-start ps-0 pe-0"><span
                                class="text-danger" style="font-size: 1.2rem;">{{ $i++ }}. </span><span
                                class="fw-bold text-primary">{{ $ct->noidung }}</span><br></span></button>
                </li>
            @endforeach

        </div>
    </div>

    <script>
        function Test(){
            console.log(123);
        }
        const soundEffect = new Audio();
        var isPlaying = true;
        var index = 0;
        var a_index;
        var index_handel = 0;

        function getcauhoi(macau) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/epstopik-test/getCauHoi',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    macau: macau,
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    $("#audio").attr("src", data.model.audio);
                    soundEffect.src = data.model.audio;
                    soundEffect.play();
                    $('#text-hidden').replaceWith(data.message);
                },
                // error: function (message) {
                //     toastr.error(message, 'Lỗi!');
                // }
            });
        }
        $('.list-unstyled').on('click', function() {
            var macau = $(this).data('code');
            getcauhoi(macau);
            moveToBottom(this);
        })

        function NgheLai() {
            var src = $("#audio").attr("src");
            if (src != '') {
                soundEffect.src = src;
                soundEffect.play();
            }

        }

        function moveToBottom(element) {
            // 1. Xác định phần tử cha (danh sách chứa các phần tử li)
            const parent = document.getElementById("cauhoict");
            // console.log(element);
            // 2. Thêm phần tử được nhấp xuống cuối danh sách
            parent.appendChild(element);
            const listItems = parent.querySelectorAll("li");
        }

        //Hàm tự động thứ tự
        function PlayQuest_Order() {
            const questions = document.querySelectorAll('.question-item');
            // return
            if (!isPlaying) {
                return;
            }
            // console.log(index);
            if (index == questions.length) {
                index = 0;
                return;
            }
            if (index < questions.length) {
                const dataCode = questions[0].dataset.code;
                getcauhoi(dataCode);
                moveToBottom(questions[0])
                index++;
            }

            setTimeout('PlayQuest_Order()', 5000);
        }

        //Hàm tự động ngẫu nhiên
        function PlayQuest_Random() {
            $('#randomButton').attr('disabled', true);
            const questions = document.querySelectorAll('.question-item');
            if (!isPlaying) {
                return;
            }
            if (!a_index) {
                a_index = getConsecutiveNumbers(0, questions.length - 1)
            }
            console.log(a_index);
            if (a_index.length > 0) {
                const randomIndex = Math.floor(Math.random() * a_index.length);
                index = a_index[randomIndex];
                if (index < questions.length) {
                    const dataCode = questions[index].dataset.code;
                    getcauhoi(dataCode);
                    a_index = a_index.filter(item => item !== index);
                }

            } else {
                return;
            }
            setTimeout('PlayQuest_Random()', 3000);
        }

        //Hàm thủ công thứ tự
        function Handle_Question() {
            const questions = document.querySelectorAll('.question-item');
            if (index < questions.length) {
                const dataCode = questions[index].dataset.code;
                getcauhoi(dataCode);
                moveToBottom(questions[index])
                index_handel++;
            }
        }

        //Hàm thủ công ngẫu nhiên
        var a_index_handle;

        function Handle_Question_Random() {
            const questions = document.querySelectorAll('.question-item');
            if ((a_index_handle == [])) {
                console.log('11')
            }
            if (!a_index_handle || a_index_handle == '') {
                a_index_handle = getConsecutiveNumbers(0, questions.length - 1)
            }
            const randomIndex = Math.floor(Math.random() * a_index_handle.length);
            index = a_index_handle[randomIndex];
            if (index < questions.length) {
                const dataCode = questions[index].dataset.code;
                getcauhoi(dataCode);
                a_index_handle = a_index_handle.filter(item => item !== index);
            }

        }

        function stop() {
            isPlaying = !isPlaying;
        }

        function getConsecutiveNumbers(start, end) {
            // Khởi tạo mảng để chứa các số liên tiếp
            const numbers = [];

            // Duyệt từ số bắt đầu đến số kết thúc
            for (i = start; i <= end; i++) {
                numbers.push(i); // Thêm số vào mảng
            }

            return numbers; // Trả về mảng các số liên tiếp
        }

        function getRandomNumber(min, max) {
            // Lấy số ngẫu nhiên trong khoảng [min, max]
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
        function HienCauHoi() {
            if ($('#cauhoi').hasClass('disable')) {
                $('#cauhoi').removeClass('disable');
                $(event.target).text('Ẩn toàn bộ câu hỏi');
            } else {
                $('#cauhoi').addClass('disable');
                $(event.target).text('Hiện toàn bộ câu hỏi');
            }
        }

        function HienChu() {
            // var buttonText = $(event.target).text('Ẩn chữ');
            // console.log(buttonText);  
            if ($('#image').hasClass('disable')) {
                // console.log(1);
                $('#image').removeClass('disable');
                $('#hidden_view').addClass('disable');
                $(event.target).text('Hiện chữ');
            } else {
                // console.log(2);
                $('#hidden_view').removeClass('disable');
                $('#image').addClass('disable');
                $(event.target).text('Ẩn chữ');
            }
        }
    </script>
@stop
