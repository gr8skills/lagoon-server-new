@extends('layouts.master')

@section('page-title', 'Edit article')

@section('plugin-styles')
@stop

@section('page-styles')
@stop

@section('content-header', 'Edit article')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('article-edit', $article->ref_id) }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $article->title }}">
                                </div>
                            </div>
                        </div>

                        <label for="summernote">Content</label>
                        <textarea id="summernote" name="content" required class="editor-height"></textarea>

                        <div class="mt-2 mb-5">
                            <button type="submit" class="btn btn-info mr-3">Save changes</button>
                            <a href="{{route('article')}}" class="btn btn-danger">Cancel</a>
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
        var pageContent = "{!! addcslashes($article->content ?? '', '"') !!}";
        // $('.summernote').summernote('reset');  // may not be required.
        // $('.summernote').summernote('destroy');
        // $('.summernote').html(pageContent);
        // $('.summernote').summernote();
        $('#summernote').summernote('pasteHTML', pageContent);
    </script>
@endsection
