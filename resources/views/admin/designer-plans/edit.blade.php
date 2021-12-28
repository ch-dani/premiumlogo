@extends('adminlte::page')

@section('title', isset($DesignerPlan) ? 'Edit Designer Plan #' . $DesignerPlan->id : 'Add Designer Plan')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Designer Plans
            </h1>
        </div>
        <div class="col-sm-6">
            @isset($DesignerPlan)
                {{ Breadcrumbs::render(\Request::route()->getName(), $DesignerPlan->id) }}
            @else
                {{ Breadcrumbs::render(\Request::route()->getName()) }}
            @endisset
        </div>
    </div>
@stop

@section('content')
    @php
        if(isset($DesignerPlan)){
            $action = route('admin.designer-plans.update', $DesignerPlan);
        }else{
            $action = route('admin.designer-plans.store');
        }
    @endphp
    <form id="dataForm" action="{{ $action }}" method="{{ isset($DesignerPlan) ? 'put' : 'post' }}">
        @csrf

        <div class="card card-default {{--col-xl-6--}} col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    @isset($Question)
                        Edit Designer Plan #{{ $DesignerPlan->id }}
                    @else
                        Add Designer Plan
                    @endisset
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">

                <div class="nav-tabs-custom">
                    @include('admin.inc.languages')

                    <div class="tab-content">
                        @php
                            $title = isset($DesignerPlan->title) ? json_decode($DesignerPlan->title, true) : [];
                            $advantages = isset($DesignerPlan->advantages) ? json_decode($DesignerPlan->advantages, true) : [];
                        @endphp
                        @foreach ($Languages as $key => $Language)
                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="{{ str_replace(' ', '_', $Language->name) }}">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title[{{ $Language->code }}]" value="{{ $title[$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="name" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Advantages</label>
                                    <textarea class="form-control" name="advantages[{{ $Language->code }}]">{{ $advantages[$Language->code] ?? '' }}</textarea>
                                    <span data-field="advantages" class="invalid-feedback"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" name="price" value="{{ $DesignerPlan->price ?? '' }}">
                    <span data-field="price" class="invalid-feedback"></span>
                </div>

                <div class="form-group">
                    <label>Currency</label>
                    <input type="text" class="form-control" name="currency" value="{{ $DesignerPlan->currency ?? '' }}">
                    <span data-field="currency" class="invalid-feedback"></span>
                </div>
                <div class="form-group">
                    <label>Symbol</label>
                    <input type="text" class="form-control" name="symbol" value="{{ $DesignerPlan->symbol ?? '' }}">
                    <span data-field="symbol" class="invalid-feedback"></span>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="is_black" value="0">
                            <input type="checkbox" name="is_black" value="1" {{ isset($DesignerPlan->is_black) && $DesignerPlan->is_black ? 'checked' : '' }}>
                            Is Black?
                        </label>
                    </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('admin.designer-plans.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script src="{{ asset('admin-assets/js/basic.js') }}"></script>
@stop
