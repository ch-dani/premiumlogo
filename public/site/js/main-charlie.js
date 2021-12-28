var $ = jQuery.noConflict();

$(document).ready(function () {

    $('.js_slider_testimonial').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        prevArrow: null,
        nextArrow: null
    });


});
