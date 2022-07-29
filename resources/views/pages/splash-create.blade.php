@extends('layouts.master')

@section('page-title', 'Upload Splash Image')

@section('plugin-styles')
@stop

@section('page-styles')
    <style>
        .preview {
            max-width: 20rem;
            max-height: 14rem;
            overflow: hidden;
        }

        #previewImg {
            width: 100%;
            height: auto;
        }

    </style>
@stop

@section('content-header')
    Splash Image
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('home-page') }}" class="btn btn-sm btn-info">
                        Go back
                    </a>
                </div>

                <div class="card-body">
                    <form action="" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ old('title') ?? '' }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="description">Category</label>
                                    <select name="category" class="form-control" id="category">
                                        <option value="photo_splash" selected>Photo Splash</option>
                                        <option value="facility">Facility</option>
                                        <option value="primary">Primary School</option>
                                        <option value="secondary">Secondary School</option>
                                        <option value="mentoring">Mentoring</option>
                                        <option value="traditions">Traditions</option>
{{--                                        <option value="clubs">Clubs</option>--}}
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            {{-- <label for="banner">Image</label> --}}
                            <input type="file" accept="image/*" class="form-control d-none" id="image" name="image">
                            <button type="button" id="openFile" class="btn btn-primary">Choose image</button>
                            <i class="text-muted ml-3">File size should be less than 20MB</i>
                        </div>

                        <div class="d-none preview">
                            <img alt="" src="" id="previewImg" />
                        </div>

                        <div class="mt-5 mb-2">
                            <button type="submit" class="btn btn-info" id="upload">Save changes</button>
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
        var request;
        var file = undefined;

        $('#openFile').on('click', function() {
            $('#image').click();
        });

        $('#image').on('change', function() {
            file = this.files[0];

            var reader = new FileReader();
            reader.onload = function(e) {
                $('.preview').removeClass('d-none').addClass('d-block');
                $('#previewImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        $('#upload').on('click', function(evt) {
            evt.preventDefault();

            if (!file){
                toastAlert('Please select a file.', 'Error', 'error');
                return;
            }

            var formData = new FormData();
            var titleInputValue = $('#title').val();
            var categoryInputValue = $('#category').val();

            formData.append('category', categoryInputValue);
            formData.append('title', titleInputValue);
            formData.append('image', file);

            if (request) request.abort();
            blockPage();

            request = $.ajax({
                url: '/store-splash',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false
            });

            request.done(function(resp) {
                unBlockPage();
                toastAlert('Splash image has been uploaded', 'Success', 'success');
                redirect('/pages/photo-splash');
            });

            request.fail(function(_, __, errMsg) {
                console.log('Error: ', errMsg);
                unBlockPage();
                toastAlert('Something went wrong.', 'Error', 'error');
            });
        });
    </script>
@endsection
