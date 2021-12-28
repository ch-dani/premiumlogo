<?php

namespace App\Providers;

use App\Models\Language;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\LocaleMiddleware;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /* Language Switcher*/
		{
//			$locale = \App::getLocale();
			$locale = LocaleMiddleware::getLocale();
			$locale_main = LocaleMiddleware::$mainLanguage;

			if(!$locale){
				$locale = $locale_main;
			}

			$ActiveLanguage = Language::where( 'code', $locale )->where( 'status', 'active' )->first();

			view()->share( 'ActiveLanguage', $ActiveLanguage );
			view()->share( 'SiteLanguages', Language::where( 'status', 'active' )->where( 'id', '!=', $ActiveLanguage->id )->orderBy( 'id', 'asc' )->get() );
		}
    }
}
