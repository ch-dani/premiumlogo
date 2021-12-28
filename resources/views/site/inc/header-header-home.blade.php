<div class="header-wrapper bg-gradient-green">
    @include('site.inc.header-header')

    @php
        $block = (new \App\Http\Controllers\HomeController)->getBlock('home-header');
        $block_data = isset($block->data) ? json_decode($block->data, true) : [];
        $slider_logos = \App\Models\Logo::inRandomOrder()->where('in_slider', true)->take($block_data['count'] ?? 0)->get();
    @endphp
    <div class="header-cover screen-height">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="title_h1">{!! Translate::t($block_data['title']) !!} ⏱</h1>
                    <div class="sub_title">{!! Translate::t($block_data['content']) !!}</div>

                    @include('site.inc.get-started-form')
                </div>
            </div>
        </div>

        @if(!$slider_logos->isEmpty())
            <div class="js_slider_company module__slider_company">
                @foreach($slider_logos as $slider_logo)
                    <div>
                        <div class="logo">
                        	<a href="{{ route('logo') . "?url=" . $slider_logo->image }}">
                                <img src="{{ $slider_logo->image }}" alt="" data-original-src="{{ $slider_logo->image }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
