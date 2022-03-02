@extends('layouts.master')

@section('page-title', ucwords('Add article'))

@section('plugin-styles')
@stop

@section('page-styles')
@stop

@section('content-header', 'Add article')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ ucwords('Add article') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('article-create') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text"
                                           class="form-control @error('title') is-invalid @enderror"
                                           name="title" id="title"
                                           required
                                           value="{{ old('title') }}">
                                </div>
                            </div>
                        </div>

                        <label for="summernote">Content</label>
                        <textarea id="summernote"
                                  name="content"
                                  required
                                  class="editor-height">{{old('content')}}</textarea>

                        <div class="mt-2 mb-5">
                            <button type="submit" class="btn btn-info mr-3">Save changes</button>
                            <a href="{{ route('article') }}" class="btn btn-danger">Cancel</a>
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
        $('#summernote').summernote();
    </script>
@endsection
