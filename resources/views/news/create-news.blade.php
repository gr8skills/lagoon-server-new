@extends('layouts.master')

@section('page-title', ucwords('Add news'))

@section('plugin-styles')
@stop

@section('page-styles')
@stop

@section('content-header')
    {{ ucwords('Add news') }} page
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ ucwords('Add news') }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('news-create') }}" method="post" enctype="multipart/form-data">
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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="banner">Banner</label><br>
                                    <input type="file" name="banner" id="banner" accept="image/*" class="d-none">
                                    <button class="btn btn-info" id="pickBanner" type="button">
                                        <i class="far fa-file-image mr-1"></i>Pick image
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row d-none" id="preview">
                            <div class="col-md-6">
                                <img style="height: 150px; width: 150px" id="imagePreview" src="#"/>
{{--                                <span style="height: 320px; width: 240px" id="imagePreview"></span>--}}
                            </div>
                        </div>

                        <label for="summernote">Content</label>
                        <textarea id="summernote"
                                  name="content"
                                  required
                                  class="editor-height">{{old('content')}}</textarea>

                        <div class="mt-2 mb-5">
                            <button type="submit" class="btn btn-info mr-3">Save changes</button>
                            <a href="{{ route('news') }}" class="btn btn-danger">Cancel</a>
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

        $('#pickBanner').on('click', function (e) {
            e.preventDefault();
            $('#banner').click();
        });

        $('#banner').on('change', function (e) {
            var file = e.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.addEventListener('load', (e) => {
                    console.log('event ', e);
                    $('#preview').removeClass('d-none');
                    $('#imagePreview').attr('src', e.target.result);
                    // $('#imagePreview').css('background', `url(${e.target.result}) center/cover no-repeat padding-box`);
                });
            }
        })
    </script>
@endsection
