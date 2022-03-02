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
        .sponsor {
            position: relative;
            width: 150px;
        }
        .sponsor-image {
            width: 150px;
        }
        .tools {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: all 200ms ease-in;
            background-color: white;
        }
        .tools:hover {
            opacity: 0.9;
        }
    </style>
@stop

@section('content-header', 'Site setting')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('site-setting-update-name') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Site display name</label>
                    <input
                        id="name"
                        class="form-control"
                        type="text"
                        name="name"
                        value="{{$setting->display_name ?? ''}}"
                    >
                </div>
                <div>
                    <button class="btn btn-sm btn-info" type="submit" id="saveSetting">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('site-setting-update-logo') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="logo">Logo</label><br/>
                    <input accept="image/*" class="d-none" id="logo" type="file" name="logo">
                    <button class="btn btn-sm btn-info" id="logoSelect" type="button">
                        @if(!!$setting->logo) Change @else Select @endif logo
                    </button>
                    <span class="text-info ml-3">Max size: 1MB</span>
                </div>
                <div class="logo-placeholder py-3" id="logo-placeholder">
                    <img
                        src="@if(!!$setting->logo) /images/{{ $setting->logo }} @endif"
                        alt="current logo"
                        class="@if(!$setting->logo) d-none @endif"
                    >
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
                <a href="{{route('sponsors-create')}}" class="btn btn-sm btn-info">Add new</a>
            </div>
        </div>
        <div class="card-body">
            @if($sponsors->count() > 0)
                <div class="form-group">
                    <label>
                        <input type="checkbox" id="toggleSponsorsDisplay" @if($setting->display_sponsors === 1) checked @endif> Display sponsors
                    </label>
                </div>
                @foreach($sponsors as $sponsor)
                    <div class="d-flex flex-row align-items-center">
                        <div class="sponsor">
                            <div><img src="{{ !!$sponsor->image ? '/images/' . $sponsor->image : '' }}" alt="" class="sponsor-image"></div>
                            <p class="text-center">{{$sponsor->name}}</p>
                            <div class="tools">
                                <a href="{{route('sponsors-delete', $sponsor->id)}}"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
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
        var request = undefined;

        $('#logoSelect').on('click', function () {
            $('#logo').click()
        });

        $('#logo').on('change', function (evt) {
            if (evt.target.files[0]) {
                var imgSrc = URL.createObjectURL(evt.target.files[0]);
                $('#logo-placeholder').find('img').removeClass('d-none').attr('src', imgSrc);
            }
        });

        $('#toggleSponsorsDisplay').on('change', function () {
            if (request) {
                request.abort();
            }
            request = $.ajax({
                url: '/sponsors/toggle-display',
                dataType: 'json'
            });
            request.done(function (res) {
                console.log('Request operation response - ', res);
            });
            request.fail(function (_, __, errMsg) {
                console.log('Network request failed with the following error - ', errMsg);
            })
        });
    </script>
@endsection
