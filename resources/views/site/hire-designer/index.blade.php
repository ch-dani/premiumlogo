@extends('layouts.site')

@section('content')
    <section class="price_card">
        <div class="container">
            <div class="row">
                @foreach(\App\Models\DesignerPlan::all() as $plan)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="card {{ $plan->is_black ? 'black' : '' }}">
                            <h6 class="card_title">{!! Translate::t($plan->title) !!}</h6>
                            <div class="price">{{ $plan->symbol }}{{ $plan->price }}</div>
                            <div class="btn_wrapper">
                                <a href="{{ route('hire-designer.form') }}" class="btn {{ !$plan->is_black ? 'btn-green' : '' }} btn_192_56">Get started</a>
                            </div>
                            <div class="advantages">
                                @foreach(explode(';', Translate::t($plan->advantages)) as $advantage)
                                    <div class="advantages_item">
                                        <?php include "site/img/icon-price-card-mark.svg"; ?>
                                        <div class="advantages_txt">{{ $advantage }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
        @include('site.inc.why-choose')
@endsection

@section('js')
    {{--    <script src="{{ asset() }}"></script>--}}
@endsection

