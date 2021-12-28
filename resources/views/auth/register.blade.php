@extends('layouts.checkout')

@section('content')
    <main>
        <section class="checkout ">
            <div class="checkout__left bg-gradient-green">
                <div class="new-customer">
                    <form action="{{ route('register') }}" id="register">
                        @csrf
                        <div class="checkout__form">
                            <h1 class="checkout__title">New Customer</h1>
                            <div class="checkout__sub-title">Sign up now to save or download your design.</div>

                            <input class="checkout__input" type="text" name="name" placeholder="Your Name"/>
                            <span data-field="name" class="invalid-feedback"></span>

                            <input class="checkout__input" type="text" name="email" placeholder="Your Email"/>
                            <span data-field="email" class="invalid-feedback"></span>

                            <input class="checkout__input" type="password" name="password" placeholder="Password"/>
                            <span data-field="password" class="invalid-feedback"></span>

                            <input class="checkout__input" type="password" name="password_confirmation" placeholder="Confirm Password"/>

                            <button class="checkout__button checkout__button-register">Register</button>
                            <button type="button" class="checkout__button checkout__button-login">Login</button>
                        </div>
                    </form>
                   @include('auth.social-buttons')
                </div>

            </div>
            <div class="separator"><img src="/site/img/label.png" alt="label" width="95" height="95"></div>
            <div class="checkout__right bg-edit">
                @if(isset($logo) && $logo)
                    <img src="{{ $logo['url'] }}" alt="logo">
                @else
                    <div class="checkout__logo">
                        <img src="/site/img/logo-make.png" width="159" height="40" alt="logo">
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection

@section('css')
    <style>
        .invalid-feedback {
            margin-top: -30px;
            text-align: left;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('site/js/auth.js') }}"></script>
@endsection

