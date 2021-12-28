var $ = jQuery.noConflict();

$(document).ready(function() {

    $('#dropdownWidget .dropdown_select').click(function() {
        $('#dropdownWidget .dropdown_option_wrapper').toggleClass('active')
    })


    $("#dropdownWidget .dropdown_option").each(function(index) {
        $(this).on("click", function() {
            var activeOption = $(this).html();
            $('#dropdownWidget .dropdown_select').html(activeOption);
            $('#dropdownWidget .dropdown_option_wrapper').removeClass('active');
        });
    });

    $('#dropdownDashboardFooter .dropdown_select').click(function() {
        $('#dropdownDashboardFooter .dropdown_option_wrapper').toggleClass('active')
    })


    $("#dropdownDashboardFooter .dropdown_option").each(function(index) {
        $(this).on("click", function() {
            var activeOption = $(this).html();
            $('#dropdownDashboardFooter .dropdown_select').html(activeOption);
            $('#dropdownDashboardFooter .dropdown_option_wrapper').removeClass('active');
        });
    });

    $('#miniText .dropdown_select').click(function() {
        $('#miniText .dropdown_option_wrapper').toggleClass('active')
    })


    $("#miniText .dropdown_option").each(function(index) {
        $(this).on("click", function() {
            var activeOption = $(this).html();
            $('#miniText .dropdown_select').html(activeOption);
            $('#miniText .dropdown_option_wrapper').removeClass('active');
        });
    });

    $('.burger_popup_sidebar').click(function() {
        $('.popup_sidebar').toggleClass('active')
    })

    $('.widget_burger').click(function() {
        $('.dashboard_widget').toggleClass('active')
    })



});