@extends('adminlte::page')

@section('title', isset($page) ? 'Edit Page #' . $page->id : 'Add Page')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Pages
            </h1>
        </div>
        <div class="col-sm-6">
            @isset($page)
                {{ Breadcrumbs::render(\Request::route()->getName(), $page->id) }}
            @else
                {{ Breadcrumbs::render(\Request::route()->getName()) }}
            @endisset
        </div>
    </div>
@stop

@section('content')
    @php
        if(isset($page)){
            $action = route('admin.pages.update', $page);
        }else{
            $action = route('admin.pages.store');
        }
    @endphp
    <form id="dataForm" action="{{ $action }}" method="{{ isset($page) ? 'put' : 'post' }}">
        @csrf
        @isset($page)
            <input type="hidden" name="page_id" value="{{ $page->id }}">
        @endisset

        <div class="card card-default {{--col-xl-6--}} col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    @isset($page)
                        Edit Page #{{ $page->id }}
                    @else
                        Add Page
                    @endisset
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="row">
                    {{--
                    <div class="form-group col-md-4">
                        <label for="key">Key</label>
                        <input type="text" id="key" name="key" class="form-control" placeholder="Key"
                               value="{{ old('key') }}" required>
                        @error('key')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    --}}
                    <div class="form-group col-md-4">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control"
                               value="{{ $page->slug ?? old('slug') }}" placeholder="Page slug" required>
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="custom-select">
                            @foreach($statusOptions as $value)
                                <option value="{{ $value }}" {{ isset($page->status) && $page->status == $value ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <br>

                <div class="nav-tabs-custom">
                    @include('admin.inc.languages')

                    <div class="tab-content">
                        @php
                            $title = isset($page->title) ? json_decode($page->title, true) : [];
                            $content = isset($page->content) ? json_decode($page->content, true) : [];
                            $content2 = isset($page->content2) ? json_decode($page->content2, true) : [];
                            $metaTitle = isset($page->meta_title) ? json_decode($page->meta_title, true) : [];
                            $metaDescription = isset($page->meta_description) ? json_decode($page->meta_description, true) : [];

                            //$data = isset($page->data) ? json_decode($page->data, true) : [];
                            $data['header_title'] = $page->data['header_title'] ?? [];
                            $data['header_subtitle'] = $page->data['header_subtitle'] ?? [];
                        @endphp
                        @foreach ($Languages as $key => $Language)
                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="{{ str_replace(' ', '_', $Language->name) }}">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title[{{ $Language->code }}]" value="{{ $title[$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="title" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Header Title</label>
                                    <input type="text" name="data[header_title][{{ $Language->code }}]" value="{{ $data['header_title'][$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="header_title" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Header Subtitle</label>
                                    <input type="text" name="data[header_subtitle][{{ $Language->code }}]" value="{{ $data['header_subtitle'][$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="header_subtitle" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea id="content_{{ $Language->code }}" class="editor-textarea" name="content[{{ $Language->code }}]">{{ $content[$Language->code] ?? '' }}</textarea>
                                    <span data-field="content" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Content 2</label>
                                    <textarea id="content2_{{ $Language->code }}" class="editor-textarea" name="content2[{{ $Language->code }}]">{{ $content2[$Language->code] ?? '' }}</textarea>
                                    <span data-field="content2" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Meta title</label>
                                    <input type="text" name="meta_title[{{ $Language->code }}]" value="{{ $metaTitle[$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="meta_title" class="invalid-feedback"></span>
                                </div>
                                <div class="form-group">
                                    <label>Meta description</label>
                                    <input type="text" name="meta_description[{{ $Language->code }}]" value="{{ $metaDescription[$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="meta_description" class="invalid-feedback"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('admin.pages.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </form>
@stop

@push('js')
    <script src="{{ asset('admin-assets/js/basic.js') }}"></script>
@endpush
