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
        var hinhanhdung=0;
        var tonganh=0;

        function getHinh(matest) {
            // console.log(macongcu);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/TestMuMau/ChuyenAnhTest',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    matest: matest,
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    if (data.status == 'success') {
                        $('#hienhinhanh_test').replaceWith(data.hienhinhanh);
                        $('#matest').val(data.model.matest);
                    }
                },
                // error: function (message) {
                //     toastr.error(message, 'Lỗi!');
                // }
            });
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

        function KiemTra() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var dapan=$('#dapan').val();
            var matest=$('#matest').val();
            $.ajax({
                url: '/TestMuMau/KiemTra',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    matest: matest,
                    dapan:dapan
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    if (data == 'correct') {
                        hinhanhdung++;
                        tonganh++;
                        swal.fire({
		                text: "Chính xác",
		                icon: "success",
		                buttonsStyling: false,
		                confirmButtonText: "OK",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            })
                    }
                    if (data == 'fail') {
                        tonganh++;
                        swal.fire({
		                text: "Sai rồi",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "OK",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}

		            })
                    }
                    HinhTiep();
                    var ketqua='<h3 id="ketqua">Kết quả đúng: '+hinhanhdung+'/'+ tonganh+'</h3>';
                    $('#dapan').val('');
                    $('#ketqua').replaceWith(ketqua);
                },
                // error: function (message) {
                //     toastr.error(message, 'Lỗi!');
                // }
            });
        }
    </script>
@stop
@section('content_thivong2')

    <input type="hidden" name='matest' id="matest" value="{{ $model_ct->matest ?? '' }}">

    <button class="btn btn-success mr-3 mt-4 ml-3" onclick="HinhTiep()">Hình tiếp theo</button>
    <div class="col-lg-12 text-center mt-3 mb-1" id="hienhinhanh_test">
        <img class="mt-3 mb-2" style="border-radius:5px;" width="40%" id='image_test' src="{{ asset($model_ct->hinhanh) }}"
            alt="">
    </div>
    <div class="d-flex col-lg-12">
        <input type="text" name='dapan' id='dapan' placeholder="Nhập số bạn thấy" class="form-control col-lg-6 mt-4 mb-4">
        <button class="btn btn-success col-lg-6 mr-3 mt-4 mb-4" onclick="KiemTra()">Kiểm tra</button>
    </div>
    <div class="text-center">
        <h3 id='ketqua'></h3>
    </div>



    <div class="disable">
        <div class="p-0 m-0" style="max-height: 600px; overflow: scroll;">
            @foreach ($model as $key => $ct)
                <li class="question-item border-bottom border-warning text-dl text-start list-unstyled"
                    data-code="{{ $ct->matest }}" data-index="{{ $key }}">
                    <button class="text-dl btn p-0 text-start m-0"><span class="btn text-dl text-start ps-0 pe-0">
                            <span class="fw-bold text-primary">{{ $ct->dapan }}</span><br></span></button>
                </li>
            @endforeach

        </div>
    </div>
@stop
