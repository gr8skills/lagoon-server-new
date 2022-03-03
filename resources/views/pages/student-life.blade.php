@extends('layouts.master')

@section('page-title', 'Student Life')

@section('plugin-styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@stop

@section('page-styles')
@stop

@section('content-header', 'Delete')

@section('content')
    <div class="row" id="">
        <div class="col-12 col-sm-6 offset-sm-3 col-md-4 offset-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Delete model</h3>
                </div>

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Preview Link</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @if($pages->count() > 0)
                            @foreach($pages as $page)
                                @php
                                    $count++;
                                @endphp
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ ucwords($page->title) }}</td>
                                    <td>
                                        <a href="{{ getenv('LIVE_URL') }}{{ $page->path }}"
                                           target="_blank">{{getenv('LIVE_URL')}}{{ $page->path }}</a>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('page-edit', $page->slug) }}" class="btn btn-sm btn-info @if($page->completed === 1) disabled @endif">
                                            <i class="far fa-edit mr-1"></i>Edit</a>
                                        {{--                                        <a href="{{ route('page-delete', $page->slug) }}" class="btn btn-sm btn-danger"><i class="far fa-trash-alt mr-1"></i>Delete</a>--}}
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
@stop

@section('page-plugin')
@stop

@section('page-scripts')
@endsection
