@extends('layouts.master')

@section('page-title', 'Home')

@section('plugin-styles')

@stop

@section('page-styles')
    <style>
        .slide-card {
            width: 320px;
            height: 123px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0;
            margin-bottom: 10px;
            overflow: hidden;
            transform: translateY(5px);
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            display: flex;
            justify-content: center;
            align: center;
        }

        .slide-card:hover {
            transform: translateY(0px);
        }

        #btn-delete {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        #btn-delete:hover {
            opacity: 0.8;
        }

    </style>
@stop

@section('content-header', 'Home Page')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-uppercase">Slider images</h3>
                        <a href="{{ route('slide-create') }}" class="btn btn-sm btn-primary">Add New</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row flex-md-wrap ">
                        @if ($slideImages->count() > 0)
                            @foreach ($slideImages as $slide)
                                <div class="slide-card mr-sm-3"
                                    style="background: url({{ asset('/images/' . $slide->image_path) }}) center/cover no-repeat padding-box">
                                    <button type="button" class="btn btn-danger" id="btn-delete" data-toggle="modal"
                                        data-target="#deleteModal" data-slide="{{ $slide->id }}">
                                        Delete
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="d-flex justify-content-center w-100">
                                <div class="alert alert-warning">
                                    <p class="text-center p-0 m-0">No slide images found.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('home-page-update-one') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 row">
                            <div class="form-group col-md-4">
                                <label for="Heading">Heading</label>
                                <input
                                    id="Heading"
                                    class="form-control"
                                    type="text"
                                    name="Heading"
                                    value="{{$message->Heading ?? ''}}"
                                    placeholder="{{$message->Heading ?? 'Heading'}}"
                                >
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Paragraph1">Paragraph</label>
                                <textarea id="summernote" name="Paragraph1" class="editor-height" placeholder="{{$message->Paragraph1 ?? 'Paragraph'}}"></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="Button">Button</label>
                                <input
                                    id="Button"
                                    class="form-control"
                                    type="text"
                                    name="Button"
                                    value="{{$message->Button ?? ''}}"
                                    placeholder="{{$message->Button ?? 'Button'}}"
                                >
                            </div>
                        </div>
                        <div class="row col-md-12">
                            <div class="form-group col-md-4">
                                <label for="link">Link</label>
                                <input
                                    id="link"
                                    class="form-control"
                                    type="text"
                                    name="link"
                                    value="{{$message->link ?? ''}}"
                                    placeholder="{{$message->link ?? 'Link'}}"
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
                <div class="card-header">
                    <div class="d-flex">
                        <h3 class="card-title" style="flex: 1; font-weight: bold">Explore More</h3>
                        <div class="text-right align-content-end">
                            <a href="{{route('explore-more-create')}}" class="btn btn-sm btn-info">Add new</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Section</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @if(sizeof($explore) > 0)
                            @foreach($explore as $link)
                                @php
                                    $count++;
                                @endphp
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{ ucwords($link['section']) }}</td>
                                    <td>{{ ucwords($link['receipt']) }}</td>
                                    <td>
                                        <a href="{{ substr_replace(config('app.front_url') ,"",-1) }}{{ $link['link'] }}"
                                           target="_blank">{{ substr_replace(config('app.front_url') ,"",-1) }}{{ $link['link'] }}</a>
                                    </td>
                                    <td>
                                        {{$link['position']}}
                                    </td>
                                    <td>
                                        <a href="{{route('landing-explore-more-toggle-display',$link['id'])}}" class="btn btn-sm btn-{{$link['status']==1?'success':'danger'}}" title="Click to  {{$link['status']==1?'Deactivate':'Activate'}}">
                                            {{$link['status']==1?'Active':'Inactive'}}
                                        </a>
                                    </td>
                                    <td class="text-center">

                                        <a href="{{ route('explore-more-edit',$link['id']) }}" class="btn btn-sm btn-info">
                                            <i class="far fa-edit mr-1"></i>Edit</a>
                                        <a href="{{ route('explore-more-delete', $link['id']) }}" class="btn btn-sm btn-danger"><i class="far fa-trash-alt mr-1"></i>Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h3 class="card-title" style="flex: 1; font-weight: bold">Mission, Vision & Core Values</h3>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Value</th>
{{--                            <th>Actions</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @if(sizeof($mission) > 0)
                            @foreach($mission as $link)
                                @php
                                    $count++;
                                @endphp
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{ ucwords($link->title) }}</td>
                                    <td style="width: 90%">
{{--                                        <input--}}
{{--                                            id="Paragraph1"--}}
{{--                                            class="form-control"--}}
{{--                                            type="text"--}}
{{--                                            name="Paragraph1"--}}
{{--                                            value="{{$link->description ?? ''}}"--}}
{{--                                            placeholder="{{$link->description ?? 'Text'}}"--}}
{{--                                        >--}}
                                        <div class="col-md-12">
                                            {{$link->description ?? ''}}
                                        </div>
                                    </td>
                                    <td class="text-center">

                                        <a href="{{ route('mission-edit',$link->id) }}" class="btn btn-sm btn-info">
                                            <i class="far fa-edit mr-1"></i>Edit</a>
                                        @if($link->id>3)
                                            <a href="{{ route('mission-delete', $link->id) }}" class="btn btn-sm btn-danger"><i class="far fa-trash-alt mr-1"></i>Delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row col-md-12">
                <div class="card col-md-8">
                    <div class="card-header">
                        <div class="d-flex">
                            <h3 class="card-title" style="flex: 1; font-weight: bold">News & Articles</h3>
                            <div class="text-right align-content-end">
                                <a href="{{route('news-article-create')}}" class="btn btn-sm btn-info">Add new</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Ceremony</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @if($news->count() > 0)
                                @foreach($news as $link)
                                    @php
                                        $count++;
                                    @endphp
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{ ucwords($link['header']) }}</td>
                                        <td>{{ ucwords($link['date']) }}</td>
                                        <td>{{ ucwords($link['ceremony']) }}</td>
                                        <td>
                                            {{$link['position']}}
                                        </td>
                                        <td>
                                            <a href="{{route('landing-news-article-toggle-display',$link['id'])}}" class="btn btn-xs btn-{{$link['status']==1?'success':'danger'}}" title="Click to  {{$link['status']==1?'Deactivate':'Activate'}}">
                                                {{$link['status']==1?'Active':'Inactive'}}
                                            </a>
                                        </td>
                                        <td class="text-center">

                                            <a href="{{ route('news-article-edit',$link['id']) }}" class="btn btn-xs btn-info">
                                                <i class="far fa-edit mr-1"></i>Edit</a>
                                             <a href="{{ route('news-article-delete', $link['id']) }}" class="btn btn-xs btn-danger"><i class="far fa-trash-alt mr-1"></i>Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card col-md-4">
                    <div class="card-header">
                        <div class="d-flex">
                            <h3 class="card-title" style="flex: 1; font-weight: bold">Upcoming Events</h3>
                            <div class="text-right align-content-end">
                                <a href="{{route('upcoming-event-create')}}" class="btn btn-xs btn-info">Add new</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-scrollable table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Event</th>
                                <th>Date</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count = 0;
                            @endphp
                            @if($event_dates->count() > 0)
                                @foreach($event_dates as $link)
                                    @php
                                        $count++;
                                    @endphp
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{ ucwords($link['ceremony']) }}</td>
                                        <td>{{ ucwords($link['date']) }}</td>
                                        <td>
                                            {{$link['position']}}
                                        </td>
                                        <td>
                                            <a href="{{route('calendar-event-toggle-display',$link['id'])}}" class="btn btn-xs btn-{{$link['status']==1?'success':'danger'}}" title="Click to  {{$link['status']==1?'Deactivate':'Activate'}}">
                                                {{$link['status']==1?'Active':'Inactive'}}
                                            </a>
                                        </td>
                                        <td class="text-center">

                                            <a href="{{ route('upcoming-event-edit',$link['id']) }}" class="btn btn-xs btn-info">
                                                <i class="far fa-edit mr-1"></i>Edit</a>
                                            <a href="{{ route('upcoming-event-delete', $link['id']) }}" class="btn btn-xs btn-danger"><i class="far fa-trash-alt mr-1"></i>Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.modals.delete-modal')
@stop

@section('page-plugin')
@stop

@section('page-scripts')
    <script>
        var content = "{!! addcslashes($message->Paragraph1 ?? '', '"') !!}";
        $('#summernote').summernote('pasteHTML', content).addClass('editor-height');

        var request = undefined;

        $('#deleteModal').on('show.bs.modal', function(evt) {
            var button = $(evt.relatedTarget);
            var slideId = button.data('slide');
            var modal = $(this);
            modal.find('#modalTitle').text('slide image');
            modal.find('#modalPrompt').text('slide image');

            modal.find('#modalDeleteBtn').on('click', function(e) {
                e.preventDefault();

                if (request) request.abort();

                blockPage();

                request = $.ajax({
                    url: '/delete-slide/' + slideId,
                    type: 'DELETE',
                });

                request.done(function(resp, textStatus) {
                    unBlockPage();
                    // console.log(textStatus);
                    // return;

                    if (textStatus == 'success') {
                        button.closest('.slide-card').remove();
                        modal.modal('hide');
                        toastAlert('Slide image deleted successfully.', 'Success', 'success');
                    } else {
                        toastAlert('Something went wrong.', 'Error', 'error');
                    }

                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                });

                request.fail(function(jqXHR, textStatus, errorMessage) {
                    unBlockPage();
                    toastAlert('Something went wrong.', 'Error', 'error');
                });
            });
        });
    </script>
@endsection
