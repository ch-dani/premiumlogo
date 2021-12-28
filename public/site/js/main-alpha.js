var $ = jQuery.noConflict();

$(document).ready(function () {
    var uaTwo = window.navigator.userAgent;
    var isIETwo = /MSIE|Trident/.test(uaTwo);

    if (isIETwo) {
        document.documentElement.classList.add('ie');
    }

    $('.js_slider_company').slick({
        infinite: true,
        slidesToShow: 7,
        slidesToScroll: 1,
        centerMode: true,
        variableWidth: true,
        ///autoplay: true,
        //autoplaySpeed: 2000,
    });

    $(document).on('click', '.js_slider_company .logo a', function() {
        let src = $(this).find('img').data('original-src');
        if (src !== $(this).find('img').attr('src')) {
            let file = new File([svgBlob[src]], "name");
            let data = new FormData();
            data.append('file', file);

            $.ajax({
                url: '/api/upload',
                data: data,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (data) {
                    if (data.status === 'success') {
                        window.location.href = '/logo?url=' + data.src
                    } else {
                        window.location.reload();
                    }
                }
            });

            return false;
        }
    });

    let svgTimer = null;

    $('#svgText').on('keyup', function() {
        if (svgTimer !== null) {
            clearTimeout(svgTimer);
        }

        svgTimer = setTimeout(() => {
            rewriteSvg($(this).val());
        }, 600);
    });

    let svgArray = {};
    let svgBlob = {};

    function rewriteSvg(text) {
        svgTimer = null;

        $('.js_slider_company .logo img').each(function(i, item) {
            let src = $(item).data('original-src');

            if (src.split('.').pop().toLowerCase() === 'svg') {
                let svg = '';

                if (typeof svgArray[src] !== 'undefined') {
                    svg = svgArray[src];
                } else {
                    svg = httpGet(src);
                    svgArray[src] = svg;
                }

                svg = svg.replace(/(<text.*?>).*?(<\/text>)/, '$1' + text + '$2');

                let blob = new Blob([svg], {type: 'image/svg+xml'});
                let url = URL.createObjectURL(blob);

                svgBlob[src] = blob;

                $(item).attr('src', url);
            }
        });
    }

    function httpGet(theUrl) {
        let xmlhttp;

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                return xmlhttp.responseText;
            }
        }

        xmlhttp.open("GET", theUrl, false);
        xmlhttp.send();

        return xmlhttp.response;
    }

    /*
    $('.languagepicker .language-link').click(function (e) {
        e.preventDefault();
        var result = $(this).clone();
        $('.language-active').html(result);
    });
    */

    $('.module__accordion .title_box').on('click', function () {
        if ($(this).parent().hasClass("active")) {
            $(this).parent().removeClass('active');
            $(this).find('.icon').removeClass('rotate');
        } else {
            $(this).parent().addClass('active');
            $(this).find('.icon').addClass('rotate');
        }
    });

    $(".burger_menu").on("click", function () {
        $(".wrapper_mobile_menu").toggleClass("open");
        $("body").toggleClass("body_overflow");
    });

    $('.open-modal').click(function () {
        var modalId = $(this).data('modal');
        var modal = $('#' + modalId);
        modal.fadeIn();
        $('body, html').addClass('body_overflow');
        return false;
    });

    $(document).mouseup(function (e) {
        var popup = $('.popup');
        if (e.target != popup[0] && popup.has(e.target).length === 0) {
            $('.overlay').fadeOut();
        }
        $('body, html').removeClass('body_overflow');
        return false;
    });

    $('.close_popup').on('click', function () {
        $('.overlay').fadeOut();
        return false;
    })

    if ($('.scroll_box').length > 0) {
        const container = document.querySelector('.scroll_box');
        const ps = new PerfectScrollbar(container);
    }

});
