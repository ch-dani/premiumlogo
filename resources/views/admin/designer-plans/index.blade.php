@extends('adminlte::page')

@section('title', 'All Designer Plans')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Designer Plans
                <a href="{{ route('admin.designer-plans.create') }}"
                   class="btn btn-outline-primary">
                    <i class="fas fa-plus"></i>
                    Add Designer Plan
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
                    <h3 class="card-title">All Designer Plans</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <table class="table table-bordered" id="tableData">
                        <thead>
                        <tr>
                            @if($table_columns)
                                @foreach($table_columns as $tc)
                                    <th>{{ $tc['title'] }}</th>
                                @endforeach
                            @endif
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
    <script>
		var table_columns = {!! json_encode($table_columns) !!};
    </script>

    <script src="{{ asset('admin-assets/js/basic.js') }}"></script>
@stop