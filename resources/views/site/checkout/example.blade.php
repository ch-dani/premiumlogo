@extends('layouts.example')

@section('content')
    <main>
        <section class="preview logo_result">
            <div class="container">
                @if($logo['original_url'])
                <div class="row" style="justify-content: center;">
                    <img src="{{ $logo['original_url'] }}"/>
                    <!-- <img src="{{ $logo['url'] }}"/> -->
                </div>
                @else

                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="circle">
                            <div class="logo_box">
                                @if(isset($logo) && $logo)
                                    <img src="{{ $logo['url'] }}" alt="">
                                @endif
                            </div>
                        </div>

                        <div class="preview-mockup-1">
                            <div class="logo_box">
                                @if(isset($logo) && $logo)
                                    <img src="{{ $logo['url'] }}" alt="">
                                @endif
                            </div>
                            <img src="{{ asset('site/img/preview-mockup-1.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="preview-mockup-2">
                            <div class="logo_box">
                                @if(isset($logo) && $logo)
                                    <img src="{{ $logo['url'] }}" alt="">
                                @endif
                            </div>
                            <img src="{{ asset('site/img/preview-mockup-2.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="wrapper_preview">
                            <div class="preview-mockup-3">
                                <div class="logo_box">
                                    @if(isset($logo) && $logo)
                                        <img src="{{ $logo['url'] }}" alt="">
                                    @endif
                                </div>
                                <img src="{{ asset('site/img/preview-mockup-3.png') }}" alt="">
                            </div>

                            <div class="preview-mockup-4">
                                <div class="logo_box">
                                    @if(isset($logo) && $logo)
                                        <img src="{{ $logo['url'] }}" alt="">
                                    @endif
                                </div>
                                <img src="{{ asset('site/img/preview-mockup-4.png') }}" alt="">
                            </div>

                            <div class="preview-mockup-5">
                                <div class="logo_box">
                                    @if(isset($logo) && $logo)
                                        <img src="{{ $logo['url'] }}" alt="">
                                    @endif
                                </div>
                                <img src="{{ asset('site/img/preview-mockup-5.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </section>
    </main>
@endsection
