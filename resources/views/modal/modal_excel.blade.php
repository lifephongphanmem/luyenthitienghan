    {{-- Nhận file Excel --}}
    {{-- {!! Form::open([
        'url' => $inputs['url'] . 'NhanExcel',
        'method' => 'POST',
        'id' => 'frm_NhanExcel',
        'class' => 'form',
        'files' => true,
        'enctype' => 'multipart/form-data',
    ]) !!} --}}
    <form action="{{'/LopHoc/NhanExcel'}}" method="POST" id="frm_NhanExcel" class="form"  enctype="multipart/form-data">
        @csrf
    <div class="modal fade bs-modal-lg" id="modal-nhanexcel" tabindex="-1" role="dialog" aria-hidden="true">
        <input type="hidden" name='malop' value="{{$inputs['lophoc']}}">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h4 class="modal-title">Nhận dữ liệu từ file</h4> --}}
                    <h4 class="modal-title"><a href="{{'/mauexcel/maudanhsachhocvien.xlsx'}}">Tải file excel mẫu tại đây</a></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="control-label">Họ và tên</label>
                            {{-- {!! Form::text('pldoituong', 'B', ['class' => 'form-control']) !!} --}}
                            <input type="text" name='tenhocvien' value="B" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Số điện thoại</label>
                            <input type="text" name="sdt" value="C" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label">CMND/CCCD</label>
                            {{-- {!! Form::text('chucvu', 'D', ['class' => 'form-control']) !!} --}}
                            <input type="text" name="cccd" value="D" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label">Ngày sinh</label>
                            {{-- {!! Form::text('tencoquan', 'E', ['class' => 'form-control']) !!} --}}
                            <input type="text" name="ngaysinh" value="E" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Giới tính</label>
                            {{-- {!! Form::text('phanloaikhenthuong', 'R', ['class' => 'form-control']) !!} --}}
                            <input type="text" name="gioitinh" value="F" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-control-label">Địa chỉ</label>
                            {{-- {!! Form::text('madanhhieukhenthuong', 'S', ['class' => 'form-control']) !!} --}}
                            <input type="text" name="diachi" value="G" class="form-control">
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="control-label">Nhận từ dòng<span class="require">*</span></label>
                            {{-- {!! Form::text('tudong', '2', ['class' => 'form-control']) !!} --}}
                            <input type="text" name="tudong" value="3" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Nhận đến dòng</label>
                            {{-- {!! Form::text('dendong', '200', ['class' => 'form-control']) !!} --}}
                            <input type="text" name="dendong" value="200" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>File danh sách:</label><span class="text-danger"> *Chỉ nhận các file excel: .xlsx, .xls</span>
                            {{-- {!! Form::file('fexcel', null, ['class' => 'form-control', 'required']) !!} --}}
                            <input type="file" name="fexcel" class="form-control" accept=".xlsx,.slx" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row text-center">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Hoàn
                                thành</button>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</form>

