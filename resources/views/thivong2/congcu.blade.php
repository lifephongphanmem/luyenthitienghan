@extends('thivong2.thivong2')
@section('custom-style')
    <style>
        .congcu {
            background-color: rgba(108, 117, 125, 0.25)
        }

        .disable {
            display: none;
        }
    </style>
@stop
@section('custom-script')
    <script>
        var count = 0;
        var index = 1;

        function getHinh(macongcu) {
            // console.log(macongcu);
            var phanloai = $('#phanloaicongcu').val();
            var hiennghia = $('#hiennghia').hasClass('disable') ? 1 : 0;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/CongCu/ChuyenHinhAnh',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    count: count,
                    phanloai: phanloai,
                    macongcu: macongcu,
                    hiennghia: hiennghia
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    if (data.status == 'success') {
                        $('#hienhinhanh').replaceWith(data.hienhinhanh);
                        $('#hiennghia').replaceWith(data.hiennghia);
                        $('#phanloaicongcu').val(data.model.phanloai);
                        $('#macongcu').val(data.model.macongcu);
                    }
                },
                // error: function (message) {
                //     toastr.error(message, 'Lỗi!');
                // }
            });
        }

        function HienNghia() {
            if ($('#hiennghia').hasClass('disable')) {
                $('#hiennghia').removeClass('disable');
                $(event.target).text('Ẩn nghĩa');
            } else {
                $('#hiennghia').addClass('disable');
                $(event.target).text('Hiện nghĩa');
            }
        }

        function HinhTiep() {
            const questions = document.querySelectorAll('.question-item');

            if (questions.length > 0) {
                const dataCode = questions[0].dataset.code;

                getHinh(dataCode);
                const li = document.querySelector('li[data-code="' + dataCode + '"]');
                if (li) {
                    li.remove();
                }
            } else {
                alert('Đã hết hình ảnh');
            }

        }
    </script>
@stop
@section('content_thivong2')
    @if (!isset($model_ct))
    <div class="d-flex justify-content-center align-items-center text-center mr-3 ml-3 mt-4 mb-1 bg-gray-800" style="border-radius:5px;" id="hienchu">
        {{-- <img class="mt-1 mb-2" id="image" src="http://luyenthitienghan.local/images/icons/loading.gif" alt="" style="filter: invert(1) hue-rotate(180deg) saturate(200%)"> --}}
        <div id="hidden_view">
            <h5 id="text-hidden" class="text-center align-middle bg-gray-800 fw-bold p-3 ps-3 pe-3 m-0 text-logo-y text-warning" style="border-bottom-left-radius:0;border-bottom-right-radius:0;font-size:2rem">Chưa có hình ảnh
            </h5>
        </div>

    </div>
    @else
        <input type="hidden" name='phanloaicongcu' id="phanloaicongcu" value="{{ $model_ct->phanloai ?? '' }}">
        <input type="hidden" name='macongcu' id="macongcu" value="{{ $model_ct->macongcu ?? '' }}">
        <div class="d-flex">
            <button class="btn btn-success mr-3 mt-4 ml-3" style="width:49.5%" onclick="HinhTiep()">Hình tiếp theo</button>
            <button class="btn btn-success mr-3 mt-4 ml-3" style="width:49.5%" onclick="HienNghia()">Hiện nghĩa</button>
        </div>
        <div class="col-lg-12 text-center mt-1 mb-1" id="hienhinhanh">
            <img class="mt-1 mb-2" style="border-radius:5px;" id='image_congcu' src="{{ asset($model_ct->hinhanh) }}"
                alt="">
        </div>
        <div class="col-lg-12 text-center mt-1 mb-1 disable" id="hiennghia">
            <p class="text-center" style="color: #517ca4;font-size:16px;font-weight:600">{{ $model_ct->tiengHan }}</p>
            <p class="text-center text-dark" style="font-size:14px;font-weight:600">{{ $model_ct->tencongcu }}</p>
        </div>
    @endif


    <div class="disable">
        <div class="p-0 m-0" style="max-height: 600px; overflow: scroll;">
            @foreach ($model as $key => $ct)
                <li class="question-item border-bottom border-warning text-dl text-start list-unstyled"
                    data-code="{{ $ct->macongcu }}" data-index="{{ $key }}">
                    <button class="text-dl btn p-0 text-start m-0"><span class="btn text-dl text-start ps-0 pe-0">
                            <span class="fw-bold text-primary">{{ $ct->tencongcu }}</span><br></span></button>
                </li>
            @endforeach

        </div>
    </div>
@stop
