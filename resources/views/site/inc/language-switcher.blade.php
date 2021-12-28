@php
    $locale = App\Http\Middleware\LocaleMiddleware::getLocale();
    $locale_main = App\Http\Middleware\LocaleMiddleware::$mainLanguage;
    $url = Request::getRequestUri();
    $url = preg_replace('/^\/'.$locale.'\//', '', $url);
    $url = preg_replace('/^\/'.$locale.'/', '', $url);
    $url = ltrim($url, '/');
@endphp
<div class="footer_bottom_item language">
    <div class="switch-language">
        <div class="language-active">
            <a class="language-link SelectLanguage">
                {{ mb_convert_case($ActiveLanguage->code, MB_CASE_UPPER, 'UTF-8') }}
            </a>
        </div>

        @if(isset($SiteLanguages) && $SiteLanguages)
            <div class="icon">@php include(public_path('site/img/arrow_bottom_icon.svg')) @endphp</div>
            <ul class="languagepicker">
                @foreach($SiteLanguages as $language)
                    @php
                        if($language->code == $locale_main){
                            $url_lang = '/' . $url;
                        }else{
                            $url_lang = '/' . $language->code;
                            if($url){
                                $url_lang .= '/' . $url;
                            }
                        }
                    @endphp
                    <li>
                        <a class="language-link SelectLanguage" href="{{ $url_lang }}" data-id="{{ $language->id }}">
                            <img src="{{ $language->flag }}">{{ $language->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>