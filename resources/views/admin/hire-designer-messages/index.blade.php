@extends('adminlte::page')

@section('title', 'All Hire Designer Messages')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <div class="header_s_title_wrpr">
                <h1 class="mb-3 text-dark">All Hire Designer Messages</h1>
            </div>
        </div><!-- /.col -->
        <div class="col-sm-6">
            {{ Breadcrumbs::render(\Request::route()->getName()) }}
        </div><!-- /.col -->
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col no-padding">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Hire Designer Messages</h3>
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
        let table_columns = {!! json_encode($table_columns) !!};
    </script>

    <script src="{{ asset('admin-assets/js/basic.js') }}"></script>
@stop
