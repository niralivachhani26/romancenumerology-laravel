
// show password
$(document).ready(function(){
    $('#show-password').on('click', function(){
        if($('#show-password').prop('checked')){
            $('#password').attr('type', 'test');
        }else{
            $('#password').attr('type', 'password');
        }
    });

    $('input').keyup(function() {
        var id = $(this).attr('id');
        if($(this).val() == ''){
            $('#' + id +'_error').text('Please enter ' + id);
        }else{
            $('#' + id +'_error').text('');
        }
    });

    $('#login').on('click', function(event){
        event.preventDefault();
        $('#login').attr('disabled', true);
        $('.error-msg').html('');
        $('#login').html('<i class="fa fa-spinner spinner"></i> Please wait...');
        NProgress.start();
        var fieldValuePairs = $('#login-form').serializeArray();
        let url = $('#login-form').attr('action');
        $.ajax({
            url: url,
            data: fieldValuePairs,
            dataType: 'json',
            type: 'POST',
            success: function(res) {
                if(resCheck(res)){
                    $('#login-form')[0].reset();
                }
                $('#login').attr('disabled', false);
                $('#login').html('Sign In');
                NProgress.done();
            }
        });
    });
});
