@include('site.inc.example-header')

<body class="{{ isset($body_class) ? $body_class : '' }}">

@yield('content')

@include('site.inc.footer')