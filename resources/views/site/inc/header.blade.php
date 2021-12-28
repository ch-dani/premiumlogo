<!doctype html>
<html lang="en">

@include('site.inc.header-head')

<body class="{{ isset($body_class) ? $body_class : '' }}">

@if(Route::currentRouteName() == 'home')
    @include('site.inc.header-header-home')
@else
    @include('site.inc.header-header')
@endif
