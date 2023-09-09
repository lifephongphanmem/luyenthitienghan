@extends('main')
@section('custom-style')
    <style>

    </style>
@endsection

@section('custom-script')
    <script>
        function oninputhoten() {
            if (document.getElementById('hoten').value == '') {
                document.getElementById('error-hoten').innerHTML = 'Xin mời nhập thông tin!';
            } else {
                document.getElementById('error-hoten').innerHTML = '';
            }
        }

        function oninputngaythi() {
            if (document.getElementById('ngaythi').value == '') {
                document.getElementById('error-ngaythi').innerHTML = 'Xin mời nhập ngày thi!';
            } else {
                document.getElementById('error-ngaythi').innerHTML = '';
            }
        }

        function changePhanloai() {
            var phanloai = document.getElementById('phanloai');

            if (phanloai.options[phanloai.selectedIndex].value == 'giaovien') {
                document.getElementById('btn-ketquathi').setAttribute('disabled', '');
                document.getElementById('ngaythi').setAttribute('disabled', '');
            } else {
                document.getElementById('btn-ketquathi').removeAttribute('disabled');
                document.getElementById('ngaythi').removeAttribute('disabled');
            }
        }

        function chinhsuabtn() {
            document.getElementById('xacnhantuychinhbtn').removeAttribute('data-dismiss');
        }

        function tatcaopt() {
            if (document.getElementById('tatca').checked) {
                document.getElementById('lonhon').checked = false;
                document.getElementById('lonhoninput').setAttribute('disabled', '');

                document.getElementById('nhohon').checked = false;
                document.getElementById('nhohoninput').setAttribute('disabled', '');
            } else if (!document.getElementById('lonhon').checked && !document.getElementById('nhohon').checked) {
                document.getElementById('tatca').checked = !document.getElementById('tatca').checked;
            }
        }

        function tuychinhopt() {
            if (document.getElementById('lonhon').checked && document.getElementById('nhohon').checked) {
                document.getElementById('tatca').checked = false;
                document.getElementById('lonhoninput').removeAttribute('disabled');
                document.getElementById('nhohoninput').removeAttribute('disabled');
            } else if (!document.getElementById('lonhon').checked && document.getElementById('nhohon').checked) {
                document.getElementById('tatca').checked = false;
                document.getElementById('lonhoninput').setAttribute('disabled', '');
                document.getElementById('nhohoninput').removeAttribute('disabled');
                document.getElementById('error-lonhon').innerHTML = '';
            } else if (document.getElementById('lonhon').checked && !document.getElementById('nhohon').checked) {
                document.getElementById('tatca').checked = false;
                document.getElementById('lonhoninput').removeAttribute('disabled');
                document.getElementById('nhohoninput').setAttribute('disabled', '');
                document.getElementById('error-nhohon').innerHTML = '';
            } else if (!document.getElementById('lonhon').checked && !document.getElementById('nhohon').checked) {
                document.getElementById('tatca').checked = true;
                document.getElementById('lonhoninput').setAttribute('disabled', '');
                document.getElementById('nhohoninput').setAttribute('disabled', '');
                document.getElementById('error-lonhon').innerHTML = '';
                document.getElementById('error-nhohon').innerHTML = '';
            }
        }

        function oninputlonhoninput() {
            if (document.getElementById('lonhon').checked) {
                if (document.getElementById('lonhoninput').value == '') {
                    document.getElementById('error-lonhon').innerHTML = 'Xin mời nhập giá trị!';
                } else {
                    document.getElementById('error-lonhon').innerHTML = '';
                }
            }
        }

        function oninputnhohoninput() {
            if (document.getElementById('nhohon').checked) {
                if (document.getElementById('nhohoninput').value == '') {
                    document.getElementById('error-nhohon').innerHTML = 'Xin mời nhập giá trị!';
                } else {
                    document.getElementById('error-nhohon').innerHTML = '';
                }
            }
        }

        function xacnhantuychinh() {
            if (document.getElementById('tatca').checked) {
                document.getElementById('text-ketquathi').value = 'Tất cả';
                document.getElementById('xacnhantuychinhbtn').setAttribute('data-dismiss', 'modal');
            } else if (document.getElementById('lonhon').checked && !document.getElementById('nhohon').checked) {
                if (document.getElementById('lonhoninput').value == '') {
                    document.getElementById('error-lonhon').innerHTML = 'Xin mời nhập giá trị';
                } else {
                    document.getElementById('error-lonhon').innerHTML = '';
                    document.getElementById('text-ketquathi').value = 'Lớn hơn hoặc bằng ' + document.getElementById('lonhoninput')
                        .value;
                    document.getElementById('xacnhantuychinhbtn').setAttribute('data-dismiss', 'modal');
                }
            } else if (!document.getElementById('lonhon').checked && document.getElementById('nhohon').checked) {
                if (document.getElementById('nhohoninput').value == '') {
                    document.getElementById('error-nhohon').innerHTML = 'Xin mời nhập giá trị';
                } else {
                    document.getElementById('error-nhohon').innerHTML = '';
                    document.getElementById('text-ketquathi').value = 'Nhỏ hơn hoặc bằng ' + document.getElementById('nhohoninput')
                        .value;
                    document.getElementById('xacnhantuychinhbtn').setAttribute('data-dismiss', 'modal');
                }
            } else if (document.getElementById('lonhon').checked && document.getElementById('nhohon').checked) {
                if (document.getElementById('lonhoninput').value == '' && document.getElementById('nhohoninput').value ==
                    '') {
                    document.getElementById('error-lonhon').innerHTML = 'Xin mời nhập giá trị';
                    document.getElementById('error-nhohon').innerHTML = 'Xin mời nhập giá trị';
                } else if (document.getElementById('lonhoninput').value == '') {
                    document.getElementById('error-lonhon').innerHTML = 'Xin mời nhập giá trị';
                } else if (document.getElementById('nhohoninput').value == '') {
                    document.getElementById('error-nhohon').innerHTML = 'Xin mời nhập giá trị';
                } else {
                    document.getElementById('error-lonhon').innerHTML = '';
                    document.getElementById('error-nhohon').innerHTML = '';
                    document.getElementById('text-ketquathi').value = 'Lớn hơn hoặc bằng ' + document.getElementById('lonhoninput')
                        .value + ' và nhỏ hơn hoặc bằng ' + document.getElementById('nhohoninput').value;
                    document.getElementById('xacnhantuychinhbtn').setAttribute('data-dismiss', 'modal');
                }
            }
        }

        function validate() {
            

            return true;
        }
    </script>
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header card-header-tabs-line">
            <div class="card-title">
                <h3 class="card-label text-uppercase">Thông tin tra cứu</h3>
            </div>
            <div class="card-toolbar">

            </div>
        </div>
        <div class="card-body">
            <form action="{{ '/TraCuu/KetQua' }}" target="_blank" method="POST" onsubmit="return(validate());">
                @csrf
                <div class="d-flex">
                    <div class="col-6">
                        <label class="control-label">Họ tên:{{-- <b class="text-danger"> *</b> --}}</label>
                        <div class="d-flex">
                            <input class="form-control" type="text" id="hoten" name="hoten" style="width: 70%"
                                {{-- oninput="oninputhoten()" --}}>
                            <div id="error-hoten" class="text-danger align-self-center pl-2" style="width: 30%"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="control-label">Phân loại:</label>
                        @if ($loaitaikhoan == 'hethong')
                            <select id="phanloai" name="phanloai" class="form-control" onchange="changePhanloai()"
                                style="width: 70%">
                                <option value="tatca" selected>Tất cả</option>
                                <option value="hocvien">Học viên</option>
                                <option value="giaovien">Giáo viên</option>
                            </select>
                        @elseif($loaitaikhoan == 'giaovien')
                            <select id="phanloai-disabled" name="phanloai-disabled" class="form-control"
                                onchange="changePhanloai()" style="width: 70%" disabled>
                                <option value="hocvien" selected>Học viên</option>
                            </select>
                            <input type="hidden" id="phanloai" name="phanloai" value="hocvien">
                        @endif
                    </div>
                </div>
                <div class="d-flex pt-3">
                    <div class="col-6">
                        <label id="ngaythi-label" class="control-label">Ngày thi:</label>
                        <div class="d-flex">
                            <input class="form-control" type="date" id="ngaythi" name="ngaythi" style="width: 70%">
                            <div id="error-ngaythi" class="text-danger align-self-center pl-2" style="width: 30%"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="control-label">Kết quả thi thử:</label>
                        <div class="d-flex">
                            <input class="form-control" id="text-ketquathi" value="Tất cả" style="width: 70%" disabled>
                            <button type="button" class="btn btn-outline-primary ml-4" id="btn-ketquathi"
                                data-target="#modal-ketquathithu" data-toggle="modal" onclick="chinhsuabtn()">Chỉnh
                                sửa</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex pt-3">
                    <div class="col-6">
                        <label class="control-label">Lớp:</label>
                        <input class="form-control" type="text" id="lophoc" name="lophoc" style="width: 70%">
                    </div>
                </div>
                <div class="text-center pt-5"><button type="submit" class="btn btn-primary">Tra cứu</button></div>
                <div id="modal-ketquathithu" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header modal-header-primary">
                                <h4 id="modal-header-primary-label" class="modal-title">Tuỳ chỉnh mốc điểm kết quả thi
                                    thử
                                </h4>
                                <button type="button" data-dismiss="modal" aria-hidden="true"
                                    class="close">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="tatca"
                                                name="tatcaoption" value="tatca" onchange="tatcaopt()" checked>
                                            <label class="form-check-label" for="tatca">Tất cả</label>
                                        </div>
                                        <div class="form-check d-flex">
                                            <div class="col-4 p-0 align-self-center">
                                                <input type="checkbox" class="form-check-input" id="lonhon"
                                                    name="lonhonoption" value="lonhon" onchange="tuychinhopt()">
                                                <label class="form-check-label" for="lonhon">Lớn hơn hoặc bằng</label>
                                            </div>
                                            <div class="col-8 p-0">
                                                <input type="number" class="form-control" id="lonhoninput"
                                                    name="lonhonvalue" oninput="oninputlonhoninput()" disabled>
                                            </div>
                                        </div>
                                        <div class="d-flex pb-2">
                                            <div class="col-4 p-0"></div>
                                            <div id="error-lonhon" class="col-10 text-danger"></div>
                                        </div>
                                        <div class="form-check d-flex">
                                            <div class="col-4 p-0 align-self-center">
                                                <input type="checkbox" class="form-check-input" id="nhohon"
                                                    name="nhohonoption" value="nhohon" onchange="tuychinhopt()">
                                                <label class="form-check-label" for="nhohon">Nhỏ hơn hoặc bằng</label>
                                            </div>
                                            <div class="col-8 p-0">
                                                <input type="number" class="form-control" id="nhohoninput"
                                                    name="nhohonvalue" oninput="oninputnhohoninput()" disabled>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="col-4 p-0"></div>
                                            <div id="error-nhohon" class="col-10 text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao
                                    tác</button>
                                <button type="button" class="btn btn-primary" id="xacnhantuychinhbtn"
                                    onclick="xacnhantuychinh()">Đồng ý</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
