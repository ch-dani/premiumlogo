<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Request;

//	use Illuminate\Http\Request;

class LocaleMiddleware
{
    public static $mainLanguage = 'en';

    public static $languages = [
        'en',
        'fr',
        'de',
        'da',
        'es',
        'id',
        'it',
        'ja',
        'no',
        'pl',
        'pt',
        'ru',
        'sv',
        'tr',
        'uk',
        'vi',
        'zh',
        'zh-TW',
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        $locale = self::getLocale();

        if ($locale) {
            App::setLocale($locale);
        } else {
            App::setLocale(self::$mainLanguage);
        }

        return $next($request);
    }

    public static function getLocale()
    {
        $uri         = Request::path();
        $segmentsURI = explode('/', $uri);

        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {
            if ($segmentsURI[0] != self::$mainLanguage) {
                return $segmentsURI[0];
            }
        }

        return null;
    }
}
