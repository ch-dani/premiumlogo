@extends('layouts.checkout')

@section('content')
    <section class="payment-successful">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="payment-successful__inner">
                        <div class="payment-successful__icon">
                            <img src="/site/img/label.png">
                        </div>
                        <h1 class="payment-successful__title">Payment Successful</h1>
                        <div class="payment-successful__sub">
                            Your payment was successful. Your logo was sent to your email. Thank you for using Free Logo Design!
                        </div>

                        {{--                        <div class="btn_wrapper">--}}
                        {{--                            <a href="{{ route('') }}" class="btn btn-green ">Download</a>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script type="text/javascript">
        var aeEvent = {};
        aeEvent.key = '{{ \App\Models\Setting::findByName('affilae_key')->data ?? null }}';
        aeEvent.Conversion = {};
        aeEvent.Conversion.id = '{{ $payment->id }}';
        aeEvent.Conversion.amount = '{{ $payment->amount / 100 }}';
        aeEvent.Conversion.payment = 'online';
        ('AeTracker' in window)
            ? AeTracker.sendConversion(aeEvent)
            : (window.AE = window.AE || []).push(aeEvent);
    </script>

    <script src="{{ asset('site/js/checkout.js') }}"></script>
@endsection
