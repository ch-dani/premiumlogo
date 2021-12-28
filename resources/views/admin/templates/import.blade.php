@extends('adminlte::page')

@section('title', 'Logos Import')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Logos
            </h1>
        </div>
        <div class="col-sm-6">
            {{ Breadcrumbs::render(\Request::route()->getName()) }}
        </div>
    </div>
@stop

@section('content')
    <form id="dataForm" action="{{ route('admin.logos.import') }}" method="post">
        @csrf

        <div class="card card-default {{--col-xl-6--}} col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    Logos Import
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="form-group" style="max-width: 50%">
                    <label>Upload new .zip archive:</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="zipFile">
                        <label class="custom-file-label" for="zipFile">Choose file</label>
                    </div>
                </div>
                <div class="form-group"  style="max-width: 50%">
                    <label>Category</label>
                    <select class="form-control select2" name="categories[]" multiple="multiple" data-placeholder="Select a Category" style="width: 100%;">
                        @forelse($Categories as $category)
                            <option value="{{ $category->id }}">{{ Translate::t($category->name) }}</option>
                        @empty
                        @endforelse
                    </select>
                    <span data-field="categories" class="invalid-feedback"></span>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('admin.logos.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script src="{{ asset('admin-assets/js/import.js') }}"></script>
@stop

