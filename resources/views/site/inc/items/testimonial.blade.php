<div class="testimonial__outer">
    <div class="testimonial__inner">
        <div class="testimonial__left">
            @if($testimonial->image)
                <div class="testimonial__avatar">
                    <img src="{{ $testimonial->image }}" width="100" height="100" alt="avatar">
                </div>
            @endif
            <div class="testimonial__review">
                <div class="testimonial__rating">
                    @foreach(range(1, 5) as $rating)
                        <img src="{{ asset('site/img/star-'.($rating <= $testimonial->rating ? 'yellow' : 'grey').'.svg') }}" width="24" height="23" alt="star-yellow">
                    @endforeach
                </div>
                <div class="testimonial__text">
                    {!! Translate::t($testimonial->content) !!}
                </div>
                <div class="testimonial__author">- {!! Translate::t($testimonial->name) !!}</div>
            </div>
        </div>
        <div class="testimonial__customer">
            <div class="testimonial__customer-text">
                {{ Translate::c('All customers reviews were collected from people who used FreeLogoDesign.') }}
            </div>
            <a href="{{ route('testimonials') }}" class="btn btn-green">{{ Translate::c('See more') }}</a>
        </div>
    </div>
</div>