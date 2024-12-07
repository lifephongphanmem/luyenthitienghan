@extends('thivong2.thivong2')
@section('content_thivong2')
    <audio src="" id="audio"></audio>
    {{-- <audio title="Nghe" controls="controls" style="width:103px" autoplay>
        <source src="{{'/data/vandap/audio/17298183631.mp3'}}">
    </audio> --}}
    <div class="col-lg-12 text-center text-warning mt-4">
        <h1>{{$a_phanloai[$inputs['phanloai']]}}</h1>
    </div>
    <div class="d-flex justify-content-center align-items-center text-center mr-3 ml-3 mt-4 mb-1 bg-gray-800" style="border-radius:5px;" id="hienchu">
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
        <button class="btn btn-success mr-3 ml-3 mt-4" style="width:49.5%" onclick="HienChu()">Hiện chữ</button>
        <button class="btn btn-success ml-3 mr-3 mt-4" style="width:49.5%" onclick="location.reload()">Khởi động lại</button>
    </div>
    <div class="d-flex">
        <button class="btn btn-primary mr-3 ml-3 mt-4 stop" style="width:49.5%" onclick="PlayQuest_Order()">Tự động theo thứ tự</button>
        <button class="btn btn-primary mr-3 ml-3 mt-4 stop" type='button' style="width:49.5%" onclick="PlayQuest_Random()" id="randomButton">Tự động ngẫu nhiên</button>
    </div>
    <div class="d-flex">
        <button class="btn btn-primary mr-3 ml-3 mt-4" style="width:49.5%" onclick="Handle_Question()">Thủ công theo thứ tự
        </button>
        <button class="btn btn-primary mr-3 ml-3 mt-4" style="width:49.5%" onclick="Handle_Question_Random()">Thủ công ngẫu nhiên
        </button>
    </div>
    <div class="d-flex">
        <button class="btn btn-primary mr-3 ml-3 mt-4" style="width:49.5%" onclick="stop()" id='stop'>Dừng</button>
        <button class="btn btn-primary mr-3 ml-3 mt-4" style="width:49.5%" onclick="NgheLai()">Nghe lại</button>
    </div>
    <div class="d-flex text-center mr-3 ml-3 mt-4 p-0">
        <button class="btn btn-info" style="width:100%" onclick="HienCauHoi()">Hiện toàn bộ câu hỏi</button>

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
@stop
