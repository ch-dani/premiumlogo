@extends('adminlte::page')

@section('title', isset($User) ? 'Edit User #' . $User->id : 'Add User')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Users
            </h1>
        </div>
        <div class="col-sm-6">
            @isset($User)
                {{ Breadcrumbs::render(\Request::route()->getName(), $User->id) }}
            @else
                {{ Breadcrumbs::render(\Request::route()->getName()) }}
            @endisset
        </div>
    </div>
@stop

@section('content')
    @php
        if(isset($User)){
            $action = route('admin.users.update', $User);
        }else{
            $action = route('admin.users.store');
        }
    @endphp
    <form id="dataForm" action="{{ $action }}" method="{{ isset($User) ? 'put' : 'post' }}">
        @csrf
        @isset($User)
            <input type="hidden" name="user_id" value="{{ $User->id }}">
        @endisset

        <div class="card card-default {{--col-xl-6--}} col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    @isset($User)
                        Edit User #{{ $User->id }}
                    @else
                        Add User
                    @endisset
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="nav-tabs-custom">
                    <div class="tab-content">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $User->name ?? '' }}" class="form-control">
                            <span data-field="name" class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ $User->email ?? '' }}" class="form-control">
                            <span data-field="email" class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select name="role_id" class="form-control">
                                <option value="">Choose Role</option>
                                @foreach(\App\Models\Role::all() as $role)
                                    <option {{ isset($User->role_id) && $User->role_id == $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                            <span data-field="role_id" class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            <span data-field="password" class="invalid-feedback"></span>
                        </div>

                        <div class="form-group">
                            <label>Password Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control">
                            <span data-field="password_confirmation" class="invalid-feedback"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('admin.users.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script src="{{ asset('admin-assets/js/basic.js') }}"></script>
@stop
