<!-- modal in danh sách biến động xã-->
<form method="POST" action="{{ '/ThongKe/DanhSachHocVien' }}" accept-charset="UTF-8" id="frm_modify_biendong_xa" target="_blank">
    @csrf
    <div id="modify-modal-danhsach" tabindex="-1" class="modal fade kt_select2_modal" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h4 id="modal-header-primary-label" class="modal-title">Danh sách học viên</h4>
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="control-label">Khóa học</label>
                            <select name="khoahoc" id="" class="form-control select2basic" style="width:100%">
                                <option value="">Tất cả</option>
                                @foreach ($baocao['khoahoc'] as $ct)
                                    <option value="{{ $ct->khoahoc }}">{{ $ct->khoahoc }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-10 mt-2">
                            <label class="control-label">Kết quả thi thử</label>
                            <select name="ketqua" id="ketqua" class="form-control select2basic" style="width:100%">
                                <option value="">Tất cả</option>
                            </select>
                        </div>
                        <div class="col-md-1 mt-2" style="padding-left: 0px;">
                            <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                            <button type="button" class="btn btn-default" data-target="#modal-ketquathi"
                                data-toggle="modal">
                                <i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary">Đồng
                        ý</button>
                </div>
            </div>
        </div>
    </div>
</form>
<div id="modal-ketquathi" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <h4 id="modal-header-primary-label" class="modal-title">Chọn mốc điểm kết quả thi thử</h4>
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-control-label">Mốc điểm<span class="require">*</span></label>
                        {{-- {!!Form::text('vanphong_add', null, array('id' => 'vanphong_add','class' => 'form-control','required'=>'required'))!!} --}}
                        <input type="text" name='mocdiem_add' id="mocdiem_add" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                <button class="btn btn-primary" onclick="add_ketquathi()">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

<script>
           function add_ketquathi(){
            $('#modal-ketquathi').modal('hide');
            var gt = $('#mocdiem_add').val();
            var ten_gt='Lớn hơn '+gt
            $('#ketqua').append(new Option(ten_gt, gt, true, true));
            $('#ketqua').val(gt).trigger('change');
        }
</script>
