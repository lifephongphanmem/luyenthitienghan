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
    <div class="d-flex">
        <buton class="btn btn-success mr-2 mt-2" style="width:49.5%" onclick="HienChu()">Hiện chữ</buton>
        <buton class="btn btn-success ml-2 mt-2" style="width:49.5%">Khởi động lại</buton>
    </div>
    <div class="d-flex">
        <buton class="btn btn-primary mr-2 mt-2" style="width:49.5%">Tự động theo thứ tự</buton>
        <buton class="btn btn-primary ml-2 mt-2" style="width:49.5%">Tự động ngẫu nhiên</buton>
    </div>
    <div class="d-flex">
        <buton class="btn btn-primary mr-2 mt-2" style="width:49.5%">Thủ công theo thứ tự</buton>
        <buton class="btn btn-primary ml-2 mt-2" style="width:49.5%">Thủ công ngẫu nhiên</buton>
    </div>
    <div class="d-flex">
        <buton class="btn btn-primary mr-2 mt-2" style="width:49.5%">Dừng</buton>
        <buton class="btn btn-primary ml-2 mt-2" style="width:49.5%" onclick="NgheLai()">Nghe lại</buton>
    </div>
    <div class="col-lg-12 text-center mt-2 p-0">
        <buton class="btn btn-info" style="width:100%" onclick="HienCauHoi()">Hiện toàn bộ câu hỏi</buton>

    </div>
    <?php $i = 1; ?>
    <div class="disable" id="cauhoi">
        <div class="p-0 m-0" style="max-height: 600px; overflow: scroll;" id="cauhoict">
            @foreach ($model as $key => $ct)
                <li class="border-bottom border-warning text-dl text-start list-unstyled" data-code="{{ $ct->macau }}" data-index="{{ $key }}">
                    <button class="text-dl btn p-0 text-start m-0"><span class="btn text-dl text-start ps-0 pe-0"><span
                                class="text-danger" style="font-size: 1.2rem;">{{ $i++ }}. </span><span
                                class="fw-bold text-primary">{{ $ct->noidung }}</span><br></span></button>
                </li>
            @endforeach

        </div>
    </div>

    <script>
        const soundEffect = new Audio();

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
        //Hàm tự động
        function PlayAudio() {

        }

        function NgheLai() {
            var src = $("#audio").attr("src");
            if (src != '') {
                soundEffect.src = src;
                soundEffect.play();
            }

        }

        function setcauhoi(phanloai) {
            //Tự động thứ tự:1;tự động ngẫu nhiên:2; thủ công thứ tự:3; thủ công ngẫu nhiên:4
            //trường hợp thủ công

        }

        function moveToBottom(element) {
            // 1. Xác định phần tử cha (danh sách chứa các phần tử li)
            const parent = document.getElementById("cauhoict");
            // console.log(element);
            // 2. Thêm phần tử được nhấp xuống cuối danh sách
            parent.appendChild(element);
            const listItems = parent.querySelectorAll("li");
        }
    </script>
@stop
