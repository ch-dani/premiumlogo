@extends('adminlte::page')

@section('title', isset($Testimonial) ? 'Edit Testimonial #' . $Testimonial->id : 'Add Testimonial')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Testimonials
            </h1>
        </div>
        <div class="col-sm-6">
            @isset($Testimonial)
                {{ Breadcrumbs::render(\Request::route()->getName(), $Testimonial->id) }}
            @else
                {{ Breadcrumbs::render(\Request::route()->getName()) }}
            @endisset
        </div>
    </div>
@stop

@section('content')
    @php
        if(isset($Testimonial)){
            $action = route('admin.testimonials.update', $Testimonial);
        }else{
            $action = route('admin.testimonials.store');
        }
    @endphp
    <form id="dataForm" action="{{ $action }}" method="{{ isset($Testimonial) ? 'put' : 'post' }}">
        @csrf
        @isset($Testimonial)
            <input type="hidden" name="page_id" value="{{ $Testimonial->id }}">
        @endisset

        <div class="card card-default {{--col-xl-6--}} col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    @isset($Testimonial)
                        Edit Testimonial #{{ $Testimonial->id }}
                    @else
                        Add Testimonial
                    @endisset
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="nav-tabs-custom">
                    @include('admin.inc.languages')

                    <div class="tab-content">
                        @php
                            $name = isset($Testimonial->name) ? json_decode($Testimonial->name, true) : [];
                            $content = isset($Testimonial->content) ? json_decode($Testimonial->content, true) : [];
                        @endphp
                        @foreach ($Languages as $key => $Language)
                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="{{ str_replace(' ', '_', $Language->name) }}">
                                <div class="form-group">
                                    <label>Author</label>
                                    <input type="text" name="name[{{ $Language->code }}]" value="{{ $name[$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="name" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea id="content_{{ $Language->code }}" class="editor-textarea" name="content[{{ $Language->code }}]">{{ $content[$Language->code] ?? '' }}</textarea>
                                    <span data-field="content" class="invalid-feedback"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <div class="icon_thumbnails">
                        <img src="{{ $Testimonial->image ?? '' }}"/>
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
                    <label>Rating</label>
                    <select class="form-control" name="rating">
                        @foreach(range(5, 1) as $rating)
                            <option value="{{ $rating }}" {{ isset($Testimonial->rating) && $rating == $Testimonial->rating ? 'selected' : '' }}>
                                {{ $rating }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="in_slider" value="1" {{ isset($Testimonial->in_slider) && $Testimonial->in_slider ? 'checked' : '' }}>
                            Show in Slider?
                        </label>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script src="{{ asset('admin-assets/js/basic.js') }}"></script>
    <script>
		jQuery(document).ready(function($){
			let $form  = $('#dataForm');

			$("#image").dropzone({
				url: "/api/upload",
				maxFiles: 1,
				addRemoveLinks: true,
				acceptedFiles: 'image/*',
				success: function (data) {
					let response = JSON.parse(data.xhr.response);

					if (response.status === 'error') {
						$('.invalid-feedback[data-field="image"]').text(response.message).show();
					} else {
						$form.append('<input type="hidden" name="image" data-for="' + response.src + '" data-src="" value="' + response.src + '">');
						$('.icon_thumbnails img').attr('src', response.src);
					}
				},
				removedfile: function (file) {
					file.previewElement.remove();
				},
				sending: function (data, xhr, formData) {
					formData.append('api_token', $('input[name="api_token"]').val());
				},
				maxfilesexceeded: function () {
					swal.fire('Error!', 'You can not upload any more files.', 'error');
				}
			});
		}); /* jQuery(document).ready() */
    </script>
@stop
