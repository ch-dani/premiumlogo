@extends('adminlte::page')

@section('title', isset($block) ? 'Edit Block #' . $block->id : 'Add Block')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Home: Header
            </h1>
        </div>
        <div class="col-sm-6">
            {{ Breadcrumbs::render(\Request::route()->getName()) }}
        </div>
    </div>
@stop

@section('content')
    <form enctype="multipart/form-data" id="dataForm" action="{{ route('admin.blocks.update') }}" method="post">
        @csrf
        <input type="hidden" name="name" value="{{ $name }}">

        <div class="card card-default col-xl-12">
            <div class="card-body">
                <div class="nav-tabs-custom">
                    @include('admin.inc.languages')

                    <div class="tab-content">
                        @php
                            $data = isset($block->data) ? json_decode($block->data, true) : [];
                        @endphp
                        @foreach ($Languages as $key => $Language)
                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="{{ str_replace(' ', '_', $Language->name) }}">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="data[title][{{ $Language->code }}]" value="{{ $data['title'][$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="title" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <input class="form-control" name="data[content][{{ $Language->code }}]" value="{{ $data['content'][$Language->code] ?? '' }}">
                                    <span data-field="content" class="invalid-feedback"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>Count of Logos</label>
                    <input class="form-control" type="number" min="0" name="data[count]" value="{{ $data['count'] ?? '' }}">
                    <span data-field="content" class="invalid-feedback"></span>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </form>
@stop

@push('js')
    <script src="{{ asset('admin-assets/js/basic.js') }}"></script>
@endpush
