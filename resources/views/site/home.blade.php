@extends('layouts.site')

@section('title')
    Home
@endsection

@section('content')
    <main>
        @include('site.inc.create-logo-seconds-left')
        @include('site.inc.step-logo')
        @include('site.inc.why-choose')

        @php
            $block = (new \App\Http\Controllers\HomeController)->getBlock('professional-logos-for-your-company');
            $block_data = isset($block->data) ? json_decode($block->data, true) : [];

            $proff_logos = \App\Models\Logo::where('in_home', true)->take($block_data['count'] ?? 0)->get();
        @endphp
        <section class="professional_logos bg-blue">
            <div class="container">
                <h2 class="title_h2 title_h2_white">{!! Translate::t($block_data['title']) !!}</h2>
                <div class="sub_title sub_title_white">{!! Translate::t($block_data['content']) !!}</div>
                <div class="wrapper_logos">
                    @if(!$proff_logos->isEmpty())
                        <div class="row">
                            @foreach($proff_logos as $proff_logo)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="logo splay_box">
	                                	<a href="{{route('logo')."?url=".$proff_logo->image}}">                                    
                                        	<img src="{{ $proff_logo->image }}" alt="">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="row">
                        <div class="col">
                            <div class="btn_wrapper">
                                <a href="{{ route('logo') }}" class="btn btn_192_56">{{ Translate::c('Create logo') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--    /freelogodesign/inc/create-logo-now.php-->
        @include('site.inc.create-logo-seconds-right')
        @include('site.inc.testimonial')
        <!--    /freelogodesign/inc/why-choose.php-->

        @include('site.inc.create-logo-now')
    </main>
@endsection
