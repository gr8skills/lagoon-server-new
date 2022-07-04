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
            <form action="{{ route('news-article-update') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="section">Title</label>
                    <input type="hidden" value="{{$page->id}}" name="page_id">
                    <input type="text" name="header" id="header" class="form-control" value="{{ $page->header ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ $page->date ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="receipt">Summary</label>
                    <textarea name="ceremony" id="ceremony" class="form-control">{{ $page->ceremony ?? '' }}</textarea>
                </div>
                <div class="form-group"><br>
                    <label for="summernote">Full Story </label>
                    <textarea id="summernote" name="paragraph" required class="editor-height">{{ $page->paragraph ?? '' }}</textarea>
                </div>
                <div class="row col-md-12">
{{--                    <div class="form-group col-md-6">--}}
{{--                        <label for="position">Position</label>--}}
{{--                        <input type="text" name="position" id="position" class="form-control" value="{{ $page->position ?? '' }}">--}}
{{--                    </div>--}}
                    <div class="form-group col-md-6">
                        <label for="description">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="1" @if($page->status == 1) selected @endif>Active</option>
                            <option value="0" @if($page->status == 0) selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="holder">Image</label><br/>
                    <input accept="image/*" class="d-none" id="holder" type="file" name="holder">
                    <button class="btn btn-sm btn-info" id="imageSelect" type="button">
                        @if(!!$page->holder) Change @else Select @endif Image
                    </button>
                    <span class="text-info ml-3">Max size: 10MB</span>
                </div>
                <div class="logo-placeholder py-3" id="logo-placeholder">
                    <img
                        src="@if(!!$page->holder) /images/{{ $page->holder }} @endif"
                        alt="Image"
                        class="@if(!$page->holder) d-none @endif"
                    >
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
