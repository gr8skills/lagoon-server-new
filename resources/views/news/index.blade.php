@extends('layouts.master')

@section('page-title', 'News & Updates')

@section('plugin-styles')
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@stop

@section('page-styles')
@stop

@section('content-header', 'News & Updates')


@section('content')
<<<<<<< HEAD
    <div class="row" id="aboutPageList">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-capitalize">News and updates list</h3>
                        <a href="{{route('news-create')}}" class="btn btn-info btn-sm">
                            <i class="fas fa-plus mr-1"></i>Add news
                        </a>
                    </div>
                </div>

=======
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">&nbsp;</h3>
                        <a class="btn btn-sm btn-info" href="{{route('news-create')}}">Add News</a>
                    </div>
                </div>
>>>>>>> 05865883bc4cf7dd32d9bf0ae924679a11ca64fa
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
<<<<<<< HEAD
                            <th>Added on</th>
                            <th>Added by</th>
=======
                            <th>Link</th>
>>>>>>> 05865883bc4cf7dd32d9bf0ae924679a11ca64fa
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @if($news->count() > 0)
                            @foreach($news as $n)
                                @php
                                    $count++;
                                @endphp
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ ucwords($n->title) }}</td>
<<<<<<< HEAD
                                    <td>{{$n->created_at->toFormattedDateString()}}</td>
                                    <td>School Admin</td>
                                    <td class="text-right">
                                        <a href="{{getenv('LIVE_URL')}}about/school-news/{{$n->slug}}"
                                           class="btn btn-sm btn-info" target="_blank">
                                            <i class="far fa-eye mr-1"></i>Preview
                                        </a>
                                        <a href="{{ route('news-edit', $n->ref_id) }}" class="btn btn-sm btn-info">
                                            <i class="far fa-edit mr-1"></i>Edit
                                        </a>
                                        <button type="button" data-news="{{$n->ref_id}}"
                                           class="btn btn-sm btn-danger deleteNewsButton">
                                            <i class="far fa-trash-alt mr-1"></i>Delete
                                        </button>
=======
                                    <td>
                                        <a href="{{config('app.front_url')}}/news/{{$n->slug}}"
                                           target="_blank">{{$n->title}}</a>
                                    </td>
                                    <td class="text-right">
                                        <a href="{{route('news-edit', $n->slug)}}" class="btn btn-sm btn-info">
                                            <i class="far fa-edit mr-1"></i>Edit</a>
                                        <a href="{{route('news-delete', $n->slug)}}" class="btn btn-sm btn-danger">
                                            <i class="far fa-trash-alt mr-1"></i>Delete</a>
>>>>>>> 05865883bc4cf7dd32d9bf0ae924679a11ca64fa
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
<<<<<<< HEAD

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
    @include('includes.modals.delete-modal');
=======
>>>>>>> 05865883bc4cf7dd32d9bf0ae924679a11ca64fa
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
<<<<<<< HEAD

        $('.deleteNewsButton').each(function () {
            var btn = $(this);

            btn.on('click', function (e) {
                e.preventDefault();
                var newsRef = btn.data('news');

                var req = $.ajax({
                    url: `/news/${newsRef}`
                });

                req.done(function (res) {
                    console.log('res ', res);
                    if(res.data === null) {
                        $('#alertDeleteNotFound').addClass('shown');
                    }

                    if (res.data !== null) {
                        var modalContainer = $('#deleteModal');
                        modalContainer.find('#modalTitle').text('News');
                        modalContainer.find('#modalPrompt').text('news');
                        modalContainer.find('#modalDeleteBtn').attr('href', `/news/delete/${newsRef}`);
                        modalContainer.modal('show');
                    }
                });

                req.fail(function (_, __, msg) {
                    $('#alertDeleteError').addClass('shown');
                });
            });
        });
=======
>>>>>>> 05865883bc4cf7dd32d9bf0ae924679a11ca64fa
    </script>
@endsection
