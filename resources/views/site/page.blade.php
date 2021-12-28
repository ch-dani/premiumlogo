@extends('layouts.site')

@section('title')
    {{ Translate::t($Page->title) }}
@endsection

@section('content')
    <div class="header-cover bg-white pb-0">
        <div class="header-cover__inner text-center">
            @if(Translate::t($Page->data['header_subtitle']) != 'No translation')
                <div class="header-cover__sub-title">{!! Translate::t($Page->data['header_subtitle']) !!}</div>
            @endif
            <h1 class="header-cover__title">{!! Translate::t($Page->data['header_title']) !!}</h1>
        </div>
    </div>

    <main>
        <section class="">
            <div class="container">
                <div class="row flex-vertical-align">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="about__text">
                            {!! Translate::t($Page->content) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <br>
    <br>
@endsection
