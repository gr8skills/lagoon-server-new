@extends('layouts.master')

@section('page-title', 'Add Q/A')

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

@section('content-header', 'Add Q/A')


@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="card-title text-capitalize">Edit {{ ucwords($page->header) }}</h3>
                <a class="btn btn-danger btn-sm" href="{{route('questions-answer')}}">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('questions-answer-update') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group col-md-12">
                    <label for="title">Question</label>
                    <input type="hidden" value="{{$page->id}}" name="page_id">
                    <input type="text" name="title" id="title" value="{{ $page->title ?? '' }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="summernote">Answer</label>
                    <textarea id="summernote" placeholder="{{$page->content ?? 'Answer'}}" name="content" required class="editor-height">{{$page->content ?? 'Answer'}}</textarea>
                </div>
                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="description">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="1"  @if($page->status == 1) selected @endif>Active</option>
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
        $('#summernote').summernote().addClass('editor-height');
        $('#imageSelect').on('click', function () {
            $('#holder').click()
        });

        $('#holder').on('change', function (evt) {
            if (evt.target.files[0]) {
                var imgSrc = URL.createObjectURL(evt.target.files[0]);
                $('#logo-placeholder').removeClass('d-none').find('img').attr('src', imgSrc);
            }
        });
    </script>
@endsection
