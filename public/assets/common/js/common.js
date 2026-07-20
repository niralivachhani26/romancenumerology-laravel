var flashMsg = ['success', 'error', 'info', 'warning'];

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

function resCheck(res) {
    let reset = false;
    for (var id in res) {
        if (flashMsg.includes(id)) {
            if (Array.isArray(res[id])) {
                toastr[id](res[id][0], res[id][1]);
            } else {
                toastr[id](res[id]);
            }
            // toastr['success']('successsadf');
            if (res[id][2]) {
                let time = 1000;
                if (res[id][3]) {
                    time = res[id][3];
                }
                setTimeout(function () {
                    window.location.replace(res[id][2]);
                }, time);
            }
            reset = true;
        }
        $('#' + id + '_error').text(res[id]);
    }
    return reset;
}
$(document).ready(function () {
    NProgress.done();

    var homeSlider = $(".home-slider");
    if (homeSlider.length != 0) {
        homeSlider.owlCarousel({
            // center: true,

            items: 6,
            margin: 5,
            autoplay: true,
            loop: true,
            nav: true,
            dots: false,
            navText: [
                '<i class="mdi mdi-chevron-left"></i>',
                '<i class="mdi mdi-chevron-right"></i>',
            ],
            responsive: {
                0: {
                    items: 1,
                    margin: 0,
                },
                500: {
                    // nav: true,
                    items: 2,
                },
                768: {
                    // nav: true,
                    items: 3,
                },
                1000: {
                    // nav: true,
                    items: 4,
                },
                1440: {
                    // nav: true,
                    items: 5,
                },
            },
        });
    }

    try {
        let table = new DataTable('.data-table',{
            responsive: true,
            pageLength: 25
        });
    } catch (error) {

    }

});
$('#newsletter').on('submit', function(event){
    $('.error-msg').html('');
    event.preventDefault();
    $('#data-btn').attr('disabled', true);
    $('#data-btn').html('<i class="fa fa-spinner spinner"></i> Please wait...');
    NProgress.start();

    var formData = new FormData(event.target);
    let url = $('#newsletter').attr('action');

    $.ajax({
        url: url,
        data: formData,
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        enctype: "multipart/form-data",
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        success: function(res) {
            resCheck(res);

            $('#data-btn').attr('disabled', false);
            $('#data-btn').html('Subscribe');
            $('#email').val('');
            $('#name').val('');
            NProgress.done();
        }
    });
});
