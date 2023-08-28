@extends('main')
@section('custom-style')
    <style>
        .pagination {
            justify-content: center;
        }
    </style>
@endsection

@section('custom-script')
    <script>
        var str = '{{ json_encode($baiviet) }}';
        str = str.replace(/&quot;/ig, '"');
        console.log(JSON.parse(str))
    </script>
@endsection

@section('content')
    <div class="card p-7">
        <h3 class="mt-1 mb-5 border-bottom border-2">TIN TỨC</h3>
        @foreach ($baiviet as $bai)
            <div class="p-5 d-flex" style="width: 100%">
                <div class="pr-7">
                    <a href="{{ url('/TinTuc/' . $bai->slug) }}">
                        <img style="object-fit: cover" src="{{ url($bai->hinhanh) }}" width="220px" height="140px">
                    </a>
                </div>
                <div>
                    <div class="lead text-dark"><a href="{{ url('/TinTuc/' . $bai->slug) }}">{{ $bai->tieude }}</a></div>
                    <div class="text-muted pt-1" style="font-size: 9pt">Đăng ngày:
                        {{ Carbon\Carbon::createFromTimeString($bai->created_at)->timezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                    </div>
                    <div class="text-secondary pt-1" style="font-size: 9.3pt">{{ $bai->phude }}</div>
                </div>
            </div>
        @endforeach
        {!! $baiviet->links() !!}
    </div>
@endsection
