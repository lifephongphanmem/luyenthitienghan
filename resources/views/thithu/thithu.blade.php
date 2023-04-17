@extends('thithu.index')

@section('title')
    <title>Thi Thử EPS-Topik</title>
@endsection

@section('header')
    <div class="p-2 align-self-center flex-fill">
        <img src="{{ url('/assets/media/logos/logo-thithu.png') }}" />
    </div>
    <div class="p-2 h2 align-self-center flex-fill">
        Test of proficiency in Korean 2020-2021
    </div>
    <div class="p-2 align-self-center" style="width:20%">
        <div class="row p-2 m-1" style="background-color: rgba(229, 231, 233)">
            <div class="col-8">
                <div class="row">
                    <div style="background-color: rgba(121, 125, 127)">
                        <div class="font-weight-bold m-1" style="color: white; font-size: 8.5pt">
                            Application No.
                        </div>
                    </div>
                    <div class="pl-2 align-items-center m-1">
                        5.00.1.24
                    </div>
                </div>

            </div>
            <div class="col-4">
                <div class="row">
                    <div style="background-color: rgba(121, 125, 127)">
                        <div class="font-weight-bold m-1" style="color: white; font-size: 8.5pt">
                            Seat No.
                        </div>
                    </div>
                    <div class="pl-2">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('subheader')
    <div class="pt-2 pr-2 pb-2 pl-3" style="font-size: 11pt;">
        Version: 5.00.1.24
    </div>
@endsection

@section('content')
    <div class="row">
        <div style="height: 480px; width: 790px; position: absolute; left:50%; transform: translate(-50%, 0%);">
            <div class="border m-2">
                <div class="text-center m-0 pt-2 pb-2 font-weight-bold"
                    style="background-image: linear-gradient(to bottom, rgba(93, 173, 226), rgba(93, 173, 226) 50%, rgba(46, 134, 193) 50%); font-size: 15pt; color: white">
                    Infomation check of applicant
                </div>
                <div class="pt-5 pb-5 font-weight-bold text-center"
                    style="color: white; background-color: rgba(44, 62, 80); font-size: 12pt">
                    Check your application and if there is no problem, click the [Confirm] button
                </div>
                <div class="border m-1" style="height: 68%">
                    <div class="row pt-15 pb-15 m-2">
                        <div class="col-3">
                            <div class="row">
                                <div class="text-center font-weight-bold" style="width: 100%; font-size: 12pt">
                                    Seat Number
                                </div>
                                <div class="text-center pt-5 pb-5" style="width: 100%; font-size: 72pt">
                                    218
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <img class="border p-1" src="{{ url('assets/media/logos/no-avatar-chat.png') }}"
                                style="position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0;" />
                        </div>
                        <div class="col-6">
                            <div class="p-1">
                                <div class="row border rounded-pill" style="border-width: 2px !important">
                                    <div class="col-4 border rounded-pill m-1 p-1 text-center"
                                        style="color: white; background-image: linear-gradient(to bottom, rgba(133, 193, 233), rgba(41, 128, 185))">
                                        SEAT NO.
                                    </div>
                                    <div class="col-7 m-1 p-1" style="color: blue; font-size: 12pt">
                                        218
                                    </div>
                                </div>
                            </div>
                            <div class="p-1">
                                <div class="row border rounded-pill" style="border-width: 2px !important">
                                    <div class="col-4 border rounded-pill m-1 p-1 text-center"
                                        style="color: white; background-image: linear-gradient(to bottom, rgba(133, 193, 233), rgba(41, 128, 185))">
                                        TEST VENUS
                                    </div>
                                    <div class="col-7 m-1 p-1" style="color: blue; font-size: 12pt">
                                        THI THỬ EPS
                                    </div>
                                </div>
                            </div>
                            <div class="p-1">
                                <div class="row border rounded-pill" style="border-width: 2px !important">
                                    <div class="col-4 border rounded-pill m-1 p-1 text-center"
                                        style="color: white; background-image: linear-gradient(to bottom, rgba(133, 193, 233), rgba(41, 128, 185))">
                                        TEST ROOM
                                    </div>
                                    <div class="col-7 m-1 p-1" style="color: blue; font-size: 12pt">
                                        THI THỬ EPS 2023
                                    </div>
                                </div>
                            </div>
                            <div class="p-1">
                                <div class="row border rounded-pill" style="border-width: 2px !important">
                                    <div class="col-4 border rounded-pill m-1 p-1 text-center"
                                        style="color: white; background-image: linear-gradient(to bottom, rgba(133, 193, 233), rgba(41, 128, 185))">
                                        APPLICATION NO.
                                    </div>
                                    <div class="col-7 m-1 p-1" style="color: blue; font-size: 12pt">
                                        5.00.1.24
                                    </div>
                                </div>
                            </div>
                            <div class="p-1">
                                <div class="row border rounded-pill" style="border-width: 2px !important">
                                    <div class="col-4 border rounded-pill m-1 p-1 text-center"
                                        style="color: white; background-image: linear-gradient(to bottom, rgba(133, 193, 233), rgba(41, 128, 185))">
                                        NAME
                                    </div>
                                    <div class="col-7 m-1 p-1" style="color: blue; font-size: 12pt">
                                        abc
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 text-center">
                <a href="{{ route('lambaithithu') }}">
                    <img src="{{ url('assets/media/logos/btn_confirm_on.jpg') }}" />
                </a>
            </div>
            <div class="text-center">
                <a href="{{ '/dashboard' }}" style="color:dodgerblue; font-size:12pt">
                    `Trở Về Trang Chủ
                </a>
            </div>
        </div>
    </div>
@endsection
