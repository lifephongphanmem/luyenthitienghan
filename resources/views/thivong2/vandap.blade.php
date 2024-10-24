@extends('thivong2.thivong2')
@section('content_thivong2')
    <audio src="" id="audio"></audio>
    <div class="col-lg-12 text-center text-warning">
        <h1>Vấn đáp</h1>
    </div>
    <div class="col-lg-12 text-center mt-1 mb-1 bg-gray-800" style="border-radius:5px;" id="hienchu">
        <img class="mt-1 mb-2" id='image'  src="{{ asset('images/icons/loading.gif') }}" alt="" style="filter: invert(1) hue-rotate(180deg) saturate(200%)">
        <h5 id="text-hiden" class="text-center align-middle bg-gray-800 fw-bold p-3 ps-3 pe-3 m-0 text-logo-y text-warning disable"
            style="border-bottom-left-radius:0;border-bottom-right-radius:0;font-size:2rem">나이가 어떻게 되세요?<br><span
                class="text-light ps-0 pe-0 fs-5">Bạn bao nhiêu tuổi?</span><br><span
                class="btn text-light ps-0 pe-0 fs-5"><b class="text-warning">T.lời mẫu:</b> 저는 (서른 여섯) 살입니다.</span></h5>
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
        <buton class="btn btn-primary ml-2 mt-2" style="width:49.5%">Nghe lại</buton>
    </div>
    <div class="col-lg-12 text-center mt-2 p-0">
        <buton class="btn btn-info" style="width:100%" onclick="HienCauHoi()">Hiện toàn bộ câu hỏi</buton>

    </div>

    <div class="disable" id="cauhoi">
        <div class="p-0 m-0" style="max-height: 600px; overflow: scroll;">
            <li class="border-bottom border-warning text-dl text-start list-unstyled"><button
                    class="text-dl btn p-0 text-start m-0"><span class="btn text-dl text-start ps-0 pe-0"><span
                            class="text-danger" style="font-size: 1.2rem;">01. </span><span class="fw-bold text-primary">이름이
                            뭐 예요?</span><br></span></button></li>
            <li class="border-bottom border-warning text-dl text-start list-unstyled"><button
                    class="text-dl btn p-0 text-start m-0"><span class="btn text-dl text-start ps-0 pe-0"><span
                            class="text-danger" style="font-size: 1.2rem;">02. </span><span class="fw-bold text-primary">나이가
                            어떻게 되세요?</span><br></span></button></li>

        </div>
    </div>


@stop
