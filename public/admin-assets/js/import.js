$(function () {
    let $form = $('#dataForm');
    let $inputFile = $('#zipFile');
    let file = null;

    $inputFile.on('change', function () {
        if (typeof $(this).prop('files')[0] !== 'undefined') {
            console.log($(this).prop('files')[0].type.split('/')[1])
            if ($(this).prop('files')[0].type.split('/')[1] === 'x-zip-compressed') {
            let reader = new FileReader();

            reader.readAsDataURL($(this).prop('files')[0]);
            file = $(this).prop('files')[0];
            $('.custom-file-label').text(file.name);
            } else {
                swal.fire('Error!', 'The file must be an .zip format.', 'error');
                $(this).val('');
            }
        }
    });
    $form.on('submit', function () {
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            async: false,
            beforeSend: function (xhr) {
                $('.invalid-feedback').hide();

                if (file !== null) {
                    let data = new FormData();
                    data.append('file', file);
                    data.append('api_token', $('meta[name="api-token"]').attr('content'));

                    swal.fire({
                        title: 'Wait!',
                        text: 'Archive loading...',
                        onBeforeOpen: () => {
                            swal.showLoading();
                        },
                        showConfirmButton: false,
                        allowOutsideClick: false
                    });

                    $.ajax({
                        url: '/api/upload',
                        data: data,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function (data) {
                            swal.close();

                            if (data.status === 'success') {
                                $form.append('<input type="hidden" name="archive_path" value="' + data.src + '">')
                                file = null;
                                $form.submit();
                            } else {
                                $('.invalid-feedback[data-field="zip"]').text(data.message).show();
                                xhr.abort();
                            }
                        }
                    });

                    return false;
                }
            },
            success: function (response) {
                if (response.success) {
                    swal.fire('Success!', response.message, 'success');
                } else {
                    swal.fire('Error!', response.message, 'error');
                }
            },
            error: function (jqXHR) {
                let response = jqXHR.responseJSON;

                swal.fire('Error!', response.message, 'error');
            }
        });

        return false;
    });

    $('.select2').select2();
});
