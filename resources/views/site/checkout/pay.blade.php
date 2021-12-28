@extends('layouts.checkout')
@section('content')
<form id="stripePayment" action="{{ route('pay-stripe', $logoPrice) }}">
	@csrf
	<section class="checkout ">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
					<div class="payment">
						<div class="payment-form">
							<div class="payment__heading">
								<h2 class="checkout__title">{{Translate::t('Choose a Payment Method')}}</h2>
							</div>
							<div class="payment__method">
								<button class="checkout__button checkout__button-credit"><img src="/site/img/credit-card.svg">{{Translate::t('Credit Card')}}</button>
								<a href="{{ route('redirect-paypal', $logoPrice->id) }}" class="checkout__button"><img src="/site/img/pp.svg">PayPal</a>
							</div>
							<div class="payment__form">
								<span data-field="card_number" class="invalid-feedback"></span>
								<input required class="checkout__input mask_it" data-vmask="0000 0000 0000 0000" type="text" name="card_number" placeholder="{{Translate::t('Card Number')}}"/>
								<span data-field="cardholder_name" class="invalid-feedback"></span>
								<input required class="checkout__input" name="cardholder_name" type="text" placeholder="{{Translate::t('Cardholder Name')}}"/>
								<div class="checkout__form-half">
									<div class="checkout__form-half-item">
										<span data-field="expiration_date" class="invalid-feedback"></span>
										<input required class="checkout__input mask_it" data-vmask="00/00" name="expiration_date" type="text" placeholder="{{Translate::t('Expiration Date')}}"/>
									</div>
									<div class="checkout__form-half-item">
										<span data-field="cvv" class="invalid-feedback"></span>
										<input required class="checkout__input mask_it" data-vmask="000" type="text" name="cvv" placeholder="CVV"/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
					<div class="payment">
						<div class="payment-form">
							<div class="payment__heading">
								<h2 class="checkout__title">{{Translate::t('Billing Details')}}</h2>
							</div>
							<div class="payment__form">
								<input required data-vmask="+0000-0000-0000"  class="mask_it checkout__input" name="billing_details[phone_number]" type="text" placeholder="{{Translate::t('Phone Number')}}" value="{{ auth()->user()->billingDetails->phone_number ?? null }}"/>
								<input required class="checkout__input"  name="billing_details[country]" type="text" placeholder="{{Translate::t('Country')}}" value="{{ auth()->user()->billingDetails->country ?? null }}"/>
								<div class="checkout__form-half">
									<div class="checkout__form-half-item">
										<input required class="checkout__input" name="billing_details[state]" type="text" placeholder="{{Translate::t('State')}}" value="{{ auth()->user()->billingDetails->state ?? null }}"/>
									</div>
									<div class="checkout__form-half-item">
										<input required class="checkout__input" name="billing_details[city]" type="text" placeholder="{{Translate::t('City')}}" value="{{ auth()->user()->billingDetails->city ?? null }}"/>
									</div>
								</div>
								<div class="checkout__form-half">
									<div class="checkout__form-half-item">
										<input required data-vmask="00000-000" class="mask_it checkout__input" name="billing_details[zip]" type="text" placeholder="{{Translate::t('Zip Code')}}" value="{{ auth()->user()->billingDetails->zip ?? null }}"/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="order-total">
		<div class="container">
			<div class="order-total__info">
				<span class="order-total__text">{{Translate::t('Order Total')}}:</span>
				<span class="order-total__sum">{{ $logoPrice->symbol }}{{ $logoPrice->price }}</span>
			</div>
		</div>
	</div>
	<div class="order-agree">
		<div class="container">
			<div class="order-agree__info">
				<span class="order-agree__text">
				<label class="module__check"><input  id="terms_checkbox" type="checkbox" class="choose__checkbox"><span
					class="check"></span></label>
					{{Translate::t('I agree with')}} <a target="_blank" href="{{url('/terms')}}">{{Translate::t('Terms and Conditions')}}</a>
				</span>
				<button class="btn bg-black">{{Translate::t('Buy Logo')}}</button>
			</div>
		</div>
	</div>
</form>
@endsection
@section('js')
<script src="{{ asset('site/js/checkout.js') }}"></script>
@endsection

