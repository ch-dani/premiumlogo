@extends('adminlte::page')

@section('title', 'All Payments')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Payments
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
                    <h3 class="card-title">All items</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <table class="table table-bordered" id="tableData">
                        <thead>
                        <tr>
                        	<td>ID</td>
                        	<td>User</td>
                            <td>Email</td>
                        	<td>Logo Price</td>
                        	<td>Payment Amount</td>
                        	<td>Payment Type</td>
                            <td>Payment ID</td>
                        	<td>Created At</td>
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
    <script src="{{ asset('admin-assets/js/payments.js') }}"></script>
@stop
