<footer>
    <div class="container">
        <div class="top_footer">
            <div class="row">
                <div class="col-xl-6">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('site/img/logo_footer.svg') }}" alt="">
                        </a>
                    </div>
                    <p class="text_footer">
                        {!! \App\Models\Setting::findByName('footer_text')->translate ?? '' !!}
                    </p>
                </div>
                <div class="col-xl-6">
                    <div class="row">
                        @php $menu_footer1 = \App\Models\Menu::findByCode('footer1')->items(); @endphp
                        @if($menu_footer1)
                            <div class="col-xl-4">
                                <div class="module__footer_menu">
                                    <div class="title">{{ Translate::c('Company') }}</div>
                                    <ul class="footer_menu">
                                        @foreach($menu_footer1 as $item)
                                            <li>
                                                <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale() . '/' . $item->link) }}">{{ $item->title_translate }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @php $menu_footer2 = \App\Models\Menu::findByCode('footer2')->items(); @endphp
                        @if($menu_footer2)
                            <div class="col-xl-4">
                                <div class="module__footer_menu">
                                    <div class="title">{{ Translate::c('Community') }}</div>
                                    <ul class="footer_menu">
                                        @foreach($menu_footer2 as $item)
                                            <li>
                                                <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale() . '/' . $item->link) }}">{{ $item->title_translate }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @php $menu_footer3 = \App\Models\Menu::findByCode('footer3')->items(); @endphp
                        @if($menu_footer3)
                            <div class="col-xl-4">
                                <div class="module__footer_menu">
                                    <div class="title">{{ Translate::c('Products') }}</div>
                                    <ul class="footer_menu">
                                        @foreach($menu_footer3 as $item)
                                            <li>
                                                <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale() . '/' . $item->link) }}">{{ $item->title_translate }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>

                    @php
                        $twitter = \App\Models\Setting::findByName('social_twitter')->data ?? null;
                        $facebook = \App\Models\Setting::findByName('social_facebook')->data ?? null;
                        $instagram = \App\Models\Setting::findByName('social_instagram')->data ?? null;
                        $youtube = \App\Models\Setting::findByName('social_youtube')->data ?? null;
                    @endphp
                    <div class="row">
                        <div class="col">
                            <ul class="module__social">
                                @if($twitter)
                                    <li>
                                        <a href="{!! Translate::t($twitter) !!}" target="_blank">
                                            @php include(public_path('site/img/cib_twitter.svg')) @endphp
                                        </a>
                                    </li>
                                @endif
                                @if($facebook)
                                    <li>
                                        <a href="{!! Translate::t($facebook) !!}" target="_blank">
                                            @php include(public_path('site/img/cib_facebook-f.svg')) @endphp
                                        </a>
                                    </li>
                                @endif
                                @if($instagram)
                                    <li>
                                        <a href="{!! Translate::t($instagram) !!}" target="_blank">
                                            @php include(public_path('site/img/cib_instagram.svg')) @endphp
                                        </a>
                                    </li>
                                @endif
                                @if($youtube)
                                    <li>
                                        <a href="{!! Translate::t($youtube) !!}" target="_blank">
                                            @php include(public_path('site/img/cib_youtube.svg')) @endphp
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="copyright">© {{ date('Y') }} {!! \App\Models\Setting::findByName('footer_copyright')->translate ?? '' !!}
                        @php $menu_footer4 = \App\Models\Menu::findByCode('footer4')->items(); @endphp
                        @if($menu_footer4)
                            @foreach($menu_footer4 as $item)
                                <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale() . '/' . $item->link) }}">{{ $item->title_translate }}</a>@if (!$loop->last) | @endif
                            @endforeach
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

@include('site.inc.footer-script')

</body>
</html>
