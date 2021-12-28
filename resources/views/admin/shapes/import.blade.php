@extends('adminlte::page')

@section('title', 'Shapes Import')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Shapes
            </h1>
        </div>
        <div class="col-sm-6">
            {{ Breadcrumbs::render(\Request::route()->getName()) }}
        </div>
    </div>
@stop

@section('content')
    <form id="dataForm" action="{{ route('admin.shapes.import') }}" method="post">
        @csrf

        <div class="card card-default {{--col-xl-6--}} col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    Shapes Import
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
			<span data-field="zip" class="invalid-feedback"></span> 
               </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('admin.shapes.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script src="{{ asset('admin-assets/js/import.js') }}"></script>
@stop

