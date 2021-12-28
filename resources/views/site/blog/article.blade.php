@extends('layouts.site')

@section('title')
    {{ Translate::t($article->name) }}
@endsection

@section('content')
    <main>
{{--        <section class="blog-top">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">--}}
{{--                        @include('site.blog.inc.most-recent-title-article-card')--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">--}}
{{--                        <div class="article-list">--}}
{{--                            @foreach($mostRecentArticles as $mostRecentArticle)--}}
{{--                                @include('site.blog.inc.most-recent-article-card')--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        @include('site.blog.inc.search')

        <section class="blog-bottom">
            <div class="container">
                @include('site.blog.inc.categories-list')

                <div class="blog-bottom__inner article">
                    <article class="hentry blog-bottom__post">
                        <div class="blog-bottom__thumb">
                            <img src="{{ $article->title_image }}" alt="{{ Translate::t($article->name) }}">
                        </div>

                        <div class="blog-bottom__content">
                            <a href="{{ route('blog.category', $article->category->id) }}" class="blog-bottom__category" style="background-color: {{ $article->category->color }}">
                                {{ Translate::t($article->category->name) }}
                            </a>
                            <span class="blog-bottom__date">
                                <time class="published" datetime="2020-09-28 12:00:00">
                                    {{ $article->created_at->format('d.m.Y') }}
                                </time>
                            </span>
                            <div class="article-content">
                                {!! Translate::t($article->content) !!}
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>
@endsection
