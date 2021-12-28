@include('site.inc.checkout-header')

<body class="{{ isset($body_class) ? $body_class : '' }}">

@yield('content')

@include('site.inc.footer')


