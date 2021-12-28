@extends('adminlte::page')

@section('title', 'Edit Hire Designer Message #' . $HireDesignerMessage->id)

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>
                Hire Designer Messages
            </h1>
        </div>
        <div class="col-sm-6">
            {{ Breadcrumbs::render(\Request::route()->getName(), $HireDesignerMessage->id) }}
        </div>
    </div>
@stop

@section('content')

    <form id="dataForm" action="{{ route('admin.hire-designer-messages.update', $HireDesignerMessage->id) }}"
          method="put">
        @csrf
        <div class="card card-default col-xl-12">
            <div class="card-header">
                <h3 class="card-title">
                    Edit Hire Designer Message #{{ $HireDesignerMessage->id }}
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" readonly value="{{ $HireDesignerMessage->name }}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" readonly value="{{ $HireDesignerMessage->email }}">
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" readonly>{{ $HireDesignerMessage->message }}</textarea>
                </div>
                <div class="form-group">
                    <label>Answer Message</label>
                    <textarea id="content_{{ $HireDesignerMessage->answer_message }}" class="editor-textarea" {{ $HireDesignerMessage->answered ? 'readonly' : '' }} name="answer_message">{{ $HireDesignerMessage->answer_message }}</textarea>
                    <span data-field="answer_message" class="invalid-feedback"></span>
                </div>
            </div>

            <div class="card-footer">
                @if(!$HireDesignerMessage->answered)
                    <button type="submit" class="btn btn-primary float-right">Answer</button>
                @endif
            </div>
        </div>
    </form>
@stop

@section('js')
    <script src="{{ asset('admin-assets/js/hireDesignerMessages.js') }}"></script>
@stop
