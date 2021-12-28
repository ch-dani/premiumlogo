$(function () {
    $('#register .checkout__button-login').click(function () {
        location.href = '/login'
    })

    $('#login .checkout__button-register').click(function () {
        location.href = '/register'
    })

    $('.checkout__button-google').click(function () {
        location.href = '/redirect/google'
    })

    $('.checkout__button-facebook').click(function () {
        location.href = '/redirect/facebook'
    })

    $('#register, #login').submit(function (e) {
        e.preventDefault();
        $.ajax({
            method: 'post',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            async: false,
            beforeSend: function () {
                $('.invalid-feedback').hide();
            },
            success: function (response) {
                if (response.success) {
                    location.href = '/save-logo'
                }
            },
            error: function (jqXHR) {
                console.log(jqXHR)
                let response = JSON.parse(jqXHR.responseText);

                $.each(response.errors, function (field, value) {
                    $('.invalid-feedback[data-field="' + field + '"]').text(value[0]).css('display', 'block');
                });
            }
        })
    })
})