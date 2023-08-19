@extends('main')
@section('custom-style')
    <style>
        .title {
            font-size: 11pt;
        }

        .text-tiny {
            font-size: 8pt;
        }

        .text-small {
            font-size: 9pt;
        }

        .text-big {
            font-size: 11pt;
        }

        .text-huge {
            font-size: 12pt;
        }

        /* td {
            vertical-align: middle !important
        } */
    </style>
@endsection

@section('custom-script')
    <script src="{{ url('assets/vendor/ckeditor5/build/ckeditor.js') }}"></script>
    <script>
        let editor
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                link: {
                    defaultProtocol: 'http://'
                }
            })
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function previewBtn() {
            let preview = document.getElementById('preview');
            let title = "<h2 style=\"text-transform: uppercase;\">" + document.getElementById('tieude').value + "</h2>";
            console.log(title);
            console.log(editor.getData());
            preview.innerHTML = title + editor.getData();
        }
    </script>
    <script type="text/javascript" language="javascript">
        function checkFile(sender, validExts) {
            var max_size = 2;                                   //MegaByte
            var max_size_in_byte = max_size * 1048576;
            var file = document.getElementById("acptfile");

            var fileExt = sender.value;
            var validExtsWithUpperCase = validExts + ", " + validExts.toUpperCase();
            var validExtsArr = validExtsWithUpperCase.split(", ");
            fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
            if (validExtsArr.indexOf(fileExt) < 0 && fileExt != "") {
                $(sender).val("");
                document.getElementById("errorfile").innerHTML =
                    "Định dạng tệp không hợp lệ (định dạng tệp được hỗ trợ gồm " + validExts.toString() +
                    ")";
                return false;
            } else if (file.files[0].size > max_size_in_byte) {
                $(sender).val("");
                document.getElementById("errorfile").innerHTML = "Kích thước tệp quá lớn (kích thước tối đa không quá " +
                    max_size + "MB)"
            } else {
                document.getElementById("errorfile").innerHTML = "";
                return true;
            }
        }
    </script>
    <script>
        function validate() {
            if (document.thongtin.tieude.value == "") {
                alert("Hãy nhập tiêu đề bài viết!");
                document.thongtin.tieude.focus();
                return false;
            }
            else if (document.thongtin.acptfile.value == "") {
                alert("Hãy chọn ảnh tiêu đề cho bài viết!");
                return false;
            }
            else if (editor.getData() == "") {
                alert("Hãy nhập nội dung bài viết!");
                return false;
            }
            else {
                return true;
            }
        }
    </script>
@endsection

@section('content')
    <div style="text-transform: uppercase;">
        <h1>Tạo bài viết</h1>
    </div>
    <form action="{{'/TinTuc/TaoBai/create'}}" method="POST" onsubmit="return(validate());" name="thongtin" enctype="multipart/form-data">
        @csrf
        <div>
            <div class="pt-2 pb-1"><label class="title" for="#tieude">Tiêu đề:</label></div>
            <div class="pt-1 pb-2"><input id="tieude" name="tieude" value="{{ old('tieude') }}" class="p-2 form-control"
                    style="width: 100%;" type="text" placeholder="Nhập tiêu đề" /></div>
        </div>
        <div>
            <div class="pt-2 pb-1"><label class="title">Phụ đề:</label></div>
            <div class="pt-1 pb-2"><input id="phude" name="phude" value="{{ old('phude') }}" class="p-2 form-control"
                    style="width: 100%" type="text" placeholder="Nhập phụ đề" /></div>
        </div>
        <div>
            <div class="pt-2 title">
                <p>Ảnh tiêu đề:</p>
            </div>
            <?php $acpt_exts = '.jpg, .png, .webp'; ?>
            <div class="pb-2"><input type="file" id="acptfile" name="acptfile" accept="{{ $acpt_exts }}"
                    onchange="checkFile(this,'{{ $acpt_exts }}')" class="form-control-file" /></div>
            <p id="errorfile" style="color:red"></p>
        </div>
        <div>
            <div class="pt-2 pb-1"><label class="title" for="#editor">Nội dung:</label></div>
            <textarea id="editor" class="form-control" name="noidung"></textarea>
        </div>
        <div class="pt-3 text-center" style="width: 100%">
            <button class="btn btn-outline-success" type="button" onclick="previewBtn()">Xem trước</button>
            <button class="btn btn-primary" type="submit">Đăng bài</button>
        </div>
    </form>
    <div class="pt-2">
        <p style="font-size: 11pt">Xem trước:</p>
    </div>
    <div class="pt-5 pb-5 pl-15 pr-15 border border-1 border-dark rounded card" style="min-height: 250px">
        <div id="preview" class="p-2"></div>
    </div>
@endsection
