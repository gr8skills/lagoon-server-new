@extends('layouts.master')

@section('page-title')
    {{ ucwords($page->title ?? '') }}
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
    Edit {{ ucwords($page->title) }}
@stop


@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('explore-more-update') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="section">Title</label>
                    <input type="hidden" value="{{$page->id}}" name="page_id">
                    <input type="text" name="section" id="section" class="form-control" value="{{ $page->section ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="receipt">Description</label>
                    <input type="text" name="receipt" id="receipt" class="form-control" value="{{ $page->receipt ?? '' }}" required>
                </div>
                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="link">Link</label>
                        <input type="text" name="link" id="link" class="form-control" value="{{ $page->link ?? '' }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="1" @if($page->status == 1) selected @endif>Active</option>
                            <option value="0" @if($page->status == 0) selected @endif>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="logo">Image</label><br/>
                    <input accept="image/*" class="d-none" id="image" type="file" name="image">
                    <button class="btn btn-sm btn-info" id="imageSelect" type="button">
                        @if(!!$page->image) Change @else Select @endif Image
                    </button>
                    <span class="text-info ml-3">Max size: 10MB</span>
                </div>
                <div class="logo-placeholder py-3" id="logo-placeholder">
                    <img
                        src="@if(!!$page->image) /images/{{ $page->image }} @endif"
                        alt="current logo"
                        class="@if(!$page->image) d-none @endif"
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
        $('#imageSelect').on('click', function () {
            $('#image').click()
        });

        $('#image').on('change', function (evt) {
            if (evt.target.files[0]) {
                var imgSrc = URL.createObjectURL(evt.target.files[0]);
                $('#logo-placeholder').removeClass('d-none').find('img').attr('src', imgSrc);
            }
        });
    </script>
@endsection
