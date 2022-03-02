@extends('layouts.master')

@section('page-title', 'Add sponsor')

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

@section('content-header', 'Add a sponsor')


@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('sponsors-store')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Sponsor name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="displayName">Image</label><br/>
                    <input accept="image/*" class="d-none" id="image" type="file" name="image">
                    <button class="btn btn-sm btn-info" id="imageSelect" type="button">Select image</button>
                    <span class="text-info ml-3">Max size: 1MB</span>
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
