<!doctype html>
<html lang="en">

@include('site.inc.header-head')

<body <?php if (isset($body_class)) { ?>class="<?php echo $body_class; ?>" <?php } ?>>

@include('site.inc.header-dashboard')
