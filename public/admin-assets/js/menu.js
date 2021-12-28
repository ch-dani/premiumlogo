$(function () {

	let table = $('#allMenu').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"order": [[0, "desc"]]
	});

	if ($('input[name="code"]').val() === 'categories') {
		$(".sortable").sortable({
			connectWith: '.sortable',
			handle: '.item-handle',
			stop: function (event, ui) {
				editor.enableButton();
				if ($(ui.item).find('.sortable li').length) {
					$(this).sortable( "cancel" );
				}
			},
			cancel: ".edit-item,.remove-item",
		});
	} else {
		$("#sortable").sortable({
			stop: function (event, ui) {
				editor.enableButton();
			},
			cancel: ".edit-item,.remove-item"
		});
	}


	$("#sortable").disableSelection();

	let editor = {
		token: '',
		items: {},
		sort: false,
		edit: false,
		code: '',
		init: function (items) {
			this.setToken();
			this.setCode();
			this.items = items;

			$('#EditorForm').on('submit', function () {
				editor.sendForm($(this));

				return false;
			});

			$('#SaveSort').on('click', function () {
				editor.SaveSort();
			});

			$('#CancelSort').on('click', function () {
				editor.CancelSort();
			});

			$(document).on('click', '.remove-item', function () {
				editor.RemoveItem($(this).closest('li'));
			});

			$(document).on('click', '.edit-item', function (e) {
				e.preventDefault();
				editor.EditItem($(this).closest('li'));
			});

			$('.operation-button-cancel').on('click', function () {
				editor.changeOperation('new');
			});
		},
		reSort: function () {
			let items = this.items;

			$('.list-group-item').each(function (i, ui) {
				items[parseInt($(ui).data('id'))]['sort'] = i;
				if (!$(ui).parent().parent().hasClass('card-body') && $(ui).parent().parent().data('id') !== $(ui).data('id')) {
					items[parseInt($(ui).data('id'))]['parent'] = $(ui).parent().parent().data('id');
				} else {
					delete items[parseInt($(ui).data('id'))]['parent'];
				}
			});

			this.items = items;
			this.enableButton();
		},
		SaveSort: function () {
			this.reSort();
			let _this = this;

			this.ajax({
				success: function (data) {
					if (data.status === 'success') {
						$('#SaveSort').prop('disabled', true);
						$('#CancelSort').hide();

						_this.sort = false;
					} else {
						swal.fire('Error', data.message, 'error');
					}
				},
				data: {
					_token: this.token,
					code: this.code,
					items: this.items
				},
				url: 'save-sortable'
			});
		},
		CancelSort: function () {
			let _this = this;

			this.ajax({
				success: function (data) {
					if (data.status === 'success') {
						$('#SaveSort').prop('disabled', true);
						$('#CancelSort').hide();
						$('#sortable').html(data.html);

						_this.sort = false;
					} else {
						swal.fire('Error', data.message, 'error');
					}
				},
				data: {
					_token: this.token,
					code: this.code
				},
				url: 'get-sortable'
			});
		},
		EditItem: function (li) {
			if (this.sort) {
				swal.fire('Error', 'You need to save or cancel the edit menu.', 'error');
				return false;
			}

			let id = li.data('id');
			this.li = li;

			if (typeof this.items[id] !== 'undefined') {
				$("#sortable").sortable("disable");
				this.changeOperation('edit');

				// $('#EditorForm input[name="title"]').val(this.items[id].title);
				let titles = JSON.parse(this.items[id].title);
				for (var prop in titles) {
					$('#EditorForm input[name="title['+prop+']"]').val(titles[prop]);
				}

				$('#EditorForm input[name="link"]').val(this.items[id].link);
				$('#EditorForm input[name="item_id"]').remove();
				$('#EditorForm').append('<input type="hidden" name="item_id" value="' + id + '">');
			}
		},
		changeOperation: function (type) {
			$('#EditorForm')[0].reset();
			$('.invalid-feedback').hide();

			if (type === 'new') {
				$("#sortable").sortable("enable");
				this.edit = false;

				$('.operation-title').text('New item')
				$('.operation-button').text('Add');
				$('.operation-button-cancel').hide();
				$('#EditorForm input[name="item_id"]').remove();
			} else {
				this.edit = true;

				$('.operation-title').text('Update item')
				$('.operation-button').text('Update');
				$('.operation-button-cancel').show();
			}
		},
		RemoveItem: function (li) {
			if (this.edit) {
				swal.fire('Error', 'Cannot be deleted when editing.', 'error');
				return false;
			}

			let id = li.data('id');
			let _this = this;

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
					this.ajax({
						success: function (data) {
							if (data.status === 'success') {
								li.remove();
								delete _this.items[id];
								swal.fire('Deleted!', '', 'success');
							} else {
								swal.fire('Error', data.message, 'error');
							}
						},
						data: {
							_token: this.token,
							id: id
						},
						url: 'remove'
					});
				}
			});
		},
		enableButton: function () {
			if (!this.sort) {
				$('#SaveSort').prop('disabled', false);
				$('#CancelSort').show();

				this.sort = true;
			}
		},
		setToken: function () {
			this.token = $('input[name="_token"]').val();
		},
		setCode: function () {
			this.code = $('input[name="code"]').val();
		},
		sendForm: function (form) {
			if (this.sort) {
				swal.fire('Error', 'You need to save or cancel the edit menu.', 'error');
				return false;
			}

			let _this = this;

			this.ajax({
				success: function (data) {
					if (data.status === 'success') {
						$('#sortable').html(data.html);

						if (!_this.edit) {
							let $item = $('#sortable li:last-child');
							$item.css('border-color', '#3c8dbc');

							setTimeout(function () {
								$item.css('border-color', '#c5c5c5');
							}, 3000);

							$('html, body').stop().animate({
								'scrollTop': $('#sortable li:last-child').offset().top - 50
							}, 500);
						}

						if (typeof _this.items[data.id] !== 'undefined') {
							// _this.items[data.id].title = $('#EditorForm input[name="title"]').val();
							_this.items[data.id].title = data.title;
							_this.items[data.id].link = $('#EditorForm input[name="link"]').val();
						} else {
							_this.items[data.id] = {
								// title: $('#EditorForm input[name="title"]').val(),
								title: data.title,
								link: $('#EditorForm input[name="link"]').val(),
								sort: data.sort
							};
						}

						_this.changeOperation('new');
					} else {
						$.each(data.message, function (field, value) {
							$('.invalid-feedback[data-field="' + field + '"]').text(value).show();
						});

						$("html, body").animate({scrollTop: $(".invalid-feedback:visible").first().offset().top - 100}, "fast");
					}
				},
				data: form.serialize(),
				url: 'store'
			});
		},
		ajax: function (request) {
			$.ajax({
				type: 'POST',
				url: '/admin-ui/menu/' + request.url,
				data: request.data,
				success: request.success,
				beforeSend: function () {
					$('.invalid-feedback').hide();
				},
				error: function () {
					swal.fire('Error', 'System error', 'error');
				}
			});
		}
	};

	editor.init(items);
});