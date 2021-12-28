@extends('adminlte::page')

@section('title', 'All pages')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <div class="header_s_title_wrpr">
                <h1 class="mb-3 text-dark">All pages
                    <a href="{{ route('admin.pages.create') }}"
                       class="btn btn-outline-primary">
                        <i class="fas fa-plus"></i>
                        Add page
                    </a>
                </h1>
            </div>
        </div><!-- /.col -->
        <div class="col-sm-6">
            {{ Breadcrumbs::render(\Request::route()->getName()) }}
        </div><!-- /.col -->
    </div>
@stop

@section('content2')
    <div class="row">
        <div class="col">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><i class="fa fa-check-circle"></i> {{ session()->get('success') }}</strong>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><i class="fa fa-exclamation-circle"></i> {{ session()->get('error') }}</strong>
                </div>
            @endif

            @if(session()->has('warning'))
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong><i class="fa fa-exclamation-triangle"></i> {{ session()->get('warning') }}</strong>
                </div>
            @endif

            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table_wrpr">
                        <table class="table" id="users_datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Static</th>
                                <th>Status</th>
                                <th style="width: 190px">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->key }}</td>
                                    <td>
                                        <a href="{{ url($page->slug) }}" target="_blank">{{ $page->title }}</a>
                                    </td>
                                    <td>{{ $page->static ? 'Yes' : 'No' }}</td>
                                    <td>{{ $page->status }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.pages.edit', $page->id) }}"
                                               class="btn btn-default">Edit</a>
                                            @unless($page->static)
                                                <div class="dropdown">
                                                    <button class="btn btn-default dropdown-toggle"
                                                            type="button" id="dropdownMenu2"
                                                            data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            style="position: absolute; transform: translate3d(-1px, 0px, 0px); top: 0; left: 0; will-change: transform;"></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <form
                                                                action="{{ route('admin.pages.destroy', $page->id) }}"
                                                                method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                    class="btn btn-default dropdown-item">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endunless
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col no-padding">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Pages</h3>
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