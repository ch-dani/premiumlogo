<ul class="nav nav-tabs">
    @foreach ($Languages as $key => $Language)
        <li class="nav-item">
            <a class="nav-link {!! $key == 0 ? 'active' : '' !!}" href="#{{ str_replace(' ', '_', $Language->name) }}" data-toggle="tab">
                <img style=" margin-right: 10px; " src="{{ $Language->flag }}"/>{{ $Language->name }}
            </a>
        </li>
    @endforeach
</ul>