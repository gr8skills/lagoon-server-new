@extends('layouts.master')

@section('page-title')
    {{ ucwords($page->header ?? '') }}
@stop

@section('plugin-styles')
@stop

@section('page-styles')
    <style>
        .logo-placeholder img {
            width: 200px;
            height: auto;
        }
    </style>
@stop

@section('content-header')
    Edit {{ ucwords($page->header) }}
@stop


@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('questions-answer-update') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="section">Question</label>
                    <input type="hidden" value="{{$page->id}}" name="page_id">
                    <input type="text" name="title" id="title" class="form-control" value="{{ $page->title ?? '' }}" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="content">Answer</label>
                    <textarea id="summernote" name="content" class="editor-height" placeholder="{{$page->content ?? 'Answer'}}"></textarea>
                </div>
                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="position">Position</label>
                        <input type="text" name="position" id="position" class="form-control" value="{{ $page->position ?? '' }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="1" @if($page->status == 1) selected @endif>Active</option>
                            <option value="0" @if($page->status == 0) selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>

                <div>
                    <button class="btn btn-sm btn-info" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('page-plugin')
@stop

@section('page-scripts')
    <script>
        $('#imageSelect').on('click', function () {
            $('#holder').click()
        });

        $('#holder').on('change', function (evt) {
            if (evt.target.files[0]) {
                var imgSrc = URL.createObjectURL(evt.target.files[0]);
                $('#logo-placeholder').removeClass('d-none').find('img').attr('src', imgSrc);
            }
        });

        var content = "{!! addcslashes($page->content ?? '', '"') !!}";
        $('#summernote').summernote('pasteHTML', content).addClass('editor-height');
    </script>
@endsection
