@php
    $block = (new \App\Http\Controllers\HomeController)->getBlock('about-freeLogoDesign');
    $block_data = isset($block->data) ? json_decode($block->data, true) : [];
@endphp

<section class="about about_2 bg_1">
    <div class="container">
        <div class="row flex-vertical-align">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="about__title-wrapper">
                    <h2 class="title_h2">{!! Translate::t($block_data['title']) !!}</h2>
                    <div class="about__sub-title sub_title">{!! Translate::t($block_data['content']) !!}</div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="about__img">
                    {!! Translate::t($block_data['content2']) !!}
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="about__text">
                    {!! Translate::t($block_data['content3']) !!}
                </div>
            </div>
        </div>
    </div>
</section>
