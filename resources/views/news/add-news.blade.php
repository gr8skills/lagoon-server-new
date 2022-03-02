@extends('layouts.master')

@section('page-title', 'News & Updates')

@section('plugin-styles')
@stop

@section('page-styles')
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

@section('content-header', 'News & Updates')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title text-capitalize">Add news</h3>
                        <a class="btn btn-danger btn-sm" href="{{route('news')}}">Cancel</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('news') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" value="">
                        </div>

                        <div class="form-group">
                            <label for="banner">Thumbnail</label><br>
                            <input type="file" accept="image/*" class="form-control d-none" id="thumb" name="thumb">
                            <button class="btn btn-info" id="pickThumbnail" type="button">Choose thumbnail image
                            </button>
                        </div>
                        <div class="selectedImageZone d-none mb-3">
                            <img alt="news thumbnail" id="selectedImage" src="">
                        </div>

                        <label for="summernote">Content</label>
                        <textarea id="summernote" name="content" required class="editor-height"></textarea>

                        <div class="mt-2 mb-5">
                            <a class="btn btn-danger" href="{{route('news')}}">Cancel</a>
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
        var selectedImage = undefined;
        $('#summernote').summernote().addClass('editor-height');
        $('#pickThumbnail').on('click', function () {
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
    </script>
@endsection
