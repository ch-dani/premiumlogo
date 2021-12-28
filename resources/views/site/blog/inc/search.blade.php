<section class="blog-search">
    <div class="container">
        <div class="module__search">
            <form class="form-with-icon" action="">
                <div class="search-icon">
                    <img src="/site/img/search.svg" width="24" height="24" alt="search">
                </div>
                <input type="text" placeholder="{{ Translate::c('Search category that you need?') }}"
                       class="default_input input-icon full-width item" id="blogCategorySearch"
                       data-locale="{{ App\Http\Middleware\LocaleMiddleware::getLocale() }}">
            </form>
        </div>
    </div>
</section>