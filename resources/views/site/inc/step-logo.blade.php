@php
    $block = (new \App\Http\Controllers\HomeController)->getBlock('how-create-logo');
    $block_data = isset($block->data) ? json_decode($block->data, true) : [];
@endphp

<section class="step_logo bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="about__title-wrapper">
                    <h2 class="title_h2">{!! Translate::t($block_data['title']) !!}</h2>
                    <div class="about__sub-title sub_title">{!! Translate::t($block_data['content']) !!}</div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($block_data['blocks'] as $blockItem)
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                    <div class="step_logo_item">
                        <div class="step_number">
                            @php include(public_path('site/img/step-number.svg')) @endphp
                            <span>{{ $loop->iteration < 10 ? '0' : '' }}{{ $loop->iteration }}</span>
                        </div>
                        <div class="step_txt">
                            <p>{!! Translate::t($blockItem['content']) !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="btn_wrapper">
                    <a href="{{ route('logo') }}" class="btn btn-green btn_192_56">{{ Translate::c('Create logo') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
