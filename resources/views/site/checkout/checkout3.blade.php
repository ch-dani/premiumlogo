@extends('layouts.checkout')

@section('content')
    <main>
        <section class="choose">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                        <form id="checkoutForm" action="{{ route('checkout') }}">
                            @csrf
                            <div class="choose__plan">
                                @foreach(\App\Models\LogoPrice::all() as $logoPrice)
                                <div class="choose__plan-item">
                                    <label class="module__check">
                                        <input  type="checkbox" class="choose__checkbox" name="plan" value="{{ $logoPrice->id }}">
                                        <span class="check"></span>
                                    </label>
                                    <h2 class="choose__plan-title">{!! Translate::t($logoPrice->title) !!}</h2>
                                    <h3 class="choose__plan-cost {{ $logoPrice->price }}">{{ $logoPrice->symbol }}{{ $logoPrice->price }}</h3>
                                    <ul class="choose__plan-term">
                                        @foreach(explode(';', Translate::t($logoPrice->advantages)) as $advantage)
                                            <li>
                                                <img src="/site/img/check.svg" width="20" height="20" alt="check">{{ $advantage }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @php
                                @endphp
                                @endforeach
                            </div>

                            <div class="order">
                                <h2 class="order__title">Order Summary</h2>
                                <div class="order__item">
                                    <div class="order__selected">{{--Low-res (Selected)--}}</div>
                                </div>
                                <div class="order__item block">
                                </div>

                                <div class="order__item">
                                    <div class="order__subtotal">Subtotal:</div>
                                    <div class="order__cost subtotal">{{--free--}}</div>
                                </div>
                            </div>

                            <button class="btn bg-black to-right">Buy Logo</button>
                        </form>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                        <div class="choose__right bg-edit">
                            @if(isset($logo) && $logo)
                                <img src="{{ $logo['url'] }}" alt="logo">
                            @else
                                <div class="checkout__logo">
                                    <img src="/site/img/logo-make.png" width="159" height="40" alt="logo">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')
	<script>
		$(document).ready(function(){
			setTimeout(()=>{
				$(".choose__checkbox").eq(1).click()
			},1000)
		});
		
	</script>
    <script src="{{ asset('site/js/checkout.js') }}"></script>
@endsection

