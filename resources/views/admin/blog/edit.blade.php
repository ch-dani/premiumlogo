@extends('adminlte::page')

@section('title', isset($page) ? 'Edit Article #' . $page->id : 'Add Article')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Articles
            </h1>
        </div>
        <div class="col-sm-6">
            @isset($article)
                {{ Breadcrumbs::render(\Request::route()->getName(), $article->id) }}
            @else
                {{ Breadcrumbs::render(\Request::route()->getName()) }}
            @endisset
        </div>
    </div>
@stop

@section('content')
    @php
        if(isset($article)){
            $action = route('admin.blog.update', $article);
        }else{
            $action = route('admin.blog.store');
        }
    @endphp

    <form id="dataForm" action="{{ $action }}" method="{{ isset($article) ? 'put' : 'post' }}">
        @csrf
        @isset($article)
            <input type="hidden" name="article_id" value="{{ $article->id }}">
        @endisset

        <div class="card card-default col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    @isset($article)
                        Edit Article #{{ $article->id }}
                    @else
                        Add Article
                    @endisset
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control" value="{{ $article->slug ?? '' }}" placeholder="Article slug" required>
                        @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">Is published</label>
                        <select name="status" id="status" class="custom-select">
                            @foreach($statusOptions as $value => $status)
                                <option value="{{ $value }}" {{ isset($article) && $article->is_published  == $value ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                        @error('is_published')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <br>

                <div class="nav-tabs-custom">
                    @include('admin.inc.languages')

                    <div class="tab-content">
                        @php
                            $name = isset($article->name) ? json_decode($article->name, true) : [];
                            $content = isset($article->content) ? json_decode($article->content, true) : [];
                        @endphp

                        @foreach($Languages as $key => $Language)
                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="{{ str_replace(' ', '_', $Language->name) }}">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name[{{ $Language->code }}]" value="{{ $name[$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="name" class="invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea id="content_{{ $Language->code }}" class="editor-textarea"
                                              name="content[{{ $Language->code }}]">{{ $content[$Language->code] ?? '' }}</textarea>
                                    <span data-field="content" class="invalid-feedback"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id" data-placeholder="Select a Category" style="width: 100%;">
                            @forelse($Categories as $category)
                                <option value="{{ $category->id }}" {{ isset($article->category) && $article->category->id == $category->id ? 'selected' : '' }}>{{ Translate::t($category->name) }}</option>
                            @empty
                            @endforelse
                        </select>
                        <span data-field="category_id" class="invalid-feedback"></span>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <div class="custom-file mb-3">
                            <input type="file" id="inputFile" name="title_image" class="form-control-file">
                            <label class="custom-file-label" for="inputFile">Choose file</label>
                            <input type="hidden" name="image">
                            <span data-field="title_image" class="invalid-feedback"></span>
                        </div>
                        <div class="icon_thumbnails">
                            <img src="{{ $article->title_image ?? null }}"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('admin.blog.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </form>
@stop

@push('js')
    <script src="{{ asset('admin-assets/js/basic.js') }}"></script>
@endpush
