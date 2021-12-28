function debounce(func, wait, immediate) {
	let timeout;

	return function executedFunction() {
		const context = this;
		const args = arguments;

		const later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};

		const callNow = immediate && !timeout;

		clearTimeout(timeout);

		timeout = setTimeout(later, wait);

		if (callNow) func.apply(context, args);
	};
};

class FormsLoader{
	showLoading(selector, button_text = '', loader_text = ''){
		var $form = $(selector);
		var $loader = $form.find(".formsLoader");

		if($loader.length===0){
			$form.addClass('relative');
			$form.append(`<div class="formsLoader" style=""><div class="lds-ripple"><div></div><div></div></div><span class="loader-text">`+loader_text+`</span></div>`);
		}

		if(button_text){
			$form.find("button").html(button_text);
		}

		$form.find(".formsLoader").show();
	}

	hideLoading(selector, button_text){
		var $form = $(selector);

		if(button_text){
			$form.find("button").html(button_text);
		}

		$form.find(".formsLoader").remove();
		$form.removeClass('relative');
	}
}
var formsLoader = new FormsLoader();