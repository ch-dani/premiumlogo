@php
    $block = (new \App\Http\Controllers\HomeController)->getBlock('why-choose-freeLogoDesign');
    $data = isset($block->data) ? json_decode($block->data, true) : [];
@endphp

@if($data)
    <section class="why_choose bg_4">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="about__title-wrapper">
                        <h2 class="title_h2">{!! Translate::t($data['title']) !!}</h2>
                        <div class="about__sub-title sub_title">{!! Translate::t($data['content']) !!}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($data['blocks'] as $blockItem)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="why_item">
                            <div class="why_icon_wrapper">
                                <img src="{!! Translate::t($blockItem['image']) !!}" alt="">
                            </div>
                            <div class="why_item_content">
                                <h3 class="why_item_title">{!! Translate::t($blockItem['title']) !!}</h3>
                                <div class="why_item_txt">
                                    <p>{!! Translate::t($blockItem['content']) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="why_item create_logo">
                        <h3 class="why_item_title">{!! Translate::t($data['create_logo']['title']) !!}</h3>
                        <div class="why_item_txt">
                            <p>{!! Translate::t($data['create_logo']['content']) !!}</p>
                        </div>
                        <a href="{{ route('logo') }}" class="btn btn-green btn_192_56">{!! Translate::t($data['create_logo']['button_text']) !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
