@extends('layouts.site')

@section('content')
    <section class="price_card" id="hire-designer">
        <div class="container">
            <div class="row">
                <form autocomplete="off" action="{{ route('hire-designer.hire') }}">
                    @csrf
                    <div class="checkout__form">
                        <h1 class="checkout__title">{{Translate::t('If you need a personal designer just complete this form')}}</h1>
                        <div class="checkout__sub-title">{{Translate::t('We will contact you as soon as possible')}}</div>

                        <span data-field="name" class="invalid-feedback"></span>
                        <input required class="checkout__input" type="text" name="name" placeholder="{{Translate::t('Your Name')}}"/>

                        <span data-field="email" class="invalid-feedback"></span>
                        <input required class="checkout__input" type="text" name="email" placeholder="{{Translate::t('Your Email')}}"/>

                        <span data-field="message" class="invalid-feedback"></span>
                        <textarea required class="checkout__input" name="message" placeholder="{{Translate::t('Yor Message')}}"></textarea>

                        <button class="checkout__button checkout__button-login">{{Translate::t('Send')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('site/js/hireDesigner.js') }}"></script>
@endsection
