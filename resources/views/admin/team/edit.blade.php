@extends('adminlte::page')

@section('title', isset($Team) ? 'Edit Team Member #' . $Team->id : 'Add Team Member')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Team Members
            </h1>
        </div>
        <div class="col-sm-6">
            @isset($Team)
                {{ Breadcrumbs::render(\Request::route()->getName(), $Team->id) }}
            @else
                {{ Breadcrumbs::render(\Request::route()->getName()) }}
            @endisset
        </div>
    </div>
@stop

@section('content')
    @php
        if(isset($Team)){
            $action = route('admin.team.update', $Team);
        }else{
            $action = route('admin.team.store');
        }
    @endphp
    <form id="dataForm" action="{{ $action }}" method="{{ isset($Team) ? 'put' : 'post' }}">
        @csrf
        @isset($Team)
            <input type="hidden" name="page_id" value="{{ $Team->id }}">
        @endisset

        <div class="card card-default {{--col-xl-6--}} col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    @isset($Team)
                        Edit Team Member #{{ $Team->id }}
                    @else
                        Add Team Member
                    @endisset
                </h3>
            </div>
            <!-- /.card-header -->

            <div class="card-body">
                <div class="nav-tabs-custom">
                    @include('admin.inc.languages')

                    <div class="tab-content">
                        @php
                            $first_name = isset($Team->first_name) ? json_decode($Team->first_name, true) : [];
                            $last_name = isset($Team->last_name) ? json_decode($Team->last_name, true) : [];
                            $position = isset($Team->position) ? json_decode($Team->position, true) : [];
                        @endphp
                        @foreach ($Languages as $key => $Language)
                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="{{ str_replace(' ', '_', $Language->name) }}">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name[{{ $Language->code }}]" value="{{ $first_name[$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="first_name" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name[{{ $Language->code }}]" value="{{ $last_name[$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="last_name" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Position</label>
                                    <input type="text" name="position[{{ $Language->code }}]" value="{{ $position[$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="position" class="invalid-feedback"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>Photo</label>
                    <div class="icon_thumbnails">
                        <img src="{{ $Team->image ?? '' }}"/>
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
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('admin.team.index') }}" class="btn btn-default">Cancel</a>
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
