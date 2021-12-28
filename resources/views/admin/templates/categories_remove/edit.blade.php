@extends('adminlte::page')

@section('title', isset($Category) ? 'Edit Category #' . $Category->id : 'Add Category')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Categories
            </h1>
        </div>
        <div class="col-sm-6">
            @isset($Category)
                {{ Breadcrumbs::render(\Request::route()->getName(), $Category->id) }}
            @else
                {{ Breadcrumbs::render(\Request::route()->getName()) }}
            @endisset
        </div>
    </div>
@stop

@section('content')
    @php
        if(isset($Category)){
            $action = route('admin.logos-categories.update', $Category);
        }else{
            $action = route('admin.logos-categories.store');
        }
    @endphp
    <form id="dataForm" action="{{ $action }}" method="{{ isset($Category) ? 'put' : 'post' }}">
        @csrf
        @isset($Category)
            <input type="hidden" name="page_id" value="{{ $Category->id }}">
        @endisset

        <div class="card card-default {{--col-xl-6--}} col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    @isset($Category)
                        Edit Category #{{ $Category->id }}
                    @else
                        Add Category
                    @endisset
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="nav-tabs-custom">
                    @include('admin.inc.languages')

                    <div class="tab-content">
                        @php
                            $name = isset($Category->name) ? json_decode($Category->name, true) : [];
                        @endphp
                        @foreach ($Languages as $key => $Language)
                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="{{ str_replace(' ', '_', $Language->name) }}">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name[{{ $Language->code }}]" value="{{ $name[$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="name" class="invalid-feedback"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>URL</label>
                    <input type="text" value="{{ $Category->url ?? '' }}" class="form-control" name="url">
                    <span data-field="url" class="invalid-feedback"></span>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('admin.logos-categories.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script src="{{ asset('admin-assets/js/logos-categories.js') }}"></script>
@stop
