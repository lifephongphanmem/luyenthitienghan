const soundEffect = new Audio();
var isPlaying = true;
var index = 0;
var a_index;
var index_handel = 0;

function getcauhoi(macau) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/epstopik-test/getCauHoi',
        type: 'GET',
        data: {
            _token: CSRF_TOKEN,
            macau: macau,
        },
        dataType: 'JSON',
        success: function(data) {
            // console.log(data);
            $("#audio").attr("src", data.model.audio);
            soundEffect.src = data.model.audio;
            soundEffect.play();
            $('#text-hidden').replaceWith(data.message);
        },
        // error: function (message) {
        //     toastr.error(message, 'Lỗi!');
        // }
    });
}
$('.list-unstyled').on('click', function() {
    var macau = $(this).data('code');
    getcauhoi(macau);
    moveToBottom(this);
})


function moveToBottom(element) {
    // 1. Xác định phần tử cha (danh sách chứa các phần tử li)
    const parent = document.getElementById("cauhoict");
    // console.log(element);
    // 2. Thêm phần tử được nhấp xuống cuối danh sách
    parent.appendChild(element);
    const listItems = parent.querySelectorAll("li");
}

//Hàm tự động thứ tự
function PlayQuest_Order() {
    disable_btn()
    const questions = document.querySelectorAll('.question-item');
    // return
    if (!isPlaying) {
        return;
    }
    // console.log(index);
    if (index == questions.length) {
        index = 0;
        return;
    }
    if (index < questions.length) {
        const dataCode = questions[0].dataset.code;
        getcauhoi(dataCode);
        moveToBottom(questions[0])
        index++;
    }

    setTimeout('PlayQuest_Order()', 5000);
}

//Hàm tự động ngẫu nhiên
function PlayQuest_Random() {
    disable_btn()
    const questions = document.querySelectorAll('.question-item');
    if (!isPlaying) {
        return;
    }
    if (!a_index) {
        a_index = getConsecutiveNumbers(0, questions.length - 1)
    }
    // console.log(a_index);
    if (a_index.length > 0) {
        const randomIndex = Math.floor(Math.random() * a_index.length);
        index = a_index[randomIndex];
        if (index < questions.length) {
            const dataCode = questions[index].dataset.code;
            getcauhoi(dataCode);
            a_index = a_index.filter(item => item !== index);
        }

    } else {
        return;
    }
    setTimeout('PlayQuest_Random()', 3000);
}

//Hàm thủ công thứ tự
function Handle_Question() {
    const questions = document.querySelectorAll('.question-item');
    if (index < questions.length) {
        const dataCode = questions[index].dataset.code;
        getcauhoi(dataCode);
        moveToBottom(questions[index])
        index_handel++;
    }
}

//Hàm thủ công ngẫu nhiên
var a_index_handle;

function Handle_Question_Random() {
    const questions = document.querySelectorAll('.question-item');
    if ((a_index_handle == [])) {
        console.log('11')
    }
    if (!a_index_handle || a_index_handle == '') {
        a_index_handle = getConsecutiveNumbers(0, questions.length - 1)
    }
    const randomIndex = Math.floor(Math.random() * a_index_handle.length);
    index = a_index_handle[randomIndex];
    if (index < questions.length) {
        const dataCode = questions[index].dataset.code;
        getcauhoi(dataCode);
        a_index_handle = a_index_handle.filter(item => item !== index);
    }

}

function stop() {
    isPlaying = !isPlaying;
    // if (isPlaying) {
    //     $(event.target).text('Dừng');
    // } else {
    //     $(event.target).text('Phát');
    // }
}
function NgheLai() {
    var src = $("#audio").attr("src");
    if (src != '') {
        soundEffect.src = src;
        soundEffect.play();
    }

}
function getConsecutiveNumbers(start, end) {
    // Khởi tạo mảng để chứa các số liên tiếp
    const numbers = [];

    // Duyệt từ số bắt đầu đến số kết thúc
    for (i = start; i <= end; i++) {
        numbers.push(i); // Thêm số vào mảng
    }

    return numbers; // Trả về mảng các số liên tiếp
}

function getRandomNumber(min, max) {
    // Lấy số ngẫu nhiên trong khoảng [min, max]
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
function HienCauHoi() {
    if ($('#cauhoi').hasClass('disable')) {
        $('#cauhoi').removeClass('disable');
        $(event.target).text('Ẩn toàn bộ câu hỏi');
    } else {
        $('#cauhoi').addClass('disable');
        $(event.target).text('Hiện toàn bộ câu hỏi');
    }
}

function HienChu() {
    // var buttonText = $(event.target).text('Ẩn chữ');
    // console.log(buttonText);  
    if ($('#image').hasClass('disable')) {
        // console.log(1);
        $('#image').removeClass('disable');
        $('#hidden_view').addClass('disable');
        $(event.target).text('Hiện chữ');
    } else {
        // console.log(2);
        $('#hidden_view').removeClass('disable');
        $('#image').addClass('disable');
        $(event.target).text('Ẩn chữ');
    }
}
function disable_btn()
{
    $('.stop').attr('disabled','disabled');
}