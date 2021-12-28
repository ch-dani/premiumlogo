$(function () {
    $('#hire-designer form').submit(function (e) {
        e.preventDefault();
        $(".invalid-feedback").hide()
        showLoader("body");
        $.ajax({
            method: 'post',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            async: false,
            success: (response)=>{
            	hideLoader();            
                if (response.success) {
                	
                	$("input, textarea", this).val("");
                	showSuccess(`We appreciate you contacting us.<br>One of our colleagues will get back in touch with you soon!<br>Have a great day!`, "Thank you for getting in touch! ", true);                
                	
                
//                    var answer = window.confirm("Message was created successfully!");
//                    if (answer) {
//                        location.href = '/'
//                    }
                }
            },
            error: function (jqXHR) {
                let response = JSON.parse(jqXHR.responseText);
                console.log(jqXHR)
            	hideLoader();

                $.each(response.errors, function (field, value) {
                    $('.invalid-feedback[data-field="' + field + '"]').text(value[0]).show();
                });

                $("html, body").animate({scrollTop: $(".invalid-feedback:visible").first().offset().top - 100}, "fast");
            }
        })
    })
})
