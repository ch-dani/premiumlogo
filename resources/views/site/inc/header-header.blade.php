<header class="header">
    <div class="top_line">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6">
                    @php $menu_header1 = \App\Models\Menu::findByCode('header1')->items(); @endphp
                    @if($menu_header1)
                        <nav>
                            <ul class="module__main_menu">
                                @foreach($menu_header1 as $item)
                                    <li>
                                        <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale() . '/' . $item->link) }}">{{ $item->title_translate }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    @endif
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('site/img/logo.svg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6">
                    <div class="wrapper_language">
                        @php $menu_header2 = \App\Models\Menu::findByCode('header2')->items(); @endphp
                        @if($menu_header2)
                            <nav>
                                <ul class="module__main_menu module__main_menu_right">
                                    @foreach($menu_header2 as $item)
                                        <li>
                                            <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale() . '/' . $item->link) }}">{{ $item->title_translate }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                        @endif

                        @include('site.inc.language-switcher')
                    </div>
                    <div class="burger_menu">
                        @php include(public_path('site/img/open-menu.svg')) @endphp
                    </div>
                    <div class="wrapper_mobile_menu">
                        @php $menu_header3 = \App\Models\Menu::findByCode('header3')->items(); @endphp
                        @if($menu_header3)
                            <nav>
                                <ul class="module__main_menu">
                                    @foreach($menu_header3 as $item)
                                        <li>
                                            <a href="{{ url(App\Http\Middleware\LocaleMiddleware::getLocale() . '/' . $item->link) }}">{{ $item->title_translate }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </nav>
                        @endif

                        @include('site.inc.language-switcher')
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
