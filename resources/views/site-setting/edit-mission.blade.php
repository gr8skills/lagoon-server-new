@extends('layouts.master')

@section('page-title')
    {{ ucwords($page->title ?? '') }}
@stop

@section('plugin-styles')
@stop

@section('page-styles')
@stop

@section('content-header')
    Edit {{ ucwords($page->title) }}
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ ucwords($page->title ?? '') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('mission-update') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="hidden" value="{{$page->id}}" name="page_id">
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $page->title ?? '' }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="url">Description</label>
                                    <input type="text" class="form-control" id="url" name="url" value="{{ $page->url ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
{{--                            <input type="text"  class="form-control" id="description" name="description" value="{{ $page->description ?? '' }}">--}}
                            <textarea id="summernote" name="description" class="editor-height" placeholder="{{$message->description ?? 'Description'}}">{{$message->description ?? ''}}</textarea>
                        </div>

{{--                        <div class="row">--}}
{{--                            <div class="col-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="target">Target</label>--}}
{{--                                    <select name="target" class="form-control" id="target">--}}
{{--                                        <option value="_blank" @if($page->target == '_blank') selected @endif>New Blank Page</option>--}}
{{--                                        <option value="_blank" @if($page->target == '_self') selected @endif>Same Page</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="slug">Slug</label>--}}
{{--                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ $page->slug ?? '' }}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}



{{--                        <label for="summernote">Content</label>--}}
{{--                        <textarea id="summernote" name="content" class="editor-height"></textarea>--}}

                        <div class="mt-2 mb-5">
                            <button type="submit" class="btn btn-info">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('page-plugin')
@stop

@section('page-scripts')
    <script>
        var content = "{!! addcslashes($page->description ?? '', '"') !!}";
        $('#summernote').summernote('pasteHTML', content).addClass('editor-height');

        $('#bannerFileButton').on('click', function (evt) {
            $('#banner').click();
        })

        $('#footerFileButton').on('click', function (evt) {
            $('#footerImage').click();
        });
    </script>
@endsection
