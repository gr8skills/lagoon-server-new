@extends('layouts.master')

@section('page-title', 'Add Event')

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

@section('content-header', 'Add Event')


@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('upcoming-event-store')}}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" name="date" id="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="ceremony">Ceremony</label>
                    <input type="text" name="ceremony" id="ceremony" class="form-control" required>
                </div>
                <div class="row col-md-12">
{{--                    <div class="form-group col-md-6">--}}
{{--                        <label for="link">Link</label>--}}
{{--                        <input type="text" name="link" id="link" class="form-control">--}}
{{--                    </div>--}}
                    <div class="form-group col-md-6">
                        <label for="description">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Inactive</option>
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
