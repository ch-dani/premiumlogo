jQuery(document).ready(function($){
	$(document).on('input, keyup', '.search_logos_categories input', searchLogosCategoriesDeb);

	$(document).on('click', '.get_started_category', function(e){
		e.preventDefault();

		$(this).closest('div').find('form').submit();
	});
}); /* jQuery(document).ready() */

const searchLogosCategoriesDeb = debounce(function() {
	searchLogosCategories();
}, 500);

function searchLogosCategories() {
	let $form = $('.search_logos_categories');
	let $input = $('input', $form);
	let $target = $('.category_box .container .row');
	let token = $('[name="csrf-token"]').attr('content');

	$.ajax({
		url: $form.attr('action'),
		type: $form.attr('method'),
		dataType: 'json',
		data: {
			search: $input.val(),
			_token:  token
		},
		beforeSend: function (xhr) {
			formsLoader.showLoading('.category_box', false, 'Processing...');
			// $target.html('');
		},
		success: function (data) {
			if (data.success) {
				$target.html(data.html);
			}
		},
		error: function (data) {
			$inputWrapper.removeClass('valid').addClass('not-valid');
			let responseText = JSON.parse(data.responseText);

			if (responseText.errors.url[0]) {
				$message.text(responseText.errors.url[0]).css('display', 'block');
			}
		},
		complete: function (xhr) {
			formsLoader.hideLoading('.category_box');
		}
	});
}