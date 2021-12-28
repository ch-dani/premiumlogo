Dropzone.autoDiscover = false;

$(function () {

	"use strict";

	let $form = $('#dataForm');
	let $table = $('#tableData');
	let table = $table.DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"order": [[0, "asc"]],
		"aoColumns": [
			{
				data: 'id',
				bSortable: true
			},
			{
				data: 'name',
				bSortable: true
			},
			/*{
				data: 'user',
				bSortable: false
			},*/
			{
				data: 'type',
				searchable: true,
				bSortable: false
			},
			{
				data: 'created_at',
				searchable: false,
				bSortable: true
			},
			{
				data: 'action',
				searchable: false,
				bSortable: false
			}
		],
		"processing": true,
		"serverSide": true,
		"ajax": ""
	});

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

	$table.on('click', '.remove', function () {
		let $button = $(this);

		swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: $button.data('remove-link'),
					type: 'DELETE',
					data: {
						_token: $('meta[name="csrf-token"]').attr('content'),
					},
					success: function (response) {
						if (response.success) {
							table.row($button.closest('tr')).remove().draw();
							swal.fire('Deleted!', '', 'success');
						} else {
							swal.fire('Error', response.message, 'error');
						}
					},
					error: function () {
						swal.fire('Error!', '', 'error').then(() => {
							window.location.reload();
						});
					}
				});
			}
		});
	});

	$("#image").dropzone({
		url: "/api/upload",
		maxFiles: 1,
		addRemoveLinks: true,
		acceptedFiles: 'image/*',
		success: function (data) {
			let response = JSON.parse(data.xhr.response);

			if (response.status === 'error') {
				$('.invalid-feedback[data-field="image"]').text(response.message).show();
			} else {
				$form.append('<input type="hidden" name="image" data-for="' + response.src + '" data-src="" value="' + response.src + '">');
				$('.icon_thumbnails img').attr('src', response.src);
			}
		},
		removedfile: function (file) {
			file.previewElement.remove();
		},
		sending: function (data, xhr, formData) {
			formData.append('api_token', $('input[name="api_token"]').val());
			formData.append('folder', $('input[name="folder"]').val());
		},
		maxfilesexceeded: function () {
			swal.fire('Error!', 'You can not upload any more files.', 'error');
		}
	});

	$('.select2').select2();
});
