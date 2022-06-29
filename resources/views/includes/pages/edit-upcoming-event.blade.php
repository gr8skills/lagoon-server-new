@extends('layouts.master')

@section('page-title')
    {{ ucwords($page->ceremony ?? '') }}
@stop

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

@section('content-header')
    Edit {{ ucwords($page->ceremony) }}
@stop


@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('upcoming-event-update') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="hidden" name="page_id" id="page_id" value="{{ $page->id }}" required>
                    <input type="date" name="date" id="date" class="form-control" value="{{ $page->date ?? '' }}" required>
                </div>
                <div class="form-group">
                    <label for="receipt">Ceremony</label>
                    <input type="text" name="ceremony" id="ceremony" class="form-control" value="{{ $page->ceremony ?? '' }}" required>
                </div>
                <div class="row col-md-12">
                    <div class="form-group col-md-6">
                        <label for="position">Position</label>
                        <input type="text" name="position" id="position" class="form-control" value="{{ $page->position ?? '' }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="1" @if($page->status == 1) selected @endif>Active</option>
                            <option value="0" @if($page->status == 0) selected @endif>Inactive</option>
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
