@extends('adminlte::page')

@section('title', 'All Shapes')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Shapes
                <a href="{{ route('admin.shapes.create') }}"
                   class="btn btn-outline-primary">
                    <i class="fas fa-plus"></i>
                    Add Shape
                </a>
                <a href="{{ route('admin.shapes.import') }}"
                   class="btn btn-outline-secondary">
                    Shapes Import
                </a>
            </h1>
        </div>
        <div class="col-sm-6">
            {{ Breadcrumbs::render(\Request::route()->getName()) }}
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col no-padding">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Shapes</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <table class="table table-bordered" id="tableData">
                        <thead>
                        <tr>
                            <th style="width: 20px">#</th>
                            <th>Name</th>
                            {{--<th>Owner Name</th>--}}
                            <th>Image</th>
                            <th>Created at</th>
                            <th style="width: 270px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('admin-assets/js/shapes.js') }}"></script>
@stop

