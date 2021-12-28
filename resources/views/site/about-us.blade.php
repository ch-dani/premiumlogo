@extends('layouts.site')

@section('title')
    {{ Translate::c('About Us') }}
@endsection

@section('content')
    <div class="header-cover bg-white pb-0">
        <div class="header-cover__inner text-center">
            <div class="header-cover__sub-title">{!! Translate::t($Page->data['header_subtitle']) !!}</div>
            <h1 class="header-cover__title">{!! Translate::t($Page->data['header_title']) !!}</h1>
        </div>
    </div>

    <main>
        {{--@include('site.inc.fastest-logo')--}}
        <section class="fast_logo">
            <div class="container">
                <div class="row flex-vertical-align">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="about__text">
                            {!! Translate::t($Page->content) !!}
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        {{--
                        <div class="about__img">
                            <img src="img/img-fast-logo.png" alt="create-logo" width="629" height="390">
                        </div>
                        --}}
                        {!! Translate::t($Page->content2) !!}
                    </div>
                </div>
            </div>
        </section>

        @php $Team = \App\Models\Team::get() @endphp
        @if(!$Team->isEmpty())
            <section class="our_team">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="about__title-wrapper">
                                <h1 class="title_h1">{{ Translate::c('Our Team') }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($Team as $member)
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                <div class="team_item margin-bottom-60">
                                    <div class="team_img_wrapper">
                                        <img src="{{ $member->image ?? '' }}" alt="">
                                    </div>
                                    <div class="team_item_content">
                                        <h3 class="team_item_name">{{ $member->fullName }}</h3>
                                        @if(isset($member->position) && $member->position)
                                            <div class="team_item_position">
                                                <p>{{ Translate::t($member->position) }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @include('site.inc.why-choose')
    </main>
@endsection
