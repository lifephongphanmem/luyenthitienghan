@extends('main')

@section('custom-style')
    <style>
        td {
            vertical-align: middle !important
        }

        .nopadding {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .subtitle {
            font-size: 8.7pt;
        }
    </style>
@endsection

@section('custom-script')
    <script></script>
@endsection

@section('content')
    <div class="card">
        <h3 class="pt-8 pb-3 pl-7 pr-7 border-bottom border-1">TIN TỨC</h3>
        <div class="pt-7 pb-7 pl-15 pr-15">
            <div class="pb-2 border-bottom border-2">
                <h2 class="text-uppercase">{{ $baiviet->tieude }}</h2>
                <div class="d-flex pb-1">
                    <div class="col-10 nopadding subtitle">Đăng bởi: {{ $baiviet->user->tentaikhoan }}</div>
                    <div class="col-2 nopadding subtitle">Lượt xem: {{ $baiviet->luotxem }}</div>
                </div>
                <div class="subtitle">Ngày đăng:
                    {{ Carbon\Carbon::createFromTimeString($baiviet->created_at)->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                </div>
            </div>
            <div class="pt-10">{!! $baiviet->noidung !!}</div>
        </div>
    </div>
    <div class="card mt-3">
        <h4 class="pt-5 pb-3 pl-10 pr-10 border-bottom border-1">TIN TỨC KHÁC</h4>
        @foreach ($cacbaivietganday as $bai)
            <div class="pt-3 pb-3 pl-15 pr-15 d-flex">
                <div class="pr-5">
                    <a href="{{ url('/TinTuc/' . $bai->slug) }}">
                        <img style="object-fit: cover;" src="{{ url($bai->hinhanh) }}" width="45px" height="45px">
                    </a>
                </div>
                <div>
                    <a href="{{ url('/TinTuc/' . $bai->slug) }}" style="font-size: 11pt">{{$bai->tieude}}</a>
                    <i style="font-size: 9.5pt">{{Carbon\Carbon::createFromTimeString($bai->created_at)->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s')}}</i>
                </div>
            </div>
        @endforeach
    </div>
@endsection
