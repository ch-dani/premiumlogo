<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Auth\AdminLoginController;

//    use App\Http\Controllers\Admin\LogoController;
//    use App\Http\Controllers\Admin;

Route::get('setlocale/{lang}', function ($lang) {

    $referer   = Redirect::back()->getTargetUrl();
    $parse_url = parse_url($referer, PHP_URL_PATH);

    $segments = explode('/', $parse_url);

    if (in_array($segments[1], App\Http\Middleware\LocaleMiddleware::$languages)) {

        unset($segments[1]);
    }

    if ($lang != App\Http\Middleware\LocaleMiddleware::$mainLanguage) {
        array_splice($segments, 1, 0, $lang);
    }

    $url = Request::root() . implode("/", $segments);

    if (parse_url($referer, PHP_URL_QUERY)) {
        $url = $url . '?' . parse_url($referer, PHP_URL_QUERY);
    }
    return redirect($url);

})->name('setlocale');

Route::group(['prefix' => App\Http\Middleware\LocaleMiddleware::getLocale()], function () {
    /*
    Route::get('/', function () {
        return view('welcome');
    });
    */

    Auth::routes();

	//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Social login
    Route::get('/redirect/{social}', '\App\Http\Controllers\Auth\LoginController@redirectToProvider')->name('social');
    Route::get('/callback/{provider}', 'App\Http\Controllers\Auth\LoginController@socialLoginCallback');


	Route::get('/logo', '\App\Http\Controllers\LogoController@index')->name('logo');
	Route::get('/create-template', '\App\Http\Controllers\LogoController@index')->name('create-template');	
	
	Route::get('/logo/{template}/edit', '\App\Http\Controllers\LogoController@templateEdit')->name('logo-edit');
	Route::get('/logo/{template}', '\App\Http\Controllers\LogoController@template')->name('logo-tshirt');
	
	Route::get('/logo-template-list', '\App\Http\Controllers\LogoController@templateList')->name('logos-templates-list');
	Route::get('/logo-template-list/{template}', '\App\Http\Controllers\LogoController@templateListById')->name('logos-templates-list-by-id');
	
	


//    Route::get('/logo', function () {
//        return view('site.logo');
//    })->name('logo');

    Route::get('/', [PageController::class, 'home'])->name('home');

    Route::prefix('logos')->name('logos.')->namespace('App\Http\Controllers')->group(function () {
        Route::get('/', 'LogoController@categories')->name('categories');
        Route::post('/', 'LogoController@searchCategories')->name('search-categories');
//			Route::get( '/', [ LogoController::class, 'categories' ] )->name( 'categories' );
        Route::get('/{category:url}', 'LogoController@category')->name('category');

		Route::prefix('json')->name('json.')->group(function () {
			Route::post('/categories', 'LogoController@getCategoriesJson')->name('categories');
			Route::get('/categories', 'LogoController@getCategoriesJson')->name('categories');			
			Route::post('/logos/{category?}', 'LogoController@getLogosJson')->name('logos');
            Route::post('/icons', 'LogoController@getIconsJson')->name('icons');
            Route::get('/icon', 'LogoController@getIcon')->name('icon');
			Route::post('/shapes', 'LogoController@getShapesJson')->name('shapes');
		});
    });

    Route::prefix('faq')->name('faq.')->namespace('App\Http\Controllers')->group(function () {
        Route::get('/', 'QuestionController@index')->name('index');
		Route::get('/{category:url}', 'QuestionController@category')->name('category');
		Route::get('/{category:url}/{question}', 'QuestionController@categoryQuestion')->name('category-question');
		Route::post('/questions', 'QuestionController@searchQuestions')->name('search-questions');
    });

    Route::get('testimonials', [PageController::class, 'testimonials'])->name('testimonials');
    Route::get('about-us', [PageController::class, 'aboutUs'])->name('about-us');

    Route::get('example-logo', '\App\Http\Controllers\CheckoutController@example')->name('example-logo');
    Route::get('save-logo', '\App\Http\Controllers\CheckoutController@index')->name('save-logo');
    Route::post('checkout', '\App\Http\Controllers\CheckoutController@checkout')->name('checkout');
    Route::get('checkout/success/{payment}', '\App\Http\Controllers\CheckoutController@success')->name('success');
    Route::get('pay/{logoPrice}', '\App\Http\Controllers\CheckoutController@pay')->name('pay');
    Route::post('save-user-logo', '\App\Http\Controllers\LogoController@saveUserLogo')->name('save-user-logo');

    Route::get('pay/paypal/{price}', '\App\Http\Controllers\Payments\PayPalController@redirect')->name('redirect-paypal');
    Route::post('pay/stripe/{price}', '\App\Http\Controllers\Payments\StripeController@pay')->name('pay-stripe');

    Route::resource('blog', BlogController::class);
    Route::prefix('blog')->as('blog.')->group(function () {
        Route::get('/category/{blog_article_category}', [BlogController::class, 'category'])->name('category');
        Route::get('/article/{article}', [BlogController::class, 'article'])->name('article');
        Route::get('/ajax/category/search', [BlogController::class, 'searchCategory']);
    });

    Route::prefix('hire-designer')->as('hire-designer.')->group(function () {
        Route::get('/', 'App\Http\Controllers\HireDesignerController@index')->name('index');
        Route::get('/hire-designer-form', 'App\Http\Controllers\HireDesignerController@contact')->name('form');
        Route::post('/hire', 'App\Http\Controllers\HireDesignerController@hire')->name('hire');
    });

    Route::prefix('contact-us')->as('contact-us.')->group(function () {
        Route::get('/', 'App\Http\Controllers\ContactController@index')->name('index');
        Route::post('/contact', 'App\Http\Controllers\ContactController@contact')->name('contact');
    });

	Route::get('/{page_path}', [PageController::class, 'page'])->where('page_path', '^(?!(admin-ui|logout|login|register|password/reset)(\/|$))[A-Za-z0-9+-_\/]+')->name('page');
});

Route::prefix('admin-ui')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'index'])->name('admin-login.index');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin-login');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin-logout');
    Route::post('/save-template', '\App\Http\Controllers\Admin\LogoController@saveTemplate')->name('admin-save-template');
});

//    Route::prefix('admin')->as('admin.')->middleware('admin')->namespace('Admin')->group(function () {
Route::prefix('admin-ui')->as('admin.')->middleware('admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('logos/import', 'LogoController@importIndex')->name('logos.import');
    Route::post('logos/import', 'LogoController@import')->name('logos.import');


	Route::resource('templates', TemplatesController::class);


    Route::resource('logos', LogoController::class);

//    Route::resource('product-designer', PDController::class);
//    Route::resource('pd-categories', PDCategoryController::class);

    Route::resource('logos-categories', LogoCategoryController::class);

    Route::resource('users', UserController::class);

    Route::get('profile', ['App\Http\Controllers\Admin\ProfileController', 'index'])->name('profile.index');
    Route::put('profile/update/{user}', ['App\Http\Controllers\Admin\ProfileController', 'update'])->name('profile.update');

    Route::get('shapes/import', 'ShapeController@importIndex')->name('shapes.import');
    Route::post('shapes/import', 'ShapeController@import')->name('shapes.import');
    Route::resource('shapes', ShapeController::class);

    Route::get('icons/import', 'IconController@importIndex')->name('icons.import');
    Route::post('icons/import', 'IconController@import')->name('icons.import');
    Route::resource('icons', IconController::class);

    Route::resource('faq', QuestionController::class);
    Route::resource('faq-categories', QuestionCategoryController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('team', TeamController::class);

    Route::prefix('settings')->as('settings.')->group(function () {
		Route::get('/', 'SettingController@index')->name('index');
		Route::post('/update', 'SettingController@update')->name('update');
	});

	Route::prefix('menu')->as('menu.')->group(function () {
		Route::get('/', 'MenuController@index')->name('index');
		Route::get('/edit/{menu}', 'MenuController@edit')->name('edit');
		Route::post('/store', "MenuController@store");
		Route::post('/get-sortable', "MenuController@get_sortable")->name('get-sortable');
		Route::post('/save-sortable', "MenuController@save_sortable")->name('save-sortable');
		Route::post('/remove', "MenuController@remove")->name('remove');
	});

    Route::prefix('pages')->as('pages.')->group(function () {
        Route::post('/{page}/data', 'PageController@updateData')->name('update-data');
        Route::post('/{page}/data/delete', 'PageController@destroyData')->name('destroy-data');
    });
    Route::resource('pages', \PageController::class);

	Route::prefix('blocks')->as('blocks.')->group(function () {
		Route::post( '/update', 'BlockController@update' )->name( 'update' );

		Route::get( '/home-header', 'BlockController@edit' )->name( 'home-header' );
		Route::get( '/create-logo-in-seconds', 'BlockController@edit' )->name( 'create-logo-in-seconds' );
		Route::get( '/how-create-logo', 'BlockController@edit' )->name( 'how-create-logo' );
		Route::get( '/why-choose-freeLogoDesign', 'BlockController@edit' )->name( 'why-choose-freeLogoDesign' );
		Route::get( '/professional-logos-for-your-company', 'BlockController@edit' )->name( 'professional-logos-for-your-company' );
		Route::get( '/about-freeLogoDesign', 'BlockController@edit' )->name( 'about-freeLogoDesign' );
	});

    Route::resource('blog', 'BlogController');
    Route::resource('blog-categories', 'BlogCategoryController');
    Route::prefix('blog')->as('blog.')->group(function () {
        //
    });

    Route::resource('designer-plans', 'DesignerPlanController');
    Route::resource('logo-prices', 'LogoPriceController');
    Route::resource('hire-designer-messages', 'HireDesignerMessageController');

    Route::resource('payments', 'PaymentController')->only(['index']);
});


include "web2.php";
