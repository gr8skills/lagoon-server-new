@extends('layouts.master')

<<<<<<< HEAD
@section('page-title', 'Edit news')
=======
@section('page-title')
    {{ ucwords($news->title ?? '') }}
@stop
>>>>>>> 05865883bc4cf7dd32d9bf0ae924679a11ca64fa

@section('plugin-styles')
@stop

@section('page-styles')
<<<<<<< HEAD
@stop

@section('content-header', 'Edit News')

=======
    <style>
        .selectedImageZone {
            min-width: 350px;
            width: 50%;
            max-width: 700px;
        }

        .selectedImageZone img {
            width: 100%;
        }
    </style>
@stop

@section('content-header')
    Edit {{ ucwords($news->title) }} page
@stop
>>>>>>> 05865883bc4cf7dd32d9bf0ae924679a11ca64fa

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
<<<<<<< HEAD
                <div class="card-body">
                    <form action="{{ route('news-edit', $news->ref_id) }}" enctype="multipart/form-data" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{ $news->title }}">
                                </div>
                            </div>
=======
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">{{ ucwords($news->title ?? '') }}</h3>
                        <a class="btn btn-danger btn-sm" href="{{route('news')}}">Cancel</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('news-edit', $news->slug) }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{$news->title}}">
                        </div>

                        <div class="form-group">
                            <label for="banner">Thumbnail</label><br>
                            <input type="file" accept="image/*" class="form-control d-none" id="thumb" name="thumb">
                            <button class="btn btn-info" id="pickThumbnailE" type="button">
                                Choose thumbnail image
                            </button>
                        </div>

                        <div class="selectedImageZone @if(!$news->thumb) d-none @endif mb-3">
                            <img
                                alt="news thumbnail"
                                id="selectedImage"
                                src="{{ !!$news->thumb ? '/images/' . $news->thumb : '' }}"
                            />
>>>>>>> 05865883bc4cf7dd32d9bf0ae924679a11ca64fa
                        </div>

                        <label for="summernote">Content</label>
                        <textarea id="summernote" name="content" required class="editor-height"></textarea>

                        <div class="mt-2 mb-5">
<<<<<<< HEAD
                            <button type="submit" class="btn btn-info mr-3">Save changes</button>
                            <a href="{{route('news')}}" class="btn btn-danger">Cancel</a>
=======
                            <a class="btn btn-danger" href="{{route('news')}}">Cancel</a>
                            <button type="submit" class="btn btn-info">Save changes</button>
>>>>>>> 05865883bc4cf7dd32d9bf0ae924679a11ca64fa
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
<<<<<<< HEAD
        var pageContent = "{!! addcslashes($news->content ?? '', '"') !!}";
        $('#summernote').summernote('pasteHTML', pageContent);

        $('#bannerFileButton').on('click', function (evt) {
            $('#banner').click();
        })

        $('#footerFileButton').on('click', function (evt) {
            $('#footerImage').click();
        });
=======
        var selectedImage = undefined;
        var content = "{!! addcslashes($news->content ?? '', '"') !!}";
        $('#summernote').summernote('pasteHTML', content).addClass('editor-height');

        $('#pickThumbnailE').on('click', function () {
            $('#thumb').click();
        });

        $('#thumb').change(function (e) {
            selectedImage = e.target.files[0];
            if (selectedImage) {
                var imgSrc = URL.createObjectURL(selectedImage);
                $('#selectedImage').attr('src', imgSrc);
                $('div.selectedImageZone').removeClass('d-none');
            }
        })
>>>>>>> 05865883bc4cf7dd32d9bf0ae924679a11ca64fa
    </script>
@endsection
