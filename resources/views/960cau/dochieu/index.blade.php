@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ '/css/960cau.css' }}">
    <style>
        .list-box.ds-blog article {
    border-bottom: 1px solid #ededed;
}
.list-box.ds-blog article, .list-box.ds-blog aside {
    padding: 15px 20px;
    width: 100%;
    float: left;
}
article .archive-page-header {
    padding: 10px 0px;
    width: 100%;
    float: left;
}
.noidung-baiviet {
    width: 100%;
    float: left;
    padding: 20px 0px;
    font-size: 14px;
}

@media only screen and (min-width: 1100px){
.col.post-item-baiviet {
    width: 48%;
    float: left;
    text-align: left;
    max-height: 90px;
    min-height: 80px;
    padding: 5px;
    margin-left: 5px;
    border-radius: 3px;
    margin-bottom: 10px;
    box-shadow: 0 2px 8px rgb(0 24 171 / 43%);
}}
.col, .gallery-item, .columns {
    position: relative;
    margin: 0;
    padding: 0 15px 30px;
    width: 100%;
}
@media only screen and (min-width: 349px){
.width-20 {
    display: block;
}}
@media only screen and (min-width: 1100px){
.width-20 {
    width: 75px;
    float: left;
    display: block;
}}
@media only screen and (min-width: 501px){
.width-20 {
    width: 65px;
    float: left;
    display: block;
}}
img {
    transition: opacity 1s;
    opacity: 1;
}
img {
    max-width: 100%;
    height: auto;
    display: inline-block;
    vertical-align: middle;
}
.list-learning a {
    color: #16a6d4;
    font-size: 16px;
}
.fa-book:before {
    content: "\f02d";
}
.content .container{
    background: #fff;
}
    </style>
@stop

@section('custom-script')
    <script type="text/javascript" src="{{ url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>

    <script src="{{ url('assets/admin/pages/scripts/table-lifesc.js') }}"></script>
    <script src="{{ url('js/custome-form.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged3.init();
        });
    </script>
@stop
@section('content')
    <article class="type-post status-publish format-standard has-post-thumbnail hentry">
        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-4993385880811146" data-ad-slot="2911114507"
            data-ad-format="auto" data-full-width-responsive="true"></ins>
        <header class="archive-page-header" style="border-bottom: 1px solid #e6f4fa;">
            <h1 class="page-title is-large uppercase  tieude-giaotrinh">960 Câu Đọc Hiểu</h1>
        </header>
        <div class="noidung-baiviet list-learning">
            @for ($i=1;$i<25;$i++)
            <div class="col post-item-baiviet"
            style="padding: 10px; padding: 10px; border: 1px solid aqua; margin-bottom: 10px;">
            <div class="width-20">
                <a href="960-cau-doc-hieu/cau-01-den-cau-40">
                    <img class="img-tintuc" src="{{asset('/images/960caudnh.jpg')}}">
                </a>
            </div>
            <div class="width-80">
                <a href="960CauDocHieu?socau={{$i}}">
                    <span style="font-size: 16px; margin-left: 15px; font-weight: 600;"> <i
                            class="fas fa-book"></i>&nbsp;
                            @if ($i==1)
                            Câu 01 đến câu 40   
                            @else
                            Câu {{(($i-1)*40)+1}} đến câu {{$i*40}}
                            @endif
                            </span>
                </a>
                <div class="from_the_blog_excerpt ">&nbsp;&nbsp;&nbsp;» Bộ 960 câu Đọc - Nghe hiểu</div>
            </div>
        </div>
            @endfor
        </div>
    </article>
@stop
