@php $testimonials = \App\Models\Testimonial::where('in_slider', true)->get() @endphp

@if(!$testimonials->isEmpty())
    <section class="testimonial bg_1 bg-grey">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="js_slider_testimonial">
                        @foreach($testimonials as $testimonial)
                            @include('site.inc.items.testimonial')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif