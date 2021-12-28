@extends('layouts.site')

@section('title')
    {{ Translate::t($category->name) ?? '' }}
@endsection

@section('content')
    <div class="header-cover bg-gradient-blue pb-0">
        <div class="header-cover__inner text-center cat-page">
            <div class="header-cover__sub-title">{{ Translate::c('Logo Ideas') }} / {{ Translate::t($category->name) ?? '' }}</div>
            <h1 class="header-cover__title">{{ Translate::t($category->name) ?? '' }}</h1>
            <div class="header-cover__buttons"><a href="{{ route('logo') }}" class="btn header-cover__btn">{{ Translate::c('Create Logo') }}</a></div>
        </div>
    </div>

    <main>
        <section class="professional_logos">
            <div class="container">
                <div class="wrapper_logos">
                    <div class="row">
                        @forelse($category->logos as $logo)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                <div class="logo splay_box splay_box-shadow">
                                	<a href="{{route('logo')."?url=".$logo->image}}">
                                   		<img src="{{ $logo->image }}">
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                {{ Translate::c('No logos found') }}
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
        @include('site.inc.testimonial')
        @include('site.inc.create-logo-now')
    </main>
@endsection
