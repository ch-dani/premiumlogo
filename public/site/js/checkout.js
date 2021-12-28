$(function () {
    $('input[name="plan"]').change(function () {
        $('input[name="plan"]').prop('checked', false)
        $(this).prop('checked', true)
        $('.subtotal').html($(this).closest('.choose__plan-item').find('.choose__plan-cost').text())
        $('.order__selected').html($(this).closest('.choose__plan-item').find('.choose__plan-title').text() + ' (Selected)')
        
        let parent = $(this).closest(".choose__plan-item");
        let plan_term = $(".choose__plan-term li", parent);
        let ul = $("<ul/>");
        plan_term.each(function(){
        	ul.append(`<li class=''>
                    <img src="/site/img/check.svg" alt="check" width="20" height="20">${$(this).text()}
        	</li>`);
        });
        
        $(".order__item.block").html("").append(ul);
    })

    $('#checkoutForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: 'post',
            data: $(this).serialize(),
            async: false,
            success: function (response) {
               if (response.redirectUrl) {
                   location.href = response.redirectUrl
               }
            }
        })
    })

    $('#stripePayment').submit(async function (e) {
        e.preventDefault();
        
        if(!$("#terms_checkbox:checked").length){
        	showError("Please indicate that you have read and agree to the <a class='warn_text' target='_blank' href='/terms'>Terms and Conditions</a>");
        	return false;
        }
        
        showLoader("body");

        await $.ajax({
            url: $(this).attr('action'),
            method: 'post',
            data: $(this).serialize(),
            async: false,
            success: function (response) {
            	hideLoader();
            
               if (response.success) {
                   location.href = '/checkout/success/' + response.paymentId
               } else {
               		showError(response.message);
                   //alert(response.message)
               }
            },
            error: function (jqXHR) {
            	hideLoader();
                let response = jqXHR.responseJSON;

                $.each(response.errors, function (field, value) {
                    $('.invalid-feedback[data-field="' + field + '"]').text(value[0]).show();
                });

                $("html, body").animate({scrollTop: $(".invalid-feedback:visible").first().offset().top - 100}, "fast");
            }
        })
    })
})
