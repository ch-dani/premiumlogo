<!doctype html>
<html lang="en">

@include('site.inc.header-head')

<header class="dashboard-header checkout2 logo_header">
    <div class="container">
        <div class="wrapper_left">
            <div class="dashboard-header__back"><a href="{{ url()->previous() }}"><img
                            src="/site/img/arroew-left-back.svg">back</a>
            </div>
            <div class="dashboard-header__logo">
                <div class="logo">
                    <a href="/">
                        <img src="/site/img/logo.svg" alt="">
                    </a>
                </div>
            </div>
        </div>
        <a href="{{ route('save-logo') }}" class="btn btn_checkout">Checkout</a>
    </div>
</header>
