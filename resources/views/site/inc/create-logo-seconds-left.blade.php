@php
    $block = (new \App\Http\Controllers\HomeController)->getBlock('create-logo-in-seconds');
    $block_data = isset($block->data) ? json_decode($block->data, true) : [];
    
@endphp

<section class="about bg_1">
    <div class="container">
        <div class="row flex-vertical-align">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="about__title-wrapper">
                    <h2 class="title_h2">{!! Translate::t($block_data['title']) !!}</h2>
                    <div class="about__sub-title sub_title">{!! Translate::t($block_data['content']) !!}</div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="about__text">
                    {!! Translate::t($block_data['content2']) !!}

                    <a href="{{ route('logo') }}" class="btn btn-green btn_192_56">{{ Translate::c('Get started') }}</a>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="about__img">
                    <img src="{{ asset('site/img/label.png') }}" alt="label" width="95" height="95" class="img-label">
                    {!! Translate::t($block_data['content3']) !!}
                </div>
            </div>
        </div>
    </div>
</section>
