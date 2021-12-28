Dropzone.autoDiscover = false;

$(function () {
    "use strict";
    let $form  = $('#dataForm');
    let $table = $('#tableData');
    let $inputFile = $('#inputFile');
    let $inputImage = $('input[name="image"]');
    let file = null;


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

    if (typeof table_columns != "undefined") {
        let table = $table.DataTable({
            "paging"      : true,
            "lengthChange": false,
            "searching"   : true,
            "ordering"    : true,
            "info"        : true,
            "autoWidth"   : false,
            "order"       : typeof table_columns_order != "undefined" ? table_columns_order : [[0, "asc"]],
            "aoColumns"   : table_columns,
            "processing"  : true,
            "serverSide"  : true,
            "ajax"        : ""
        });
    }

    $inputFile.on('change', function () {
        if (typeof $(this).prop('files')[0] !== 'undefined') {
            if ($(this).prop('files')[0].type.split('/')[0] === 'image') {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('.icon_thumbnails img').attr('src', e.target.result);
                    $('.icon_thumbnails').show();
                };

                reader.readAsDataURL($(this).prop('files')[0]);
                file = $(this).prop('files')[0];
                $('.custom-file-label').text(file.name);
                $inputImage.val('');
            } else {
                swal.fire('Error!', 'The file must be an image.', 'error');
                $(this).val('');
            }
        }
    });

    $form.on('submit', function (e) {
        $.ajax({
            type      : $(this).attr('method'),
            url       : $(this).attr('action'),
            data      : $(this).serialize(),
            async     : false,
            beforeSend: function (xhr) {
                $('.invalid-feedback').hide();

                if (file !== null) {
                    let data = new FormData();
                    data.append('file', file);
                    data.append('api_token', $('meta[name="api-token"]').attr('content'));

                    swal.fire({
                        title: 'Wait!',
                        text: 'Image loading...',
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
                                $inputImage.val(data.src);
                                $inputImage.attr('name', $form.find('input[type="file"]').attr('name'))
                                file = null;
                                $form.submit();
                            } else {
                                $('.invalid-feedback[data-field="image"]').text(data.message).show();
                                xhr.abort();
                            }
                        }
                    });

                    return false;
                }
            },
            success   : function (response) {
                if (response.success) {
                    swal.fire('Success!', response.message, 'success').then(() => {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    });
                } else {
                    swal.fire('Error!', response.message, 'error');
                }
            },
            error     : function (jqXHR) {
                let response = jqXHR.responseJSON;

                $.each(response.errors, function (field, value) {
                    $('.invalid-feedback[data-field="' + field + '"]').text(value[0]).show();
                });

                $("html, body").animate({scrollTop: $(".invalid-feedback:visible").first().offset().top - 100}, "fast");
            }
        });

        return false;
    });

    $table.on('click', '.remove', async function (e) {
        e.preventDefault();

        let $button = $(this);

        let result = await swal.fire({
            title             : 'Are you sure?',
            text              : "You won't be able to revert this!",
            type              : 'warning',
            showCancelButton  : true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor : '#d33',
            confirmButtonText : 'Yes, delete it!'
        });

        if (result.value) {
            let response = await $.ajax({
                url    : $button.data('remove-link'),
                type   : 'DELETE',
                data   : {_token: $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    if (response.success) {
                        $table.DataTable().row($button.closest('tr')).remove().draw(false);
                        swal.fire('Deleted!', '', 'success');
                    } else {
                        swal.fire('Error', response.message, 'error');
                    }
                },
                error  : function () {
                    swal.fire('Error!', '', 'error').then(() => {
                        window.location.reload();
                    });
                }
            });
        }
    });

    $('.select2').select2();
});
