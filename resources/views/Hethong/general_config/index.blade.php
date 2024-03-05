@extends('main')
@section('custom-style')
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}" />
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
    <!--begin::Container-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title text-uppercase">Thiết lập</h3>
                        <div class="card-toolbar">
                            {{-- <div class="example-tools justify-content-center">
                                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                            </div> --}}
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form action="{{ '/generalconfig/update' }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="exampleSelect1">Đăng nhập 1 tài khoản cùng 1 thời điểm
                                        <span class="text-danger">*</span></label>
                                    <select class="form-control" name="dxtaikhoan">
                                        <option value="0" {{ $model->dxtaikhoan == 0 ? 'selected' : '' }}>Không cho đăng
                                            nhập ở thiết bị khác khi tài khoản đang đăng nhập</option>
                                        <option value="1" {{ $model->dxtaikhoan == 1 ? 'selected' : '' }}>Đăng xuất tài
                                            khoản ngay lập tức</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="control-label">Số lần đăng nhập sai</label>
                                    <input type="text" name="solandn" value="{{$model->solandn}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
                            {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card-->

                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    </div>
    </div>
    <!--end::Container-->

@stop
