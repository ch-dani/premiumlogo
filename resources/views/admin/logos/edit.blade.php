@extends('adminlte::page')

@section('title', isset($Logo) ? 'Edit Logo #' . $Logo->id : 'Add Logo')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Logos
            </h1>
        </div>
        <div class="col-sm-6">
            @isset($Logo)
                {{ Breadcrumbs::render(\Request::route()->getName(), $Logo->id) }}
            @else
                {{ Breadcrumbs::render(\Request::route()->getName()) }}
            @endisset
        </div>
    </div>
@stop

@section('content')
    @php
        if(isset($Logo)){
            $action = route('admin.logos.update', $Logo->id);
        }else{
            $action = route('admin.logos.store');
        }
    @endphp
    <form id="dataForm" action="{{ $action }}" method="{{ isset($Logo) ? 'put' : 'post' }}">
        @csrf
        @isset($Logo)
            <input type="hidden" name="page_id" value="{{ $Logo->id }}">
        @endisset
        <input type="hidden" name="folder" value="logos">

        <div class="card card-default {{--col-xl-6--}} col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    @isset($Logo)
                        Edit Logo #{{ $Logo->id }}
                    @else
                        Add Logo
                    @endisset
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="nav-tabs-custom">
                    @include('admin.inc.languages')

                    <div class="tab-content">
                        @php
                            $name = isset($Logo->name) ? json_decode($Logo->name, true) : [];
                        @endphp
                        @foreach ($Languages as $key => $Language)
                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="{{ str_replace(' ', '_', $Language->name) }}">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name[{{ $Language->code }}]" value="{{ $name[$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="name" class="invalid-feedback"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{--
                <div class="form-group">
                    <label>Project creator</label>
                    <input type="text" readonly value="{{ '[' . $project->user->id . '] ' . $project->user->full_name }}" class="form-control">
                </div>
                --}}
                {{--
                @if(isset($Logo->image) && $Logo->image)
                    <div class="form-group">
                        <label>Image</label>
                        <div class="form-group">
                            <img width="300" src="{{ $Logo->image }}" alt="">
                        </div>
                    </div>
                @endif
                --}}

                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" name="categories[]" multiple="multiple" data-placeholder="Select a Category" style="width: 100%;">
                        @forelse($Categories as $category)
                            <option value="{{ $category->id }}" {{ isset($logo_categories_ids) && in_array($category->id, $logo_categories_ids) ? 'selected' : '' }}>{{ Translate::t($category->name) }}</option>
                        @empty
                        @endforelse
                    </select>
                    <span data-field="categories" class="invalid-feedback"></span>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <div class="icon_thumbnails">
                        <img src="{{ $Logo->image ?? '' }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <div id="image" class="dropzone dropzone2 input_file_container">
                        <input type="file" name="image" accept="image/*" class="file_input_dropzone"
                               style="display: none"/>
                        <div class="wrap_btn_dropzone">
                            <div class="wrap_dropzone">
                            </div>
                        </div>
                    </div>
                    <span data-field="image" class="invalid-feedback"></span>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="in_slider" value="0">
                            <input type="checkbox" name="in_slider" value="1" {{ isset($Logo->in_slider) && $Logo->in_slider ? 'checked' : '' }}>
                            Show in Slider?
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="hidden" name="in_home" value="0">
                            <input type="checkbox" name="in_home" value="1" {{ isset($Logo->in_home) && $Logo->in_home ? 'checked' : '' }}>
                            Show on Home Page?
                        </label>
                    </div>
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
    <script src="{{ asset('admin-assets/js/logos.js') }}"></script>
@stop
