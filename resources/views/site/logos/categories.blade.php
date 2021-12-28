@extends('layouts.site')

@section('title')
    {{ Translate::c('Logo Ideas') }}
@endsection

@section('content')
    <div class="header-cover bg-gradient-blue">
        <div class="header-cover__inner text-center">
            <div class="header-cover__sub-title">{{ Translate::c('Logo Ideas') }}</div>
            <h1 class="header-cover__title">{{ Translate::c('Need logo ideas?') }}💡</h1>
            <div class="module__search">
                <form class="form-with-icon search_logos_categories" action="{{ route('logos.search-categories') }}" method="post">
                    <div class="search-icon"><img src="{{ asset('site/img/search.svg') }}" width="24" height="24" alt="search"></div>
                    <input type="text" placeholder="{{ Translate::c('Search category that you need?') }}" class="default_input input-icon full-width item">
                </form>
            </div>
        </div>
    </div>

    <main>
        <section class="category_box">
            <div class="container">
                <div class="row">
                    @forelse($categories as $category)
                        @include('site.inc.items.logos-category')
                    @empty
                        @include('site.inc.items.logos-category-empty')
                    @endforelse
                </div>
            </div>
        </section>

        @include('site.inc.testimonial')
        @include('site.inc.create-logo-now')
    </main>
@endsection
