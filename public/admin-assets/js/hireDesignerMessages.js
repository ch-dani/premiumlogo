$(function () {

    $('.editor-textarea').each(function (i, item) {
        CKEDITOR.replace($(this).attr('id'));
    });
    CKEDITOR.on('instanceReady', function () {
        $.each(CKEDITOR.instances, function (instance) {
            CKEDITOR.instances[instance].on("change", function (e) {
                for (instance in CKEDITOR.instances)
                    CKEDITOR.instances[instance].updateElement();
            });
        });
    });

    let $form = $('#dataForm');
    console.log($form)
    console.log($('.form-control'))

    $form.on('submit', function () {
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            async: false,
            beforeSend: function () {
                $('.invalid-feedback').hide();
            },
            success: function (response) {
                if (response.success) {
                    swal.fire('Success!', response.message, 'success').then(() => {
                        // window.location.href = "/admin/projects/";
                        if(response.redirect){
                            window.location.href = response.redirect;
                        }
                    });
                } else {
                    swal.fire('Error!', response.message, 'error');
                }
            },
            error: function (jqXHR) {
                let response = jqXHR.responseJSON;

                $.each(response.errors, function (field, value) {
                    $('.invalid-feedback[data-field="' + field + '"]').text(value[0]).show();
                });

                $("html, body").animate({scrollTop: $(".invalid-feedback:visible").first().offset().top - 100}, "fast");
            }
        });

        return false;
    });
});

