@extends('adminlte::page')

@section('title', 'All Team Members')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Team Members
                <a href="{{ route('admin.team.create') }}"
                   class="btn btn-outline-primary">
                    <i class="fas fa-plus"></i>
                    Add Team Member
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
                    <h3 class="card-title">All Team Members</h3>
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
