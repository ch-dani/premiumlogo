@extends('adminlte::page')

@section('title', isset($Menu) ? 'Edit Menu #' . $Menu->id : 'Add Menu')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Menu
            </h1>
        </div>
        <div class="col-sm-6">
            @isset($Menu)
                {{ Breadcrumbs::render(\Request::route()->getName(), $Menu->id) }}
            @else
                {{ Breadcrumbs::render(\Request::route()->getName()) }}
            @endisset
        </div>
    </div>
@stop

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <form role="form" id="EditorForm">
                            @csrf
                            <input type="hidden" name="code" value="{{ $Menu->code }}">

                            <div class="card-header">
                                <h3 class="card-title operation-title">New item</h3>
                            </div>
                            <div class="card-body">
                                <div class="nav-tabs-custom">
                                    @include('admin.inc.languages')

                                    <div class="tab-content">
                                        @php
                                            $name = isset($Icon->name) ? json_decode($Icon->name, true) : [];
                                        @endphp
                                        @foreach ($Languages as $key => $Language)
                                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="{{ str_replace(' ', '_', $Language->name) }}">
                                                <div class="form-group">
                                                    <label for="menu_title[{{ $Language->code }}]">Title</label>
                                                    <input type="text" name="title[{{ $Language->code }}]" class="form-control" data-id="{{ $Language->id }}" id="menu_title[{{ $Language->code }}]">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{--
                                <div class="form-group">
                                    <label for="inputTitle">Title</label>
                                    <input type="text" name="title" class="form-control" id="inputTitle" placeholder="">
                                    <span data-field="title" class="invalid-feedback"></span>
                                </div>
                                --}}
                                <div class="form-group">
                                    <label for="inputLink">Link</label>
                                    <input type="text" name="link" class="form-control" id="inputLink" placeholder="">
                                    <span data-field="link" class="invalid-feedback"></span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success operation-button">
                                    Add
                                </button>
                                <button type="button" class="btn btn-danger operation-button-cancel" style="display: none;">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $Menu->name }}</h3>
                            <div class="float-right">
                                <button type="button" id="SaveSort" disabled class="btn btn-success">Save</button>
                                <button type="button" id="CancelSort" style="display: none;" class="btn btn-danger">Cancel</button>
                            </div>
                        </div>
                        <div class="card-body" id="cont">
                            <ul id="sortable" class="sortable list-group main-sort-list">
                                @foreach ($Menu->items() as $item)
                                    <li class="list-group-item" data-id="{{ $item->id }}">
                                        <div class="item-handle">
                                            <i class="fa fa-files-o"></i> <span class="txt">{{ $item->title_translate }}</span>
                                            <div class="btn-group float-right">
                                                <a href="#" class="btn btn-default btn-xs edit-item">Edit</a>
                                                <a href="#" class="btn btn-danger btn-xs remove-item">X</a>
                                            </div>
                                        </div>
                                        <ul class="sortable list-group">
                                            @foreach ($item->children() as $child)
                                                <li class="list-group-item" data-id="{{ $child->id }}">
                                                    <div class="item-handle">
                                                        <i class="fa fa-files-o"></i> <span class="txt">{{ $child->title_translate }}</span>
                                                        <div class="btn-group float-right">
                                                            <a href="#" class="btn btn-default btn-xs edit-item">Edit</a>
                                                            <a href="#" class="btn btn-danger btn-xs remove-item">X</a>
                                                        </div>
                                                    </div>
                                                    <ul class="sortableLists list-group"></ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop

@section('js')
    <script>
		var items = {};

        @foreach ($Menu->itemsAll() as $item)
            items[{{$item->id}}] = {
                sort: {{ $item->sort }},
                title: '{!! $item->title !!}',
                link: '{{ $item->link }}',
                @if (!is_null($item->parent))
                    parent: {{ $item->parent }},
                @endif
            };
        @endforeach
    </script>
    <script src="{{ asset('admin-assets/js/menu.js') }}"></script>
@stop
