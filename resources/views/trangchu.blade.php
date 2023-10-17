@extends('main')
@section('custom-style')
    <style>
        h2.main-heading {
            width: 100%;
            text-align: center;
            margin-top: 25px;
        }

        h2.main-heading span {
            background: url(../../images/heading-bg.png) center bottom no-repeat;
            height: 40px;
            line-height: 40px;
            color: #27a4e0;
            font-size: 18px;
            display: inline-block;
            font-weight: 700;
        }

        #feature-list .feature .feature-icon {
            width: 88px;
            height: 88px;
            overflow: hidden;
            margin: 0 auto;
        }

        #feature-list {
            width: 100%;
            text-align: center;
        }

        #feature-list .feature {
            display: inline-block;
            width: 180px;
            padding: 0 10px;
            margin: 0 20px;
            margin-top: 50px;
        }

        #feature-list .feature .feature-icon {
            width: 88px;
            height: 88px;
            overflow: hidden;
            margin: 0 auto;
        }

        #feature-list .feature .feature-icon img {
            transition: all ease-in-out 0.2s;
            width: 88px;
            display: block;
        }

        #feature-list .feature:hover .feature-icon img {
            -webkit-transform: translateY(-88px);
            -ms-transform: translateY(-88px);
            transform: translateY(-88px);
        }

        #feature-list .feature h3.feature-heading {
            text-align: center;
            margin-top: 10px;
        }

        #feature-list .feature h3.feature-heading a {
            color: #247bd5;
            font-size: 15px;
            font-weight: 700;
        }

        #feature-list .feature .feature-des {
            text-align: center;
            color: #acacac;
            font-size: 11px;
            margin: 0 -15px;
            height: 56px;
            overflow: hidden;
        }

        #feature-list .feature .feature-readmore {
            color: #171717;
            font-size: 13px;
            border: 1px solid #171717;
            display: block;
            border-radius: 3px;
            width: 120px;
            height: 30px;
            line-height: 30px;
            margin: 0 auto;
            margin-top: 10px;
            font-weight: 400;
        }

        #feature-list .feature .feature-readmore:hover {
            color: #e02729;
            border-color: #e02729;
        }

        a {
            text-decoration: none !important;
            outline: none !important;
        }

        a {
            color: #337ab7;
            text-decoration: none;
        }

        a {
            background-color: transparent;
        }

        #feature-list .feature .feature-icon img {
            transition: all ease-in-out 0.2s;
            width: 88px;
            display: block;
        }

        #header-banner-slider {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        #header-banner-slider .owl-nav {
            display: none;
        }

        #header-banner-slider .owl-dots {
            position: absolute;
            width: 100%;
            height: 30px;
            line-height: 30px;
            bottom: 0;
            text-align: center;
        }

        #header-banner-slider .owl-dots .owl-dot {
            text-align: center;
            width: 12px;
            height: 12px;
            margin: 0 5px;
            background: rgba(232, 232, 232, 1.00);
            display: inline-block;
            border-radius: 50%;
        }

        #header-banner-slider .owl-dots .owl-dot.active {
            background: #fff;
            width: 15px;
            height: 15px;
        }

        #header-banner img {
            width: 100%;
        }

        h2.left-heading {
            background: url(../../images/heading-bg2.png) left bottom no-repeat;
            height: 40px;
            line-height: 40px;
            color: #e02729;
            font-size: 17px;
            font-weight: 700;
        }

        .normal-news {
            background: url(../../images/bullet.png) left 2px no-repeat;
            padding-left: 20px;
            padding-bottom: 10px;
            margin-top: 20px;
            border-bottom: 1px solid #f0f0f0;
        }

        .normal-news:last-child {
            border: none;
        }

        .normal-news .news-heading {
            font-size: 15px;
            color: #323232;
            font-weight: 500;
            line-height: 1.6rem;
        }

        .normal-news .news-heading:hover {
            color: #E02729;
        }

        .post-time {
            font-size: 11px;
            color: #acacac;
        }

        .news-des {
            color: #919191;
            display: -webkit-box;
            max-height: 3.2rem;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            -webkit-line-clamp: 2;
            line-height: 1.6rem;
        }

        .show-main-home.show-tintuc {
            padding: 40px 0px;
        }

        .show-main-home {
            width: 100%;
            float: left;
            padding-top: 40px;
        }
    </style>
@endsection
@section('banner')
    <div id="header-banner" class="div-group-content">
        <div class="collapse" style="float: right; height: auto; width: 100%; display: block;margin-top: 10px;">
            <div id="owl-baner" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
                <div class="owl-wrapper-outer">
                    <div class="owl-wrapper" style="width: 100%; left: 0px; display: block;">
                        <div class="owl-item" style="width: 100%;">
                            <div class="owl-item" style="width: 100%;">
                                <span><img class="img-banner img-responsive center-block"
                                        src="{{ url('/images/banner.jpg') }}"
                                        data-at2x="{{ url('/images/banner.jpg') }}"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-controls clickable" style="display: none;">
                    <div class="owl-pagination">
                        <div class="owl-page active"><span class=""></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="show-main-home show-icon-home">
        <h2 class="main-heading">
            <span style="text-transform: uppercase;">TRUNG TÂM DỊCH VỤ VIỆC LÀM QUẢNG BÌNH - CHẤT LƯỢNG LÀ HÀNG ĐẦU</span>
        </h2>
        <div id="feature-list">
            <div class="feature">
                <div class="feature-icon">
                    <a href="gioi-thieu"><img src="{{ url('/images/gioithieu.png') }}"></a>
                </div>
                <h3 class="feature-heading">
                    <a >Giới thiệu</a>
                </h3>
                <div class="feature-des">
                    Thông tin về Trung tâm, chất lượng và dịch vụ của chúng tôi.
                </div>
                {{-- <a class="feature-readmore" href="gioi-thieu">Tìm hiểu thêm</a> --}}
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <a><img src="{{ url('/images/tich-hop.png') }}"></a>
                </div>
                <h3 class="feature-heading">
                    <a>Chi phí</a>
                </h3>
                <div class="feature-des">
                    Là đơn vị đào tạo với chi phí hợp lý nhất hiện nay.
                </div>
                {{-- <a class="feature-readmore" href="mien-phi">Tìm hiểu thêm</a> --}}
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <a><img src="{{ url('/images/dichvu-ondinh.png') }}"></a>
                </div>
                <h3 class="feature-heading">
                    <a>Dịch vụ ổn định</a>
                </h3>
                <div class="feature-des">
                    Cam kết tỷ lệ đỗ cao sau khóa học kết thúc.
                </div>
                {{-- <a class="feature-readmore" href="dich-vu">Tìm hiểu thêm</a> --}}
            </div>
            <div class="feature">
                <div class="feature-icon">
                    <a><img src="{{ url('/images/chinhsachdaily.png') }}"></a>
                </div>
                <h3 class="feature-heading">
                    <a >Chất lượng đảm bảo</a>
                </h3>
                <div class="feature-des">
                    Kinh nghiệm giảng dạy giúp các bạn có chất lượng tuyệt đối.
                </div>
                {{-- <a class="feature-readmore" href="chat-luong">Tìm hiểu thêm</a> --}}
            </div>
        </div>
    </div>
    <div class="show-main-home show-tintuc">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="box_dark" style="margin-top: 60px;"><iframe width="100%" height="350"
                        src="https://www.youtube.com/embed/PJmp_E0MUAc" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen=""></iframe></div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <h2 class="left-heading">TIN MỚI NHẤT</h2>
                <div id="news-list">
                    @foreach ($cacbaivietganday as $baiviet)
                        <div class="normal-news">
                            <a style="display: -webkit-box;max-height: 3.2rem;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;white-space: normal;-webkit-line-clamp: 1;"
                                class="news-heading" href="{{ url('/TinTuc/' . $baiviet->slug) }}">
                                {{ $baiviet->tieude }}</a>
                            <div class="post-time" style="padding: 5px 0px;">Đăng ngày:
                                {{ Carbon\Carbon::createFromTimeString($baiviet->created_at)->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                            </div>
                            <div class="news-des">{{ $baiviet->phude }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
