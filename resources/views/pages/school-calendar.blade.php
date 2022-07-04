@extends('layouts.master')

@section('page-title', 'School Calendar')

@section('plugin-styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@stop

@section('page-styles')
@stop

@section('content-header', 'School Calendar')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex float-right">
                        <h3 class="card-title">&nbsp;</h3>
                        <a class="btn btn-sm btn-success mr-2 " id="uploadButton"><i class="fa fa-upload"></i> Upload Events</a>
{{--                        <a class="btn btn-sm btn-warning mr-2" href="/calendar_sample.xlsx"><i class="fa fa-list"></i> Download Sample</a>--}}
                        <a class="btn btn-sm btn-info" href="{{route('upcoming-event-create')}}"><i class="fa fa-plus-circle"></i> Add Event</a>
                    </div>
                </div>
                <div class="card-body table-scrollable table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Event/Ceremony</th>
                            <th>Date</th>
{{--                            <th>Position</th>--}}
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
{{--                                    <td>--}}
{{--                                        {{$link['position']}}--}}
{{--                                    </td>--}}
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

    <div class="alert-container" id="alertDeleteNotFound">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Error!</h5>
            News not found
        </div>
    </div>

    <div class="alert-container" id="alertDeleteError">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Error!</h5>
            Unknown error occurred. Please try again.
        </div>
    </div>
    @include('includes.modals.upload-modal')
@stop

@section('page-plugin')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
@stop

@section('page-scripts')
    <script>
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#uploadButton').on('click', function (e) {
            var modalContainer = $('#uploadModal');
            modalContainer.find('#modalTitle').text('Calendar');
            modalContainer.modal('show');
        });
    </script>
@endsection
