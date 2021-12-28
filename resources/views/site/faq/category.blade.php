@extends('layouts.site')

@section('title')
    {{ Translate::c('FAQ') }}
@endsection

@section('content')
    <div class="header-cover bg-gradient-blue pb-0">
        <div class="header-cover__inner text-center">
            <div class="header-cover__sub-title">{{ Translate::c('FAQ') }}</div>
            <h1 class="header-cover__title">{{ Translate::c('Have some questions?') }}</h1>
            <div class="module__search">
                <form class="form-with-icon" action="">
                    <div class="search-icon"><img src="{{ asset('site/img/search.svg') }}" width="24" height="24" alt="search"></div>
                    <input type="text" placeholder="{{ Translate::c('Search question that you need?') }}" class="default_input input-icon full-width item">
                </form>
            </div>
            <div class="header-cover__buttons">
                @forelse($Categories as $category)
                    <a href="{{ route('faq.category', $category) }}" class="btn btn-white header-cover__btn">{{ Translate::t($category->name) }}</a>
                @empty
                @endforelse
            </div>
        </div>
    </div>

    <main>
        <section class="faq_questions">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="faq_questions_title">
                            <h2 class="title_h2">{{ Translate::t($Category->name) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="content_box">
                            {!! Translate::t($Category->content) !!}
                        </div>
                        <div class="module__accordion">
                            @forelse($Category->questions as $question)
                                <div class="item {{ isset($Question) && $question->id == $Question->id ? 'active' : '' }}">
                                    <div class="title_box">
                                        <div class="icon">@php include(public_path('site/img/accordion_arrow.svg')) @endphp</div>
                                        <p>{{ Translate::t($question->name) }}</p>
                                    </div>
                                    <div class="content_box">
                                        {!! Translate::t($question->content) !!}
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('site.inc.testimonial')
        @include('site.inc.create-logo-now')
    </main>
@endsection

@section('js')
    @include('site.inc.faq-search')
@endsection