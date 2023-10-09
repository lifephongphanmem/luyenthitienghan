$('#loaicauhoi').on('change', function() {
    var loaicauhoi = $(this).val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/CauHoi/LoaiCauHoi',
        type: 'POST',
        data: {
            _token: CSRF_TOKEN,
            loaicauhoi: loaicauhoi
        },
        dataType: 'JSON',
        success: function(data) {
            $('#xoadangcaudoc').remove();
            $('#xoadangcaunghe').remove();
            $('#xoaxemtranh').remove();
            $('#caudoc').append(data);
        },
        error: function(message) {
            toastr.error(message, "Lỗi")
        }
    });

});

$('#hoithoai').on('change', function() {
    var hoithoai = $(this).val();
    $('#noidung').remove();
    if (hoithoai == 0) {
        var html = '<div  id="noidung">';
        html += '<label class="control-label">Nội dung<span class="require">*</span></label>';
        html += '<textarea name="noidung" id="noidungcau" rows="5" class="form-control"></textarea>';
        html += '</div>'


    } else {
        var html = '<div id="noidung">'
        html += '<div class="row mt-2">'
        html += '<div class="col-md-6 mt-2">'

        html += '<label class="control-label">Hội thoại 1<span class="require">*</span></label>';
        html += '<input type="text" name="hoithoai1" class="form-control">';
        html += '</div>';
        html += '<div class="col-md-6 mt-2">'
        html += '<label class="control-label">Hội thoại 2<span class="require">*</span></label>';
        html += '<input type="text" name="hoithoai2" class="form-control">';
        html += '</div>';
        html += '<div class="col-md-6 mt-2">'
        html += '<label class="control-label">Hội thoại 3<span class="require">*</span></label>';
        html += '<input type="text" name="hoithoai3" class="form-control">';
        html += '</div>';
        html += '<div class="col-md-6 mt-2">'
        html += '<label class="control-label">Hội thoại 4<span class="require">*</span></label>';
        html += '<input type="text" name="hoithoai4" class="form-control">';
        html += '</div>';
        html += '</div>';
        html += '</div>';

    }
    $('#cauhoithoai').append(html);
});