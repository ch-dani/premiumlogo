<header class="dashboard_header">
    <div class="dh_left">
        <a href="{{ route('home') }}" class="dh_logo">
            <img src="{{ asset('site/img/logo-2.svg') }}" alt="">
        </a>

        <div class="dh_btn_wrapper">
            <a href="{{ route('faq.index') }}" class="dh_btn">{{ Translate::c('Help Center') }}</a>
        </div>
    </div>
    <div class="dh_center">
        <div class="dh_tool_btns">
            <a href="#" class="dh_tool_btn add-new-text">
                <img src="{{ asset('site/img/icon-btn-tool-1.svg') }}" alt="">
                {{ Translate::c('Add Text') }}
            </a>
            <a href="#" class="dh_tool_btn open-modal" data-modal="add_shape">
                <img src="{{ asset('site/img/icon-btn-tool-2.svg') }}" alt="">
                {{ Translate::c('Add Shape') }}
            </a>
            <a href="#" class="dh_tool_btn open-modal" data-modal="add_icon">
                <img src="{{ asset('site/img/icon-btn-tool-3.svg') }}" alt="">
                {{ Translate::c('Add Icon') }}
            </a>
            <a href="#" class="dh_tool_btn open-modal" data-modal="add_logo">
                <img src="{{ asset('site/img/icon-btn-tool-4.svg') }}" alt="">
                {{ Translate::c('Add Logo') }}
            </a>
        </div>
    </div>
    <div class="dh_right">
        <div class="bg_dashboard">
            <span>{{ Translate::c('Background') }}</span>

            <div class="bg_dashboard_tool_wrapper">
                <input type="color" class="bg_dashboard_tool" id="bgColorInput"/>
            </div>
        </div>

        @include('site.inc.language-switcher')

        <a href="" class="btn_save">
                @php include(public_path('site/img/save-file.svg')) @endphp
            {{ Translate::c('save') }}
        </a>
    </div>
</header>