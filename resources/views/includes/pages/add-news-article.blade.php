@extends('layouts.master')

@section('page-title', 'Add News & Article')

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

@section('content-header', 'Add News & Article')


@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="card-title text-capitalize">Add news</h3>
                <a class="btn btn-danger btn-sm" href="{{route('news')}}">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('news-article-store')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="header">Title</label>
                        <input type="text" name="header" id="header" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                </div>
                <div class="row col-md-12">
                        <label for="header">Summary</label>
                        <textarea rows="7" style="width: 100%" name="ceremony" id="summary" class="form-control col-md-12"></textarea>

                </div>

                <div class="form-group"><br>
                    <label for="summernote">Full Story </label>
                    <textarea id="summernote" name="paragraph" required class="editor-height"></textarea>

{{--                    <label for="ceremony">Ceremony</label>--}}
{{--                    <input type="text" name="ceremony" id="ceremony" class="form-control" required>--}}
                </div>
                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="description">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="holder">Image</label><br/>
                    <input accept="image/*" class="d-none" id="holder" type="file" name="holder">
                    <button class="btn btn-sm btn-info" id="imageSelect" type="button">Select image</button>
                    <span class="text-info ml-3">Max size: 10MB</span>
                </div>
                <div class="logo-placeholder mb-3 d-none" id="logo-placeholder">
                    <img src="" alt=""/>
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
