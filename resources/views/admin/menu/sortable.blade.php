@foreach ($menu->items() as $item)
    <li class="list-group-item" data-id="{{ $item->id }}">
        <div class="item-handle">
            <i class="fa fa-files-o"></i> <span class="txt">{{ $item->title_translate }}</span>
            <div class="btn-group float-right">
                <a href="#" class="btn btn-default btn-xs edit-item">Edit</a>
                <a href="#" class="btn btn-danger btn-xs remove-item">X</a>
            </div>
        </div>
        <ul class="sortableLists list-group"></ul>
    </li>
@endforeach