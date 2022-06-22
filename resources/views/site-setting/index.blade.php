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
        .welcome_pic-placeholder img {
            width: 250px;
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

        .card-body form div div label {
            margin-bottom: -5px !important;
        }
        .card-body form div div input {
            margin-bottom: 5px !important;
        }
    </style>
@stop

@section('content-header', 'Site setting')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('site-setting-update-name') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12 row">
                    <div class="form-group col-md-4">
                        <label for="name">Site Display Name</label>
                        <input
                            id="name"
                            class="form-control"
                            type="text"
                            name="name"
                            value="{{$setting->display_name ?? ''}}"
                            placeholder="{{$setting->display_name ?? 'Site Display Name'}}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="secondary_phone">Secondary School Phone</label>
                        <input
                            id="secondary_phone"
                            class="form-control"
                            type="text"
                            name="secondary_phone"
                            value="{{$setting->secondary_phone ?? ''}}"
                            placeholder="{{$setting->secondary_phone ?? 'Secondary School Phone'}}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="primary_phone">Primary School Phone</label>
                        <input
                            id="primary_phone"
                            class="form-control"
                            type="text"
                            name="primary_phone"
                            value="{{$setting->primary_phone ?? ''}}"
                            placeholder="{{$setting->primary_phone ?? 'Primary School Phone'}}"
                        >
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="form-group col-md-4">
                        <label for="name">Email</label>
                        <input
                            id="email"
                            class="form-control"
                            type="text"
                            name="name"
                            value="{{$setting->email ?? ''}}"
                            placeholder="{{$setting->email ?? 'School Email'}}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">Portal URL</label>
                        <input
                            id="portal_url"
                            class="form-control"
                            type="text"
                            name="portal_url"
                            value="{{$setting->portal_url ?? ''}}"
                            placeholder="{{$setting->portal_url ?? 'Portal URL'}}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">Inquire (URL)</label>
                        <input
                            id="inquire"
                            class="form-control"
                            type="text"
                            name="inquire"
                            value="{{$setting->inquire ?? ''}}"
                            placeholder="{{$setting->inquire ?? 'URL'}}"
                        >
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="form-group col-md-4">
                        <label for="apply">Apply</label>
                        <input
                            id="apply"
                            class="form-control"
                            type="text"
                            name="apply"
                            value="{{$setting->apply ?? ''}}"
                            placeholder="{{$setting->apply ?? 'Apply (URL)'}}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="visit_us">Visit Us (URL)</label>
                        <input
                            id="visit_us"
                            class="form-control"
                            type="text"
                            name="visit_us"
                            value="{{$setting->visit_us ?? ''}}"
                            placeholder="{{$setting->visit_us ?? 'Visit Us (URL)'}}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="direction">Direction</label>
                        <input
                            id="direction"
                            class="form-control"
                            type="text"
                            name="direction"
                            value="{{$setting->direction ?? ''}}"
                            placeholder="{{$setting->direction ?? 'Direction'}}"
                        >
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="form-group col-md-12">
                        <label for="address">Address</label>
                        <input
                            id="address"
                            class="form-control"
                            type="text"
                            name="address"
                            value="{{$setting->address ?? ''}}"
                            placeholder="{{$setting->address ?? 'Address'}}"
                        >
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="form-group col-md-3">
                        <label for="facebook">Facebook (URL)</label>
                        <input
                            id="facebook"
                            class="form-control"
                            type="text"
                            name="facebook"
                            value="{{$setting->facebook ?? ''}}"
                            placeholder="{{$setting->facebook ?? 'Facebook (URL)'}}"
                        >
                    </div>
                    <div class="form-group col-md-3">
                        <label for="twitter">Twitter (URL)</label>
                        <input
                            id="twitter"
                            class="form-control"
                            type="text"
                            name="twitter"
                            value="{{$setting->twitter ?? ''}}"
                            placeholder="{{$setting->twitter ?? 'Twitter (URL)'}}"
                        >
                    </div>
                    <div class="form-group col-md-3">
                        <label for="instagram">Instagram (URL)</label>
                        <input
                            id="instagram"
                            class="form-control"
                            type="text"
                            name="instagram"
                            value="{{$setting->instagram ?? ''}}"
                            placeholder="{{$setting->instagram ?? 'Instagram (URL)'}}"
                        >
                    </div>
                    <div class="form-group col-md-3">
                        <label for="youtube">Youtube (URL)</label>
                        <input
                            id="youtube"
                            class="form-control"
                            type="text"
                            name="youtube"
                            value="{{$setting->youtube ?? ''}}"
                            placeholder="{{$setting->youtube ?? 'Youtube (URL)'}}"
                        >
                    </div>
                </div>

                <div class="row col-md-12">
                    <div class="form-group">
                        <label for="welcome_pic">Welcome Splash Image</label><br/>
                        <input accept="image/*" class="d-none" id="welcome_pic" type="file" name="welcome_pic">
                        <button class="btn btn-sm btn-info" id="welcome_picSelect" type="button">
                            @if(!!$setting->welcome_pic) Change @else Select @endif Welcome Splash Image
                        </button>
                        <span class="text-info ml-3">Max size: 10MB</span>
                    </div>
                    <br>
                    <div class="welcome_pic-placeholder py-3" id="welcome_pic-placeholder">
                        <img
                            src="@if(!!$setting->welcome_pic) /images/{{ $setting->welcome_pic }} @endif"
                            alt="Welcome Splash Image"
                            class="@if(!$setting->welcome_pic) d-none @endif"
                        >
                    </div>
                </div>


                <div>
                    <button class="btn btn-sm btn-success" type="submit" id="saveSetting">Save</button>
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

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <h3 class="card-title" style="flex: 1;">Useful Links</h3>
                    <div class="text-right align-content-end">
                        <a href="{{route('useful-link-create')}}" class="btn btn-sm btn-info">Add new</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Title</th>
                        <th>Link</th>
                        <th>Target</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $count = 0;
                    @endphp
                    @if($links->count() > 0)
                        @foreach($links as $link)
                            @php
                                $count++;
                            @endphp
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ ucwords($link->title) }}</td>
                                <td>
                                    <a href="{{ $link->url }}"
                                       target="_blank">{{ $link->url }}</a>
{{--                                    {{ config('app.front_url') }}--}}
                                </td>
                                <td>
                                    {{$link->target}}
                                </td>
                                <td class="text-center">
                                    <a href="{{route('useful-link-toggle-display',$link->id)}}" class="btn btn-sm btn-{{$link->status==1?'success':'danger'}}" title="Click to  {{$link->status==1?'hide':'show'}}">
                                        {{$link->status==1?'Shown':'Hidden'}}
                                    </a>
                                    <a href="{{ route('useful-link-edit',$link->id) }}" class="btn btn-sm btn-info">
                                        <i class="far fa-edit mr-1"></i>Edit</a>
                                    <a href="{{ route('useful-link-delete', $link->id) }}" class="btn btn-sm btn-danger"><i class="far fa-trash-alt mr-1"></i>Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Affiliates/Sponsors</h4>
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
        $('#welcome_picSelect').on('click', function () {
            $('#welcome_pic').click()
        });

        $('#logo').on('change', function (evt) {
            if (evt.target.files[0]) {
                var imgSrc = URL.createObjectURL(evt.target.files[0]);
                $('#logo-placeholder').find('img').removeClass('d-none').attr('src', imgSrc);
            }
        });
        $('#welcome_pic').on('change', function (evt) {
            if (evt.target.files[0]) {
                var imgSrc = URL.createObjectURL(evt.target.files[0]);
                $('#welcome_pic-placeholder').find('img').removeClass('d-none').attr('src', imgSrc);
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
