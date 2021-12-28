@extends('layouts.site')

@section('title')
    {{ Translate::c('Testimonials') }}
@endsection

@section('content')
    <div class="header-cover bg-white pb-0">
        <div class="header-cover__inner text-center">
            {{--<div class="header-cover__sub-title">About Free Logo Design</div>--}}
            <h1 class="header-cover__title">Customers Reviews</h1>
        </div>
    </div>

    <main class="testimonial_page">
        <section class="testimonial bg_1 bg-grey">
            <div class="container">
                <div class="row">
                    <div class="col">
                        @forelse($Testimonials as $testimonial)
                            @include('site.inc.items.testimonial')
                        @empty
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                {{ Translate::c('No reviews found') }}
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        @if($Testimonials->hasPages())
            <div class="container">
                <div class="popup_pagination">
                    @include('site.inc.pagination', ['paginator' => $Testimonials])
                </div>
            </div>
        @endif

        @include('site.inc.create-logo-now')
    </main>
@endsection
