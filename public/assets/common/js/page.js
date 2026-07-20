
$(document).ready(function(){
    $('input').keyup(function() {
        var id = $(this).attr('id');
        if($(this).val() == ''){
            $('#' + id +'_error').text('Please enter ' + id);
        }else{
            $('#' + id +'_error').text('');
        }
    });

    $('#data-form').on('submit', function(event){
    //$('#data-btn1').on('click', function(event){
        $('.error-msg').html('');
        event.preventDefault();
        $('#data-btn').attr('disabled', true);
        $('#data-btn').html('<i class="fa fa-spinner spinner"></i> Please wait...');
        NProgress.start();

        var formData = new FormData(event.target);
        let url = $('#data-form').attr('action');
        $.ajax({
            url: url,
            data: formData,
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            enctype: "multipart/form-data",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                if(resCheck(res)){
                    $('#data-form')[0].reset();
                }
                $('#data-btn').attr('disabled', false);
                $('#data-btn').html('Save');
                NProgress.done();
            }
        });
    });
});

var loadFile = function (event, id = 'image_view', error = 'image_error') {
    $('#' + error).text('');
    var image = document.getElementById(id);
    image.src = URL.createObjectURL(event.target.files[0]);
};
