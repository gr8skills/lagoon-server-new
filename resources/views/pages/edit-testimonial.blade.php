@extends('layouts.master')

@section('page-title', 'Edit Club')

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

@section('content-header', 'Edit Club')


@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="card-title text-capitalize">Edit {{ ucwords($page->name) }}</h3>
                <a class="btn btn-danger btn-sm" href="{{route('school-clubs')}}">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('club-update') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="title">Club Name</label>
                        <input type="hidden" value="{{$page->id}}" name="page_id">
                        <input type="text" name="name" id="title" value="{{ $page->name ?? '' }}" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="title">Link</label>
                        <input type="text" name="link" id="title" value="{{ $page->link ?? '' }}" class="form-control">
                    </div>
                </div>

                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="description">Link Target (Open in ...)</label>
                        <select name="target" class="form-control" id="status">
                            <option value="_blank"  @if($page->target == '_blank') selected @endif>Blank Page</option>
                            <option value="_self" @if($page->target == '_self') selected @endif>Same Page</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Category</label>
                        <select name="category" class="form-control" id="status">
                            <option value="primary"  @if($page->category == 'primary') selected @endif>Primary School</option>
                            <option value="secondary" @if($page->category == 'secondary') selected @endif>Secondary School</option>
                        </select>
                    </div>
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
