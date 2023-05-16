$(document).ready(function () {
    $('#Login').on('click', function () {
        $.ajax({
            url: base_url + 'login/service/login_service/login',
            type: "POST",
            dataType: "JSON",
            data: {
                username: $('#username').val(),
                password: $('#password').val(),
            },
            success: function(response) {
                if (response.has_error) {
                    toastr.error(response.error_message);
                } else {
                    window.location = base_url + "customer";
                }
            }
        });
        // window.location = base_url + "dashboard";
    });

    $('#password').on('keyup', function (e) {
        if (e.keyCode == 13)
            $('#Login').click();
    });
});