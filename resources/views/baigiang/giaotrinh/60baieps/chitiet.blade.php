@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
        <style>
            .ml-3{
                width: 10%;

            }
            .btn{
                width: 100%;
            }
        </style>
@stop

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>

    <script src="{{ url('assets/admin/pages/scripts/table-lifesc.js') }}"></script>
    <script src="{{url('js/custome-form.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
        });

        function clickChonLoai(e,phanloai){
        // console.log($(this).val());
            $('.row').find('.btn-warning').removeClass('btn-warning').addClass('btn-primary');
            $(e).addClass('btn-warning').removeClass('btn-primary');

            var baihocchinh=$('.baihocchinh').hasClass('d-none');
            var tuvung=$('.tuvung').hasClass('d-none');
            var tracnghiem=$('.tracnghiem').hasClass('d-none');
            var hinhanh=$('.hinhanh').hasClass('d-none');
            
            if(!baihocchinh){
                $('.baihocchinh').addClass('d-none');
            }
            if(!tuvung){
                $('.tuvung').addClass('d-none');
            }
            if(!tracnghiem){
                $('.tracnghiem').addClass('d-none');
            }
            if(!hinhanh){
                $('.hinhanh').addClass('d-none');
            }

            $('.'+phanloai).removeClass('d-none');

    }
    </script>
@stop
@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Example-->
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header card-header-tabs-line">
                    <div class="card-title">
                        <h3 class="card-label text-uppercase">{{$model->tenbaihoc}}</h3>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row" style="align-items: center;justify-content: center;">
                        <div class="ml-3">
                            <button class="btn btn-sm btn-warning btn-square" onclick="clickChonLoai(this,'baihocchinh')">BÀI HỌC CHÍNH</button>
                        </div>
                        <div class=" ml-3">
                            <button class="btn btn-sm btn-primary btn-square" onclick="clickChonLoai(this,'tuvung')">TỪ VỰNG</button>
                        </div>
                        <div class=" ml-3">
                            <button class="btn btn-sm btn-primary btn-square" onclick="clickChonLoai(this,'tracnghiem')">TRẮC NGHIỆM</button>
                        </div>
                        <div class=" ml-3">
                            <button class="btn btn-sm btn-primary btn-square" onclick="clickChonLoai(this,'hinhanh')">HÌNH ẢNH</button>
                        </div>

                    </div>
                        <div class="baihocchinh">
                            <div class="box_dark">
                            <iframe width="100%" height="720" src="https://www.youtube.com/embed/ewKUARpZ2Tw?list=PLbE1A9P3lz9zki9ehzjGyc2HIaGwd6jlV" title="Bài 2.1:  PATCHIM VÀ PHÁT ÂM TRONG TIẾNG HÀN" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen"></iframe>
                            <p class="mt-5 text-center">Link youtube</p>
                            </div>
                            <div class="box_dark">
                            <video controls width="100%">
                                <source src="{{'/uploads/2.1.mp4'}}">
                            </video>
                            <p class="mt-5 mb-5 text-center">Link local</p>
                            </div>
                            @for ($i=1;$i<=$trang;$i++)
                            <?php $a_baihocchinh=$m_baihocchinh->where('stt',$i); ?>
                            @foreach ($a_baihocchinh as $ct )
                            <div class="box_dark">
                                <p><img style="width:100%" src="{{url($ct->anh)}}"></p>
                                @if ($ct->audio != null)
                                <p style="background-color: #fef4eb; text-align: center; margin: -27px 0px 0px 0px;"><br><audio title="Nghe K-4" controls="controls"><source src="{{asset($ct->audio)}}"></audio></p>       
                                @endif
                                @if ($ct->anh2 != null)
                                <p><img style="width:100%" src="{{url($ct->anh2)}}"></p>  
                                @endif
                                
                                </div>
                            @endforeach
                        @endfor
                        </div>
                        <div class=" tuvung d-none">

                        </div>
                        <div class="tracnghiem d-none">

                        </div>
                        <div class="hinhanh d-none">

                        </div>

                </div>
            </div>
        </div>
        <!--end::Card-->
        <!--end::Example-->
    </div>
    <!--end::Row-->
@stop
