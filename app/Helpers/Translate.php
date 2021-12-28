<?php

	namespace App\Helpers;

	use App\Models\Language;
	use App\Models\LanguageConstant;
	use Illuminate\Http\Request;
	use App;
	use App\Http\Middleware\LocaleMiddleware;

	class Translate {
		/**
		 * @param string $json
		 *
		 * @return string
		 */
		public static function t( $json = '' )
		{
			$locale = App::getLocale();
			$locale_main = LocaleMiddleware::$mainLanguage;

			if($locale){
				if($json){
					if(is_array($json)){
						$json = json_encode($json);
					}

					$array = json_decode($json, true);

					if($array){
						if(isset($array[$locale]) && $array[$locale]){
							return html_entity_decode($array[$locale]);
						}elseif(isset($array[$locale_main]) && $array[$locale_main]){
							return $array[$locale_main];
						}else{
							return Translate::c('No translation');
						}
					}
				}
			}

			return $json;
		}

		/**
		 * @param string $text
		 *
		 * @return string
		 */
		public static function c( $text = '' )
		{
			$locale  = LocaleMiddleware::getLocale() ?? LocaleMiddleware::$mainLanguage;
			$lang_id = Language::where( 'code', $locale )->pluck( 'id' )->first();
			$text    = trim( $text );
			$new_obj = LanguageConstant::where( "key", $text )->first();

			if ( ! $new_obj ) {
				$new_obj = [];
				foreach ( Language::all() as $l ) {
					if ( $l->id == 1 ) {
						$new_obj[ $l->id ] = $text;
					} else {
						$new_obj[ $l->id ] = "";
					}
				}

				LanguageConstant::create( [
					"key"       => $text,
					"translate" => json_encode( $new_obj )
				] );

				return $text;
			} else {
				$new_obj = json_decode( $new_obj['translate'], 1 );
				$ret = ( $new_obj && isset( $new_obj[ $lang_id ] ) ) ? $new_obj[ $lang_id ] : $text;

				if ( ! $ret ) {

					return $text;
				}

				return $ret;
			}

			return $text;
		}

		public static function getClearRequestPath( Request $request )
		{
			return preg_replace('/^'.App::getLocale().'\//', '', $request->path());
		}
	}