@extends('layouts.master')

@section('page-title', 'Site setting')

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

@section('content-header', 'Site setting')


@section('content')
    <div class="card">
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="displayName">Site display name</label>
                    <input id="displayName" class="form-control" type="text" name="displayName">
                </div>
                <div>
                    <button class="btn btn-sm btn-info" type="submit" id="saveSetting">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="displayName">Logo</label><br/>
                    <input accept="image/*" class="d-none" id="logo" type="file" name="logo">
                    <button class="btn btn-sm btn-info" id="logoSelect" type="button">Select logo</button>
                    <span class="text-info ml-3">Max size: 1MB</span>
                </div>
                <div class="logo-placeholder py-3 d-none" id="logo-placeholder">
                    <img src="" alt="current logo">
                </div>
                <div>
                    <button class="btn btn-sm btn-info" type="submit" id="saveLogo">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Sponsors</h4>
                <a href="#" class="btn btn-sm btn-info">Add new</a>
            </div>
        </div>
        <div class="card-body">
            @if($sponsors->count() > 0)
                @foreach($sponsors as $sponsor)
                    <div>
                        <div><img src="{{ !!$sponsor->image ? '/images' . $sponsor->image : '' }}" alt=""></div>
                        <div><p>{{$sponsor->name}}</p></div>
                    </div>
                @endforeach
            @else
                <div class="d-flex justify-content-center">
                    <b>No sponsors yet. Start by adding some</b>
                </div>
            @endif
        </div>
    </div>
@stop

@section('page-plugin')
@stop

@section('page-scripts')
    <script>
        $('#logoSelect').on('click', function () {
            $('#logo').click()
        });

        $('#logo').on('change', function (evt) {
            if (evt.target.files[0]) {
                var imgSrc = URL.createObjectURL(evt.target.files[0]);
                $('#logo-placeholder').removeClass('d-none').find('img').attr('src', imgSrc);
            }
        });
    </script>
@endsection
