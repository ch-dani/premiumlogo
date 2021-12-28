<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
	jQuery(document).ready(function($){
		if($('.faq_questions .module__accordion .item.active').length){
			de = $('.faq_questions .module__accordion .item.active').offset().top;
			$('html, body').animate({scrollTop: de - 20}, 500);
		}

		$('.module__search input').select2({
			placeholder: '{{ Translate::c("Search question that you need?") }}',
			ajax: {
				url: '{{ route('faq.search-questions') }}',
				dataType: 'json',
				type: 'POST',
				data: function (params) {
					var query = {
						search: params.term,
						_token: $('[name="csrf-token"]').attr('content')
					};
					return query;
				}
			}
		});

		$('.module__search input').on("select2:selecting", function(e) {
			if(e.params.args.data.url){
				window.location = e.params.args.data.url;
			}
		});
	}); /* jQuery(document).ready() */
</script>

<style>
    .module__search .search-icon{
        z-index: 9;
    }
    .select2-container .select2-selection--single{
        padding-left: 55px;
        width: 100%;
        font-size: 18px;
        color: #A2A2A2;
        min-height: 70px;
        padding: 0 25px;
        background: #fff;
        border: none;
        border-radius: 12px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.04), 0px 0px 2px rgba(0, 0, 0, 0.06), 0px 0px 1px rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
    }
    .select2-container .select2-selection--single .select2-selection__rendered{
        padding-left: 35px;
        text-align: left;
    }
    .select2-container--open .select2-dropdown--below{
        border: 1px solid #aaa;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        display: none;
    }
</style>