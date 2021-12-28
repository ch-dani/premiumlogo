<head>
<?php
$url='';
   if(Request::path()!='/'){
    $url=Request::path();
}
?>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ auth()->user()->api_token ?? null }}">
    <meta name="description" content="{{ $page->seo_description ?? '' }}">
    <link rel="canonical" href="https://www.premiumlogodesign.com/{{$url}}"/>
    @if(isset($page->seo_title))
        <title>{{ $page->seo_title }} | {{ env('APP_NAME') }}</title>
    @else
        <title>@yield('title') | {{ env('APP_NAME') }}</title>
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap-grid.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/main-alpha.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/main-bravo.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/main-charlie.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/main-delta.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/main-tango.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/media-alpha.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/media-bravo.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/media-charlie.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/media-delta.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/dashboard-main-alpha.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/dashboard-main-bravo.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/dashboard-main-charlie.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/dashboard-media-alpha.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/dashboard-media-bravo.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/dashboard-media-charlie.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('site/js/picker/jquery.gradientPicker.css') }}">
    <link rel="stylesheet" href="{{ asset('site/js/picker/jqPlugins/colorpicker/css/colorpicker.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Chilanka&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="/favicon.ico">

    <script type="text/javascript">
        var _ae = {
            'pid': '{{ \App\Models\Setting::findByName('affilae_program_id')->data ?? null }}',
        };

        (function() {
            var element = document.createElement('script'); element.type = 'text/javascript'; element.async = true;
            element.src = '//static.affilae.com/ae-v3.5.js';
            var scr = document.getElementsByTagName('script')[0]; scr.parentNode.insertBefore(element, scr);
        })();
    </script>

    @yield('css')
</head>
