function checkpass(){
    cpass=$('#cpass').val();
    pass=$('#password').val();
    if(cpass == pass){
        $('#cpass').css('border-color','green');
        $('#cpass_submit').prop('disabled',false);
    }else{
        $('#cpass').css('border-color','red');
        $('#cpass_submit').prop('disabled',true);
    }
}