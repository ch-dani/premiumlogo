@extends('layouts.site')

@section('title')
    {{ Translate::c('Blog') }} {{ Translate::t($category->name) }}
@endsection

@section('content')
    <main>
        <section class="blog-top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                        @include('site.blog.inc.most-recent-title-article-card')
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                        <div class="article-list">
                            @foreach($mostRecentArticles as $mostRecentArticle)
                                @include('site.blog.inc.most-recent-article-card')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('site.blog.inc.search')

        <section class="blog-bottom">
            <div class="container">
                @include('site.blog.inc.categories-list')

                <div class="blog-bottom__inner">
                    <div class="row">
                        @foreach($articles as $article)
                            @include('site.blog.inc.article-card')
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="popup_pagination">
                @include('site.inc.pagination', ['paginator' => $articles->setPath('/blog/category/' . $category->id)])
            </div>
        </div>
    </main>
@endsection
