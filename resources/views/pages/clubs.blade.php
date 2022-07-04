@extends('layouts.master')

@section('page-title', 'School Clubs')

@section('plugin-styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@stop

@section('page-styles')
@stop

@section('content-header', 'School Clubs')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">&nbsp;</h3>
                        <a class="btn btn-sm btn-info" href="{{route('club-create')}}">Add Q/A</a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Category</th>
{{--                            <th>Position</th>--}}
{{--                            <th>Status</th>--}}
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @if($clubs->count() > 0)
                            @foreach($clubs as $link)
                                @php
                                    $count++;
                                @endphp
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{ ucwords($link['name']) }}</td>
                                    <td>{{ ucwords($link['category']) }}</td>
{{--                                    <td>{{ ucwords($link['position']) }}</td>--}}
{{--                                    <td>--}}
{{--                                        <a href="{{route('questions-answer-toggle-display',$link['id'])}}" class="btn btn-xs btn-{{$link['status']==1?'success':'danger'}}" title="Click to  {{$link['status']==1?'Deactivate':'Activate'}}">--}}
{{--                                            {{$link['status']==1?'Active':'Inactive'}}--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
                                    <td class="text-center">

                                        <a href="{{ route('club-edit',$link['id']) }}" class="btn btn-xs btn-info">
                                            <i class="far fa-edit mr-1"></i>Edit</a>
                                        <a href="{{ route('club-delete', $link['id']) }}" class="btn btn-xs btn-danger"><i class="far fa-trash-alt mr-1"></i>Delete</a>
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
    @include('includes.modals.delete-modal')
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

        $('.deleteNewsButton').each(function () {
            var btn = $(this);

            btn.on('click', function (e) {
                e.preventDefault();
                var newsRef = btn.data('news');

                var req = $.ajax({
                    url: `/questions-answer/${newsRef}`
                });

                req.done(function (res) {
                    console.log('res ', res);
                    if(res.data === null) {
                        $('#alertDeleteNotFound').addClass('shown');
                    }

                    if (res.data !== null) {
                        var modalContainer = $('#deleteModal');
                        modalContainer.find('#modalTitle').text('Questions & Answer');
                        modalContainer.find('#modalPrompt').text('Q/A');
                        modalContainer.find('#modalDeleteBtn').attr('href', `/questions-answer/delete/${newsRef}`);
                        modalContainer.modal('show');
                    }
                });

                req.fail(function (_, __, msg) {
                    $('#alertDeleteError').addClass('shown');
                });
            });
        });
    </script>
@endsection
