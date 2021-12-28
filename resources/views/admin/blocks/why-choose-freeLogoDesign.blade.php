@extends('adminlte::page')

@section('title', isset($block) ? 'Edit Block #' . $block->id : 'Add Block')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Why choose FreeLogoDesign
            </h1>
        </div>
        <div class="col-sm-6">
            {{ Breadcrumbs::render(\Request::route()->getName()) }}
        </div>
    </div>
@stop

@section('content')
    <form enctype="multipart/form-data" id="dataForm" action="{{ route('admin.blocks.update') }}" method="post">
        @csrf
        <input type="hidden" name="name" value="{{ $name }}">

        <div class="card card-default col-xl-12">
            <div class="card-body">
                <div class="nav-tabs-custom">
                    @include('admin.inc.languages')

                    <div class="tab-content">
                        @php
                            //$title = isset($block->name) ? json_decode($block->name, true) : [];
                            $data = isset($block->data) ? json_decode($block->data, true) : [];
                        @endphp
                        @foreach ($Languages as $key => $Language)
                            <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="{{ str_replace(' ', '_', $Language->name) }}">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="data[title][{{ $Language->code }}]" value="{{ $data['title'][$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="title" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <input class="form-control" name="data[content][{{ $Language->code }}]" value="{{ $data['content'][$Language->code] ?? '' }}">
                                    <span data-field="content" class="invalid-feedback"></span>
                                </div>

                                <br>
                                <h3>Block Items</h3>

                                @foreach(range(0, 4) as $blockNumber)
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="question-answer question-answer2">
                                                    <label style="display: block;">icon</label>
                                                    <div class="answer-icon-wrapper upload-component">
                                                        @php $image_name = 'data[blocks]['.$blockNumber.'][image]['.$Language->code.']'; @endphp
                                                        <input type="file" data-target-name="{{ $image_name }}">
                                                        <input type="hidden" name="{{ $image_name }}" value="{{ $data['blocks'][$blockNumber]['image'][$Language->code] ?? '' }}">
                                                        <span class="upload-label">upload</span>
                                                        <img src="{{ $data['blocks'][$blockNumber]['image'][$Language->code] ?? '/site/img/placeholder.png' }}" alt="" class="answer-icon">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="data[blocks][{{ $blockNumber }}][title][{{ $Language->code }}]" value="{{ $data['blocks'][$blockNumber]['title'][$Language->code] ?? '' }}" class="form-control">
                                                <span data-field="title" class="invalid-feedback"></span>
                                            </div>

                                            <div class="form-group">
                                                <label>Description</label>
                                                <input class="form-control" name="data[blocks][{{ $blockNumber }}][content][{{ $Language->code }}]" value="{{ $data['blocks'][$blockNumber]['content'][$Language->code] ?? '' }}">
                                                <span data-field="content" class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <br>
                                <h3>Create Logo</h3>

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="data[create_logo][title][{{ $Language->code }}]" value="{{ $data['create_logo']['title'][$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="title" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" name="data[create_logo][content][{{ $Language->code }}]" value="{{ $data['create_logo']['content'][$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="content" class="invalid-feedback"></span>
                                </div>

                                <div class="form-group">
                                    <label>Button Text</label>
                                    <input type="text" name="data[create_logo][button_text][{{ $Language->code }}]" value="{{ $data['create_logo']['button_text'][$Language->code] ?? '' }}" class="form-control">
                                    <span data-field="button_text" class="invalid-feedback"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </div>
    </form>
@stop

@push('js')
    <script src="{{ asset('admin-assets/js/basic.js') }}"></script>

    <script>
        $(document).on('change', '.answer-icon-wrapper input', function (e) {
            var $this = $(this);
            var file = e.currentTarget.files[0];
            var preview = $this.siblings('img');
            var reader = new FileReader();
            /*
            if ($this.attr('url')) {
                console.log($this.attr('url'))
                uploadImage($this.attr('url'), file, $this);
            }
            */
			uploadImage('/api/upload', file, $this);

            reader.onload = function () {
                preview.attr('src', reader.result);
            };
            reader.readAsDataURL(file);
        });

        function uploadImage(url, file, $input){
			var formData = new FormData();
			formData.append('file', file, file.name);
			formData.append('folder', 'blocks');

			$.ajax({
				url : url,
				type : 'POST',
				data : formData,
				processData: false,  // tell jQuery not to process the data
				contentType: false,  // tell jQuery not to set contentType
				success : function(data) {
					if(data.status == 'success'){
                        $('[name="'+$input.data('targetName')+'"]').val(data.src);
                    }else{
						swal.fire('Error!', 'Error was occurred.', 'error');
                    }
				}
			});
        }
    </script>
@endpush
