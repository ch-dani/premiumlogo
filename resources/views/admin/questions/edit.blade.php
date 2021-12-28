@extends('adminlte::page')

@section('title', isset($Question) ? 'Edit Question #' . $Question->id : 'Add Question')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Questions
            </h1>
        </div>
        <div class="col-sm-6">
            @isset($Question)
                {{ Breadcrumbs::render(\Request::route()->getName(), $Question->id) }}
            @else
                {{ Breadcrumbs::render(\Request::route()->getName()) }}
            @endisset
        </div>
    </div>
@stop

@section('content')
    @php
        if(isset($Question)){
            $action = route('admin.faq.update', $Question);
        }else{
            $action = route('admin.faq.store');
        }
    @endphp
    <form id="dataForm" action="{{ $action }}" method="{{ isset($Question) ? 'put' : 'post' }}">
        @csrf
        @isset($Question)
            <input type="hidden" name="page_id" value="{{ $Question->id }}">
        @endisset

        <div class="card card-default {{--col-xl-6--}} col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    @isset($Question)
                        Edit Question #{{ $Question->id }}
                    @else
                        Add Question
                    @endisset
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="nav-tabs-custom">
                    @include('admin.inc.languages')

                    <div class="tab-content">
                        @php
                            $name = isset($Question->name) ? json_decode($Question->name, true) : [];
                            $content = isset($Question->content) ? json_decode($Question->content, true) : [];
                        @endphp
                        @foreach ($Languages as $key => $Language)
                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="{{ str_replace(' ', '_', $Language->name) }}">
                                <div class="form-group">
                                    <label>Question</label>
                                    <input type="text" name="name[{{ $Language->code }}]" value="{{ $name[$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="name" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Answer</label>
                                    <textarea id="content_{{ $Language->code }}" class="editor-textarea" name="content[{{ $Language->code }}]">{{ $content[$Language->code] ?? '' }}</textarea>
                                    <span data-field="content" class="invalid-feedback"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control select2" name="categories[]" multiple="multiple" data-placeholder="Select a Category" style="width: 100%;">
                        @forelse($Categories as $category)
                            <option value="{{ $category->id }}" {{ isset($question_categories_ids) && in_array($category->id, $question_categories_ids) ? 'selected' : '' }}>{{ Translate::t($category->name) }}</option>
                        @empty
                        @endforelse
                    </select>
                    <span data-field="categories" class="invalid-feedback"></span>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_popular" value="1" {{ isset($Question->is_popular) && $Question->is_popular ? 'checked' : '' }}>
                            Is Popular?
                        </label>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('admin.faq.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script src="{{ asset('admin-assets/js/basic.js') }}"></script>
@stop
