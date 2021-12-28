<div class="module__search_select">
    <form action="{{ route('logo') }}" method="get">
        <input type="text" placeholder="{{ Translate::c('Enter your company name...') }}" class="default_input item" autocomplete="off" id="svgText" name="company">
        <select class="default_select item" name="category">
            <option value="">{{ Translate::c('All categories') }}</option>
            @forelse(App\Models\LogoCategory::get() as $item)
                <option value="{{ $item->id }}">{{ Translate::t($item->name) }}</option>
                {{--<option value="">{{ $item->name_translate }}</option>--}}
            @empty
            @endforelse
        </select>
    </form>
    <a href="#" class="btn get_started_category">{{ Translate::c('Get started') }}</a>
</div>